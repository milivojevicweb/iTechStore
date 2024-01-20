<?php

if(isset($_GET['name'])){
    header('Content-Type: application/json');
    require_once "../../../config/connection.php";
    include "functions.php";

    $name=$_GET['name'];
    try{

        if($name=="Contact"){
            if(isset($_GET['contactStatus'])){
                $status=$_GET['contactStatus'];
                if($status=="1" || $status=="0"){

                    $count=countContactStatus($status);
                }else{
                    $count=countContact();
                }
            }else{
                $count=countContact();
            }
           
        }elseif($name=="User"){
            $count=countUser();
        }

            \http_response_code(200);
            echo json_encode($count);

    }
    catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }
}