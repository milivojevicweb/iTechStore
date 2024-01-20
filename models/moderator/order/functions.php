<?php

function getStatus($id){
    return executePreparedOne("SELECT idOrderStatus FROM orders where idOrders=?",[$id]);
}

function changeStatus($value,$id){
    return uidPrepared("UPDATE orders SET idOrderStatus = ? WHERE idOrders = ?",[$value,$id]);
}

function filterDate($dateFrom,$dateTo){
    return executePrepared("SELECT DISTINCT o.idOrders,o.dateOrders,o.date,os.name AS status,os.idOrderStatus,o.total,k.name,k.lastName FROM product p INNER JOIN orders_products op on p.idProduct=op.idProduct INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_status os ON o.idOrderStatus=os.idOrderStatus where o.dateOrders BETWEEN ? AND ? order by o.idOrders desc",[$dateFrom,$dateTo]);
}

function getOrderStatus($status){
    return executePrepared("SELECT DISTINCT o.idOrders,o.dateOrders,os.name AS status,os.idOrderStatus,o.total,k.name,k.lastName FROM product p INNER JOIN orders_products op on p.idProduct=op.idProduct INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_status os ON o.idOrderStatus=os.idOrderStatus where os.idOrderStatus=? order by o.idOrders desc",[$status]);
}

function searchOrderId($id,$page){
    return executeQuery("SELECT DISTINCT o.idOrders,o.dateOrders,os.name AS status,os.idOrderStatus,o.total,k.name,k.lastName FROM product p INNER JOIN orders_products op on p.idProduct=op.idProduct INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_status os ON o.idOrderStatus=os.idOrderStatus where o.idOrders LIKE '%$id%' order by o.idOrders desc LIMIT 6 ");
}
function searchOrderIdNoParam(){
    return executeQuery("SELECT DISTINCT o.idOrders,o.dateOrders,os.name AS status,os.idOrderStatus,o.total,k.name,k.lastName FROM product p INNER JOIN orders_products op on p.idProduct=op.idProduct INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_status os ON o.idOrderStatus=os.idOrderStatus order by o.idOrders desc");
}

function getOrderWithDate($firstDate,$secondDate,$searchId,$page){
    return executePrepared("SELECT DISTINCT o.idOrders,o.dateOrders,o.date,os.name AS status,os.idOrderStatus,o.total,k.name,k.lastName FROM product p INNER JOIN orders_products op on p.idProduct=op.idProduct INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_status os ON o.idOrderStatus=os.idOrderStatus where o.idOrders LIKE '%$searchId%' AND ( o.dateOrders BETWEEN ? AND ? ) order by o.idOrders desc LIMIT 6 OFFSET $page ",[$firstDate,$secondDate]);
}

function getOrderWithStatus($status,$searchId,$page){
    return executePrepared("SELECT DISTINCT o.idOrders,o.dateOrders,os.name AS status,os.idOrderStatus,o.total,k.name,k.lastName FROM product p INNER JOIN orders_products op on p.idProduct=op.idProduct INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_status os ON o.idOrderStatus=os.idOrderStatus where os.idOrderStatus=? AND  o.idOrders LIKE '%$searchId%' order by o.idOrders desc LIMIT 6 OFFSET $page ",[$status]);
}

function getOrderWithAllFilters($status,$firstDate,$secondDate,$searchId,$page){
    return executePrepared("SELECT DISTINCT o.idOrders,o.dateOrders,o.date,os.name AS status,os.idOrderStatus,o.total,k.name,k.lastName FROM product p INNER JOIN orders_products op on p.idProduct=op.idProduct INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_status os ON o.idOrderStatus=os.idOrderStatus where os.idOrderStatus=? AND o.idOrders LIKE '%$searchId%' AND (o.dateOrders BETWEEN ? AND ? ) order by o.idOrders desc LIMIT 6 OFFSET $page",[$status,$firstDate,$secondDate]);
}

function getOrderOneRow($id){
    return executePreparedOne("SELECT DISTINCT k.name,k.lastName,k.email,k.address,k.zip,k.city,o.date,o.idOrderStatus,o.total,c.name AS country, opm.name as payment FROM user k INNER JOIN orders o on k.idUser=o.idUser INNER JOIN orders_products op on o.idOrders=op.idOrders INNER JOIN country c ON k.idCountry=c.idCountry INNER JOIN order_payment_method opm ON o.idOrderPaymentMethod=opm.idOrderPaymentMethod WHERE o.idOrders= ?",[$id]);
}

function getOrderId($id){
	return executePrepared("SELECT op.quantity,p.name,p.newPrice FROM user k INNER JOIN orders o on k.idUser=o.idUser INNER JOIN orders_products op on o.idOrders=op.idOrders INNER JOIN product p on op.idProduct=p.idProduct WHERE o.idOrders= ?",[$id]);
}

function getStauts(){
    return executeQuery("SELECT idOrderStatus,name  FROM order_status");
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