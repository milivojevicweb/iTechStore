<?php

if(isset($_GET['id'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    header('Content-Type: application/json');

    $id=$_GET['id'];

        try{
            $result=getContryInfo($id);


        }catch(PDOException $ex){
            echo json_encode(['message'=> 'Database error: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }

        echo json_encode($result);
    
}