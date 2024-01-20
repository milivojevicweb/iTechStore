<?php

if(isset($_POST['idpag'])){
    require_once "../../config/connection.php";
    include "functions.php";

    $page=($_POST["idpag"]-1)*4;
    

    try{

        $result=getNewsPagination($page);
        echo json_encode($result);
        http_response_code(201);
    }
    catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }
}
?>