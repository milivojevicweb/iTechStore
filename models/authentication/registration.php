<?php
session_start();
ob_start();
if(isset($_POST['registration'])){
    require_once "../../config/connection.php";
    include "functions.php";
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6Lf_0NAUAAAAAGGwkeYWbPltykyJw0ZWbl7TGa1f';
    $recaptcha_ip = $_SERVER['REMOTE_ADDR'];
    $recaptcha_response = $_POST['re'];

    // Make and decode POST request
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response . '&remoteip=' . $recaptcha_ip);
    $recaptcha = json_decode($recaptcha);
    if($recaptcha->success==true) {
            http_response_code(200);

        $ime=$_POST['imeReg'];
        $prezime=$_POST['prezimeReg'];
        $email=$_POST['emailReg'];
        $lozinka=md5($_POST['passwordReg']);
        $addres=$_POST['addressReg'];
        $city=$_POST['cityReg'];
        $country=$_POST['countryReg'];
        $zip=$_POST['zipCode'];
        $idRole=2;
        

        $errors = [];
        $reLozinka ="/^[a-f0-9]{32}$/";
        $reIme="/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14})*$/";
        $rePrezime="/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14})*$/";
        $reAddress="/^[a-zA-Z0-9šŠđĐžŽčČćĆ\s \/\-\.]+$/";
        $reCity="/^([\w]+\D|[\w]+\s[\w]+\D)$/";
        $reZip="/^[\d]{5}$/";
        $reEmail="/^\w+([.-]?[\w\d]+)*@\w+([.-]?[\w]+)*(\.\w{2,4})+$/";
    
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
           $errors[] = "Email nije ok";
        }
        // if(!preg_match($reEmail, $email)){
        //     $errors[] = "Ime nije ok.";
        // }
        if(!preg_match($reIme, $ime)){
            $errors[] = "Ime nije ok.";
        }
        if(!preg_match($rePrezime, $prezime)){
            $errors[] = "Prezime nije ok.";
        }
        if(!preg_match($reLozinka, $lozinka)){
            $errors[] = "Lozinka nije ok.";
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
            header("Location: ../../index.php?page=home");
        }
        else {
            $rezultat =registration($ime,$prezime,$email,$lozinka,$addres,$city,$zip,$idRole,$country);
            
            if($rezultat){
                    try{

                    $korisnik = getUserInfo($ime,$prezime,$email,$lozinka);

                    $_SESSION["korisnik_id"] = $korisnik->idUser;
                    $_SESSION['korisnik'] = $korisnik;
                    if($_SESSION['korisnik']->idRole == 1){
                        header("Location: ../../index.php?page=admin");
                    }
                    elseif($_SESSION['korisnik']->idRole == 3){
                        header("Location: ../../index.php?page=moderator");
                    }
                    elseif($_SESSION['korisnik']->idRole == 4){
                        header("Location: ../../index.php?page=developer");
                    }
                    else {
                        header("Location: ../../index.php?page=user");

                    }
                }catch(\PDOException $ex){
                    echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
                    http_response_code(500);
                    upisGreskeIzBaze($ex);
                }
                

            } else {
                header("Location: ../../index.php?page=user");
            }
        }
    }
    }