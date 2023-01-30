<?php
header("Access-Control-Allow-Origin: *");
require_once 'Database.php';
header("Content-Type: application/json; charset=UTF-8");

function getArticles($conn){
    $sql = "select * from articles order by id asc";
    $result=mysqli_query($conn, $sql);
    if($result){
        header("Content-Type: JSON");
        $i=0;
        while($row= mysqli_fetch_assoc($result)){
            $response[$i]['id']=$row['id'];
            $response[$i]['name']=$row['name'];
            $response[$i]['price']=$row['price'];
            $response[$i]['amount']=$row['amount'];
            $response[$i]['media']=$row['media'];
            $i++;
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
getArticles($conn);
?>