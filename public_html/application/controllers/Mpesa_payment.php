
<?php

use GuzzleHttp\Client;

class Mpesa_payment extends CI_Controller {

	private $consumer_key;
	private $consumer_secret;
	private $endpoint;
	private $mpesa_express_endpoint = "https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest"; //https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest
	private $token_endpoint = "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
	private $passKey;
	private $partyB;
	private $businessShortCode; // Can be the business store number
	private $transactionType = "CustomerPayBillOnline";
	private $callBackUrl ="https://spin-wingame.com/callback_response";
	private $accountBalanceUrl = "https://api.safaricom.co.ke/mpesa/accountbalance/v1/query";
	private $accountReference;
	private $transactionDesc = "Adding money to my wallet";
	private $stkQueryEndpoint = "https://api.safaricom.co.ke/mpesa/stkpushquery/v1/query"; //https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query
	private $payments_table = "payments";
	
    // Safaricom Simulation and registration endpoints
    private $registerURLsEndpoint = "https://api.safaricom.co.ke/mpesa/c2b/v2/registerurl";
    // private $shortCode = 600247;
    private $confirmationUrl = "https://spin-wingame.com/payments/confirmation";
    private $validationUrl = "https://spin-wingame.com/payments/validation";
    private $timeoutMessage = "https://spin-wingame.com/accounts/message";
    private $accountBalanceResultUrl = "https://spin-wingame.com/accounts/confirmation";

	function __construct()
	{
		parent::__construct();
		$this->load->model(["Mpesa_model", "Admin_dashboard_model"]);
		$this->load->config('mpesa');
		$this->consumer_key = $this->config->item('consumer_key');
		$this->consumer_secret = $this->config->item('consumer_secret');
		$this->passKey = $this->config->item('passKey');
		$this->businessShortCode = $this->config->item('businessSortCode');
		$this->accountReference = $this->config->item('accountReference');
		$this->partyB = $this->config->item('partyB');
	}

	function index() {
		$settingsArray = [
			'consumer_key' => $this->consumer_key,
			'consumerSecret' => $this->consumer_secret,
			'passKey' => $this->passKey,
			'businessShortCode' => $this->businessShortCode,
			'accountReference' => $this->accountReference,
			'partyB' => $this->partyB,
			'token' => $this->get_mpesa_access_token(),
			'stats' => $this->Admin_dashboard_model->get_dashbord_stats(),
		];
		echo json_encode($settingsArray);
	}
	
	public function checkAccountBalance() {
        $access_token = $this->get_mpesa_access_token();
        $response = $this->makeAccountBalanceRequest($access_token);
        
        $data = json_decode($response);
        echo json_encode($data);
        
        if ($data && isset($data->AccountBalance)) {
            $balance = $data->AccountBalance;
            echo json_encode(["status" => "success", "data" => $balance, "message" => "Account Balance Retrievied Successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to retrieve account balance."]);
        }
    }
    
    private function makeAccountBalanceRequest($access_token) {
        $url = $this->accountBalanceUrl;
        $timestamp = date('YmdHis');
        $payload = array(
            'Initiator' => 'INKWELL DIGITAL CONCEPTS',
            'SecurityCredential' => base64_encode($this->businessShortCode.$this->passKey.$timestamp),
            'CommandID' => 'AccountBalance',
            'PartyA' => $this->businessShortCode,
            'IdentifierType' => '4',
            'Remarks' => 'ok',
            'QueueTimeOutURL' => $this->timeoutMessage,
            'ResultURL' => $this->accountBalanceResultUrl,
        );
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $access_token,
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        
        $response = curl_exec($ch);
        
        curl_close($ch);
        
        return $response;
    }
    
    public function getAccountBalance() {
        $data = file_get_contents("php://input");
		$response = json_decode($data, true);
		
		// Write File to logs
        $timestamp = time(); // Get the current Unix timestamp
        $filePath = 'logs/mpesa/bal-' . $timestamp . '.json';
        $fileContents = json_encode($response);
        $fileContents = utf8_encode($fileContents);
        file_put_contents($filePath, $fileContents);
    }
    
    public function getMpesaBalanceErrorMessage() {
        $data = file_get_contents("php://input");
		$response = json_decode($data, true);
		
		// Write File to logs
        $timestamp = time(); // Get the current Unix timestamp
        $filePath = 'logs/mpesa/balError-' . $timestamp . '.json';
        $fileContents = json_encode($response);
        $fileContents = utf8_encode($fileContents);
        file_put_contents($filePath, $fileContents);
    }
	
	function initiate_stk_pusher() {
		$token = $this->get_mpesa_access_token();
		$amount = $this->input->post('amount');
		$customer_phone_number = $this->input->post('phone_number');
// 		$amount = 1;
// 		$customer_phone_number = 'Enter your phone number';
		$result = $this->push_stk($token, $customer_phone_number, $amount);
		// Return response 
		$response = [
			'status' => 'success',
			'message' => $result['message'],
			'CheckoutRequestID' => $result['CheckoutRequestID'],
		];
		echo json_encode($response);
	}

	function push_stk($token, $phone, $amount)
	{
		$phone = substr_replace($phone, "254", 0, 1);
		$phone_number = $phone;
		$timestamp = date('YmdHis');
		$partyA = $phone_number;
		$partyB = $this->partyB;
		$password = base64_encode($this->businessShortCode.$this->passKey.$timestamp);
		$datapayload = [
			'BusinessShortCode' => $this->businessShortCode,
			'Password' => $password,
			'Timestamp' => $timestamp,
			'TransactionType' => $this->transactionType,
			'Amount' => $amount,
			'PartyA' => $partyA,
			'PartyB' => $partyB,
			'PhoneNumber' => $phone_number,
			'CallBackURL' => $this->callBackUrl,
			'AccountReference' => $this->accountReference,
			'TransactionDesc' => $this->transactionDesc
		];

		$res = $this->getCurlSetting($this->mpesa_express_endpoint, $datapayload, $token);
		$response = json_decode($res);
		$responseCode = $response->ResponseCode;
		if ($responseCode == 0) { // The request was successful
			$merchantRequestID = $response->MerchantRequestID;
            $checkoutRequestID = $response->CheckoutRequestID;
            $customerMessage = $response->CustomerMessage;
			$paymentData = array(
				// 'id' => $this->generate_transaction_number(),
				'phone_number' => $phone,
				'amount' => $amount,
				'account_reference' => $this->accountReference,
				'response_description' => $this->transactionDesc,
				'merchant_request_id' => $merchantRequestID,
				'checkout_request_id' => $checkoutRequestID,
				'customer_message' => "Requested",
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Mpesa_model->save_payment_details((array)$paymentData);
			
			$responseReturn = array(
				'message' => $customerMessage,
				'CheckoutRequestID' => $checkoutRequestID
			);
			
			return $responseReturn;
		} else {
			return "Request was unable to be completed";
		}
	}
	
    // 	This function checks if the payment was successfully made
	function checkForSuccessfullPayment($checkoutRequestID)
	{
	    $this->Mpesa_model->check_for_successfull_payment($checkoutRequestID);
	}

	// get STK Callback after the payment has been processed from safaricom
	function stk_callback() 
	{
	   
		$data = file_get_contents("php://input");
		$response = json_decode($data, true);
		$this->Mpesa_model->update_payment_details($response);
	}

	// Check if the payment was successfull or not
	public function validate_payment(){
		$checkoutRequestID = $this->input->post('CheckoutRequestID');
	    $query = $this->db->get_where('payments', array('checkout_request_id' => $checkoutRequestID))->row();
	    if (!empty($query)) {
	        $customerMessage = $query->customer_message;
	        if ($customerMessage == 'Paid') {
	            $returnRes = array(
					'status' => 'success',
					'message' => 'Payment made successfully',
					'status_code' => 1
				);
				echo json_encode($returnRes);
	        } else {
	            $returnRes = array(
					'status' => 'error',
					'message' => 'Payment was unsuccessfully',
					'status_code' => -1
				);
				echo json_encode($returnRes);
	        }
	    }
    }

	// Calculate the amount to update the client's wallet
	function update_users_wallet($phone, $amount) 
	{
		$this->Mpesa_model->calculate_amount($phone, $amount);
	}
	
    // Register Safaricom callback urls 	
	function register_url() 
	{
		$accessToken = $this->get_mpesa_access_token();
		
        $url = $this->registerURLsEndpoint;
        $shortCode = $this->businessShortCode;
        $responseType = "Completed";
        $confirmationUrl = $this->confirmationUrl;
        $validationUrl = $this->validationUrl;

		$payloadData = array(
			'ShortCode' => $shortCode,
            'ResponseType' => $responseType,
            'ConfirmationURL' => $confirmationUrl,
            'ValidationURL' => $validationUrl
		);
		
// 		print_r($payloadData);
// 		die();
		
		$response = $this->getCurlSetting($url, $payloadData, $accessToken);

        echo json_encode($response);
	}
	
	// Safaricom Validation methods
	function validation()
    {
        $data = file_get_contents("php://input");
    
        // // Validation logic 
        $response = json_decode($data,true);
        $phoneNumber = "0".substr($response['BillRefNumber'], -9);
        $customerDetails = $this->db->get_where('clients', array('client_phone_num' => $phoneNumber)); 
        
        if (!empty($customerDetails->row())) { // Phone number matches one in records
            // Success message
            return json_encode([
                'ResultCode' => 0,
                'ResultDesc' => 'Accepted'
            ]);
        } else { // phone number do not match one in records
            // Rejected Response
            return json_encode([
                'ResultCode' => 'C2B00012',
                'ResultDesc' => 'Rejected'
            ]);
        }
        
		
    }
    
    // This method will be hit by a call back from safaricom
    public function confirmation()
    {
        $data = file_get_contents("php://input");

        $response = json_decode($data, true);
		$this->Mpesa_model->save_confirmation_data($response);
    }

	function generate_transaction_number()
    {
        // Get the last waybill number
        $this->db->select('id');
        $this->db->from($this->payments_table);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $last_waybill = $query->row()->waybill_number;
            $last_four_digits = substr($last_waybill, -4);
            $last_four_digits = (int) $last_four_digits;
            $last_four_digits = $last_four_digits + 1;
            $last_four_digits = (string) $last_four_digits;
            $last_four_digits_length = strlen($last_four_digits);
            if ($last_four_digits_length < 4) {
                $diff = 4 - $last_four_digits_length;
                for ($i = 0; $i < $diff; $i++) {
                    $last_four_digits = '0' . $last_four_digits;
                }
            }
            $first_four_digits = substr($last_waybill, 0, 4);
            $waybill = $first_four_digits . $last_four_digits;
            return $waybill;
        } else {
            return '10000001';
        }
	}

	//initializing curl
	function getCurlSetting($url, $curldata, $token)
	{
		$url = $url;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$token));
		$dataString = json_encode($curldata);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
	
		$response = curl_exec($curl);
		$error = curl_error($curl);
		if ($error) {
			return $error;
		} else {
			return $response;
		}
	}

    
    public function get_mpesa_access_token()
   {
       $url = $this->token_endpoint;
       $curl = curl_init();
       curl_setopt($curl, CURLOPT_URL, $url);
       $credentials = base64_encode($this->consumer_key.':'.$this->consumer_secret);

      //setting a custom header      
       curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
       curl_setopt($curl, CURLOPT_HEADER, false);
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
       
       $curl_response = curl_exec($curl);

       return json_decode($curl_response)->access_token;       
    }
}
