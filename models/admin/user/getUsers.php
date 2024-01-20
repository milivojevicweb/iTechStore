<?php

header('Content-Type: application/json');

require_once "../../../config/connection.php";
include "functions.php";

$code=500;
try{
    $users = getUsers();
    if($users){
        $code=201;
        echo json_encode($users);
    }else{
        $code=301;
    }
}
catch(\PDOException $ex){
    echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
    \http_response_code(500);
    upisGreskeIzBaze($ex);
}
http_response_code($code);

