<?php
if(isset($_POST['id'])){
    require_once "../../../config/connection.php";
    include "function.php";

    $id=$_POST['id'];

    try{
        $status=(int)getStatus($id)->status;
        if($status==1){
            changeStatusInactive($id);
        }else{
            $getAllStatus=allStatus();
            foreach($getAllStatus as $item){
                changeAllPollStatusInactive($item->idPoll);
            }
            changeStatusActive($id);
            
        }


    }catch(\PDOException $e){
            echo http_response_code(500);
            echo $e->getMessage();
    }
}