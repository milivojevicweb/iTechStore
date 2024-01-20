<?php

if(isset($_POST['categoryName'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    $name=$_POST['categoryName'];
    if($name!=""){
        try{
            insertCategory($name);
        }catch(PDOException $ex){
            echo json_encode(['message'=> 'Database error: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }
    }
}