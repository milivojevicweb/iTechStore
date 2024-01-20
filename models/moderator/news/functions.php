<?php

function deleteNews($id){
    return uidPrepared("DELETE FROM news WHERE idNews = ?",[$id]);
}

function getNews(){
    return executeQuery("SELECT idNews,title,text,date,bigImage,image,idUser FROM news ORDER BY idNews DESC");
}

function insertNews($header,$text,$date,$bigImage,$smallImage,$idUsers){
    return uidPrepared("INSERT into news(title,text,date,bigImage,image,idUser) values(?,?,?,?,?,?)",[$header,$text,$date,$bigImage,$smallImage,$idUsers]);
}

function updateNewsWithImage($header,$text,$newImage,$oldImage,$id){
    return uidPrepared("UPDATE news SET title = ?, text = ?, bigImage=?, image=? WHERE idNews = ?",[$header,$text,$newImage,$oldImage,$id]);
}

function updateNewsNoImage($header,$text,$id){
    return uidPrepared("UPDATE news SET title = ?, text = ? WHERE idNews = ?",[$header,$text,$id]);
}

function getNewsId($id){
    return executePreparedOne("SELECT idNews,title,text,date,bigImage,image,idUser FROM news WHERE idNews= ?",[$id]);
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