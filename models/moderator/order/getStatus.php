<?php
if(isset($_GET['id'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    \header('Content-Type: application/json');
    $id=$_GET['id'];

    try{
        $status = getStatus($id);
    }catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }
    


    echo json_encode($status);
}