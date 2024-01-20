<?php

if(isset($_POST['value'])){
    require_once "../../config/connection.php";
    include "functions.php";

    $value=$_POST['value'];
    $product=$_POST['product'];
    $price=$_POST['price'];

    try{
        
        if($value==""){
            $sql=filterProductsPrice($product,$price);
        }
        else{
            $sql =  filterProductsPriceSearch($product,$value,$price);
        }

        \http_response_code(200);
        echo json_encode($sql);
    }
    catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }

}
