<?php
function checkCategory($page) {
    return executePreparedOne("SELECT idCategory,name FROM category where name=?",[$page]);
}
function MenuCategory() {
    return executeQuery("SELECT idCategory,name FROM category");
}
function getMenu(){
    return executeQuery("SELECT * from menu");
}
function insertEmail($email){
    return uidPrepared("INSERT INTO newsletter(email) value(?)",[$email]);
}
function getUserName($id){
    return executePreparedOne("SELECT name, lastName FROM user WHERE idUser = ?",[$id]);
}