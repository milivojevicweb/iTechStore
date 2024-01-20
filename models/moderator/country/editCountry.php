<?php
if(isset($_POST['contryId'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    $id=$_POST['contryId'];
    $name=$_POST['contryName'];

    if($name!=""){
        try{
            updateContry($name,$id);
        }catch(PDOException $ex){
            echo json_encode(['message'=> 'Database error: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }
    }
}