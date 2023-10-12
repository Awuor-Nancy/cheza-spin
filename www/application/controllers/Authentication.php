<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	private function complete_goauth($user_email){
		 header("Access-Control-Allow-Origin: *");
		$_SESSION['logged_in_user'] = $user_email;
			get_settings();
			$response = "";
			//admin check
			$is_admin = $this->authentication_model->check_if_admin($user_email);
			$is_writer = $this->authentication_model->check_if_writer($user_email);
	
			
			if($is_admin > 0){
				$_SESSION['logged_in_admin'] = $user_email;
				$_SESSION['logged_in_user'] = null;
				$response = array(
						   "code"=>3,
						   "response"=>"valid passwrod",
						   "desc"=>"Login successful. Redirecting to your portal");
				echo json_encode($response);
				return;
			}
			if($is_writer[0]['type'] == 2){
				$_SESSION['logged_in_admin'] = $user_email;
				$_SESSION['logged_in_writer'] = $user_email;
				$_SESSION['logged_in_user'] = null;
				$response = array(
						   "code"=>3,
						   "response"=>"valid passwrod",
						   "desc"=>"Login successful. Redirecting to your portal");
				echo json_encode($response);
				return;
			}else{
				$response = array(
						   "code"=>2,
						   "response"=>"valid passwrod",
						   "desc"=>"Login successful. Redirecting to your portal");
				echo json_encode($response);
				return;
			}
	}
	public function g_oauth(){
		$this->load->model("authentication_model");
		$form_data = $_POST;
		
		$user_name = $form_data["client_name"];
		$user_email = $form_data["client_email"];
		
		$check_email_exists = $this->check_email_exists($user_email);
		
		if($check_email_exists > 0){ // user already exists
			$this->complete_goauth($user_email);
		}else{ //email does not exists.. register user.
			$save_status = $this->authentication_model->save_new_client_goauth($form_data);
			
			if($save_status == 1){
				$_SESSION['logged_in_user'] = $user_email;
				
				//send registration email
				$subject = 'Your account has been created';
				$href = site_url().'/authentication/verify/?code='.$registration_code;
				
				sendMail('welcome', 'Welcome to Skilled Essays', $user_name, $user_email, $href, $subject);
				
				$this->complete_goauth($user_email);
			}else{
				$error = array(
						   "code"=>1,
						   "error"=>"Unknown error",
						   "desc"=>"Unable to save data. Please try again");

				echo json_encode($error);
				return;
			}
			
		}
		
	}
	public function index()
	{
		echo 'This route is reached';
	}
	
	public function logout(){
	    session_reset();
	    session_destroy();
	    redirect(site_url(), 'refresh');
	    
	}
	
	public function register()
	{
		$this->load->view('/authentication/register.php');
	}
	
	public function forgot_password()
	{
		$this->load->view('/authentication/forgot_password.php');
	}
	
	private function check_phone_num_exists($num){

		 
		//Load model
        $this->load->model('authentication_model');
		$result = $this->authentication_model->check_phone_num_exists($num);
		
		return $result;
	}
	
	public function testmail(){
		//$this->php_mailer->mailer();
		
		$url = 'https://mypenservices.com/phpmailer/emailer.php';
		
	   $curl = curl_init();
		
	   $fields = array(
		   'type' => 'welcome',
		   'title' => 'Welcome to Skilled essays',
		   'name' => 'James',
		   'href' => 'http://www.skilledessays.com/client/veri/?code=134123',
		   'subject' => 'Your Account has been created'
	   );
		
	   $fields_string = http_build_query($fields);
		
	   curl_setopt($curl, CURLOPT_URL, $url);
	   curl_setopt($curl, CURLOPT_POST, TRUE);
	   curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
		
	   $data = curl_exec($curl);
		
	   curl_close($curl);
	}
	
	public function reset(){
	   $this->load->model("authentication_model");
	   $form_data = $_POST;
		
	   $cust_phone_number = $form_data["phone_num_reset"]; 
	   $check_num = true;
		
		
		//verify phone number
		$check_phone_num_format  = $this->respect_validation->validate_phone_num($cust_phone_number);
		if(!$check_phone_num_format){
			$error = array(
						   "code"=>1,
						   "placeholder"=>2,
						   "error"=>"Invalid phone",
						   "desc"=>"Phone Submitted is incorrect. Check and try again");

			echo json_encode($error);
			return;
		}
		$check_phone_num_exists = $this->check_phone_num_exists($cust_phone_number);
		if($check_phone_num_exists == 0){
		     $check_num = false;
			$error = array(
						   "code"=>2,
						   "placeholder"=>2,
						   "error"=>"Phone in use",
						   "desc"=>"New password sent.");

			echo json_encode($error);
			return;
		}else{
		    //resdt password
		 
		    $reset_pass = $this->authentication_model->reset_user_password($cust_phone_number);
		   
		    $res = array(
						   "code"=>2,
						   "placeholder"=>2,
						   "res"=>"Phone in use",
						   "desc"=>"New password sent..");

			//echo json_encode($res);
			return;
		}
		
		
	}
	
	
	public function login_validate(){
		$this->load->model("authentication_model");
		$form_data = $_POST;
		
		$user_phone_num = $form_data["phone_num"];
		$user_password = $form_data["user_login_password"];

		
		/*
		$check_password = $this->respect_validation->validate_password($user_password);
		if(!$check_password){
			$error = array(
						   "code"=>1,
						   "error"=>"Invalid passwrod",
						   "desc"=>"Password you submitted is invalid. Should be alphanumeric between 6 and 12 chars");

			echo json_encode($error);
			return;
		} */
		
		//validate login details
		$is_valid = $this->authentication_model->validate_login($form_data);
		if($is_valid['status'] == 0){
			$error = array(
						   "code"=>1,
						   "error"=>"Invalid password",
						   "desc"=>"Invalid password or username. Try again or recover password");

			echo json_encode($error);
			return;
		}
		
		if($is_valid['status'] == 1){
			$_SESSION['logged_in_user'] = $user_phone_num;
			$_SESSION['logged_in_user_phone'] = $user_phone_num;
			$_SESSION['logged_in_user_name'] = $is_valid['cust_name'];
			//get_settings();
			$response = "";
			$response = array(
						   "code"=>2,
						   "response"=>"valid password",
						   "desc"=>"Login successful");
				echo json_encode($response);
				return;

		}
		//redirect('/account/login', 'refresh');
		
	}
	
	public function verify(){
	      $this->load->model("order_model");
		 
		 if(isset($_GET['for'])){
		     $for = $_GET['for'];
			 if($for == "stranger"){
			   $code = $_GET['code'];
			   $validate_code = $this->order_model->validate_code($code);
			   if(empty($validate_code)){
					$msg = "Invalid code";
					$code = 0;
					redirect(site_url().'/client/order/confirm_s?msg='.$msg.'&code='.$code, 'refresh');
			   }else{
					$email = $validate_code[0]['email'];
					$user_password = rand(10000, 99999);
					$password = password_hash($user_password, PASSWORD_DEFAULT);
					$register_stranger = $this->order_model->register_stranger($email, $password);
					$_SESSION['logged_in_user'] = $email;
					$msg = "Code verified. You can head back to the order page and proceed with checkout. </br> To login to your account, Please use your email address and ".$user_password." as temporary password";
					//$register_stranger = $this->order_model->register_stranger($email);
					//remove code
					$remove_code = $this->order_model->remove_validation_code($code);
					$code = 1;
					redirect(site_url().'/client/order/confirm_s?msg='.$msg.'&code='.$code, 'refresh');
			   }
			   
			 }
		 }
	}
	
	public function register_validate()
	{
		$form_data = $_POST;
		
		$cust_name = $form_data["cust_name"];
		$cust_phone_number = $form_data["cust_phone_number"];
		$cust_password1 = $form_data["cust_password1"];
		$cust_password2 = $form_data["cust_password2"];
		
		if(strlen((string)$cust_phone_number) > 10){
			$error = array(
						   "code"=>1,
						   "placeholder"=>2,
						   "error"=>"Invalid Phone Number",
						   "desc"=>"Phone number submitted is invalid. Should be a 10 digit number");

			echo json_encode($error);
			return;
		}
		
		$check_name = $this->respect_validation->validate_username($cust_name);
		if(!$check_name){
			$error = array(
						   "code"=>1,
						   "placeholder"=>1,
						   "error"=>"Invalid Name",
						   "desc"=>"Name you submitted is invalid. Should be alpha numberic between 3 and 30 chars");

			echo json_encode($error);
			return;
		}

        $check_num = true;
		$check_phone_num_exists = $this->check_phone_num_exists($cust_phone_number);
		
		if($check_phone_num_exists > 0){
		     $check_num = false;
			$error = array(
						   "code"=>1,
						   "placeholder"=>2,
						   "error"=>"Phone in use",
						   "desc"=>"Phone number you submitted is already taken. Please use another");

			echo json_encode($error);
			return;
		}
		
		//verify phone number
		$check_phone_num_format  = $this->respect_validation->validate_phone_num($cust_phone_number);
		if(!$check_phone_num_format){
			$error = array(
						   "code"=>1,
						   "placeholder"=>2,
						   "error"=>"Invalid phone",
						   "desc"=>"Phone Submitted is incorrect. Correct format is 0700000000");

			echo json_encode($error);
			return;
		}
		
		
		
		$check_password = $this->respect_validation->validate_password($cust_password1);
		if(!$check_password){
			$error = array(
						   "code"=>1,
						   "placeholder"=>3,
						   "error"=>"Invalid passwrod",
						   "desc"=>"Password you submitted is invalid. Should be alphanumeric between 6 and 12 chars");

			echo json_encode($error);
			return;
		}
		
		if($cust_password1 != $cust_password2){
		    $error = array(
						   "code"=>1,
						   "placeholder"=>4,
						   "error"=>"Invalid password",
						   "desc"=>"Password you submitted do not match");

			echo json_encode($error);
			return;
		}
		
				$cust_password = $form_data["cust_password1"];
	        	$user_password = password_hash($cust_password1, PASSWORD_DEFAULT);
                    $userData = array( 
                        'client_name' =>$cust_name,
                        'client_phone_num' => $cust_phone_number,
                        'client_password' => $user_password,
                        'status' => "ACTIVE"
                        );
		
		
		if($check_name && $check_num && $check_password){
			//save to db
			$registration_code = getRandomString(8);
	    	$save_status = $this->authentication_model->save_new_client($userData, $registration_code);
			
			if($save_status == 1){
				$_SESSION['logged_in_user'] = $cust_phone_number;
				$_SESSION['logged_in_user_phone'] = $cust_phone_number;
				$_SESSION['logged_in_user_name'] = $cust_name;
				
				//send registration email
				//$subject = 'Your account has been created';
				//$href = site_url().'/authentication/verify/?code='.$registration_code;
				
				
				
				$response = array(
						   "code"=>2,
						   "response"=>"Registration complete",
						   "desc"=>"You have successfully registered with Spin Pesa. Its time to start winning. Deposit to start winning.");
				//echo json_encode($response);
				return;
			}else{
				$error = array(
						   "code"=>1,
						   "error"=>"Unknown error",
						   "desc"=>"Unable to save data. Please try again");

				echo json_encode($error);
				return;
			}
			
			
		}
	}
}
