<?php
    require_once "../../../config/connection.php";
    include "functions.php";
    
    \header('Content-Type: application/json');

    try{
        $poll=getAllNewsletter();
    }catch(\PDOException $e){
            echo \http_response_code(500);
            echo $e->getMessage();
    }
    echo \json_encode($poll);