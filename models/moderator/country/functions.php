<?php

function deleteContry($id){
    return uidPrepared("DELETE FROM country WHERE idCountry=?",[$id]);
}

function getContryInfo($id){
    return executePreparedOne("SELECT idCountry,name FROM country WHERE idCountry=?",[$id]);
}

function updateContry($name,$id){
    return uidPrepared("UPDATE country SET name=? WHERE idCountry=?",[$name,$id]);
}

function insertContry($name){
    return uidPrepared("INSERT INTO country(name) VALUES(?)",[$name]);
}
