<?php
if(isset($_POST['answers'])){
    require_once "../../../config/connection.php";
    include "function.php";
    $answers=$_POST['answers'];
    $question=$_POST['question'];
    try{

        createPoll($question);
        $lastId=getLastId();
        foreach($answers as $item){
            createAnswers($item['name'],$lastId);
        }
    }catch(PDOException $e){
        $e->getMessage();
        upisGreskeIzBaze($e);

    }
}