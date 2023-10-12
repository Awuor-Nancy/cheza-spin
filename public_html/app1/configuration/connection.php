<?php
    /* Database credentials. Assuming you are running MySQL server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'inkwell2_app');
    define('DB_PASSWORD', 'Jomoleakey456');
    define('DB_NAME', 'inkwell2_app');
    
    /* Attempt to connect to MySQL database */
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($mysqli->connect_error){
        header("Location: login.php?error=connect_error");
        // die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
?>