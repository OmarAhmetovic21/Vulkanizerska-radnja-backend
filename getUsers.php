<?php
header("Access-Control-Allow-Origin: *");
require_once 'Database.php';
header("Content-Type: application/json; charset=UTF-8");

function getUsers($conn){
    $sql = "select * from users order by id asc";
    $result=mysqli_query($conn, $sql);
    if($result){
        header("Content-Type: JSON");
        $i=0;
        while($row= mysqli_fetch_assoc($result)){
            $response['id']=$row['id'];
            $response['email']=$row['email'];
            $response['password']=$row['password'];
            $response['displayName']=$row['displayName'];
            $response['role']=$row['role'];
            $i++;
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
getUsers($conn);
?>