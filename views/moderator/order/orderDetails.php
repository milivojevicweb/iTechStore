<?php
include "models/moderator/order/functions.php";
accessAllowModerator();
if(isset($_GET['id'])){

$id = $_GET['id'];
$rez = getOrderOneRow($id);

if($rez==null){
    header("Location: index.php?page=moderator");
}?>

<div id="ordderDetailsContainer">
    <div class="omotac">
        <div class="cartBuy">
            <div class="cartLeft darkEmptyTextWhite">
                <ul>
                    <li>Name: <?= $rez->name?> <?= $rez->lastName?></li>
                    <li>Payment method: <?= $rez->payment?></li>
                    <li>Email: <?= $rez->email?></li>
                    <li>Date: <?= $rez->date?></li>
                    <li>Address: <?= $rez->address?></li>
                    <li>Zip: <?= $rez->zip?></li>
                    <li>Country: <?= $rez->country?></li>
                    <?php $ree=getOrderId($id); foreach($ree as $items):?>
                    <li>Name: <?= $items->name ?> Price: <?= $items->newPrice ?> Quantity: <?= $items->quantity?></li>
                    <?php endforeach;?>
                    <li>Total Price: <?= $rez->total?></li>
                </ul>
            </div>
            <div id="orderDetailsRight">
            <ul class="darkEmptyLightBackground darkEmptyTextWhite">
                <li id="status">
                <?php
                    if($rez->idOrderStatus==1){
                    echo "Processing in progress <span class='wait'><i class='fa fa-circle'></i></span>";
                    }elseif($rez->idOrderStatus==2){
                        echo "Delivered <span class='sell'>  <i class='fa fa-circle'></i></span>";
                    }else{
                        echo "Canceled <span class='error'><i class='fa fa-circle'></i></span>";
                    }
                ?>
                </li>
                <li><select id="statusOrder" class="darkEmptyBackround darkEmptyTextWhite">
                    <?php $staus=getStauts(); 
                    foreach($staus as $item):
                        if($rez->idOrderStatus==$item->idOrderStatus):
                    ?>
                        <option selected value=<?=$item->idOrderStatus?>><?=$item->name?></option>
                    <?php else:?>
                        <option value=<?=$item->idOrderStatus?>><?=$item->name?></option>
                    <?php endif; endforeach; ?>
                </select></li>
                    <li><button id="changeStatus" data-id=<?=$id?> type="button">Submit</button></li>
            </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/cekiran.js"></script>
<script type="text/javascript" src="assets/js/orderUpdate.js"></script>

<?php } ?>

