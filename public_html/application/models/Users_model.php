<?php
class Users_model extends CI_Model {
    
    private $payments_table = "payments";
    
    function get_all_deposits(){
		$this->db->select('*');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->payments_table);
		return $query->result_array();
    }
    
    function get_all_deposits_2(){
		$mysqli = get_mysqli();
		$sql = "SELECT deposits2.*, clients.client_name FROM deposits2 LEFT JOIN clients ON clients.client_id = deposits2.user_id ORDER BY created_at DESC LIMIT 0, 1000";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$data = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			array_push($data, $row);
		}
        
        return $data;
    }
    
    
    function get_users(){
        $mysqli = get_mysqli();
		$sql = "SELECT clients.* FROM clients ORDER BY client_id DESC";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$data = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			array_push($data, $row);
		}
        
        return $data;
    }
    
    function get_user($user_id){
        $mysqli = get_mysqli();
		$sql = "SELECT clients.* FROM clients WHERE client_id=$user_id";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$data = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
		    $data = $row;
		}
        
        return $data;
    }
    
    function update_details($post){
        $client_id = $post["client_id"];
        $user_name = $post["user_name"];
        $balance = $post["balance"];
        $status = $post["status"];
        
        $mysqli = get_mysqli();
		$sql = "UPDATE clients SET client_name='$user_name', client_wallet_bal=$balance WHERE client_id = $client_id";
		
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']=>'.$sql);
        }
        
        return 'done';
        
    }
    
    function update_password($post){
        $client_id = $post["client_id"];
        $password = $post["password"];
        
        if(strlen($password)<4){
            return 'Password Should be atleast 4 characters';
        }
        
        $user_password = password_hash($password, PASSWORD_DEFAULT);
        
        
        
        $mysqli = get_mysqli();
		$sql = "UPDATE clients SET client_password='$user_password' WHERE client_id = $client_id";
		
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']=>'.$sql);
        }
        
        return $sms_status;
        
    }
    
	function get_user_deposits($user_id){
		$mysqli = get_mysqli();
		$sql = "SELECT deposits2.*, clients.client_name FROM deposits2 LEFT JOIN clients ON clients.client_id = deposits2.user_id  WHERE user_id = $user_id ORDER BY created_at DESC";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$data = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			array_push($data, $row);
		}
        
        return $data;
	}
	
	
	function get_latest_deposits(){
		$mysqli = get_mysqli();
		$sql = "SELECT deposits.*, clients.client_name FROM deposits LEFT JOIN clients ON clients.client_id = deposits.user_id  WHERE status_id = 2 ORDER BY created_at DESC LIMIT 0, 10";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$data = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			array_push($data, $row);
		}
        
        return $data;
	}
	
	function get_deposit_count($status){
	    $mysqli = get_mysqli();
		$sql = "SELECT COUNT(deposits.id) as count FROM deposits  WHERE status_id = $status";
       
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
		$sql = "SELECT SUM(deposits.amount) as amount FROM deposits  WHERE status_id = $status";
       
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

}

?>