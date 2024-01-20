<?php  include "models/author/functions.php";?>
<div class="omotac">
    <div id="author" class="darkEmptyLightBackground">
    <img src="assets/images/autor.jpg" alt="autor">
        <div id="authorContent" >
            <?php $author=author();?>
            <h2 class="darkEmptyTextWhite"><?=$author->nameLastName?></h2>
            <p class="darkEmptyTextWhite"><?=$author->text?></p>
            
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/js/cekiran.js"></script>  
<script type="text/javascript" src="assets/js/main.js"></script>