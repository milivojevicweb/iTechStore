<?php
if(isset($_POST['id'])){
    require_once "../../../config/connection.php";
    include "function.php";
    $answers=$_POST['answers'];
    $question=$_POST['question'];
    $id=$_POST['id'];
    try{
        delitePollAnswer($id);
        updateQuestion($question,$id);
        foreach($answers as $item){
            createAnswers($item['name'],$id);
        }
    }catch(PDOException $e){
        $e->getMessage();
        upisGreskeIzBaze($e);

    }
}