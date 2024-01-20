<?php
session_start();
if(isset($_POST['comment'])){
    require_once "../../config/connection.php";
    include "functions.php";
        $commentId=(int)$_POST['commentId'];
        $comment=$_POST['comment'];
        $user=$_POST['user'];


        try{
            insertCommentReplies($commentId,$comment);
            insertUserCommentReplies($user);
        }catch(\PDOException $ex){
            echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
            \http_response_code(500);
            upisGreskeIzBaze($ex);
        }   
}
