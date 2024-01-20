<?php

function getUsers(){
    return executeQuery("SELECT idUser,name,lastName,email,password,address,city,token,u.idRole,idCountry,u.name FROM user k INNER JOIN role u ON k.idRole=u.idRole");
}

function deleteUser($id){
    return uidPrepared("DELETE FROM user WHERE idUser = ?",[$id]);
}

function insertUser($name,$lastName,$email,$password,$idRole,$city,$zip,$address,$idContry){
    return uidPrepared("INSERT into user(name,lastName,email,password,idRole,city,zip,address,idCountry) values(?,?,?,?,?,?,?,?,?)",[$name,$lastName,$email,$password,$idRole,$city,$zip,$address,$idContry]);
}

function getUser($id){
    return executePreparedOne("SELECT idUser,name,lastName,email,zip,password,address,city,token,idRole,idCountry FROM user WHERE idUser=?",[$id]);
}

function editUser($name,$lastName,$email,$idRole,$city,$zip,$address,$idContry,$idUser){
    return uidPrepared("UPDATE user SET name = ?, lastName = ?, email = ?,idRole = ?,city= ?,zip=?, address=?, idCountry=? WHERE idUser = ?",[$name,$lastName,$email,$idRole,$city,$zip,$address,$idContry,$idUser]);
}

function role(){
    return executeQuery("SELECT idRole,name FROM role");
}

function contry(){
    return executeQuery("SELECT idCountry, name AS countryName FROM country");
}

function accessAllowAdmin(){
    if(!isset($_SESSION['korisnik'])){
        $_SESSION['greska'] = "NISTE ULOGOVANI!";
        header("Location: index.php");
    }
    if($_SESSION['korisnik']->idRole != 1 && $_SESSION['korisnik']->idRole != 4){
        $_SESSION['greska'] = "NISTE ADMIN!";
        header("Location: index.php");
    }
}
