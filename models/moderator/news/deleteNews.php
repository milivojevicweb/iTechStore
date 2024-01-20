<?php

if(isset($_POST['idNews'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    $id = $_POST['idNews'];

    try {
        deleteNews($id);
        \http_response_code(204);
    }
    catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }
} else {
    \http_response_code(400);
}