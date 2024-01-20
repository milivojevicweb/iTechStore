<?php
session_start();
if(isset($_POST['btnLogin'])){
    require_once "../../config/connection.php";
    include "functions.php";
$r=0;
  $email = $_POST['tbEmail'];
  $lozinka =md5($_POST['tbLozinka']);
  $errors = [];
  $reLozinka = "/[0-9]{0,16}[a-z]{0,15}/";
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors[] = "Email nije ok";
    $r=1;
  }
  if(!preg_match($reLozinka, $lozinka)){
    $errors[] = "Lozinka nije ok.";
    $r=1;
  }
  if($r==1){
    $_SESSION['logovanje_greska'] = $errors;
    header("Location: ../../index.php?page=login");

  }
  else {
        try{
  
          $user =  getUserParam($email,$lozinka);
          if($user){ 
              if(checkUserExist($email,$lozinka)->number==1){
                  $_SESSION["korisnik_id"] = $user->idUser;
                  $_SESSION['korisnik'] = $user;
                  $_SESSION['logovanje_dobro']="";
                   
                  

                    
                  if($_SESSION['korisnik']->idRole == 1){
                      header("Location: ../../index.php?page=admin");
                  }
                  elseif($_SESSION['korisnik']->idRole == 3){
                      header("Location: ../../index.php?page=moderator");
                  }
                  elseif($_SESSION['korisnik']->idRole == 4){
                    header("Location: ../../index.php?page=admin");
                  }
                  else {
                      header("Location: ../../index.php?page=user");
                  }
              } else {
                   $_SESSION['logovanje_greska']="Nesto nije uredu!";
                   header("Location: ../../index.php?page=login");  
                   mail($email,"Poruka sa sajta","Niste se lepo ulogovali",'From:markoitech.000webhostapp.com');
                   $im=implode("|",$errors);
                   zabeleziGreske($email,"niste se lepo ulogovali");
              }
          } else {
            $_SESSION['logovanje_greska']="Nesto nije uredufff!";
            header("Location: ../../index.php?page=login");
            mail($email,"Poruka sa sajta","Niste se lepo ulogovali",'From:markoitech.000webhostapp.com');
            $im=implode("|",$errors);
            zabeleziGreske($email,"niste se lepo ulogovali");

          }
        }catch(\PDOException $ex){
          echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
          http_response_code(500);
          upisGreskeIzBaze($ex);
      }
      
  }
  }
