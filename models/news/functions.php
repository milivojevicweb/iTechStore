<?php

function countNews(){
    return executeQueryOneRow("SELECT COUNT(*) AS number FROM news ");
}

function getNewsPagination($pag){
    return executeQuery("SELECT idNews,title,text,date,bigImage,image,idUser FROM news ORDER BY idNews DESC LIMIT 4 OFFSET $pag");
}

function news(){
    return executeQuery("SELECT idNews,title,text,date,bigImage,image,idUser FROM news  order by idNews desc LIMIT 4");
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

function retingForProduct($idProducts,$ipAddress){
    return executePreparedOne("SELECT rating FROM rating_product WHERE idProduct=? AND ipAddress=?",[$idProducts,$ipAddress]);
}
function retingForProductAvg($idProducts){
    return executePreparedOne("SELECT ROUND(AVG(rating),1) AS avg FROM rating_product WHERE idProduct=? ",[$idProducts]);
}

function getOneNews($id){
    return executePreparedOne("SELECT * FROM news WHERE idNews= ?",[$id]);
}

function home(){
    return executeQuery("SELECT p.idProduct,p.name,p.description,p.oldPrice,p.newPrice,i.path,i.alt from product p join home_product ip on p.idHomeProduct=ip.idHomeProduct
    INNER JOIN images i ON p.idProduct=i.idProduct where i.cover=1 AND ip.name='Home'");
}

function last4News(){
    return executeQuery("SELECT idNews,title,text,date,bigImage,image,idUser FROM news order by date desc LIMIT 4");
}

