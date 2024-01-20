<?php

function accessAllowCartPage(){

    if(isset($_SESSION['korisnik']) && ($_SESSION['korisnik']->idRole == 1 || $_SESSION['korisnik']->idRole == 3)){
        $_SESSION['greska'] = "NISTE USER!";
        header("Location: index.php");
    }
}

function accessAllowCartSuccessPage(){

    if(!isset($_SESSION['korisnik'])){
        header("Location: index.php");
    }

    if(isset($_SESSION['korisnik']) && ($_SESSION['korisnik']->idRole == 1 || $_SESSION['korisnik']->idRole == 3)){
        $_SESSION['greska'] = "NISTE USER!";
        header("Location: index.php");
    }
}

function accessAllowCart(){
    if(!isset($_SESSION['korisnik'])){
        $_SESSION['greska'] = "NISTE ULOGOVANI!";
        header("Location: index.php");
    }
    if($_SESSION['korisnik']->idRole != 2 && $_SESSION['korisnik']->idRole != 4){
        $_SESSION['greska'] = "NISTE USER!";
        header("Location: index.php");
    }
}