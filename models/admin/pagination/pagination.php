<?php
 if(isset($_POST['send'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    $page=($_POST["idpag"]-1)*6;
    $name=$_POST["name"];

    try{

        if($name=="Contact"){
            if(isset($_POST["contactStatus"])){
                $status=$_POST["contactStatus"];
                if($status=="1" || $status=="0"){
                    $result=getContactStatus($status,$page);
                }else{
                    $result=getAllContactPagination($page);
                }
            }else{
                $result=getAllContactPagination($page);
            }
            
        }else if($name=="User"){
            $result=getAllUserPagination($page);
        }

        echo json_encode($result);
        http_response_code(200);
    }
    catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }
}
?>