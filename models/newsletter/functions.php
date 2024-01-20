<?php

function checkEmail($email){
    return executePreparedOne("SELECT COUNT(*) as number FROM newsletter_client where email=?",[$email]);
}

function sendEmail($email){
    return uidPrepared("INSERT INTO newsletter_client(email,date) values(?,NOW())",[$email]);
}