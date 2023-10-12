<?php

class Mpesa_model extends CI_Model {
    
	private $payments_table = 'payments';
	private $clients_table = 'clients';
	private $mpesa_settings_table = 'mpesa_settings';
	private $offline_payments_table = 'offline_payments';

	function save_payment_details($paymentData) {
		$this->db->insert($this->payments_table, $paymentData);
		return true;
	}
	
	function check_for_successfull_payment($checkoutRequestId)
	{
	    $this->db->select("*");
	    $this->db->where('checkout_request_id', $checkoutRequestId);
	    $query = $this->db->get();
	    
	    if ($query->num_rows() > 0 && !empty($query->row()->mpesa_recipt_number)) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function update_payment_details($response) {
	   // print_r($response);
		$ResultCode = $response["Body"]["stkCallback"]["ResultCode"];
		$merchantRequestID = $response["Body"]["stkCallback"]["MerchantRequestID"];
		$checkoutRequestID = $response["Body"]["stkCallback"]["CheckoutRequestID"];
		$resultDescription = $response["Body"]["stkCallback"]["ResultDesc"];
		$amount = $response["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"];
		$mpesaReciptNumber = $response["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"];
		// $Balance = $response->Body->stkCallBack->CallbackMetadata->Item[2]->Value;
		$transactionDate = $response["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"];
		$phoneNumber = $response["Body"]["stkCallback"]["CallbackMetadata"]["Item"][4]["Value"];
		
		if ($phone = $this->getCustomerPhone($checkoutRequestID)) {
            if ($ResultCode == 0 && !empty($mpesaReciptNumber)) {
                $this->update_details("Paid", $checkoutRequestID, $resultDescription, $transactionDate, $merchantRequestID, $amount, $mpesaReciptNumber, $phone);
            } else {
                $this->update_details("Failed", $checkoutRequestID, $resultDescription, $transactionDate);
            }
        } else {
            return;
        }
		
	}
	
    // This method gets the customers phone number from the payments table
	function getCustomerPhone($checkoutRequestId)
	{
	    $this->db->select("*");
	    $this->db->where('checkout_request_id', $checkoutRequestId);
	    $query = $this->db->get('payments');
	    
	    if (!empty($query->row())) {
	        return "0".substr($query->row()->phone_number, -9);
	    } else {
	        return false;
	    }
	}

    // This function updats the database with data from the callback url
	function update_details($payment_status, $checkoutRequestID, $resultDescription, $transactionDate, $merchantRequestID="", $amount="", $mpesaReciptNumber="", $phoneNumber="")
	{
	    
		if (!empty($merchantRequestID) && !empty($mpesaReciptNumber)) {
		    
			$payloadData = array(
				'customer_message' => $payment_status,
				'merchant_request_id' => $merchantRequestID,
				'checkout_request_id' => $checkoutRequestID,
				'result_description' => $resultDescription,
				'amount' => $amount,
				'mpesa_recipt_number' => $mpesaReciptNumber,
				'transaction_date' => $transactionDate // date('Y-m-d H:i:s')
			);
			
			$this->db->select('*');
			$this->db->where('checkout_request_id', $checkoutRequestID);
			$this->db->update($this->payments_table, $payloadData);
			$this->calculate_amount("0".substr($phoneNumber, -9), $amount);
			
			$response = array(
			    'status' => 'paid',
			    'Message' => 'Wallet Credited Successfully',
			    'CheckoutRequestID' => $checkoutRequestID
			);
			return json_encode($response);
		} else {
			$payloadData = array(
				'customer_message' => $payment_status,
				'checkout_request_id' => $checkoutRequestID,
				'result_description' => $resultDescription,
				'amount' => $amount,
				'transaction_date' => $transactionDate
			);
			$this->db->select('*');
			$this->db->where('checkout_request_id', $checkoutRequestID);
			$this->db->update($this->payments_table, $payloadData);
			
			$response = array(
			    'status' => 'failed',
			    'Message' => 'Error processing payment',
			    'CheckoutRequestID' => $checkoutRequestID
			);
			return json_encode($response);
		}
	}

	function calculate_amount($phone, $amount)
	{
		// Get the customer form the clients table
		$this->db->select(['client_name', 'client_phone_num', 'client_wallet_bal']);
		$this->db->where('client_phone_num', $phone);
		$this->db->from($this->clients_table);
		$query = $this->db->get();
		if (!empty($query->row())) {
			$amount_in_account = $query->row()->client_wallet_bal;
			// Calculate the amount and update the wallet
			$totalAmount = $amount_in_account + $amount;
			// Update the clients table
			$this->db->where('client_phone_num', $phone);
			$this->db->update($this->clients_table, array('client_wallet_bal' => $totalAmount));
			return true;
		} else {
			return false;
		}
		
	}

	function update_payment($checkoutRequestID, $message, $code)
	{
		if ($code == 0) {
			$this->db->select('*');
			$this->db->where('checkout_request_id', $checkoutRequestID);
			$this->db->update($this->payments_table, array('customer_message' => 'Paid', 'result_description' => $message));
			return true;
		} else {
			$this->db->select('*');
			$this->db->where('checkout_request_id', $checkoutRequestID);
			$this->db->update($this->payments_table, array('customer_message' => 'Failed', 'result_description' => $message));
			return true;
		}
	}

	function update_mpesa_settings($payloadData) 
	{
		$this->db->select('*');
		$this->db->where('id', 1);
		$this->db->update($this->mpesa_settings_table, $payloadData);
		return true;

	}
	
	function save_confirmation_data($payload)
	{
	    if (!empty($payload)) {
    		// Save data to the database
            $TransactionType = $payload['TransactionType'];
            $TransID = $payload['TransID'];
            $TransTime = $payload['TransTime'];
            $TransAmount = $payload['TransAmount'];
            $BusinessShortCode = $payload['BusinessShortCode'];
            $BillRefNumber = $payload['BillRefNumber'];
            $InvoiceNumbe = $payload['InvoiceNumber'];
            $OrgAccountBalance = $payload['OrgAccountBalance'];
            $ThirdPartyTransID = $payload['ThirdPartyTransID'];
            $MSISDN = $payload['MSISDN'];
            $FirstName = $payload['FirstName'];
    
            $C2bData = array();
            $C2bData['TransactionType'] = $TransactionType;
            $C2bData['TransID'] = $TransID;
            $C2bData['TransTime'] = $TransTime;
            $C2bData['TransAmount'] = $TransAmount;
            $C2bData['BusinessShortCode'] = $BusinessShortCode;
            $C2bData['BillRefNumber'] = $BillRefNumber;
            $C2bData['InvoiceNumbe'] = $InvoiceNumbe;
            $C2bData['OrgAccountBalance'] = $OrgAccountBalance;
            $C2bData['ThirdPartyTransID'] = $ThirdPartyTransID;
            $C2bData['MSISDN'] = $MSISDN;
            $C2bData['FirstName'] = $FirstName;
            
            // Write File to logs
            $filePath = 'logs/'.$TransTime.'.json';
            $fileContents = json_encode($payload);
            $fileContents = utf8_encode($fileContents);
            file_put_contents($filePath, $fileContents);
           
            $this->db->insert($this->offline_payments_table, $C2bData);
            
            $this->calculate_amount($BillRefNumber, $TransAmount);
            
            $resultArray=[
                "ResultDesc"=>"Confirmation Service request accepted successfully",
                "ResultCode"=>"0"
            ];
            
            header('Content-Type: application/json');

            echo json_encode($resultArray);
            
	    } else {
	       $resultArray=[
                "ResultDesc"=>"Confirmation Service not accepted",
                "ResultCode"=>"1"
            ];
            
            header('Content-Type: application/json');

            echo json_encode($resultArray);
	    }
	}
}
