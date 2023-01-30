<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *"); 
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: *");
require_once 'Database.php';

function deleteArticles($conn){
    $data = file_get_contents("php://input");

    if(isset($data) && !empty($data)){
       $request = json_decode($data);
	
        
  // Validate.
        if(trim($request->name) === '')
            {
                return http_response_code(400);
            }
	
  // Sanitize.
             $name = mysqli_real_escape_string($conn, trim ($request->name));
             $sql = "delete from articles where name = '{$name}'";
             mysqli_query($conn, $sql);

    }
}

deleteArticles($conn);
?>