<?php
if(isset($_POST['idUser'])){
    require_once "../../../config/connection.php";
    include "functions.php";
  $idUser = $_POST['idUser']; 
  $name = $_POST['name'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $city = $_POST['city']; 
  $address = $_POST['address'];
  $zip = $_POST['zip'];
  $idContry = $_POST['contry'];
//   $password = md5($_POST['password']);
  $role = $_POST['role'];
  $errors = [];
  $reName="/^[A-Z][a-z]+$/";
  $reLastName="/^[A-Z][a-z]+$/";
  $reAddress="/^[a-zA-Z0-9šŠđĐžŽčČćĆ\s \/\-\.]+$/";
  $reCity="/^([\w]+\D|[\w]+\s[\w]+\D)$/";
  $reZip="/^[\d]{5}$/";

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors[] = "Email nije dobar";
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
    if(!preg_match($reName, $name)){
        $errors[] = "Ime nije dobro.";
    }
    if(!preg_match($reLastName, $lastName)){
        $errors[] = "Prezime nije dobro.";
    }
    if($role ==0){
        $errors[] = "Izaberi ulogu.";
    }
    if($idContry ==0){
        $errors[] = "Choose Contry.";
    }
    if(count($errors) > 0){
        $_SESSION['greske_korisnik'] = $errors;
        var_dump($errors);
    }
    else {
        try{
            editUser($name,$lastName,$email,$role,$city,$zip,$address,$idContry,$idUser);
        
        }catch(PDOException $e){
            $e->getMessage();
            upisGreskeIzBaze($e);
        }
    }
}