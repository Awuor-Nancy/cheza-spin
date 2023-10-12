<?php
require 'vendor/autoload.php';
use Respect\Validation\Validator as v;


class respect_validation {
	public function __construct() {
	   $ci=& get_instance();

	}
	
	function validate_username($name){
		$usernameValidator = v::stringType()->length(3, 30);
		return $usernameValidator->validate($name); // true
	}
	
	function validate_name($name){
		$usernameValidator = v::stringType()->length(3, 30);
		return $usernameValidator->validate($name); // true
	}
	
	function validate_email($email){
		return v::email()->validate($email); 
	}
	
	function validate_password($password){
		$passwordValidator = v::stringType()->length(6, 12);
		return $passwordValidator->validate($password); // true
	}
	
	function validate_date($date){
		return v::date()->validate($date);
	}
	
	function validate_alphanum($string){
		return v::alnum()->validate($string);
	}
	
	function validate_num($num){
		return v::digit()->validate($num);
	}
	function validate_phone_num($p_num){
        return v::phone()->validate($p_num);
    }
}



?>