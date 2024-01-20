<?php

if(isset($_POST['commentId'])){
    require_once "../../config/connection.php";
    include "functions.php";
    $idComment=$_POST['commentId'];



    try {
        
        $delete=deleteComment($idComment);
        if($delete){
            \http_response_code(204);
        }
    }
    catch(PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }
}

if(isset($_POST['repliesId'])){
    require_once "../../config/connection.php";
    include "functions.php";
    $repliesId=$_POST['repliesId'];


    try {
        
        $replies=deleteCommentReplies($repliesId);
        if($replies){
            \http_response_code(204);
        }

    }
    catch(\PDOException $ex){
        echo json_encode(['poruka'=> 'Problem sa bazom: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }
}

