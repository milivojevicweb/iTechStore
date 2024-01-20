<?php

if(isset($_POST['id'])){
    
    require_once "../../config/connection.php";
    include "functions.php";

    try{
        $product=$_POST['product'];
        $id=$_POST['id'];


        if($id=="0"){

            $products=paginationNumber($product);
            \http_response_code(200);
            echo json_encode($products);

        }

    }
    catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }
}