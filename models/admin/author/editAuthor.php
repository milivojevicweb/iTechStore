<?php
session_start();
if(isset($_POST['id'])){
    require_once "../../../config/connection.php";
    include "functions.php";
    $id = $_POST['id']; 
    $name = $_POST['name'];
    $text = $_POST['text'];
    $reName="/^[A-ZŽŠĐČĆ][a-zžšđčć]{1,30}\s[A-ZŽŠĐČĆ][a-zžšđčć]{1,30}$/";
    $error=0;
    if(!preg_match($reName,$name)){
        $_SESSION['autorGreska']="Ime i prezime nisu dobri";
        $error=1;
    }
    if($text==""){
        $_SESSION['autorGreska']="Text error!";
        $error=1;
    }
    if($error==0){
        try{
        $rezultat=editAuthor($name,$text,$id);
        }catch(\PDOException $ex){
            echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
            \http_response_code(500);
            upisGreskeIzBaze($ex);
        }
    }
}