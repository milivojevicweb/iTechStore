<?php
    include "models/moderator/newsletter/functions.php";
    accessAllowModerator();
    $id=$_GET['id'];
    checkIdNewsletter($id);
    $newsletter=getOneNewsletter($id);
    if($newsletter==null){
        header("Location index.php?page=moderator");
    }
?>
<div class="omotac">
    <div class="container5 darkEmptyLightBackground darkEmptyTextWhite">
            <div class="row">
                <div class="col-25">
                    <span id="updateTitleStatus"></span><p>Title</p>
                </div>
                <div class="col-75" >    
                    <input type="text" id="titleNewsleterEdit" class="darkEmptyBackround darkEmptyTextWhite" value="<?=$newsletter->title?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <span id="updateCodeStatus"></span><p>Code</p>
                </div>
                <div class="col-75">    
                    <textarea name="" id="textareaNewsletterEdit" class="darkEmptyBackround darkEmptyTextWhite" ><?=$newsletter->code?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">

                </div>
                <div class="col-75" >    
                    <span id="newsletterStatusUpdate"></span>
                    <button id="updateNewsletterButton" class="darkEmptyBackround adminModeratorButtonColor adminButtonTab" data-idnewsletter="<?=$id?>" >Update</button>
                </div>
            </div>
            <div class="row">
                <div class="col-25">

                </div>
                <div class="col-75">    
                    <button id="sendNewsletterButton" class="darkEmptyBackround adminModeratorButtonColor adminButtonTab" data-idnewsletter="<?=$id?>">Send</button>
                </div>
            </div>
    </div>

    <div class="container5 darkEmptyLightBackground darkEmptyTextWhite">
        <div class="row">
            <div class="col-25">
                <span>Preview:</span>
            </div>
            <div class="col-75" id="newsletterPrewiev">    
                <?=html_entity_decode($newsletter->code)?>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="assets/js/newsletter.js"></script>
<script type="text/javascript" src="assets/js/cekiran.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>