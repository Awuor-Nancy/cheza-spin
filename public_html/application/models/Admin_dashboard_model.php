<?php
class Admin_dashboard_model extends CI_Model {
    
    private $payments_table = "payments";
    private $offline_payment_table = "offline_payments";
    
    function get_dashbord_stats(): array
    {
        $completePayment = 0;
        $incompletePayment = 0;
        $offlinePayment = 0;
        // Get all complete payments from the databse 
        $this->db->select('amount');
        $this->db->where('customer_message', 'Paid'); // Paid
        $query = $this->db->get($this->payments_table);
        if ($query->num_rows() > 0) {
            // Data found in the database
            $payments = $query->result();
            $filteredAmount = $this->get_amounts($payments);
            $completePayment = array_sum($filteredAmount);
        }
        // Get all incomplete diposits from the database
        $this->db->select('amount');
        $this->db->where('customer_message', 'Requested'); // Requested
        $query = $this->db->get($this->payments_table);
        if ($query->num_rows() > 0) {
            // Data found in the database
            $payments = $query->result();
            $filteredAmount = $this->get_amounts($payments);
            $incompletePayment = array_sum($filteredAmount);
        }
        // Get all complete offline payments from the databse 
        $this->db->select('TransAmount');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->offline_payment_table);
        if ($query->num_rows() > 0) {
            // Data found in the database
            $payments = $query->result();
            $filteredAmount = $this->get_offline_amounts($payments);
            $offlinePayment = array_sum($filteredAmount);
        }
        
        $statsData = array(
            "incompletePayment" => $incompletePayment,
            "completePayment" => $completePayment,
            "offlinePayment" => $offlinePayment
        );
        return $statsData;
    }
    
    function get_amounts($amounts):array
    {
        $amount = [];
        foreach($amounts as $amt):
            $amountz = $amt->amount;
            array_push($amount, $amountz);
        endforeach;
        return $amount;
    }
    
    function get_offline_amounts($amounts):array
    {
        $amount = [];
        foreach($amounts as $amt):
            $amountz = $amt->TransAmount;
            array_push($amount, $amountz);
        endforeach;
        return $amount;
    }
    
	function get_latest_deposits() :array {
	    $this->db->select('*');
	    $this->db->where('customer_message', 'Paid');
	    $this->db->order_by('created_at', 'DESC');
	    $this->db->limit(10);
	    $query = $this->db->get($this->payments_table);
	    if ($query->num_rows() > 0) {
	        return $query->result_array();
	    } else {
	        return [];
	    }
	}
	
	// Get the offline Payments
	function get_latest_offline_deposits() :array {
	    $this->db->select('*');
	    $this->db->order_by('created_at', 'DESC');
	    $this->db->limit(10);
	    $query = $this->db->get($this->offline_payment_table);
	    if ($query->num_rows() > 0) {
	        return $query->result_array();
	    } else {
	        return [];
	    }
	}
	
	function get_deposit_count($status){
	    $mysqli = get_mysqli();
		$sql = "SELECT COUNT(deposits2.id) as count FROM deposits2  WHERE status_id = $status";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$data = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$data[] = $row;
		}
        
        return $data;
	}
	
	
	function get_deposit_total($status){
	    $mysqli = get_mysqli();
		$sql = "SELECT SUM(deposits2.amount) as amount FROM deposits2  WHERE status_id = $status";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$data = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$data[] = $row;
		}
        
        return $data;
	}
	
	function get_total_users(){
	     $mysqli = get_mysqli();
		$sql = "SELECT COUNT(clients.client_id) as count FROM clients";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$data = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$data[] = $row;
		}
        
        return $data;
	}
	
	function get_suspicious_spins(){
	     $mysqli = get_mysqli();
		$sql = "SELECT COUNT(suspicious_spins.id) as count FROM suspicious_spins";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$data = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$data[] = $row;
		}
        
        return $data;
	}
	
	function get_admin_email(){
	    $mysqli = get_mysqli();
		$sql = "SELECT admin_email from admin WHERE 1";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$data = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$data[] = $row;
		}
        
        return $data;
	}

}

?>
