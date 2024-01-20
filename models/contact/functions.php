<?php

function insertContact($name,$email,$text,$phone){
    return uidPrepared("INSERT INTO contact (name, email, text, phone) VALUES (?,?,?,?)",[$name, $email, $text, $phone]);
}