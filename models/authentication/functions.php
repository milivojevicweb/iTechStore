<?php

function updateToken($token,$email){
    return uidPrepared("UPDATE user set token=? WHERE email=?",[$token,$email]);
}

function checkEmail($email){
    return executePreparedOne("SELECT * from user where email=?",[$email]);
}

function checkEmailAndToken($email,$token){
    return executePreparedOne("SELECT * from user where email=? AND token=?",[$email,$token]);
}

function updatePassword($password,$email,$token){
    return uidPrepared("UPDATE user set password=? where email=? AND token=?",[md5($password),$email,$token]);
}

function getUserParam($email,$password){
    return executePreparedOne("SELECT idUser,name,lastName,email,address,city,zip,idRole,idCountry FROM  user WHERE email = ? AND password =?",[$email,$password]);
}

function checkUserExist($email,$password){
    return executePreparedOne("SELECT COUNT(idUser) AS number FROM  user WHERE email = ? AND password =?",[$email,$password]);
}

function checkLoginUser(){
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->idRole!=4){
        $_SESSION['greska'] = "NISTE ULOGOVANI!";
        header("Location: index.php");
    }

}

function registrationContry() {
    return executeQuery("SELECT idCountry,name FROM country");
}

function registration($ime,$prezime,$email,$lozinka,$addres,$city,$zip,$idRole,$country){
    return uidPrepared("INSERT into user(name,lastName,email,password,address,city,zip,idRole,idCountry)values(?,?,?,?,?,?,?,?,?)",[$ime,$prezime,$email,$lozinka,$addres,$city,$zip,$idRole,$country]);
}

function getUserInfo($name,$lastName,$email,$password){
    return executePreparedOne("SELECT * FROM user WHERE name=? and lastName=? and email = ? AND password =?",[$name,$lastName,$email,$password]);
}