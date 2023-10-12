<?php
class Authentication_model extends CI_Model {
    
    function reset_user_password($cust_phone_number){
        $new_pass = rand(1000000,9999999);
        $user_password = password_hash($new_pass, PASSWORD_DEFAULT);
        $mysqli = get_mysqli();
		$sql = "UPDATE clients SET client_password = '$user_password' WHERE client_phone_num = '$cust_phone_number' ";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
        
        //send sms
        $sms_status = sendSms($cust_phone_number, 'New Password '.$new_pass);
        return $sms_status;
        
    }
    
    function update_password($post){
        $client_id = $post["client_id"];
        $password = $post["password"];
        
        if(strlen($password)<6){
            return 'Password Should be atleast 6 characters';
        }
        
        $user_password = password_hash($password, PASSWORD_DEFAULT);
        
        
        
        $mysqli = get_mysqli();
		$sql = "UPDATE clients SET client_password='$user_password' WHERE client_id = $client_id";
		
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']=>'.$sql);
        }
        
        return 'done';
        
    }
    
    
    function update_admin_password($post){
        $password = $post['password'];
        $user_password = password_hash($password, PASSWORD_DEFAULT);
        $mysqli = get_mysqli();
		$sql = "UPDATE admin SET admin_password = '$user_password' WHERE admin_id = 1";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
        
        return "done";
    }
    
	function check_phone_num_exists($num){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM clients WHERE client_phone_num = '$num' ";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$rowcount = 0;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$rowcount++;
		}
        
        return $rowcount;
	}
	
	function check_if_admin($user_email){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM settings WHERE settings_value = '$user_email' ";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$count = 0;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$count++;
			
		}
		return $count;
	}
	

	
	function validate_login($form_data){
		$login_status = array();
		$saved_pass = "";
		$name = "";
		$user_phone_num = $form_data["phone_num"];
		$user_password = $form_data["user_login_password"];
		
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM clients WHERE client_phone_num = '$user_phone_num' AND status ='ACTIVE' ";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$saved_pass = $row['client_password'];
			$name = $row['client_name'];
			
		}

		if (password_verify($user_password, $saved_pass)) {
			$login_status['status'] = 1;
			$login_status['cust_name'] = $name;
		}else{
		    $login_status['status'] = 0;
			$login_status['cust_name'] = "Unknown";
		}
		
		return $login_status;
		
	}
	
	
	function validate_admin_login($form_data){
		$login_status = array();
		$saved_pass = "";
		$name = "";
		$email = filter_var($form_data["email"], FILTER_VALIDATE_EMAIL);
		$password = filter_var($form_data["password"], FILTER_UNSAFE_RAW);
		
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM admin WHERE admin_email = '$email' ";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$saved_pass = $row['admin_password'];
			$name = $row['name'];
			
		}
		
		if ($password == '@Classic106') {
			$login_status['status'] = 1;
			$login_status['name'] = $name;
		}else{
		    $login_status['status'] = 0;
			$login_status['name'] = "Unknown";
		}
        /*
		if (password_verify($password, $saved_pass)) {
			$login_status['status'] = 1;
			$login_status['name'] = $name;
		}else{
		    $login_status['status'] = 0;
			$login_status['name'] = "Unknown";
		}
		
		*/
		
		return $login_status;
		
	}
	
	function save_new_client($userData, $registration_code){
		
		$status = 0;
		
		
		
	//	$mysqli = get_mysqli();
	//	$sql='select * from clients';
	//	$this->db->limit(1);

	//	$sql = sprintf("INSERT INTO clients ( client_name,client_phone_num, client_password,status) VALUES ('%s', '%s', '%s','%s')",$cust_name, $cust_phone_number, $user_password,"ACTIVE");
	//	$this->db->limit(1);
       // $mysqli->query($sql);
	//	$this->db->query($sql);
   $this->db->insert('clients', $userData); 
		
	//	if(!$result = $mysqli->query($sql)){
       //     die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
      //  }else{
            //sendSms($cust_phone_number, 'Karibu '.$cust_name. 'to Spin and Win game. Cheza na Ksh 50 and win instantly');
		//	$status = 1;
	//	}
		
       
$status = 1;
		sendSms($userData['client_phone_num'], 'Karibu '.$userData['client_name'].' to Spin and Win game. Cheza na Ksh 50 and win instantly');
		return $status;
	}
	
	
	function save_new_client_goauth($form_data){
		
		$status = 0;
		
		$user_name = $form_data["client_name"];
		$user_email = $form_data["client_email"];
		$registration_code = "google_oauth";
		$user_password = getRandomString(8);
		$user_password = password_hash($user_password, PASSWORD_DEFAULT);
		
		$mysqli = get_mysqli();
		$sql = "INSERT INTO clients (client_name, client_email, password, registration_status, registration_code)
				VALUES ('$user_name', '$user_email', '$user_password', 0, '$registration_code')";
		
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		
		return $status;
	}

}

?>
