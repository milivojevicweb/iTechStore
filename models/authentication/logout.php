<?php
session_start();
global $konekcija;
if(isset($_SESSION['korisnik'])){
    unset($_SESSION['korisnik']);
    session_destroy();
    header("Location: index.php");
}