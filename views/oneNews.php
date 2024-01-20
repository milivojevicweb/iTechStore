<?php

if(isset($_GET['id'])){
    include "models/poll/functions.php";
    include "models/news/functions.php";
    $id = $_GET['id'];
    $rez = getOneNews($id);
    if($rez==null){
        header("Location: index.php?page=news");
    }
}else{
    header("Location: index.php?page=news");
}?>

    <div class="omotac">
        <div id="newsContainer">
            <div id="newsText" class="darkEmptyLightBackground">
                <div id="newsInfoContainer">
                    <img class="newsMainImg" src="<?=$rez->bigImage?>" alt="vest"/>
                    <div id="newsInfoText">
                        <h2 class="vestNaslov"><?=$rez->title?></h2>
                        <div id="fb-root"></div>
                        <p class="vestDatum"><?=$rez->date?></p>
                        <ul class="ss">
                            <li id="print"><a href="https://www.facebook.com/sharer/sharer.php?u=https://markoitech.000webhostapp.com/index.php" class="podeliProizvodF"><i class="fa fa-facebook"></i></a><a class="podeliProizvodT" href="https://twitter.com/share?url=https://markoitech.000webhostapp.com/index.php"><i class="fa fa-twitter"></i></a><a href="mailto:?subject=KD Best products &body=https://markoitech.000webhostapp.com/index.php" class="podeliProizvodM"><i class="fa fa-envelope"></i></a><a href=javascript:window.print() class="podeliProizvodM"><i class="fa fa-print"></i></a><li>
                        </ul>
                    </div>
                </div>
                <div class="vestTekst darkEmptyBackroundTable darkEmptyTextWhite"><?=$rez->text?></div>
            </div>
            <div id="newsOtherItems" class="darkEmptyBackround">
                <div id="newsProducts">
                    <div class="slideshow-container">
                    <?php
                    $products=home();
                      foreach($products as $item):?>
                      <div class="card cardMargin">
                          <?=calculatePercent($item->oldPrice,$item->newPrice)?>
                          <img src="<?=$item->path?>" alt="<?=$item->alt?>"/>
                          <h2 class="naziv"><?=$item->name?></h2>

                          <div>
                          <?php for($i=1;$i<round(retingForProductAvg($item->idProduct)->avg+1);$i++):?>
                              <span class="fa fa-star checked" data-index=<?= $i ?>></span>
                          <?php endfor; ?>
                          <?php 
                          if( round(retingForProductAvg($item->idProduct)->avg+1)==0 ){
                              $i=1;
                          }else{
                              $i=round(retingForProductAvg($item->idProduct)->avg+1);
                          }
                          for($i;$i<=5;$i++):?>
                              <span class="fa fa-star nochecked" data-index=<?= $i ?>></span>
                          <?php endfor; ?>
                                          


                          </div>
                          <?=salePriceCheck($item->oldPrice,$item->newPrice);?>
                          <a href="index.php?page=oneProduct&idProduct=<?=$item->idProduct?>" class="kupiProizvod">buy</a>
                      </div>
                      <?php endforeach;?>
                    </div>

                </div>
                <div id="lastNews" class="darkEmptyLightBackground"> 
                    <?php $news=last4News();
                    foreach($news as $items):?>
                    <a href="index.php?page=oneNews&id=<?=$items->idNews?>">
                        <div class="oneLastNews darkEmptyBackround">
                            <img src="<?=$items->bigImage?>" alt="vest"/>
                            <div class="lastNewsParam">
                                <h2 class="darkEmptyTextWhite"><?=$items->title?></h2>
                                <p class="darkEmptyTextWhite"><?=$items->date?></p>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
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
                                    <button name="anketa_dugme" class="anketa_vrednost darkEmptyBackround" id="sendPoll" class="btn btn-primary" >Submit</button>
                                </li>
                            </ul>
                        </div>
                    
                        <button id="showResult" class="darkEmptyTextWhite darkEmptyBackround  <?php if(checkIpAddress($_SERVER['REMOTE_ADDR'])->number>=1){echo"none";}?>">Results</button>

                        <div class="odgovori newsPoll <?php if(checkIpAddress($_SERVER['REMOTE_ADDR'])->number>=1){echo'block';}?>" >
                                        <p class="pollHead darkEmptyTextWhite">Poll Result</p>
                                        <div id="poll_result">
                                            <?=pollResult();?>
                                </div>
                        </div>        
                        <button id="returnPoll" class="anketa_vrednost darkEmptyBackround">Return</button>

                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

<script type="text/javascript" src="assets/js/cekiran.js"></script>  
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/oneNews.js"></script>
<script type="text/javascript" src='assets/js/poll.js'></script>
<script type="text/javascript" src="assets/plugins/slickSlider/slick.min.js"></script>