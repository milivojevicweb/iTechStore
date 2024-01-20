<?php


function getProductImage($id){
    return executePrepared("SELECT i.path,i.alt FROM product p INNER JOIN images i on p.idProduct=i.idProduct WHERE p.idProduct= ?",[$id]);
}

function getProductInfo($id){
    return executePreparedOne("SELECT name,description,oldPrice,newPrice,Quantity FROM product  WHERE idProduct= ?",[$id]);
}

function getComment($id){
    return executePrepared("SELECT c.idComment,c.comment,c.date,k.name,k.lastName,u.idRole FROM product p INNER JOIN comments c on p.idProduct=c.idProduct INNER JOIN user k on c.idUser=k.idUser INNER JOIN role u on k.idRole=u.idRole WHERE p.idProduct = ?",[$id]);
}

function getRepliesComment($id){
    return executePrepared("SELECT cr.idReplies,cr.text,cr.date,k.name,k.lastName,u.idRole FROM comments c INNER JOIN comment_replies cr ON c.idComment=cr.idComment INNER JOIN users_comment_replies ucr ON cr.idReplies=ucr.idReplies INNER JOIN user k ON ucr.idUser=k.idUser INNER JOIN role u on k.idRole=u.idRole WHERE c.idComment= ?",[$id]);
}

function getAllCommentNumber($id){
    return executeQueryOneRow("SELECT COUNT(cr.idReplies)+(SELECT COUNT(c.idComment) FROM product p INNER JOIN comments c on p.idProduct=c.idProduct WHERE p.idProduct=$id) as total FROM product p INNER JOIN comments c ON p.idProduct=c.idProduct INNER JOIN comment_replies cr ON c.idComment=cr.idComment WHERE p.idProduct=$id");
}

function getCommentNumber($id){
    return executeQueryOneRow("SELECT COUNT(idComment) as total FROM comments WHERE idProduct=$id");
}

function repliesNumber($id){
    return brojRedova("SELECT COUNT(cr.idReplies) FROM comments c INNER JOIN comment_replies cr ON c.idComment=cr.idComment INNER JOIN users_comment_replies ucr ON cr.idReplies=ucr.idReplies INNER JOIN user k ON ucr.idUser=k.idUser INNER JOIN role u on k.idRole=u.idRole WHERE c.idComment= $id GROUP BY cr.idReplies");
}

function homeProduct(){
    return executeQuery("SELECT * FROM home_product");
}

function home(){
    return executeQuery("SELECT p.idProduct,p.name,p.description,p.oldPrice,p.newPrice,i.path,i.alt from product p join home_product ip on p.idHomeProduct=ip.idHomeProduct
    INNER JOIN images i ON p.idProduct=i.idProduct where i.cover=1 AND ip.name='Home'");
}
function vestiPocetna(){
    return executeQueryOneRow("SELECT idVesti,naslov,tekst,datum,velikaSlika,malaSlika  FROM vesti order by datum desc");
}

function cetriVesti(){
    return executeQuery("SELECT idVesti,naslov,tekst,datum,velikaSlika,malaSlika from vesti order by datum desc LIMIT 2");
}

function triNajeftinijaProizvoda(){
    return executeQuery("SELECT* from product order by cenaNova desc LIMIT 3");
}

function usersCart(){
    return isset($_SESSION['korisnik']);
}

function retingForProduct($idProducts,$ipAddress){
    return executePreparedOne("SELECT rating FROM rating_product WHERE idProduct=? AND ipAddress=?",[$idProducts,$ipAddress]);
}
function retingForProductAvg($idProducts){
    return executePreparedOne("SELECT ROUND(AVG(rating),1) AS avg FROM rating_product WHERE idProduct=? ",[$idProducts]);
}

function last4News(){
    return executeQuery("SELECT idVesti,naslov,tekst,datum,velikaSlika,malaSlika from vesti order by datum desc LIMIT 4");
}

function calculatePercent($oldPrice,$newPrice){
    if(($oldPrice>$newPrice)&&$newPrice>0){
        $percent=round((($oldPrice-$newPrice)/$oldPrice*100.0),0);
        $result="";
        if($percent<=20){
            $result="<span class='pricePercent greenPercent'>-".$percent."%</span>";
        }else if($percent<=40){
            $result="<span class='pricePercent yellowPercent'>-".$percent."%</span>";
        }else{
            $result="<span class='pricePercent redPercent'>-".$percent."%</span>";
        }

        return $result;
    }
}

function salePriceCheck($oldPrice,$newPrice){
    $result="";
    if($newPrice>0 &&($oldPrice>$newPrice)){
        $result="<p class='first precrtan '>&#36;".$oldPrice.".00</p>
                <p class='first nova'>&#36;".$newPrice.".00</p>";
    }else if($newPrice>$oldPrice){
        $result="<p class='first'>&#36;".$newPrice.".00</p>";
    }else{
        $result="<p class='first'>&#36;".$oldPrice.".00</p>";
    }
    return $result;
}

function salePriceCheckOneProduct($oldPrice,$newPrice){
    $result="";
    if($newPrice>0 &&($oldPrice>$newPrice)){
        $result="<li class='precrtan productPriceOld darkEmptyTextWhite' ><span></span> <p>&#36;$oldPrice.00</p></li>
        <li class='productPrice' ><span></span> <p>&#36;$newPrice.00</p></li>";
    }else if($newPrice>$oldPrice){
        $result="<li class='productPrice' ><span></span> <p>&#36;$newPrice.00</p></li>";
    }else{
        $result="<li class='productPriceOld darkEmptyTextWhite' ><span></span> <p>&#36;$oldPrice.00</p></li>";
    }
    return $result;
}

function checkProductId($id){
    if(!preg_match("/^[0-9]+$/",$id)){
        header("Location: index.php?page=home");
    }
}
