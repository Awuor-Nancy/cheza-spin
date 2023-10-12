<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spin_wheel_settings extends CI_Controller {

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
		$this->load->view('admin/dashboard.php');
	}
	
	public function demo()
	{
	    $this->load->model("WheelData_model");
	    $form_data =  $this->WheelData_model->get_demo_wheel_data_form();
	    $data['backend_form'] = $form_data['backend_form'];
	    $data['frontend_script'] = $form_data['frontend_script'];
		$this->load->view('admin/builder.php', $data);
	}
	
	public function live()
	{
	    $this->load->model("WheelData_model");
	    $form_data =  $this->WheelData_model->get_demo_wheel_data_form();
	    $data['backend_form'] = $form_data['backend_form'];
	    $data['frontend_script'] = $form_data['frontend_script'];
		$this->load->view('admin/builder.php', $data);
	}
	
	public function save_demo_wheel(){
	    //var_dump($_POST);
	    $response = array();
	    $this->load->model("WheelData_model");
	    $form_data_save =  $this->WheelData_model->save_demo_wheel_data($_POST);
	    //save data to js file
	    
	    $frontend_script = $_POST['frontend_script'];
	    
	    $top = ' var log = console.log;';
	     $top = $top. ' ';
	    $top = $top.'jQuery(document).ready(function($){ ';
	    $top = $top. ' ';
	    $frontend_script =  $top . $frontend_script;
	    
	    $filename = 'assets/spinwheel/assets/js/bottom.txt';
        $f = fopen($filename, 'r');
        
        if ($f) {
            $contents = fread($f, filesize($filename));
            fclose($f);
            //echo nl2br($contents);
            $frontend_script =  $frontend_script . $contents;
        }
	    $myfile = fopen("assets/spinwheel/assets/js/scripts2.js", "w") or die("Unable to open file!");
        fwrite($myfile, $frontend_script);
        fclose($myfile);

	    if($form_data_save){
	        $response['status'] = 'saved';
	        $response['message'] = 'Data saved successfully';
	    }else{
	        $response['status'] = 'failed';
	        $response['message'] = 'Data save failed';
	    }
	    
	    echo json_encode($response);
	}
}
