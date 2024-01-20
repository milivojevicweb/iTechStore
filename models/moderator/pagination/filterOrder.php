<?php
header('Content-Type: application/json');

require_once "../../../config/connection.php";
include "functions.php";
$firstDate=$_GET['firstDate'];
$secondDate=$_GET['secondDate'];
$status=$_GET['statusOrder'];
$searchId=$_GET['searchId'];
$payment=$_GET['payment'];
$page=($_GET["page"]-1)*6;


$query="SELECT DISTINCT opm.name AS payment, o.idOrders,o.dateOrders,o.date,os.name AS status,os.idOrderStatus,o.total,k.name,k.lastName FROM product p INNER JOIN orders_products op on p.idProduct=op.idProduct INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_status os ON o.idOrderStatus=os.idOrderStatus INNER JOIN order_payment_method opm ON o.idOrderPaymentMethod=opm.idOrderPaymentMethod WHERE o.idOrders LIKE '%$searchId%'  ";


    if($payment!=""){
        $query.="AND o.idOrderPaymentMethod=$payment";
    }

    if($status==""){
        if($firstDate!="" && $secondDate!=""){
            $query.=" AND (o.dateOrders BETWEEN '$firstDate' AND '$secondDate' ) ";
        }
    }else{
        if($firstDate=="" && $secondDate==""){
             $query.=" AND  os.idOrderStatus=$status";
        }else {
            $query.=" AND  (o.dateOrders BETWEEN '$firstDate' AND '$secondDate' ) AND os.idOrderStatus=$status";
        }

    }
    $query.=" ORDER BY o.idOrders DESC LIMIT 6 OFFSET $page";

    try{
        $result=executeQuery($query);
    }catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }

echo json_encode($result);