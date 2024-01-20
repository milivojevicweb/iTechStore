<?php
header('Content-Type: application/json');

require_once "../../../config/connection.php";
include "functions.php";
$firstDate=$_GET['firstDate'];
$secondDate=$_GET['secondDate'];
$status=$_GET['statusOrder'];
$searchId=$_GET['searchId'];
$payment=$_GET['payment'];

$query="SELECT COUNT(o.idOrders) AS number  FROM orders o INNER JOIN orders_products op on op.idOrders=o.idOrders INNER JOIN product p on p.idProduct=op.idProduct  WHERE o.idOrders LIKE '%$searchId%'  ";

    if($payment!=""){
        $query.=" AND idOrderPaymentMethod=$payment  ";
    }
    if($status==""){
        if($firstDate!="" && $secondDate!=""){
            $query.=" AND (o.dateOrders BETWEEN '$firstDate' AND '$secondDate' ) ";
        }
    }else{
        if($firstDate=="" && $secondDate==""){
             $query.=" AND o.idOrderStatus=$status";
        }else {
            $query.=" AND (o.dateOrders BETWEEN '$firstDate' AND '$secondDate' ) AND o.idOrderStatus=$status";
        }

    }

    $query.=" GROUP BY o.idOrders";

    try{
        $result=["number"=>rowCount($query)];
    }catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }

echo json_encode($result);