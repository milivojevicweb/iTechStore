<?php
session_start();
ob_start();
require_once "../../config/connection.php";
include "functions.php";

if(isset($_POST['submitInfo'])){

    $name=$_POST['name'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $addres=$_POST['address'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $zip=$_POST['zip'];
    $id=$_SESSION['korisnik']->idUser;

    $errors = [];
    $reName="/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14})*$/";
    $reLastname="/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14})*$/";
    $reAddress="/^[a-zA-Z0-9šŠđĐžŽčČćĆ\s \/\-\.]+$/";
    $reCity="/^([\w]+\D|[\w]+\s[\w]+\D)$/";
    $reZip="/^[\d]{5}$/";

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       $errors[] = "Email nije ok";
    }
    if(!preg_match($reName, $name)){
        $errors[] = "Name is not ok.";
    }
    if(!preg_match($reLastname, $lastname)){
        $errors[] = "Prezime nije ok.";
    }
    if(!preg_match($reAddress, $addres)){
        $errors[] = "Adresa nije ok.";
    }
    if(!preg_match($reCity, $city)){
        $errors[] = "Grad nije ok.";
    }
    if(!preg_match($reZip, $zip)){
        $errors[] = "Zip nije ok.";
    }
    if($country==0){
        $errors[] = "Drzava nije ok.";
    }


    if(count($errors) > 0){
        $_SESSION['registracija_greske'] = $errors;
        $im=implode("|",$errors);
        zabeleziGreske($email,$im);

    }
    else {
        try{
            $result =updateUserInfo($name,$lastname,$email,$city,$zip,$country,$id);
        }catch(\PDOException $ex){
            echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
            http_response_code(500);
            upisGreskeIzBaze($ex);
        }
    }
    
}