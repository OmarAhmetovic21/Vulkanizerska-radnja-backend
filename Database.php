<?php

    define('DB_HOST', 'localhost');
    define('DB_USER', 'omar');
    define('DB_PASS', 'omar_vulkanizer');
    define('DB_NAME', 'vulkanizer');
    
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    mysqli_set_charset($conn,"utf8");

    
    if($conn -> connect_error){
        die('Connection failed' . $conn -> connect_error);
    }
    
?>
