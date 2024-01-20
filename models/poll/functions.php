<?php

function getPollAnswer(){
    return executeQuery("SELECT pa.answer,pa.idPollAnswer FROM poll p INNER JOIN poll_answer pa ON p.idPoll=pa.idPoll WHERE p.status=1");
}

function getQuestion(){
    return executeQueryOneRow("SELECT question FROM poll WHERE status=1");
}

function sendUserAnswerPoll($idPoll){
    $ip=$_SERVER['REMOTE_ADDR'];
    return uidPrepared("INSERT INTO poll_user_answer(ipAddress,date,idPollAnswer) VALUES(?,NOW(),?)",[$ip,$idPoll]);
}

function checkIpAddress($ip){
    return executePreparedOne("SELECT COUNT(*) AS number FROM poll p INNER JOIN poll_answer pa ON p.idPoll=pa.idPoll INNER JOIN poll_user_answer pua ON pa.idPollAnswer=pua.idPollAnswer WHERE p.status=1 AND pua.ipAddress=? ",[$ip]);
}

function pollResult(){
    $rowCount=executeQueryOneRow("SELECT COUNT(pa.idPollAnswer) AS rowNumber FROM poll p INNER JOIN poll_answer pa ON p.idPoll=pa.idPoll INNER JOIN poll_user_answer pua ON pa.idPollAnswer=pua.idPollAnswer WHERE p.status=1");

    $result="";
    $arrayIdAnswer=executeQuery("SELECT DISTINCT pa.idPollAnswer AS number FROM poll p INNER JOIN poll_answer pa ON p.idPoll=pa.idPoll WHERE p.status=1");
    foreach($arrayIdAnswer as $item){
        $oneAnswer=executePrepared("SELECT COUNT(pa.idPollAnswer) AS rowNumber,pa.answer FROM poll p INNER JOIN poll_answer pa ON p.idPoll=pa.idPoll INNER JOIN poll_user_answer pua ON pa.idPollAnswer=pua.idPollAnswer WHERE p.status=1 AND pa.idPollAnswer=?",[$item->number]);
    
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