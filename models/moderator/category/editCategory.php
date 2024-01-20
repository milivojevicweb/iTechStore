<?php
if(isset($_POST['categoryId'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    $id=$_POST['categoryId'];
    $name=$_POST['categoryName'];

    if($name!=""){
        try{
            updateCategory($name,$id);
        }catch(PDOException $ex){
            echo json_encode(['message'=> 'Database error: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }
    }
}