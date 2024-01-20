<?php
session_start();
ob_start();
require_once "../../config/connection.php";
include "functions.php";

if(isset($_POST['submitPassword'])){

    $password=$_POST['password'];
    $rePassword=$_POST['rePassword'];
    $id=$_SESSION['korisnik']->idUser;

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
        $_SESSION['registracija_greske'] = $errors;
        $im=implode("|",$errors);
        zabeleziGreske($email,$im);

    }
    else {
        try{
            $result =updatePassword($password,$id);
        }catch(\PDOException $ex){
            echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }
    }
    
}