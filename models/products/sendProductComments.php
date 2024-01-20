<?php
session_start();
if(isset($_POST['comment'])){

    require_once "../../config/connection.php";
    include "functions.php";

    $userId=(int)$_POST['userId'];
    $productId=(int)$_POST['productId'];
    $comment=$_POST['comment'];


    try{
        insertComment($userId,$productId,$comment);
    }catch(\PDOException $ex){
            echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
            \http_response_code(500);
            upisGreskeIzBaze($ex);
    }
}