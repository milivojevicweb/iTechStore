<?php

require_once "../../../config/connection.php";
include "functions.php";

if(isset($_POST['idnewsletter'])){
    $code=$_POST['code'];
    $title=$_POST['title'];
    $id=$_POST['idnewsletter'];

    if($title==""){
        $errors[] = "Title is required";
    }
    if($code==""){
        $errors[] = "Code is required";
    }

    if($error==""){

        try {
            updateNewsletter($id,$title,$code);
        }
        catch(PDOException $ex){
            echo json_encode(['poruka'=> 'Problem sa bazom: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }

    }
}