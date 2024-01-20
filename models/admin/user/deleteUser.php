<?php

header('Content-Type: application/json');

if(isset($_POST['idUser'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    $id = $_POST['idUser'];

    try {
        deleteUser($id);
        http_response_code(204);
    }
    catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }
} else {
    http_response_code(400);
}