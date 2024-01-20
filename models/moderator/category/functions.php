<?php

function insertCategory($name){
    return uidPrepared("INSERT INTO category(name) VALUES(?)",[$name]);
}

function updateCategory($name,$id){
    return uidPrepared("UPDATE category SET name=? WHERE idCategory=?",[$name,$id]);
}

function getCategoryInfo($id){
    return executePreparedOne("SELECT idCategory,name FROM category WHERE idCategory=?",[$id]);
}
function deleteCategory($id){
    return uidPrepared("DELETE FROM category WHERE idCategory=?",[$id]);
}
