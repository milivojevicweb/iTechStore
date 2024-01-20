<?php
    include "models/moderator/poll/function.php";
    $id=$_GET['id'];
    checkIdPoll($id);
    $question=getOneQuestion($id);
    if($question==null){
        header("Location: index.php?page=moderator");
    }
    
?>
<div class="omotac">
    <div class="container5 darkEmptyLightBackground darkEmptyTextWhite">
        <div class="row">
            <div class="col-25">
                <label>Question</label>
            </div>
            <div class="col-75">    
                <input id="editQuestion" class="darkEmptyBackround darkEmptyTextWhite" type="text" value="<?=$question->question?>" name="question"/>
            </div>
        </div>

        <input type="hidden" id="pollId" value="<?=$id?>"/>
        
        <div id="pollAnswers">
            <?php
            $answers=getAnswers($id);
            foreach($answers as $item):
            ?>

            <div class="row">
                <div class="col-25">
                    <label>Answer</label>
                </div>
                <div class="col-75">    
                    <input class='darkEmptyBackround darkEmptyTextWhite pollAnswers pollAnswerValidation pollInput' type="text" name="<?=$item->answer?>" value="<?=$item->answer?>"/><button data-idanswer=<?=$item->idPollAnswer?> class="deleteAnswer f adminModeratorButton"><i class="fa fa-close"></i></button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-25">
                <label>Add new answers</label>
            </div>
            <div class="col-75">    
                <input type="number" class="darkEmptyBackround darkEmptyTextWhite" id="numberAnswers"/>
                <div id="inputPoll">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
            </div>
            <div class="col-75">    
                <span id="statusEditPoll"></span>
                <button id="updatePollButton" class="darkEmptyBackround darkEmptyTextWhite adminModeratorButtonColor adminButtonTab " data-idpoll="<?=$id?>">Edit</button>
            </div>
        </div>
        
    </div>

</div>

<div id="returnPoll"></div>
<div class="odgovori"></div>
<script type="text/javascript" src="assets/js/poll.js"></script>
<script type="text/javascript" src="assets/js/cekiran.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>