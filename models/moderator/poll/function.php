<?php

function createPoll($question){
    return uidPrepared("INSERT INTO poll(question,date) VALUES(?,NOW())",[$question]);
}

function createAnswers($answer,$lastId){
    return uidPrepared("INSERT INTO poll_answer(answer,idPoll) VALUES(?,?)",[$answer,$lastId]);
}

function getAllPolls(){
    return executeQuery("SELECT p.question,p.date,p.status,p.idPoll FROM poll p");
}

function deletePoll($id){
    return uidPrepared("DELETE FROM poll WHERE idPoll=?",[$id]);
}

function deletePollAnswer($id){
    return uidPrepared("DELETE FROM poll_answer WHERE idPollAnswer=?",[$id]);
}

function getOneQuestion($id){
    return executePreparedOne("SELECT question FROM poll WHERE  idPoll=?",[$id]);
}

function getAnswers($id){
    return executePrepared("SELECT idPollAnswer,answer FROM poll_answer WHERE idPoll=?",[$id]);
}

function checkIdPoll($id){
    $id=executePreparedOne("SELECT COUNT(idPoll) AS count FROM poll WHERE idPoll=?",[$id]);
    if($id->count<1){
        \header('Location: index.php');
    }
}

function delitePollAnswer($id){
    return uidPrepared("DELETE FROM poll_answer WHERE idPoll=?",[$id]);
}

function updateQuestion($question,$id){
    return uidPrepared("UPDATE poll SET question=? WHERE idPoll=?",[$question,$id]);
}

function getStatus($id){
    return executePreparedOne("SELECT status FROM poll WHERE idPoll=?",[$id]);
}

function changeStatusActive($id){
    return uidPrepared("UPDATE poll SET status=1 WHERE idPoll=?",[$id]);
}

function changeStatusInactive($id){
    return uidPrepared("UPDATE poll SET status=0 WHERE idPoll=?",[$id]);
}

function changeAllPollStatusInactive($id){
    return uidPrepared("UPDATE poll SET status=0 WHERE idPoll=?",[$id]); 
}

function allStatus(){
    return executeQuery("SELECT idPoll FROM poll WHERE status=1");
}

function pollResult($id){
    $rowCount=executeQueryOneRow("SELECT COUNT(pa.idPollAnswer) AS rowNumber FROM poll p INNER JOIN poll_answer pa ON p.idPoll=pa.idPoll INNER JOIN poll_user_answer pua ON pa.idPollAnswer=pua.idPollAnswer WHERE p.idPoll=$id");

    $result="";
    $arrayIdAnswer=executeQuery("SELECT DISTINCT pa.idPollAnswer AS number FROM poll p INNER JOIN poll_answer pa ON p.idPoll=pa.idPoll WHERE p.idPoll=$id");
    $pollName=executeQueryOneRow("SELECT question FROM poll WHERE idPoll=$id");
    $result="<h2>$pollName->question</h2>";
    foreach($arrayIdAnswer as $item){
        $oneAnswer=executePrepared("SELECT COUNT(pa.idPollAnswer) AS rowNumber,pa.answer FROM poll p INNER JOIN poll_answer pa ON p.idPoll=pa.idPoll INNER JOIN poll_user_answer pua ON pa.idPollAnswer=pua.idPollAnswer WHERE p.idPoll=$id AND pa.idPollAnswer=?",[$item->number]);
    
        foreach($oneAnswer as $item){
            @$percent=round(($item->rowNumber/$rowCount->rowNumber)*100);
            if(is_nan($percent)){
                $percent=0;
            }
            $result.="<p class='darkEmptyTextWhite'>".$item->answer."</p>
            <div class='rez'>
                <div class='skills html' style='width:".$percent."%;'><p>".$percent."%</p></div>
            </div>";
        }
        }
    return $result;
}
function accessAllowModerator(){
    if(!isset($_SESSION['korisnik'])){
        $_SESSION['greska'] = "NISTE ULOGOVANI!";
        header("Location: index.php");
    }
    if($_SESSION['korisnik']->idRole == 2){
        $_SESSION['greska'] = "NISTE MODERATOR!";
        header("Location: index.php");
    }
}