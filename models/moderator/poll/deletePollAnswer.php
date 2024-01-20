<?php
if(isset($_POST['id'])){
    require_once "../../../config/connection.php";
    include "function.php";
    
    $id=$_POST['id'];

    try{
        $poll=deletePollAnswer($id);
    }catch(\PDOException $e){
            echo http_response_code(500);
            echo $e->getMessage();
    }
}
