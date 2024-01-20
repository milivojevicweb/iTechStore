<?php
function countProducts($productSearch){
    return executeQueryOneRow("SELECT COUNT(p.idProduct) AS number from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where p.name LIKE '%$productSearch%' AND i.cover=1");
}

function countProductStatus($productSearch){
    return executeQueryOneRow("SELECT COUNT(p.idProduct) AS number from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where i.cover=1 AND p.name LIKE '%$productSearch%' AND p.quantity>0 ");
}

function countProductStatusZero($productSearch){
    return executeQueryOneRow("SELECT COUNT(p.idProduct) AS number from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where p.name LIKE '%$productSearch%' AND i.cover=1 AND p.quantity<1 ");
}

function getAllProductsPagination($productSearch,$page){
    return executeQuery("SELECT p.idProduct,i.path,i.alt,p.name ,p.description,p.Quantity,p.oldPrice,p.newPrice,k.name as knaziv from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where p.name LIKE '%$productSearch%' AND i.cover=1 ORDER BY p.idProduct DESC LIMIT 6 OFFSET $page ");
}

function getProductStatus($productSearch,$page){
    return executeQuery("SELECT p.idProduct,i.path,i.alt,p.name ,p.Quantity,p.description,p.oldPrice,p.newPrice,k.name as knaziv from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where p.name LIKE '%$productSearch%' AND  i.cover=1 AND p.quantity>0 ORDER BY p.idProduct DESC LIMIT 6 OFFSET $page ");
}
function getProductStatusZero($productSearch,$page){
    return executeQuery("SELECT p.idProduct,i.path,i.alt,p.name ,p.description,p.Quantity,p.oldPrice,p.newPrice,k.name as knaziv from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where p.name LIKE '%$productSearch%' AND  i.cover=1 AND p.quantity<1 ORDER BY p.idProduct DESC LIMIT 6 OFFSET $page ");
}

function countNews(){
    return executeQueryOneRow("SELECT COUNT(idNews) AS number from news");
}

function getAllNewsPagination($page){
    return executeQuery("SELECT idNews,title,text,date,bigImage,image,idUser FROM news ORDER BY idNews DESC LIMIT 6 OFFSET $page ");
}
function countCategory(){
    return executeQueryOneRow("SELECT COUNT(idCategory) AS number from category");
}

function getAllCategoryPagination($page){
    return executeQuery("SELECT idCategory,name FROM category ORDER BY idCategory ASC LIMIT 6 OFFSET $page ");
}

function countNewsletter(){
    return executeQueryOneRow("SELECT COUNT(idNewsletter) AS number from newsletter");
}

function getAllNewsletterPagination($page){
    return executeQuery("SELECT idNewsletter,title,code,date FROM newsletter ORDER BY idNewsletter DESC  LIMIT 6 OFFSET $page ");
}

function countPoll(){
    return executeQueryOneRow("SELECT COUNT(idPoll) AS number from poll");
}

function countContry(){
    return executeQueryOneRow("SELECT COUNT(idCountry) AS number from country");
}


function getAllPollPagination($page){
    return executeQuery("SELECT p.question,p.date,p.status,p.idPoll FROM poll p ORDER BY p.idPoll DESC LIMIT 6 OFFSET $page ");
}

function getAllContryPagination($page){
    return executeQuery("SELECT idCountry,name FROM country ORDER BY idCountry LIMIT 6 OFFSET $page ");
}


function getOrderWithDateCount($firstDate,$secondDate,$searchId,$payment){
    return executePreparedOne("SELECT COUNT(idOrders) AS number  FROM orders where idOrders LIKE '%$searchId%' AND ( dateOrders BETWEEN '$firstDate' AND '$secondDate' )  AND o.idOrderPaymentMethod=?  ",[$firstDate,$secondDate,$payment]);
}

function getOrderWithStatusCount($status,$searchId,$payment){
    return executePreparedOne("SELECT COUNT(o.idOrders) AS number  FROM orders o INNER JOIN order_status os ON o.idOrderStatus=os.idOrderStatus where os.idOrderStatus=? AND  z AND o.idOrderPaymentMethod=? ",[$status,$payment]);
}

function getOrderWithAllFiltersCount($status,$firstDate,$secondDate,$searchId,$payment){
    return executePreparedOne("SELECT COUNT(o.idOrders) AS number  FROM orders o INNER JOIN order_status os ON o.idOrderStatus=os.idOrderStatus  where os.idOrderStatus=? AND o.idOrders LIKE '%$searchId%' AND ( o.dateOrders BETWEEN ? AND ? ) AND o.idOrderPaymentMethod=?",[$status,$firstDate,$secondDate,$payment]);
}

function searchOrderIdCount($id,$payment){
    return executeQueryOneRow("SELECT COUNT(idOrders) AS number FROM orders  where idOrders LIKE '%$id%' AND idOrderPaymentMethod=$payment ");
}

function countOrder(){
    return rowCount("SELECT COUNT(o.idOrders) AS number FROM orders o INNER JOIN orders_products op on op.idOrders=o.idOrders INNER JOIN product p on p.idProduct=op.idProduct GROUP BY o.idOrders");
}