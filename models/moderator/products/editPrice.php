<?php
if(isset($_POST['oldPrice']) && isset($_POST['newPrice'])){

    include "../../../config/connection.php";
    include "functions.php";


    $newPrice=$_POST['newPrice'];
    $oldPrice=$_POST['oldPrice'];
    $id=$_POST['id'];
    $error="";
    if (!filter_var($newPrice, FILTER_VALIDATE_INT)) {
        $error="newPrice";
    }

    if (!filter_var($oldPrice, FILTER_VALIDATE_INT)) {
        $error="oldPrice";
    }

    if(checkId($id)->number<1){
        $error="id";
    }


    if($error==""){
        try{
            $result=updatePrice($oldPrice,$newPrice,$id);
        }catch(PDOException $e){
            $e->getMessage();
            upisGreskeIzBaze($e);
        }
    }else{
        echo $error;
    }
}
