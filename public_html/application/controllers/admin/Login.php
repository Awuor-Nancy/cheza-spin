<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
        // destroy session
        session_destroy();
		$this->load->view('admin/login.php');
	}
	
	public function validate(){
	    $this->load->model("authentication_model");
		$form_data = $_POST;
		
		
		$email = $_POST['email'];
	
		
		
		//validate login details
		$is_valid = $this->authentication_model->validate_admin_login($form_data);
		if($is_valid['status'] == 0){
			$error = array(
						   "code"=>1,
						   "error"=>"Invalid password",
						   "desc"=>"Invalid password or username. Try again or recover password");

			echo json_encode($error);
			return;
		}
		
		if($is_valid['status'] == 1){
			$_SESSION['admin_email'] = $email;
			$_SESSION['admin_name'] = $is_valid['name'];
			//get_settings();
			$response = "";
			$response = array(
						   "code"=>2,
						   "response"=>"valid password",
						   "desc"=>"Login successful");
				echo json_encode($response);
				return;

		}
	}
}
