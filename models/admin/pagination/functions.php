<?php

function countContact(){
    return executeQueryOneRow("SELECT COUNT(idContact) AS number FROM contact");
}

function countContactStatus($status){
    return executePreparedOne("SELECT COUNT(idContact) AS number FROM contact WHERE status=?",[$status]);
}

function getAllContactPagination($page){
    return executeQuery("SELECT idContact,name,email,text,phone,status FROM contact ORDER BY idContact DESC LIMIT 6 OFFSET $page ");
}

function getContactStatus($status,$page){
    return executePrepared("SELECT idContact,name,email,text,phone,status FROM contact WHERE status=? ORDER BY idContact DESC LIMIT 6 OFFSET $page ",[$status]);
}
function countUser(){
    return executeQueryOneRow("SELECT COUNT(idUser) AS number FROM user k INNER JOIN role u ON k.idRole=u.idRole");
}

function getAllUserPagination($page){
    return executeQuery("SELECT idUser,k.name,lastName,email,password,address,city,token,u.idRole,idCountry,u.name as roleName FROM user k INNER JOIN role u ON k.idRole=u.idRole ORDER BY u.idRole ASC LIMIT 6 OFFSET $page ");
}
