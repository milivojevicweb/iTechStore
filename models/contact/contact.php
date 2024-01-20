<?php
session_start();
ob_start();
if(isset($_POST['sendContact'])){
    require_once "../../config/connection.php";
    include "functions.php";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone=$_POST['phone'];
    $text=$_POST['text'];
    $errors = [];
    $reName="/^[A-ZŽŠĐČĆ][a-zžšđčć]{1,30}\s[A-ZŽŠĐČĆ][a-zžšđčć]{1,30}$/";
    $rePhone="/^[0-9]*$/";

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email error";
    }

    if(!preg_match($reName, $name)){
      $errors[] = "Name error.";
    }
    if(!preg_match($rePhone, $phone)){
        $errors[] = "Phone error.";
    }
    if($text==""){
        $errors[] = "Text error.";
    }

    if(count($errors) > 0){
        $_SESSION['contact_error'] = "Error!";
        \header("Location: ../../index.php?page=contact");
    }
    else {
        try{
            $result=insertContact($name,$email,$text,$phone);
            if($result){
                $_SESSION['contact_error'] = "Success!";
            }else{
                $_SESSION['contact_error'] = "Error!";
            }
            \header("Location: ../../index.php?page=contact");
        }catch(\PDOException $ex){
            echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }
        
    }
}
