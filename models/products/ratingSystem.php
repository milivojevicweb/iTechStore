<?php
require_once "../../config/connection.php";
require_once "functions.php";

if(isset($_POST['index']) && isset($_POST['idProducts'])){
    $ipAddress=$_SERVER['REMOTE_ADDR'];
    $index=$_POST['index'];
    $idProducts=$_POST['idProducts'];

    try{

        if(checkAddressRating($ipAddress,$idProducts)){
            updateRating($index,$idProducts,$ipAddress);
        }else{
            insertRating($idProducts,$index,$ipAddress);
        }

        echo retingForProductAvg($idProducts)->avg;
        
    }catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }

}