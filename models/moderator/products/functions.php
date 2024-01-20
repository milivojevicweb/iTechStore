<?php

function getPrice($id){
    return executePreparedOne("SELECT oldPrice AS oldPrice,newPrice AS newPrice FROM product WHERE idProduct=?",[$id]);
}

function updatePrice($oldPrice,$newPrice,$id){
    return uidPrepared("UPDATE product SET oldPrice=?,newPrice=? WHERE idProduct=?",[$oldPrice,$newPrice,$id]);
}

function checkId($id){
    return executePreparedOne("SELECT COUNT(*) as number FROM product where idProduct=?",[$id]);
}


function getProductId(){
    return executeQueryOneRow("SELECT idProduct as idProduct FROM product ORDER BY idProduct DESC LIMIT 1");
}

function insertProductImage($id,$path,$pathOld,$cover,$alt){
    return uidPrepared("INSERT INTO images (idProduct, path, pathOld, cover, alt) VALUES (?, ?, ?, ?, ?)",[$id,$path,$pathOld,$cover,$alt]);
}

function insertProduct($name,$desc,$priceOld,$priceNew,$category,$idUser,$idHome,$quantity){
    return uidPrepared("INSERT INTO product(name,description,oldPrice,newPrice,idCategory,idUser,idHomeProduct,quantity) VALUES (?,?,?,?,?,?,?,?)",[$name,$desc,$priceOld,$priceNew,$category,$idUser,$idHome,$quantity]);
}

function updateProductWithImage($name,$description,$istaknuti,$category,$path,$cover,$idProductsImage,$quantity,$alt,$id){
    return uidPrepared("UPDATE product p INNER JOIN images i ON p.idProduct=i.idProduct SET p.name = ?, p.description = ?, p.idHomeProduct=?,p.idCategory=?,i.path=?,i.cover=?,i.idProduct=?,p.quantity=?,i.alt=? WHERE p.idProduct = ? and i.cover =1",[$name,$description,$istaknuti,$category,$path,$cover,$idProductsImage,$quantity,$alt,$id]);
}

function updateProductNoImage($name,$description,$istaknuti,$category,$quantity,$alt,$id){
    return uidPrepared("UPDATE product p INNER JOIN images i ON p.idProduct=i.idProduct SET p.name = ?, p.description = ?, p.idHomeProduct=?, p.idCategory=? ,p.quantity=? ,i.alt=? WHERE p.idProduct = ?",[$name,$description,$istaknuti,$category,$quantity,$alt,$id]);
}

function updateProductMultipleImage($path,$pathOld,$cover,$id){
    return uidPrepared("UPDATE images SET path = ?, pathOld = ?, cover=? WHERE idImages = ?",[$path,$pathOld,$cover,$id]);
}

function getProfileImage($idProduct){
    return executePreparedOne("SELECT path,alt FROM images WHERE idProduct=?",[$idProduct]);
}

function getMultiImage($idProduct){
    return executePrepared("SELECT idProduct,idImages,path,alt FROM images WHERE idProduct=? AND cover=0",[$idProduct]);
}

function deleteProductMultiImages($idImages){
    return uidPrepared("DELETE FROM images WHERE idImages=?",[$idImages]);
}

function deleteProduct($id){
    return uidPrepared("DELETE FROM product WHERE idProduct = ?",[$id]);
}

function getAllParamProducts(){
    return executeQuery("SELECT p.name,p.description,p.oldPrice,p.newPrice,p.Quantity,k.name as knaziv,i.path,i.alt from product p join category k on p.idCategory=k.idCategory inner join images i on p.idProduct=i.idProduct where and i.cover=1");
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
function dohvatiProizvodId($id){
    return executePreparedOne("SELECT p.idProduct,p.name,p.description,p.oldPrice,p.newPrice,p.idHomeProduct,p.idCategory,i.alt,p.quantity,i.path FROM product p inner join images i on p.idProduct=i.idProduct WHERE p.idProduct= ? AND i.cover=1",[$id]);
}
function checkProductId($id){
    return rowCount("SELECT p.idProduct,p.name,p.description,p.oldPrice,p.newPrice,p.idHomeProduct,p.idCategory,i.alt,p.quantity,i.path FROM product p inner join images i on p.idProduct=i.idProduct WHERE p.idProduct=$id AND i.cover=1");
}
function getAllimages($id){
    return executePrepared("SELECT idProduct,idImages,path,alt FROM images WHERE idProduct=? and cover=0",[$id]);
}
function productsCategory() {
    return executeQuery("SELECT idCategory,name FROM category");
}
function homeProduct(){
    return executeQuery("SELECT * FROM home_product");
}