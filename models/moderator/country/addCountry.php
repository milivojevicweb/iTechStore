<?php

if(isset($_POST['contryName'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    $name=$_POST['contryName'];
    if($name!=""){
        try{
            insertContry($name);
        }catch(PDOException $ex){
            echo json_encode(['message'=> 'Database error: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }
    }
}