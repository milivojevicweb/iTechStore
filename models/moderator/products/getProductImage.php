<?php

include "../../../config/connection.php";
include "functions.php";

if(isset($_GET['profileImage']) && isset($_GET['idProduct'])){

    header('Content-Type: application/json');

    try{
        $idProduct=$_GET['idProduct'];
        $image=getProfileImage($idProduct); 
    }catch(PDOException $e){
        $e->getMessage();
        upisGreskeIzBaze($e);
    }
    echo json_encode($image);

}

if(isset($_GET['multiImage']) && isset($_GET['idProduct'])){
    header('Content-Type: application/json');

    try{
        $idProduct=$_GET['idProduct'];
        $images=getMultiImage($idProduct);
    }catch(PDOException $e){
        $e->getMessage();
        upisGreskeIzBaze($e);
    }
    echo json_encode($images);

}