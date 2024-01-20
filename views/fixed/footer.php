<?php
    include_once "models/home/functions.php";
?>
        <footer id="futer" class="darkEmptyBackround">
            <div id="newsletter" class="darkEmptyLightBackground">
                <div class="omotac">
                    <div id="newsletterSection">
                        <h2>Enter your E-mail</h2>
                        <div id="nesletterLine"></div>
                        <p>Subscribe for Exclusive Bonuses, Free Tips and News.</p>
                        <div id="newsletterForm">
                            <input type="email" id="emailnewsletter" placeholder="Enter your email" name="newsletter" />
                            <button class="buttonDisable" disabled id="newsletterbutton">Send</button>
                           
                        </div>
                        <span id="newsletterstatus"></span>
                    </div>
                </div>
            </div>
            <div class="omotac">
                <div id="fgore">
                <ul class="kolona1">
                        <li class="naslov">ABOUT US</li>
                        <li>Our vision and mission is to bring digital to every person, home and organization for a fully connected, intelligent world.</li>
                    </ul>    
            
                    <ul class="kolona1">
                        <li class='naslov'>PRODUCTS</li>
                    <?php 
                        $category=MenuCategory();
                        foreach($category as $item):?>
                            <li><a href='index.php?page=<?=$item->name?>'><?=$item->name?></a></li>
                        <?php endforeach;?>
                    
                    </ul>
                    <ul class="kolona1">
                        <li class="naslov">ORGANISATION</li>
                        <li><a href="dokumentacija.pdf">Dokumentacija</a></li>
                        <li><a href="rss.xml">Rss</a></li>
                        <li><a href="sitemap.xml">Sitemap</a></li>
                        <li><a href="robots.txt">Robots</a></li>
                    </ul>
                    <ul class="kolona1">
                        <li class="naslov">MENU</li>
                        <?php $menu=getMenu();
                        foreach ($menu as $item):?>
                            <li><a href='<?=$item->href?>'><?=$item->name?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div id="footerSocialNetworkContainer">
                    <ul class="drustveneMreze">
                            <li class="facebookPadding"><a href="https://www.facebook.com"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="https://www.youtube.com"><i class=" fa fa-youtube-play"></i></a></li>
                            <li><a href="https://twitter.com"><i class="ikonica fa fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a></li>
                    </ul> 
                </div>

                <div class="cistac"></div>

            </div>
            <div id="fdole">
                <p>&copy; 2024 Marko Milivojević</p> 
            </div>
            <div class="cistac"></div>
        </footer>    
        <div id="scrollToTop"><i class='scrolColor fa fa-angle-up'></i><div>
    
    </body>
</html>
<script type="text/javascript" src="assets/js/newsletter.js"></script>