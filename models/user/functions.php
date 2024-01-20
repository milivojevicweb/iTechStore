<?php

function ordersUser($id){
    return executePrepared("SELECT opm.name AS payment, o.idOrders,o.dateOrders,o.idOrderStatus,o.total,k.name,k.lastName FROM  orders o INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_payment_method opm ON o.idOrderPaymentMethod=opm.idOrderPaymentMethod WHERE k.idUser=?  ORDER BY o.idOrders DESC   LIMIT 6" ,[$id]);
}

function userInfo($id){
        return executePreparedOne("SELECT k.idUser,k.name,k.lastName,k.email,k.address,k.city,k.zip,c.idCountry,c.name as countryName FROM user k INNER JOIN country c ON k.idCountry=c.idCountry WHERE k.idUser=?",[$id]);
}

function contry(){
    return executeQuery("SELECT idCountry,name from country");
}

function updateUserInfo($name,$lastname,$email,$city,$zip,$contry,$id){
    return uidPrepared("UPDATE user SET name=?,lastName=?,email=?,city=?,zip=?,idCountry=? WHERE idUser=?",[$name,$lastname,$email,$city,$zip,$contry,$id]);
}

function updatePassword($password,$id){
    return uidPrepared("UPDATE user SET password=? WHERE idUser=?",[md5($password),$id]);
}

function countUserOrder($id){
    return executePreparedOne(" SELECT COUNT(k.idUser) AS number  FROM  orders o INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_payment_method opm ON o.idOrderPaymentMethod=opm.idOrderPaymentMethod WHERE k.idUser=? ",[$id]);
}

function getUserOrderPagination($id,$page){
    return executeQuery("SELECT opm.name AS payment, o.idOrders,o.dateOrders,o.idOrderStatus,o.total,k.name,k.lastName FROM  orders o INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_payment_method opm ON o.idOrderPaymentMethod=opm.idOrderPaymentMethod WHERE k.idUser=$id  ORDER BY o.idOrders DESC  LIMIT 6 OFFSET $page");
}

function getOrder($id){
    return executePreparedOne("SELECT DISTINCT k.name,k.lastName,k.email,k.address,k.zip,k.city,o.date,o.idOrderStatus,o.total,c.name AS country, opm.name as payment FROM user k INNER JOIN orders o on k.idUser=o.idUser INNER JOIN orders_products op on o.idOrders=op.idOrders INNER JOIN country c ON k.idCountry=c.idCountry INNER JOIN order_payment_method opm ON o.idOrderPaymentMethod=opm.idOrderPaymentMethod WHERE o.idOrders= ?",[$id]);
}

function getOrderProduct($id){
	return executePrepared("SELECT op.quantity,p.name,p.newPrice FROM user k INNER JOIN orders o on k.idUser=o.idUser INNER JOIN orders_products op on o.idOrders=op.idOrders INNER JOIN product p on op.idProduct=p.idProduct WHERE o.idOrders= ?",[$id]);
}

function accessAllowUser(){
    if(!isset($_SESSION['korisnik'])){
        $_SESSION['greska'] = "NISTE ULOGOVANI!";
        header("Location: index.php");
    }
    if($_SESSION['korisnik']->idRole != 2 && $_SESSION['korisnik']->idRole != 4){
        $_SESSION['greska'] = "NISTE USER!";
        header("Location: index.php");
    }
}

