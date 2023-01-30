<?php
header("Access-Control-Allow-Origin: *");
require_once 'Database.php';
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");

function postArticles($conn){
    $postdata = file_get_contents("php://input");

    if(isset($postdata) && !empty($postdata)){
       $request = json_decode($postdata);
	
        
  // Validate.
        if(trim($request->name) === '' || trim($request->price) === '' || (int)$request->amount < 1 || trim($request->media) === '' )
            {
                return http_response_code(400);
            }
	
  // Sanitize.
             $name = mysqli_real_escape_string($conn, trim($request->name));
             $price = mysqli_real_escape_string($conn, (double)$request->price);
             $amount = mysqli_real_escape_string($conn, (int)$request->amount);
             $media = mysqli_real_escape_string($conn, trim($request->media));
    

  // Store.
  $sql = "insert into articles (name, price, amount, media) values('{$name}', '{$price}', '{$amount}', '{$media}')";

  if(mysqli_query($conn,$sql))
  {
    http_response_code(201);
    $article = [
      'name' => $name,
      'price' => $price,
      'amount'=> $amount,
      'media' => $media
    ];
    echo json_encode(['data'=>$article]);
  }
  else
  {
    http_response_code(422);
  }
}
}
postArticles($conn);
?>