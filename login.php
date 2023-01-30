<?php
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: * ");
require_once 'Database.php';

function getToken($conn){
    $sql = "select * from users order by id asc";
    $result=mysqli_query($conn, $sql);
    if($result){
        header("Content-Type: JSON");
        $i=0;
        $row= mysqli_fetch_assoc($result);

      //  echo json_encode($response, JSON_PRETTY_PRINT);
    }
    
    $postdata = file_get_contents("php://input");

    if(isset($postdata) && !empty($postdata)){
       $request = json_decode($postdata);
	
        if($row["email"] == $request->email && $row["password"] == $request->password){
            $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
            $payload = json_encode([$request->email, $request->password]);
            $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
            $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
            $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
            $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
            $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
            $object= [
              'token'=>$jwt
            ];
            $result = json_encode($object);
            echo $result;
        }else{
            return http_response_code(401);
            echo "podaci nisu tacni";
        
    }
  // Validate.
    }
    
}
getToken($conn);
?>