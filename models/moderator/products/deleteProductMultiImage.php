<?php

if( isset($_POST['idImages'])){
    include "../../../config/connection.php";
    include "functions.php";


    $idImages=$_POST['idImages'];
    try{

        $image=deleteProductMultiImages($idImages); 
    }catch(PDOException $e){
        $e->getMessage();
        upisGreskeIzBaze($e);
    }

}

