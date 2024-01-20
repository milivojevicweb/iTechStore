<?php

header('Content-Type: application/json');

if(isset($_POST['id'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    $id = $_POST['id'];

    try {
        deleteContact($id);
        \http_response_code(204);
    }
    catch(PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }
} else {
    http_response_code(400);
}