<?php
include "models/functions.php";
if(isset($_GET['idProduct'])){

    $id = $_GET['idProduct'];
    checkProductId($id);
    $productImage = getProductImage($id);
    $rez=getProductInfo($id);
    if($rez==null){
        header("Location: index.php?page=home");
    }
    $comment=getComment($id);
    $commnetNumber=getCommentNumber($id);
    $allCommentNumber=getAllCommentNumber($id);

    $rating=retingForProduct($id,$_SERVER['REMOTE_ADDR']);
    if($rating){
        $ratingProductsNumber=$rating->rating;
    }else{
        $ratingProductsNumber=0;

    }
}else{
    header("Location: index.php?page=home");
}

?>
<div class="omotac2">
    <div class="product">
        <div id="productImage">

            <div class="containerImageProduct">
                <?php foreach($productImage as $item):?>
                <div class="mySlides">
                <img class="productsImage" src="<?=$item->path?>" alt="<?=$item->alt?>"/>
                </div>
                <?php endforeach; ?>
                    
                <button id="prev" >❮</button>
                <button id="next" >❯</button>



                <div id="rowPicture">
                <?php foreach($productImage as $item):?>
                    <div class="column">
                    <img class="demo cursor productsImage" src="<?=$item->path?>" alt="<?=$item->alt?>"/>
                    </div>
                    <?php endforeach; ?>
                    
                </div>
            </div>
            
        </div>

        <div id="productInfo" class="darkEmptyLightBackground">
            <ul>
                <li class="productName darkEmptyTextWhite"><p><?=$rez->name?></p></li>
                <li class="productDesc darkEmptyTextWhite"><?=$rez->description?></li>
                <li id="starsContainer">
                    <div id="stars">
                        <?php for($i=1;$i<round(retingForProductAvg($id)->avg);$i++):?>
                            <span class="fa fa-star checked" data-index=<?= $i ?>></span>
                        <?php endfor; ?>
                        <?php 
                        if( round(retingForProductAvg($id)->avg)==0 ){
                            $i=1;
                        }else{
                            $i=round(retingForProductAvg($id)->avg);
                        }
                        for($i;$i<=5;$i++):?>
                            <span class="fa fa-star nochecked" data-index=<?= $i ?>></span>
                        <?php endfor; ?>
                                    
                    <input type="hidden" id="productIdrating" value=<?=$_GET['idProduct'];?>>
                    <input type="hidden" id="productRatingNumber" value="<?= $ratingProductsNumber;?>"/>
                    <input type="hidden" id="initalRating" value="<?= retingForProductAvg($id)->avg?>"/>

                    </div>
                    <span id="ratingSpan" class="darkEmptyTextWhite">(<?php if( retingForProductAvg($id)->avg ==""){echo "No Votes";}else{echo retingForProductAvg($id)->avg; } ?>)</span>
                </li>
                <li><span> <?php if($rez->Quantity>=1):?><span class='sell darkEmptyTextWhite'><i class='fa fa-circle'></i>In stock  </span> <?php else: ?><span class='wait darkEmptyTextWhite'><i class='fa fa-circle'></i>Out of stock </span><?php endif;?> </span></li>
                    <?=salePriceCheckOneProduct($rez->oldPrice,$rez->newPrice);?>
                <li id="print"><a href="https://www.facebook.com/sharer/sharer.php?u=https://markoitech.000webhostapp.com/index.php" class="podeliProizvodF"><i class="fa fa-facebook"></i></a><a class="podeliProizvodT" href="https://twitter.com/share?url=https://markoitech.000webhostapp.com/index.php"><i class="fa fa-twitter"></i></a><a href="mailto:?subject=KD Best products &body=https://markoitech.000webhostapp.com/index.php" class="podeliProizvodM darkEmptyBackround"><i class="fa fa-envelope"></i></a><a href=javascript:window.print() class="podeliProizvodM darkEmptyBackround"><i class="fa fa-print"></i></a><li>
                <li>
                  <div id="shippingFree" class="darkEmptyBackround">
                    <i class="fa fa-rocket darkEmptyTextWhite"></i>
                    <p class="darkEmptyTextWhite">Free next-day delivery</p>
                  </div>
                </li>
                <input type="hidden" id="addProductToCartNumber" value="0" />
                <?php  if($rez->Quantity>=1):?>
                    <li> 
                        <button type="button" data-id="<?=$id?>" class="minus-one buttonProducts" >-</button>
                        <span class="productQuantity darkEmptyTextWhite">0</span> 
                        <button type="button" data-id="<?=$id?>" class="plus-one buttonProducts" >+</button>
                        <button data-idcart=<?=$id?> class="oneProductBuyButton buttonProducts">Add to cart <i class='fa fa-shopping-cart'></i></button>
                    </li>
                <?php  endif;?>
                
            </ul>
        </div>
    </div>
</div>

<div id="commentContainer">
    <div class="omotac2">
        <div id="productComments">
        <span class="darkEmptyTextWhite"><?php if($allCommentNumber->total==1){echo"1 Comment";}else{echo $allCommentNumber->total." Comments";}?></span>
            <div id="sendComment">
            <?php if(isset($_SESSION['korisnik'])){ ?>
            <input type="hidden" id="productId" value=<?=$_GET['idProduct'];?>>
            <input type="hidden" id="userId" value=<?=$_SESSION["korisnik_id"];?>>
            <textarea id="commentValue" class="commentInput darkEmptyLightBackground" placeholder="Add a public comment..." cols="30" rows="2"></textarea>
            <span id="noText"></span>
            <button class="commentButton" id="addComment">Comment</button>
            <?php }else{ ?>
                <div class="logReg">
                <a href="index.php?page=login">Log in </a> or
                <a href="index.php?page=registration">Registration</a>
                </div>
            <?php } ?>
            </div>
        </div>
        
        <?php $i=1; foreach($comment as $item):?>
        <div class="comment ko kom<?=$i?>">
            <div class="mainComment darkEmptyLightBackground">
                <div class="userInfo darkEmptyTextWhite"><span class=<?php if(($item->idRole=="1") || ($item->idRole=="3")){echo"adminCommentUserName";}else{echo"commentUserName";}?>><?php if(($item->idRole=="1") || ($item->idRole=="3")){echo"iTech";}else{echo"$item->name $item->lastName";}?></span><span class="dateComment"><?=$item->date?></span></div>
                <p class="userComment darkEmptyTextWhite darkEmptyTextWhite"><?=$item->comment?></p>
                <div class="buttonDivComment">
                    <p class="moreRepliesButton <?php  if(repliesNumber($item->idComment)==0){echo "repliesNone";}?>"><?php  if(repliesNumber($item->idComment)==1){echo "View reply";}else{echo"View ".repliesNumber($item->idComment)." replies";}?><i class="fa fa-sort-down"></i></p>
                    <div>
                        <span class="delText delText<?=$item->idComment?>"></span>
                        <button class="replyButton" >Reply</button>
                        <?php if(isset($_SESSION['korisnik_id'])){ if($_SESSION['korisnik']->idRole != 2 ){echo"<button class='delComment' data-idcomment=$item->idComment><i class='fa fa-close'></i></button>";}} ?>
                    </div>
                </div>
                
            </div>
            <div class="replies">
                <div class="replayArea">
                    <?php if(isset($_SESSION['korisnik'])){?>
                    <input type="hidden" class="userId<?=$item->idComment?>" value=<?=$_SESSION["korisnik_id"];?>>
                    <textarea placeholder="Add a public comment..." class="replayValue<?=$item->idComment?>" cols="30" rows="2"></textarea>
                    <div class="buttonDivComment">
                    <span class="noText"></span>
                    <button class="addReply" data-id=<?=$item->idComment?>  id="addReply">Add Reply</button>
                    </div>
                    <?php }else{ ?>
                        <div class="logReg logRegReplies">
                        <a href="index.php?page=login">Log in </a> or
                        <a href="index.php?page=registration">Registration</a>
                        </div>
                    <?php } ?>
                </div>
                <?php $replies=getRepliesComment($item->idComment); foreach($replies as $items):?>
                <div class="comment repliesComment darkEmptyLightBackground">
                <div class="userInfo darkEmptyTextWhite"><span class=<?php if(($items->idRole=="1") || ($items->idRole=="3")){echo"adminCommentUserName";}else{echo"commentUserName";}?>><?php if(($items->idRole=="1") || ($items->idRole=="3")){echo"iTech";}else{echo"$items->name $items->lastName";}?></span><span class="dateComment"><?=$items->date?></span></div>                    
                <div class="commentRepliesContainer">
                    <div class="userComment darkEmptyTextWhite"><?=$items->text?></div>
                    <div>
                        <?php if(isset($_SESSION['korisnik_id'])){ if($_SESSION['korisnik']->idRole != 2 ){echo"<span class='delText delText$items->idReplies'></span><button class='delReplies' data-idreplie=$items->idReplies><i class='fa fa-close'></i></button>";}} ?>
                    </div>
                </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <?php $i++; endforeach;  ?>
        <div id="showMoreContainer" <?php if($commnetNumber->total<=3){echo"class='none'";} ?> ><button id="showCommentButton" >Show more <i class="fa fa-sort-down"></i></button></div>
    </div>
</div>





<script type="text/javascript" src="assets/js/cekiran.js"></script>  
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/oneProduct.js"></script>
