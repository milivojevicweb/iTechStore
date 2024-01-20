<?php

if(isset($_GET['id'])){
    require_once "../../../config/connection.php";
    include "functions.php";
    
    $id = $_GET['id'];

    try {
        deleteProduct($id);
        http_response_code(204);
    }
    catch(PDOException $ex){
        echo json_encode(['poruka'=> 'Problem sa bazom: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }
} else {
    http_response_code(400);
}