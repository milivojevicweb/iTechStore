<?php


if(isset($_GET['checkEmail'])){
    \header('Content-Type: application/json');

    require_once "../../config/connection.php";
    include "functions.php";
    
    $email=$_GET['checkEmail'];
    $code=301;

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){

        try{

            $result=checkEmail($email);
            $code=200;
            
        }catch(\PDOException $ex){
            echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }
        

    }else{
        $result="error";
        $code=404;
    }

    echo \json_encode($result);
}

if(isset($_POST['sendEmail'])){
    require_once "../../config/connection.php";
    include "functions.php";

    $email=$_POST['sendEmail'];
    $code=301;

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){

        try{

            $result=sendEmail($email);
            $code=200;

        }catch(\PDOException $ex){
            echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }
        

    }else{
        $result="error";
        $code=404;
    }

    \http_response_code($code);

    return $result;
}