<?php
session_start();
ob_start();
if(isset($_POST['password'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    $name=$_POST['name'];
    $lastName=$_POST['lastName'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $idRole=$_POST['role'];
    $idContry=$_POST['contry'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $zip=$_POST['zip'];
    $errors = [];
    $rePassword = "/[0-9]{0,16}[\w]{0,15}/";
    $reName="/^[A-Z][a-z]+$/";
    $reLastName="/^[A-Z][a-z]+$/";
    $reNumber="/^[0-9]+$/";
    $reAddress="/^[a-zA-Z0-9šŠđĐžŽčČćĆ\s \/\-\.]+$/";
    $reCity="/^([\w]+\D|[\w]+\s[\w]+\D)$/";
    $reZip="/^[\d]{5}$/";
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email nije dobar";
    }
    if(!preg_match($reName, $name)){
        $errors[] = "reNameIme nije dobro.";
    }
    if(!preg_match($reCity, $city)){
        $errors[] = "Error City";
    }
    if(!preg_match($reAddress, $address)){
        $errors[] = "Error Address";
    }
    if(!preg_match($reZip, $zip)){
        $errors[] = "Error Zip";
    }
    if(!preg_match($reLastName, $lastName)){
        $errors[] = "Prezime nije dobro.";
    }
    if(!preg_match($rePassword, $password)){
        $errors[] = "Lozinka nije dobra.";
    }
    if($idRole ==0){
        $errors[] = "Izaberi ulogu.";
    }
    if($idContry ==0){
        $errors[] = "Choose Contry.";
    }
    if(count($errors) > 0){
        $_SESSION['greske_admin'] = $errors;
    }
    else {

        try {
            insertUser($name,$lastName,$email,$password,$idRole,$city,$zip,$address,$idContry);
            $code=201;
        }
        catch(PDOException $ex){
             $ex->getMessage();
             upisGreskeIzBaze($ex);
        }
        $_SESSION['dobro_admin']="Uspesan unos";
    }
}
