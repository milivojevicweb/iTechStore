<?php
ob_start();
if(isset($_POST['email']) && isset($_POST['token'])){
    require_once "../../config/connection.php";
    require_once "functions.php";

    $email=$_POST['email'];
    $token=$_POST['token'];

    $password=$_POST['password'];
    $rePassword=$_POST['rePassword'];

    
    $errors = [];
    $regexPassword ="/[0-9]{0,16}[a-z]{0,15}/";


    if(!preg_match($regexPassword, $password)){
        $errors[] = "Name is not ok.";
    }
    if(!preg_match($regexPassword, $rePassword)){
        $errors[] = "Prezime nije ok.";
    }
    if($password!=$rePassword){
        $errors[] = "Prezime nije ok.";
    }


    if(count($errors) > 0){
        header("Location: ../../index.php?page=home");
    }else{

        if(checkEmailAndToken($email,$token)){

            if(updatePassword($password,$email,$token)){
                header("Location: ../../index.php?page=home");
            }else{
                header("Location: ../../index.php?page=resetPasswordEmail");

            }
        }else{
            echo"error";
            var_dump(checkEmailAndToken($email,$token));
            
            echo $token;

        }
    }
}else{
    echo"error";
}