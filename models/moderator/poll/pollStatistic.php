<?php
    if(isset($_GET['id'])){
        require_once "../../../config/connection.php";
        include "function.php";
        
        \header('Content-Type: application/json');
        $id=$_GET['id'];
        try{
            $poll=pollResult($id);
        }catch(\PDOException $e){
                echo http_response_code(500);
                echo $e->getMessage();
        }
        echo \json_encode($poll);
    }