<?php

if(isset($_POST['poll'])){

    require_once "../../config/connection.php";
    include "functions.php";

    try{
    
        $idPoll=$_POST['poll'];
        sendUserAnswerPoll($idPoll);
    
    }catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }
    

}