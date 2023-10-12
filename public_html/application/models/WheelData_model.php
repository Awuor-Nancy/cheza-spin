<?php
class WheelData_model extends CI_Model {
    
    
    function get_demo_wheel_data_form(){
		$mysqli = get_mysqli();
		$sql = "SELECT backend_form, frontend_script FROM spin_wheel_data WHERE wheel = 'demo'";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$form_data = "";
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$form_data = $row;
		}
        
        return $form_data;
	}
	
	function get_live_wheel_data_form(){
		$mysqli = get_mysqli();
		$sql = "SELECT backend_form, frontend_script FROM spin_wheel_data WHERE wheel = 'live'";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$form_data = "";
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$form_data = $row;
		}
        
        return $form_data;
	}
	
	
	function get_user_bal($user_phone){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM clients WHERE client_phone_num = $user_phone";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run get_user_bal query. There was an error running the query [' . $mysqli->error . ']'.$sql);
        }
		$form_data = "";
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$form_data = $row;
		}
        
        return $form_data;
	}
	
	function set_user_bal($user_phone, $new_balance){
		$mysqli = get_mysqli();
		$sql = "UPDATE clients SET client_wallet_bal = $new_balance WHERE client_phone_num = $user_phone";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run set_user_bal query. There was an error running the query [' . $mysqli->error . ']'.$sql);
        }
        return 'done';
	}
	
	function set_user_spin_manip($manip_reason, $current_bal, $amount, $new_balance,$phone, $username){
	    $mysqli = get_mysqli();
	    // save notification
		$sql = "INSERT INTO suspicious_spins (user_name, user_phone, manip_reason, amount, account_bal_before, account_bal_after)
		VALUE('$username', '$phone', '$manip_reason', $amount, $current_bal, $new_balance)";
		if(!$result = $mysqli->query($sql)){
		    echo $sql;
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		
		return $status;
	}
	
	function set_user_spin( $current_bal, $amount, $new_balance,$phone, $username){
	    $mysqli = get_mysqli();
	    // save notification
		$sql = "INSERT INTO user_spins (user_name, user_phone, amount, account_bal_before, account_bal_after)
		VALUE('$username', '$phone', $amount, $current_bal, $new_balance)";
		if(!$result = $mysqli->query($sql)){
		    echo $sql;
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		
		return $status;
	}
	
	function save_demo_wheel_data($post){
	    $mysqli = get_mysqli();
	    $is_saved = false;
	    $frontend_script = $mysqli->real_escape_string($post['frontend_script']);
	    $backend_form = $mysqli->real_escape_string($post['backend_form']);
	    
	    $sql = "UPDATE spin_wheel_data SET backend_form = '$backend_form', frontend_script = '$frontend_script'  WHERE wheel = 'demo'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
           $is_saved = true; 
        }
        
        return $is_saved;
	}
	
	private function notification_set($sender, $notification_type, $notification_value){
		$notice = "";
		if($notification_type == "no"){
			str_replace("{{client}}", $sender, $notification_value);
		}
		
		
		return $notice;
		
	}
	
	function save_new_order_notification($sender, $recepient, $order_id, $tab, $notification_type){
		$mysqli = get_mysqli();
		//get notification settings
		$notice = "You have a new order by ". $sender;
		$heading = "New Order";
				
		// save notification
		$sql = "INSERT INTO notifications (notification, heading, sent_to, order_id, order_tab, is_read)
		VALUE('$notice', '$heading', '$recepient', '$order_id', '$tab', 0)";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		
		return $status;
	}
	
	function save_new_file_notification($sender, $recepient, $order_id, $tab, $notification_type){
		$mysqli = get_mysqli();
		//get notification settings
		$notice = $sender . " Uploaded a file";
		$heading = "New File";
				
		// save notification
		$sql = "INSERT INTO notifications (notification, heading, sent_to, order_id, order_tab, is_read)
		VALUE('$notice', '$heading', '$recepient', '$order_id', '$tab', 0)";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		
		return $status;
	}
	
	function save_new_payment_notification($sender, $recepient, $order_id, $tab, $notification_type){
		$mysqli = get_mysqli();
		//get notification settings
		$notice = "New Payment by". $sender;
		$heading = "New Payment";
				
		// save notification
		$sql = "INSERT INTO notifications (notification, heading, sent_to, order_id, order_tab, is_read)
		VALUE('$notice', '$heading', '$recepient', '$order_id', '$tab', 0)";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		
		return $status;
	}
	
	function save_new_thread_notification($sender, $recepient, $order_id, $tab, $notification_type){
		$mysqli = get_mysqli();
		//get notification settings
		$notice = "You have a new message thread by ". $sender;
		$heading = "New Thread";
				
		// save notification
		$sql = "INSERT INTO notifications (notification, heading, sent_to, order_id, order_tab, is_read)
		VALUE('$notice', '$heading', '$recepient', '$order_id', '$tab', 0)";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		
		return $status;
	}
	
	function save_new_reply_notification($sender, $recepient, $order_id, $tab, $notification_type){
		$mysqli = get_mysqli();
		//get notification settings
		$notice = $sender . " replied to message thread ";
		$heading = "Message Reply";
				
		// save notification
		$sql = "INSERT INTO notifications (notification, heading, sent_to, order_id, order_tab, is_read)
		VALUE('$notice', '$heading', '$recepient', '$order_id', '$tab', 0)";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}

		return $status;
	}
	
	
	function save_new_file($uploadedFile, $order_uniqid, $user_email, $note = "Source to be used"){
		$mysqli = get_mysqli();
		
		$sql = "INSERT INTO client_files (file_name, note, order_id) VALUE('$uploadedFile', '$note', '$order_uniqid')";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
			// send notification
			$this->save_new_file_notification($user_email, 'admin', $order_uniqid, 'file', 'no');
		}
		
		return $status;
	}
	
	function get_client_by_email($email){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM clients WHERE client_email = '$email'";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$clients = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$clients[] = $row;
		}
        
        return $clients;
	}
	
	function save_new_message($message_uniqid, $thread_id, $order_id, $user, $message){
		$mysqli = get_mysqli();
		$sql = "INSERT INTO message_replies (thread_id, sent_by, message)
				VALUES ('$thread_id', '$user', '$message')";
		
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		//update threads
		$date_now = date("Y-m-d H:i:s");
		$sql = "UPDATE message_threads SET last_update = '$date_now' WHERE message_uniqid = '$thread_id'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		
		$this->save_new_reply_notification($user, 'admin', $order_id, 'msg', 'rp');
		
		return $status;
	}
	
	function save_new_thread($message_uniqid, $order, $user, $message){
		$mysqli = get_mysqli();
		$sql = "INSERT INTO message_threads (message_uniqid, sent_by, order_id, message)
				VALUES ('$message_uniqid', '$user', '$order', '$message')";
		
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		
		// send notification
		$this->save_new_thread_notification($user, 'admin', $order, 'msg', 'nm');
		
		return $status;
	
	}
	
	function remove_validation_code($code){
		$mysqli = get_mysqli();
		$sql = "DELETE FROM strangers
				WHERE code = '$code'";
		
		$result = null;
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
	}
	
	function validate_code($code){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM strangers
				WHERE code = '$code'";
		
		$result = null;
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$clients = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$clients[] = $row;
		}
        
        return $clients;
	}
	
	function register_stranger($email, $password){
		$mysqli = get_mysqli();
		$status = 0;
		$sql = "INSERT INTO clients (client_email, password)
				VALUES ('$email', '$password')";
		
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		return $status;
	}
	
	function save_stranger($email, $registration_code){
		$mysqli = get_mysqli();
		$sql = "INSERT INTO strangers (email, code)
				VALUES ('$email', '$registration_code')";
		
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		return $status;
	
	}
	
	function save_payment($order_id, $user_email, $payment_dets){
		$mysqli = get_mysqli();
		$payment_details = json_decode($payment_dets, true);
		$status = 0;
		
		$paypal_payment_id = $payment_details['id'];
		$payment_status = $payment_details['status'];
		$payment_amount = floatval($payment_details['purchase_units'][0]['amount']['value']);
		$payer = $payment_details['payer']['name']['given_name']. ' '.$payment_details['payer']['name']['surname'];
		$payer_email = $payment_details['payer']['email_address'];
		$create_time = $payment_details['create_time'];
		$uniq_payment_id = uniqidReal(24);
		
		$sql = "INSERT INTO payments (payment_uniqid, order_id, user_email, paypal_payment_id,
		payment_status, payment_amount, payer, payer_email, create_time, full_payment_details)
				VALUES ('$uniq_payment_id', '$order_id', '$user_email', '$paypal_payment_id',
				'$payment_status', $payment_amount, '$payer', '$payer_email', '$create_time', '$payment_dets' )";
		
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		//update order
		$sql = "UPDATE orders SET payment_status = '$payment_status', payment_id = '$uniq_payment_id',
		progress_status = 2 WHERE order_uniqid = '$order_id'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		
		return $status;
		// send notification
		//$this->save_new_order_notification($user_email, 'admin', $order_uniqid, 'info', 'no');
		// send notification
		$this->save_new_payment_notification($user_email, 'admin', $order_uniqid, 'info', 'no');
	}
	
	function save_new_order($form_data, $order_uniqid, $coupon){
		
		$mysqli = get_mysqli();
		
		$topic = $form_data['topic'];
		$academic_level = $form_data['academic_level'];
		$paper_format = $form_data['paper_format'];
		$num_of_pages = $form_data['num_of_pages'];
		$deadline = $form_data['deadline'];
		$pp_slides = $form_data['slides'];
		$instructions = $form_data['instructions'];
		$coupon_code = $form_data['coupon_code'];
		$user_email = $_SESSION['logged_in_user'];
		$payment_status = "Awaiting Payment";
		$progress_status = 1;
		$time_now = date("Y-m-d H:i:s");
		
		$sql = "INSERT INTO orders (order_uniqid, user_email, topic, academic_level, paper_format, num_of_pages, deadline, pp_slides, instructions, coupon_code, discount, date_created, payment_status, progress_status)
				VALUES ('$order_uniqid', '$user_email', '$topic', $academic_level, $paper_format, $num_of_pages, $deadline, $pp_slides, '$instructions', '$coupon_code', $coupon, '$time_now', '$payment_status', '$progress_status' )";
	
		if(!$result = $mysqli->query($sql)){
            die('Unable to save order. There was an error running the query [' . $mysqli->error . ']');
        }else{
			$status = 1;
		}
		// send notification
		$this->save_new_order_notification($user_email, 'admin', $order_uniqid, 'info', 'no');
		
		
		return $status;
	}
	
	
	
	function get_client_messages($order_id){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM message_threads WHERE order_id = '$order_id' ORDER BY last_update DESC";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$messages = array();
		
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$bundle = array();
			$replies = array();
			$thread = array();
			//var_dumb($row);
			//print_r($row);
			$thread_id = $row['message_uniqid'];
			
			$replies[] = $this->get_message_replies($thread_id);
			$thread[] = $row;
			$bundle['thread'] = $thread;
			$bundle['replies'] = $replies;
			$messages[] = $bundle;
		}
        
        return $messages;
	}
	
	private function get_message_replies($thread_id){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM message_replies WHERE thread_id = '$thread_id'";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$replies = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$replies[] = $row;
		}
        
        return $replies;
	}
	
	function get_coupon($coupon_code){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM coupons WHERE code = '$coupon_code' LIMIT 1";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$coupon= array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$coupon[] = $row;
		}
        
        return $coupon;
	}
	
	function get_client_orders($email){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM orders WHERE user_email = '$email'";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$orders = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$orders[] = $row;
		}
        
        return $orders;
	}
	
	public function get_latest_notifications($user){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM notifications WHERE sent_to = '$user' AND is_read = 0 ORDER BY notification_id DESC LIMIT 0, 5";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$notifications = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$notifications[] = $row;
		}
        
        return $notifications;
	}
	
	public function get_notifications($user){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM notifications WHERE sent_to = '$user' ORDER BY notification_id ASC";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		
		//echo $sql; die();
		$notifications = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$notifications[] = $row;
		}
        
        return $notifications;
	}
	
	function get_extra_slides($order_uniqid){
		$mysqli = get_mysqli();
		$sql = "SELECT additional_slides FROM orders WHERE order_uniqid = '$order_uniqid'";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$order_details = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$order_details[] = $row;
		}
        
        return $order_details;
	}
	
	function get_extra_pages($order_uniqid){
		$mysqli = get_mysqli();
		$sql = "SELECT additional_pages FROM orders WHERE order_uniqid = '$order_uniqid'";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$order_details = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$order_details[] = $row;
		}
        
        return $order_details;
	}
	
	function update_shorten_deadline($order_uniqid, $deadline_id){
		$mysqli = get_mysqli();
		$sql = "UPDATE orders SET shorten_deadline = '$deadline_id' WHERE order_uniqid = '$order_uniqid'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			return 1;
		}
	}
	
	function mark_message_read($id){
		$mysqli = get_mysqli();
		$sql = "UPDATE notifications SET is_read = 1 WHERE notification_id = $id";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			return 1;
		}
	}
	
	function cancel_order($order_uniqid){
		$mysqli = get_mysqli();
		$sql = "UPDATE orders SET progress_status = 6 WHERE order_uniqid = '$order_uniqid'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			return 1;
		}
	}
	
	
	function reorder_order($order_uniqid){
		$mysqli = get_mysqli();
		$sql = "UPDATE orders SET progress_status = 1 WHERE order_uniqid = '$order_uniqid'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			return 1;
		}
	}
	
	function update_extra_pages($order_uniqid, $additional_pages){
		$mysqli = get_mysqli();
		$sql = "UPDATE orders SET additional_pages = '$additional_pages' WHERE order_uniqid = '$order_uniqid'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			return 1;
		}	
	}
	
	function update_extra_slides($order_uniqid, $additional_slides){
		$mysqli = get_mysqli();
		$sql = "UPDATE orders SET additional_slides = '$additional_slides' WHERE order_uniqid = '$order_uniqid'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			return 1;
		}	
	}
	
	function remove_extra_pages($order_uniqid){
		$mysqli = get_mysqli();
		$sql = "UPDATE orders SET additional_pages = '' WHERE order_uniqid = '$order_uniqid'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			return 1;
		}
	}
	
	function delete_file($filename){
		$mysqli = get_mysqli();
		$sql = "DELETE FROM client_files WHERE file_name = '$filename'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			return 1;
		}
	}
	
	
	function save_user_new_password_login($user_email, $password){
		$user_password = password_hash($password, PASSWORD_DEFAULT);
		$mysqli = get_mysqli();
		$sql = "UPDATE clients SET password = '$user_password' WHERE client_email = '$user_email'";
		if(!$result = $mysqli->query($sql)){
			die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
		}else{
			return 1;
		}
		
		
		return $status;
	}
	
	function remove_discount($order_uniqid){
		$mysqli = get_mysqli();
		$sql = "UPDATE orders SET coupon_code = '', discount = '' WHERE order_uniqid = '$order_uniqid'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			return 1;
		}
	}
	
	function remove_extra_slides($order_uniqid){
		$mysqli = get_mysqli();
		$sql = "UPDATE orders SET additional_slides = '' WHERE order_uniqid = '$order_uniqid'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			return 1;
		}
	}
	
	function remove_shorten_deadline($order_uniqid){
		$mysqli = get_mysqli();
		$sql = "UPDATE orders SET shorten_deadline = '' WHERE order_uniqid = '$order_uniqid'";
		if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }else{
			return 1;
		}
	}
	
	
	
	function get_client_files($client_order){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM client_files WHERE order_id = '$client_order'";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$file_details = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$file_details[] = $row;
		}
        
        return $file_details;
	}
	
	function get_admin_files($client_order){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM admin_files WHERE order_id = '$client_order'";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$file_details = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$file_details[] = $row;
		}
        
        return $file_details;
	}
	
	function get_single_order($order_id){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM orders WHERE order_uniqid = '$order_id'";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$order_details = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$order_details[] = $row;
		}
        
        return $order_details;
	}
	
	function get_progress_status(){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM progress_status WHERE 1 ";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$status = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$status[] = $row;
		}
        
        return $status;
	}
	
	function get_academic_levels(){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM academic_levels WHERE 1 ";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$academics = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$academics[] = $row;
		}
        
        return $academics;
	}
	
	function get_deadlines(){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM deadline WHERE 1 ";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$deadlines = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$deadlines[] = $row;
		}
        
        return $deadlines;
	}
	
	function get_paper_formats(){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM paper_formats WHERE 1 ";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$paper_formats = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$paper_formats[] = $row;
		}
        
        return $paper_formats;
	}
	
	function get_settings(){
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM settings WHERE 1 ";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		$settings = array();;
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			//var_dumb($row);
			//print_r($row);
			$settings[] = $row;
		}
        
        return $settings;
	}
	
	
	function validate_login($form_data){
		$login_status = 0;
		$saved_pass = "";
		$user_email = $form_data["emailAddress"];
		$user_password = $form_data["loginPassword"];
		
		$mysqli = get_mysqli();
		$sql = "SELECT * FROM clients WHERE client_email = '$user_email' ";
       
       if(!$result = $mysqli->query($sql)){
            die('Unable to run  query. There was an error running the query [' . $mysqli->error . ']');
        }
		
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$saved_pass = $row['password'];
			
		}

		if (password_verify($user_password, $saved_pass)) {
			$login_status = 1;
		}
		
		return $login_status;
		
	}
	
	

}

?>