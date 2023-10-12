<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
	    $this->load->model("admin_dashboard_model");
	    $this->load->model("users_model");
	    $latest_deposits = $this->admin_dashboard_model->get_latest_deposits();
	    
	    //pending deposits
	    $pending_deposits = $this->admin_dashboard_model->get_deposit_count(1);
	    
	    //completed deposits
	    $completed_deposits = $this->admin_dashboard_model->get_deposit_count(2);
	    
	    //completed deposits total
	    $sum_deposits = $this->admin_dashboard_model->get_deposit_total(2);
	    
	    //completed deposits total
	    $sum_pending_deposits = $this->admin_dashboard_model->get_deposit_total(1);
	    
	    //total users
	    $total_users = $this->admin_dashboard_model->get_total_users();
	    
	    //suspicous spins
	    $sus_spins = $this->admin_dashboard_model->get_suspicious_spins();
	    
	    //get all users
	    
	    $users = $this->users_model->get_users();
	    
	    

	    $data['latest_deposits'] = $latest_deposits;
	    $data['pending_deposits_count'] = $pending_deposits[0]['count'];
	    $data['completed_deposits_count'] = $completed_deposits[0]['count'];
	    $data['sum_completed_deposits'] = $sum_deposits[0]['amount'];
	    $data['sum_pending_deposits'] = $sum_pending_deposits[0]['amount'];
	    $data['total_users'] = $total_users[0]['count'];
	    $data['susp_spins'] = $sus_spins[0]['count'];
	    $data['users'] = $users;
	    
		$this->load->view('admin/users.php', $data);
	}
	
    function deposits(){
	    $this->load->model("admin_dashboard_model");
	    $this->load->model("users_model");
	    //get all userse
	    $users = $this->users_model->get_users();
	    //get all deposits
	    $all_deposits = $this->users_model->get_all_deposits();
	    $diposits = $this->users_model->get_all_deposits_2();

	    $data['users'] = $users;
	    $data['all_deposits'] = $all_deposits;
	    $data['deposits'] = $diposits;
	    
		$this->load->view('admin/deposits.php', $data);
	}
	
	function view(){
	    $this->load->model("admin_dashboard_model");
	    $this->load->model("users_model");
	    $latest_deposits = $this->admin_dashboard_model->get_latest_deposits();
	    
	    //pending deposits
	    $pending_deposits = $this->admin_dashboard_model->get_deposit_count(1);
	    
	    //completed deposits
	    $completed_deposits = $this->admin_dashboard_model->get_deposit_count(2);
	    
	    //completed deposits total
	    $sum_deposits = $this->admin_dashboard_model->get_deposit_total(2);
	    
	    //completed deposits total
	    $sum_pending_deposits = $this->admin_dashboard_model->get_deposit_total(1);
	    
	    //total users
	    $total_users = $this->admin_dashboard_model->get_total_users();
	    
	    //suspicous spins
	    $sus_spins = $this->admin_dashboard_model->get_suspicious_spins();
	    
	    //get all users
	    
	    $users = $this->users_model->get_users();
	    
	    $user_id = $this->uri->segment(4);
	    $user_data = $this->users_model->get_user($user_id);
	    $user_deposits = $this->users_model->get_user_deposits($user_id);
	    
	    //var_dump($user_data); die();
	    
        $response = '';
	    $data['latest_deposits'] = $latest_deposits;
	    $data['pending_deposits_count'] = $pending_deposits[0]['count'];
	    $data['completed_deposits_count'] = $completed_deposits[0]['count'];
	    $data['sum_completed_deposits'] = $sum_deposits[0]['amount'];
	    $data['sum_pending_deposits'] = $sum_pending_deposits[0]['amount'];
	    $data['total_users'] = $total_users[0]['count'];
	    $data['susp_spins'] = $sus_spins[0]['count'];
	    $data['users'] = $users;
	    $data['user_data'] = $user_data;
	    //var_dump($user_data); die();
	    $data['user_deposits'] = $user_deposits;
	    $this->load->view('admin/user_form.php', $data);
	}
	
	function update_details(){
	    $this->load->model("users_model");
	    $update_details = $this->users_model->update_details($_POST);
	    
	    if($update_details == 'done'){
	        $response = array(
						   "code"=>1,
						   "response"=>"Data Saved",
						   "desc"=>"User Data saved");
	    }else{
	        $response = array(
						   "code"=>2,
						   "response"=>"Data Not Saved",
						   "desc"=>"User Data Not saved");
	    }
	    
	    echo json_encode($response);
		return;
	}
	
	
	function update_password(){
	    $this->load->model("authentication_model");
	    $update_details = $this->authentication_model->update_password($_POST);
	    
	    //send sms
        //$sms_status = sendSms('07', 'Your password has changed');
	    
	    if($update_details == 'done'){
	        $response = array(
						   "code"=>1,
						   "response"=>"Data Saved",
						   "desc"=>"User Data saved");
	    }else{
	        $response = array(
						   "code"=>2,
						   "response"=>"Data Not Saved",
						   "desc"=>"User Data Not saved. ".$sms_status);
	    }
	    
	    echo json_encode($response);
		return;
	}

}
