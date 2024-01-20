<?php include "models/functions.php"; ?>
<div id="pozadina" > 
            <div id="tekst">
                <h2>Brilliant phone.</h2><!--15 and 65 characters.-->
                <h2>In every way.</h2><!--15 and 65 characters.-->
                <p>Get 50% to our products</p>
                <a href="index.php?page=iphone">Buy best phone</a>
            </div>
            <div id="siviTekst">
                    <p>HIGH</p>
                    <p>QUALITY</p>
            </div>
                <div class="diagonal" class="z"></div>
                <img src="assets/images/iphone12Silver.png" alt="iphone phone apple iTech"/> 
        </div>

        <div id="macHome">
            <div class="omotac">
                <div id="macHomeContainer">
                    <div id="macHomeText">
                        <img src="assets/images/ar_icon.png" alt="ar"/>
                        <h2>Use AR to see MacBook Pro 13" in your workspace.</h2>
                        <a href="index.php?page=macbook">Buy MacBook <span class="strelica"><i class="fa crvena fa-long-arrow-right"></i></span></a>
                        <div id="macHomeCircle">
                            <div class="circle1 circleContainer circleBorder"><div class="homeCircle sliverCircle"></div></div>
                            <div class="circle2 circleContainer"><div class="homeCircle grayCircle"></div></div>
                        </div>
                    </div>
                    <div id="macHomeImg">
                        <img src="assets/images/ar_silver.jpg" alt="ar"/>
                    </div>
                </div>
            </div>
        </div>
        <div id="istaknutiProizvodi" class="darkEmptyLightBackground">
            <div class="omotac">
                <h3 id="animirantekst" class="darkEmptyTextWhite">I Recommended</h3>

            <div id="slider">
        
        <div id="slide-container">
        <?php

            $rezultat=home();

            foreach ($rezultat as $item):
                
        ?>
                <div class="card cardMargin">
                    <?=calculatePercent($item->oldPrice,$item->newPrice)?>
                    <img src="<?=$item->path?>" alt="<?=$item->alt?>"/>
                    <p class="naziv"><?=$item->name?></p>

                    <div id="stars">
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
            </div>
        </div>

        <div class="omotac">
            <div id="iwatch" class="darkEmptyLightBackground">
                    <div id="sat">          
                            <img src="assets/images/ecg_primary_medium_opt.png" alt="iphone phone apple watch series 4 iTech"/>
                        <video autoplay muted loop  id="myVideo">
                                <source src="assets/images/medium.mp4" type="video/mp4">
                        </video>
                    </div>
                    <div id="satTekst">
                        <h2 class="darkEmptyTextWhite">iWatch</h2>
                        <p class="darkEmptyTextWhite">Introducing Apple Watch Series 4. Fundamentally redesigned and re-engineered to help you stay even more active, healthy, and connected.</p>
                        <a  href="index.php?page=iwatch">Buy iWatch <span class="strelica"><i class="fa crvena fa-long-arrow-right"></i></span></a>
                    </div>
            </div>
            <a href="index.php?page=iwatch" id="nevidljivLink"><p>Buy iWatch <span class="strelica"><i class="fa crvena fa-long-arrow-right"></i></span></p></a>
        </div>

        <div id="ipad" class="darkEmptyLightBackground">
            <div class="omotac">
                <div id="ipadFlex">
                    <div id="ipadLevo">
                        <h2 class="darkEmptyTextWhite">iPad Pro</h2>
                        <p class="darkEmptyTextWhite">It’s all new, all screen, and all powerful.&nbsp; Completely redesigned and packed with our most advanced technology, it will make you rethink what iPad is capable of.</p>
                        <a id="ipadAtag" href="index.php?page=ipad">Buy iPad <span class="strelica"><i class="fa crvena fa-long-arrow-right"></i></span></a>
                    </div>
                    <div id="ipadDesno">
                        <img src="assets/images/ipad.png" alt="iphone ipad pro apple iTech"/>
                    </div>
                    <a id="hiddenAtagipad" href="index.php?page=ipad">Buy iPad <span class="strelica"><i class="fa crvena fa-long-arrow-right"></i></span></a>
                </div>
                
            </div>
            <div class="cistac"></div>
        </div>

        
        <script type="text/javascript" src="assets/js/cekiran.js"></script>  
        <script type="text/javascript" src="assets/js/main.js"></script>
        <script type="text/javascript" src="assets/js/home.js"></script>
        <script type="text/javascript" src="assets/plugins/slickSlider/slick.min.js"></script>