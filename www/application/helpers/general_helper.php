<?php$this->CI =& get_instance();function sendSms($mobile, $message){		//$this->php_mailer->mailer();				$url = 'https://quicksms.advantasms.com/api/services/sendsms/';			   $curl = curl_init();			   $fields = array(	       'mobile' => $mobile,		   'message' => $message,		   'shortcode' => 'Inkwell',		   'pass_type' => 'plain',		   'partnerID' => '7606',		   'apikey' => 'd5ac189b3977ba30d150549c030787bb'	   );			   $fields_string = http_build_query($fields);			   curl_setopt($curl, CURLOPT_URL, $url);	   curl_setopt($curl, CURLOPT_POST, TRUE);	   curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);			   $data2 = curl_exec($curl);			   curl_close($curl);	   //echo "done with sms";	   //return $data;	}	function getRandomString($n) {    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';    $randomString = '';      for ($i = 0; $i < $n; $i++) {        $index = rand(0, strlen($characters) - 1);        $randomString .= $characters[$index];    }      return $randomString;}function uniqidReal($length = 13) {    // uniqid gives 13 chars, but you could adjust it to your needs.    if (function_exists("random_bytes")) {        $bytes = random_bytes(ceil($length / 2));    } elseif (function_exists("openssl_random_pseudo_bytes")) {        $bytes = openssl_random_pseudo_bytes(ceil($length / 2));    } else {        throw new Exception("no cryptographically secure random function available");    }    return substr(bin2hex($bytes), 0, $length);}function get_upload_directory(){	$dir = $_SERVER["DOCUMENT_ROOT"].'/uploads/';	return $dir;}function force_download($filename) {	$upload_dir = get_upload_directory();    $filedata = file_get_contents($upload_dir.$filename);    // SUCCESS    if ($filedata)    {        // GET A NAME FOR THE FILE        $basename = basename($filename);		$filename2 = explode("_", $filename);		$filename3 = $filename2[1];        // THESE HEADERS ARE USED ON ALL BROWSERS        header("Content-Type: application-x/force-download");        header("Content-Disposition: attachment; filename=$filename3");        header("Content-length: " . (string)(strlen($filedata)));        header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"), date("s"), date("m"), date("d"), date("Y")))." GMT");        header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");        // THIS HEADER MUST BE OMITTED FOR IE 6+        if (FALSE === strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE '))        {            header("Cache-Control: no-cache, must-revalidate");        }        // THIS IS THE LAST HEADER        header("Pragma: no-cache");        // FLUSH THE HEADERS TO THE BROWSER        flush();        // CAPTURE THE FILE IN THE OUTPUT BUFFERS - WILL BE FLUSHED AT SCRIPT END        ob_start();        echo $filedata;    }    // FAILURE    else    {        die("ERROR: UNABLE TO OPEN $filename");    }}   function sendMail($type, $title, $name, $email, $href, $subject){		//$this->php_mailer->mailer();				$url = 'https://mypenservices.com/phpmailer/emailer.php';			   $curl = curl_init();			   $fields = array(		   'type' => $type,		   'title' => $title,		   'name' => $name,		   'email' => $email,		   'href' => $href,		   'subject' => $subject	   );			   $fields_string = http_build_query($fields);			   curl_setopt($curl, CURLOPT_URL, $url);	   curl_setopt($curl, CURLOPT_POST, TRUE);	   curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);			   $data = curl_exec($curl);			   curl_close($curl);	}			 function sendMail2($type, $title, $name, $email, $href, $subject){		//$this->php_mailer->mailer();				$url = 'https://mypenservices.com/phpmailer/emailer2.php';			   $curl = curl_init();			   $fields = array(		   'type' => $type,		   'title' => $title,		   'name' => $name,		   'email' => $email,		   'href' => $href,		   'subject' => $subject	   );			   $fields_string = http_build_query($fields);			   curl_setopt($curl, CURLOPT_URL, $url);	   curl_setopt($curl, CURLOPT_POST, TRUE);	   curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);			   $data = curl_exec($curl);			   curl_close($curl);	}						function sendMail_new_order_client($type, $title, $topic, $instructions, $email, $href, $subject){		//$this->php_mailer->mailer();				$url = 'https://mypenservices.com/phpmailer/new_order_client.php';			   $curl = curl_init();			   $fields = array(		   'type' => $type,		   'title' => $title,		   'topic' => $topic,		   'instructions' => $instructions,		   'email' => $email,		   'href' => $href,		   'subject' => $subject	   );			   $fields_string = http_build_query($fields);			   curl_setopt($curl, CURLOPT_URL, $url);	   curl_setopt($curl, CURLOPT_POST, TRUE);	   curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);			   $data = curl_exec($curl);			   curl_close($curl);	}				function sendMail_new_file_client($type, $title, $email, $href, $subject){		//$this->php_mailer->mailer();				$url = 'https://mypenservices.com/phpmailer/new_file_client.php';			   $curl = curl_init();			   $fields = array(		   'type' => $type,		   'title' => $title,		   'email' => $email,		   'href' => $href,		   'subject' => $subject	   );			   $fields_string = http_build_query($fields);			   curl_setopt($curl, CURLOPT_URL, $url);	   curl_setopt($curl, CURLOPT_POST, TRUE);	   curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);			   $data = curl_exec($curl);			   curl_close($curl);	}			function sendMail_new_message_client($type, $title, $email, $href, $subject){		//$this->php_mailer->mailer();				$url = 'https://mypenservices.com/phpmailer/new_message_client.php';			   $curl = curl_init();			   $fields = array(		   'type' => $type,		   'title' => $title,		   'email' => $email,		   'href' => $href,		   'subject' => $subject	   );			   $fields_string = http_build_query($fields);			   curl_setopt($curl, CURLOPT_URL, $url);	   curl_setopt($curl, CURLOPT_POST, TRUE);	   curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);			   $data = curl_exec($curl);			   curl_close($curl);	}						function sendMail_new_payment_client($type, $title, $payer, $client_email, $payer_email, $amount, $payment_status, $payment_id, $href, $subject){		//$this->php_mailer->mailer();				$url = 'https://mypenservices.com/phpmailer/new_payment_client.php';			   $curl = curl_init();			   $fields = array(		   'type' => $type,		   'title' => $title,		   'payer' => $payer,		   'cemail' => $client_email,		   'pemail' => $payer_email,		   'amount' => $amount,		   'status' => $payment_status,		   'payment_id' => $payment_id,		   'href' => $href,		   'subject' => $subject	   );			   $fields_string = http_build_query($fields);			   curl_setopt($curl, CURLOPT_URL, $url);	   curl_setopt($curl, CURLOPT_POST, TRUE);	   curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);			   $data = curl_exec($curl);			   curl_close($curl);	   return $data;	}				function get_latest_notifications(){		$CI =& get_instance();		$CI->load->model("admin_order_model");		$data = array();		$latest_notifications =  $CI->admin_order_model->get_latest_notifications();		return $latest_notifications;	}		function get_settings(){		$CI =& get_instance();		$CI->load->model("order_model");		$settings = $CI->order_model->get_settings();		foreach($settings as $setting){			if($setting['settings_name'] == "paypal_id"){				$_SESSION['paypal_id'] = $setting['settings_value'];			}		}	}		function get_latest_notifications2($user){		$CI =& get_instance();		$CI->load->model("order_model");		$data = array();		$latest_notifications =  $CI->order_model->get_latest_notifications($user);		return $latest_notifications;	}		function cleanInput($string) { 		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.		$string = str_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.		$string =  str_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.		$string =  str_replace('-', ' ', $string); // Replaces multiple hyphens with single one.				return $string;	}	?>