<?php
$code=500;
if(isset($_GET['id'])){
header('Content-Type: application/json');

require_once "../../../config/connection.php";
include "functions.php";

$status=$_GET['id'];
try{
    $orders=getOrderStatus($status);
    $code=200;
}catch(\PDOException $ex){
    echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
    \http_response_code(500);
    upisGreskeIzBaze($ex);
}

http_response_code($code);
}
echo json_encode($orders);