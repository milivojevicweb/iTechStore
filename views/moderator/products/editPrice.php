<?php
    include "models/moderator/products/functions.php";
    accessAllowModerator();
    $id=$_GET['id'];
    $price=getPrice($id);
    if($price==null){
        header("Location: index.php?page=moderator");
    }
?>
<div class="omotac">
    <div class="container5 darkEmptyLightBackground darkEmptyTextWhite">
        <div class="row">
            <div class="col-25">
                <label>Old Price</label>
            </div>
            <div class="col-75">    
                <input type="number" class="darkEmptyBackround darkEmptyTextWhite" id="oldPriceEdit" value="<?=$price->oldPrice?>" name="oldPrice"/>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label>New Price</label>
            </div>
            <div class="col-75">    
                <input type="number" class="darkEmptyBackround darkEmptyTextWhite" id="newPriceEdit" value="<?=$price->newPrice?>" name="newPrice"/>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label>Calculate Percent</label>
            </div>
            <div class="col-75">    
                <input class="darkEmptyBackround darkEmptyTextWhite" min="0" max="100" type="number" id="percent" name="percent" />
            </div>
        </div>
        <div class="row">
            <div class="col-25">
            </div>
            <div class="col-75">    
                <span id="statusPriceUpdate"></span>
                <button id="sendPriceUpdate" class="darkEmptyBackround darkEmptyTextWhite adminModeratorButtonColor adminButtonTab" data-id="<?=$id?>" name="send">Change</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/js/editPrice.js"></script>
<script type="text/javascript" src="assets/js/cekiran.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>