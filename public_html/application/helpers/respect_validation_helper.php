<?php
require_once 'vendor/autoload.php';

use \Respect\Validation\Validator as v;

// registration validation

function validate_user_name($name){
	return v::alnum()->validate($name);
}

function validate_email($email){
    return v::email()->validate($email);
}

function validate_phone_num($p_num){
    return v::phone()->validate($p_num);
}

function validate_registration_code($code){
	return v::alnum()->validate($code);
}

// validates passwords. checks if equal
function validate_registration_passwords($password1, $password2){
	return v::equals($password1)->validate($password2); // true
}


// general function to check alphanumeric
function validate_alphanumeric($string){
	
	return v::alnum()->validate($string); // true
}


// general function to check string
function validate_not_empty($string){
	
	return v::stringType()->notEmpty()->validate($string); // true
}

//general function to validate numeric/ strictly no decimal
function validate_numeric($p){
   return(v::intVal()->length(1, 10)->validate($p));

}


//general function to validate numeric/ strictly no decimal
function validate_decimal($p){
   return(v::numericVal()->length(1, 10)->validate($p));

}

function validate_mdY_date($d){
	return(v::date('m/d/Y')->validate($d)); // true)
}







/*
// application publish
function validate_application_name($name){
    return v::alnum()->notEmpty()->validate($name);
}

function validate_application_download_link($link){
	return v::url()->validate($link);
}

function validate_application_version($data){
    return v::notEmpty()->validate($data);
}

function validate_item_name($item_name){
	
	if(strlen(trim($item_name)) == 0){
        return false;
    }else{
        return true;
    }
}

function validate_plot_number($data){
    return v::notEmpty()->validate($data);
}

function validate_account_number($data){
    return v::notEmpty()->validate($data);
}

function validate_staff_number($data){
    return v::notEmpty()->validate($data);
}

function validate_meter_number($data){
    return v::notEmpty()->validate($data);
}


// registration validation

function validate_user_name($name){
	return v::alpha()->validate($name);
}

function validate_company_name($name){
	return v::notEmpty()->validate($name);
}

function validate_email($email){
    return v::email()->validate($email);
}

function validate_phone_num($p_num){
    return v::phone()->validate($p_num);
}

function validate_town($town){
	return v::alnum()->validate($town);
}

function validate_address($name){
	return v::alnum()->validate($name);
}

function validate_postal($p){
   return(v::intVal()->length(1, 10)->validate($p));

}


function validate_suggested_item_category($suggested_item_category){
	if(strlen(trim($suggested_item_category)) == 0){
        return false;
    }else{
        return true;
    }
}



function test(){
	echo "respect is okay";
}


function validate_name($name){
    return v::alpha()->notEmpty()->validate($name);
}

function validate_phone_numo($p_num){
    return v::phone()->validate($p_num);
}

function validate_id_number($id){
   return(v::intVal()->length(5, 10)->validate($id));

}

function validate_dob($date){
    $date = strtotime ($date);
	$new_date  = date ("Y-m-d", $date);
    return (v::age(18)->validate($new_date));
}

function validate_postalj($postal){
    if(strlen(trim($postal)) == 0){
        return false;
    }else{
        return true;
    }
}

function validate_registration_password($pass1, $pass2){
    if($pass1 == $pass2 && strlen($pass1) > 5 && strlen($pass1) < 12){
        return TRUE;
    }else{
        return FALSE;
    }
    
}

function validate_properties_string($string){
    if(strlen(trim($string)) == 0){
        return false;
    }else{
        return true;
    }
}

function validate_numeric($number){
    return (v::digit()->validate($number));
}



//LOGIN SCRIPT

function check_login_password($pass){
    return (v::alnum()->validate($pass)); // true
}

//pipeline edit
function validate_pipeline_name($name){
    return v::alnum()->notEmpty()->validate($name);
}

function validate_pipeline_remarks($remarks){
    return v::alnum()->notEmpty()->validate($remarks);
}


//zone edit
function validate_zone_name($name){
    return v::alnum()->notEmpty()->validate($name);
}

function validate_zone_remarks($remarks){
    return v::alnum()->notEmpty()->validate($remarks);
}

//department edit
function validate_department_name($name){
    return v::alnum()->notEmpty()->validate($name);
}

//validate current meter reading
function validate_current_reading($num){
   return(v::intVal()->length(1, 10)->validate($num));

}


//validate meter reading cycle
function validate_reading_cycle($cycle){
   return(v::intVal()->length(1, 2)->validate($cycle));

}

//valivate conncection names
function validate_connection_number($name){
    return v::notEmpty()->validate($name);
}

//validate house number
function validate_house_number($name){
    return v::alnum()->notEmpty()->validate($name);
}

//validate house number
function validate_client_account($name){
    return v::notEmpty()->validate($name);
}

//validate meter installation date
function validate_installation_date($installation_date){
    return v::notEmpty()->validate($installation_date);
}

*/

?>
