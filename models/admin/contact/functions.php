<?php

function deleteContact($id){
    return uidPrepared("DELETE FROM contact WHERE idContact = ?",[$id]);
}

function getAllContact(){
    return executeQuery("SELECT idContact,name,email,text,phone,status FROM contact");
}

function contactNumber(){
    return rowCount("SELECT COUNT(idContact) from contact group by idContact");
}

function getOneContact($id){
    return executePreparedOne("SELECT idContact,name,email,phone,status FROM contact WHERE idContact=?",[$id]);
}

function updateContactStatus($id){
    return uidPrepared("UPDATE contact SET status=1 WHERE idContact=?",[$id]);
}