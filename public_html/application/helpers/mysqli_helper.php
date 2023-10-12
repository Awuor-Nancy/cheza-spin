<?php
$this->CI =& get_instance();
$this->CI->load->database('default');   
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}     
    
    function get_mysqli(){
        
        
        $db = (array)get_instance()->db;
       
        $mysqli = mysqli_connect('localhost', $db['username'], $db['password'], $db['database']) or die( mysqli_connect_error) ;
        $_SESSION['mysqli'] = $mysqli;
		return $mysqli;  
        
    }
	
	function get_pdo(){
		$con = null;
		try 

			{
				$db = (array)get_instance()->db;
				$host = 'localhost';
				$db_name = $db['database'];

				$con = new PDO("mysql:host=$host;dbname=$db_name", $db['username'], $db['password']);

			}



			catch(PDOException $exception)

			{

				echo "Connection error: " . $exception->getMessage();

			}
			
			return $con;
	}
    



?>