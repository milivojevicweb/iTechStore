<?php

if(isset($_GET['id'])){
    header('Content-Type: application/json');

    require_once "../../config/connection.php";
    include "functions.php";

    $id=$_GET['id'];
    try{
        $product=retingForProductAvg($id);
    }catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }

    echo json_encode($product);
}
