<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
	    $this->load->model("WheelData_model");
	    $demo_data =  $this->WheelData_model->get_demo_wheel_data_form();
	    $data['demo_frontend_script'] = $demo_data['frontend_script'];
	    
	    $live_data =  $this->WheelData_model->get_live_wheel_data_form();
	    $data['live_frontend_script'] = $live_data['frontend_script'];
	    
	    
		$this->load->view('front/index.php', $data);
	}
	
	public function get_user_bal(){
	    $user = '';
	    $response = '';
	    if(isset($_SESSION['logged_in_user'])){
	        $user = $_SESSION['logged_in_user'];
	        $this->load->model("WheelData_model");
	        $bal_data =  $this->WheelData_model->get_user_bal($user);
	        //var_dump($bal_data);
	        //echo $bal_data ["client_wallet_bal"];
	        $response = array(
						   "code"=>1,
						   "response"=>"valid",
						   "bal"=>$bal_data ["client_wallet_bal"]);
	    }else{
	        $response = array(
						   "code"=>0,
						   "response"=>"invalid",
						   "bal"=>0);
	    }
	    
	    echo json_encode($response);
		return;
	}
	
	
	public function update_user_bal(){
	    $options = array(20, 50, 100, 200, 500);
	    $manipulated = false;
	    $manip_reason = "";
	    $user = '';
	    $response = '';
	    if(isset($_SESSION['logged_in_user'])){
	        $phone = $_SESSION['logged_in_user'];
	        $username = $_SESSION['logged_in_user_name'];
	        $this->load->model("WheelData_model");
	        $bal_data =  $this->WheelData_model->get_user_bal($phone);
	        $current_balance = $bal_data ["client_wallet_bal"];
	        $amount = filter_var($_POST['amt'],FILTER_SANITIZE_STRING); $amount = intval($amount);
	        
	        if(!in_array($amount, $options)){
	            //possible manipulation
	            $manipulated = true;
	            $manip_reason = "Amount not in Spin options";
	        }
	        if($amount > $current_balance){
	             //possible manipulation
	            $manipulated = true;
	            $manip_reason = "Amount greater than current balance";   
	            
	        }
	        
	        if(!$manipulated){
	            //update balance
	            $new_balance = $current_balance - $amount;
	            $update_user_spin = $this->WheelData_model->set_user_spin( $current_balance, $amount, $new_balance,$phone, $username);
	            $update_bal_data =  $this->WheelData_model->set_user_bal($phone, $new_balance);
	            
	            //get balance
    	        $bal_data =  $this->WheelData_model->get_user_bal($phone);
    
    	        $response = array(
    						   "code"=>1,
    						   "response"=>"valid");

	        }else{
	            $new_balance = $current_balance - $amount;
	            $update_user_manip = $this->WheelData_model->set_user_spin_manip($manip_reason, $current_balance, $amount, $new_balance, $phone, $username );
	            $response = array(
						   "code"=>0,
						   "response"=>"invalid. Inconsistent Data",
						   "bal"=>0);
	        }
	        
	        
	    }else{
	        $response = array(
						   "code"=>0,
						   "response"=>"invalid. Session not set",
						   "bal"=>0);
	    }
	    
	    echo json_encode($response);
		return;
	}
}
