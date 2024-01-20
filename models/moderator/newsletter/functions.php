<?php

function getAllEmail(){
    return executeQuery("SELECT email FROM newsletter_client");
}

function insertNewsletter($title,$code){
    return uidPrepared("INSERT INTO newsletter(title,code,date) VALUES(?,?,NOW())",[$title,$code]);
}

function getAllNewsletter(){
    return executeQuery("SELECT idNewsletter,title,code,date FROM newsletter ORDER BY idNewsletter DESC LIMIT 6");
}

function checkIdNewsletter($id){
    $id=executePreparedOne("SELECT COUNT(idNewsletter) AS count FROM newsletter WHERE idNewsletter=?",[$id]);
    if($id->count<1){
        \header('Location: index.php');
    }
}

function getOneNewsletter($id){
    return executePreparedOne("SELECT title,code,date,idNewsletter FROM newsletter WHERE idNewsletter=?",[$id]);
}

function updateNewsletter($id,$title,$code){
    return uidPrepared("UPDATE newsletter SET title=?,code=? WHERE idNewsletter=?" ,[$title,$code,$id]);
}

function deleteNewsletter($id){
    return uidPrepared("DELETE FROM newsletter WHERE idNewsletter=?",[$id]);
}

function accessAllowModerator(){
    if(!isset($_SESSION['korisnik'])){
        $_SESSION['greska'] = "NISTE ULOGOVANI!";
        header("Location: index.php");
    }
    if($_SESSION['korisnik']->idRole == 2){
        $_SESSION['greska'] = "NISTE MODERATOR!";
        header("Location: index.php");
    }
}