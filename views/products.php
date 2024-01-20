<?php include "models/products/functions.php";
include "models/poll/functions.php";


if(isset($_GET['page'])){
  $product=$_GET['page'];
}else{
  $product="iphone";
}

?>
<div class="dropbtn blokiraj"></div>

    
<div class="omotac">
  <div id="productsFilter" class="danger">Filter</div>
</div>    

<div class="omotac">
  <div id="proizvodi">
    <div id="filteri">
      <div id="meniLevo" class="darkEmptyLightBackground">
            <div id="linija">
                <div id="lista">
                  <ul>
                    <li>
                      <form id="pretraga">
                        <input type="text"  id="search" placeholder="Search..">
                      </form>
                    </li>
                    <li>
                      <div class="slidecontainer">
                        <input type="range" min="1" max="<?= getMaxPrice($product)->maxPrice;?>" value="<?= getMaxPrice($product)->maxPrice;?>" class="slider" id="myRange">
                        <p class="darkEmptyTextWhite" >prices range from 0 to $<span id="demo"></span></p>
                      </div>
                    </li>
                    <li>
                      <div id="cena">
                        <label class="darkEmptyTextWhite">Sort Price:</label>
                        <p class="btn danger asc darkEmptyBackround">ASC <i class="fa fa-caret-down"></i></p>
                        <p class="btn danger desc darkEmptyBackround">DESC<i class="fa fa-caret-up"></i></p>
                      </div>
                    </li>
                  </ul>
                </div>
            </div>
      </div>

      <?php $question=getQuestion(); if($question):?>

      <div id="poll" class="darkEmptyLightBackground">

        <div id="anketa_form" <?php if(checkIpAddress($_SERVER['REMOTE_ADDR'])->number>=1){echo"class='none'";}?>>
          <ul>
            <li>
              <p class="pollHead darkEmptyTextWhite"><?=$question->question?></p>
            </li>
            <?php $pollAnswer=getPollAnswer();
            foreach($pollAnswer as $item):
            ?>
            <li>
              <div class="inputGroup darkEmptyBackround">
                <input name="anketa_vrednsot" value="<?=$item->idPollAnswer?>" id="<?=$item->idPollAnswer?>" class="poll_option" type="radio"/>
                <label class="darkEmptyTextWhite" for="<?=$item->idPollAnswer?>"><?=$item->answer?></label>
              </div>
            </li>
            <?php endforeach; ?>
            <li>
              <button name="anketa_dugme" class="anketa_vrednost darkEmptyBackround" id="sendPoll"  >Submit</button>
            </li>
          </ul>
        </div>
        
        <button id="showResult" class="darkEmptyTextWhite darkEmptyBackround <?php if(checkIpAddress($_SERVER['REMOTE_ADDR'])->number>=1){echo"none";}?>">Results</button>

        <div class="odgovori <?php if(checkIpAddress($_SERVER['REMOTE_ADDR'])->number>=1){echo'block';}?>" >
          <p class="pollHead darkEmptyTextWhite">Poll Result</p>
          <div id="pollStatistic">
            <?=pollResult();?>
          </div>
        </div>        
        <button id="returnPoll" class="anketa_vrednost darkEmptyBackround">Return</button>

      </div>
      <?php endif; ?>

    </div>
      <div id="proizvodiDesno">
        <div id="p">
          <?php
          $productInfo = get_products($product);

          foreach($productInfo as $item):?>
          <div class="card">
              <?=calculatePercent($item->oldPrice,$item->newPrice)?>
              <img src="<?=$item->path?>" alt="<?=$item->alt?>"/>
              <h2 class="naziv"><?=$item->name?></h2>

              <div class="ratingProduct<?=$item->idProduct?>">
              <?php for($i=1;$i<round(retingForProductAvg($item->idProduct)->avg+1);$i++):?>
                  <span class="fa fa-star checked"></span>

              <?php endfor; ?>
              <?php 
              if( round(retingForProductAvg($item->idProduct)->avg+1)==0 ){
                  $i=1;
              }else{
                  $i=round(retingForProductAvg($item->idProduct)->avg+1);
              }
              for($i;$i<=5;$i++):?>
                  <span class="fa fa-star nochecked" ></span>
              <?php endfor; ?>
                              


              </div>
              <?=salePriceCheck($item->oldPrice,$item->newPrice);?>
              <a href="index.php?page=oneProduct&idProduct=<?=$item->idProduct?>" class="kupiProizvod">buy</a>
          </div>
          <?php endforeach;?>

          <div class="cistac">
          </div>
        </div>
        <div class="center">
          <input type="hidden" id="pagFilter" value="1" />
          <input type="hidden" id="sortAscDesc" value="" />
          <input type="hidden" id="page" value="<?=$product?>" />
          <div id="pagination"></div>
        </div>
      </div>
      <div class="cistac"></div>
  </div>
</div>


<script type="text/javascript" src="assets/js/main.js"></script>
<script type='text/javascript' src='assets/js/products.js'></script>
<script type="text/javascript" src="assets/js/cekiran.js"></script> 
<script type="text/javascript" src='assets/js/poll.js'></script>




