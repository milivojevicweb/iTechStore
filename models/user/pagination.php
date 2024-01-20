<?php


 if(isset($_POST['idpag'])){
    require_once "../../config/connection.php";
    include "functions.php";

    $page=($_POST["idpag"]-1)*6;
    $idUser=$_POST['idUser'];
    

    try{

        $result=getUserOrderPagination($idUser,$page);
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