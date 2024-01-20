<?php

use Stripe\Product;


if(isset($_GET['oneProductId'])){
    header('Content-Type: application/json');

    require_once "../../config/connection.php";
    include "functions.php";

    $id=$_GET['oneProductId'];
    try{
        $product=getOneProductQuantity($id);
    }catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }

    echo json_encode($product);
}
