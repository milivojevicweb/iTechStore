<?php

    header('Content-Type: application/json');
    require_once "../../../config/connection.php";
    include "functions.php";

    try{

            $count=countUser();
            \http_response_code(200);
            echo json_encode($count);

    }
    catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }