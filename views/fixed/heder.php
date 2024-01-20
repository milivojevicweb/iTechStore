<?php
    include_once "models/home/functions.php";
?>

<body class="darkEmptyBackround <?php if(isset($_GET['page'])){ if($_GET['page']=="admin" || $_GET['page']=="moderator" || $_GET['page']=="user"){ echo "moderatroAdminBody";}}?>" >
    <header <?php if(isset($_GET['page'])){ if($_GET['page']=="admin" || $_GET['page']=="moderator"){ echo "class='adminModeratorHeader'";}}?> id="heder">
        <h1 class="prviH1">iTech | Brilliant phone,pay on the web,iWatch,iPad Pro,iPhone</h1>
        <div class="omotac">
            <div id="slikaHeder">    
                <a href="index.php"><img  <?php if(isset($_GET['page'])){ if($_GET['page']=="admin" || $_GET['page']=="moderator"){ echo "src='assets/images/logoWhiteTransparent.png'";}else{ echo "class='colorLogo' src='assets/images/logo3.png'";}}else{echo "class='colorLogo' src='assets/images/logo3.png'";}?> class="logo2" alt="logo iTech"/></a>
            </div>
            <div id="navigacija">
                <div id="mySidenav" class="sidenav">
                    <a class="closebtn" id="meniLinkClose">&times;</a>
                    <a class='meniHover'href='index.php'>Home</a>
                    <?php
                        $category=MenuCategory();
                        foreach($category as $item):
                            
                    ?>
                        <a class='meniHover'href='index.php?page=<?=$item->name?>'><?=$item->name?></a>
                    <?php endforeach; ?>
                    <?php $menu=getMenu();
                        foreach ($menu as $key=>$rez):
                            if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->idRole!=4){
                                if($rez->name!="Login"){
                                    echo "<a class='meniHover'href='$rez->href'>$rez->name</a>";
                                }
                            }else{
                                echo "<a class='meniHover'href='$rez->href'>$rez->name</a>";
                            }
                            
                            endforeach;

                        if(isset($_SESSION['korisnik_id'])){
                                echo"<p class='responsiveHidden'>".$_SESSION['korisnik']->name." ".$_SESSION['korisnik']->lastName."</p>";
                            if($_SESSION['korisnik']->idRole == 1){
                                echo"<a class='headerRed' href='index.php?page=admin'>Admin</a>";
                                echo"<a class='headerRed' href='index.php?page=moderator'>-Moderator</a>";
                            }elseif($_SESSION['korisnik']->idRole == 4){
                                echo"<a class='headerRed' href='index.php?page=admin'>-Admin</a>";
                                echo"<a class='headerRed' href='index.php?page=moderator'>-Moderator</a>";
                                echo"<a class='headerRed' href='index.php?page=user'>-User</a>";
                            }elseif($_SESSION['korisnik']->idRole == 3){
                                echo"<a class='headerRed' href='index.php?page=moderator'>-Moderator</a>";
                            }else{
                                echo"<a class='headerRed' href='index.php?page=user'>-User</a>";
                            }
                                
                                echo"<a class='headerRed responsiveHidden' href='index.php?page=logout'>-Logout</a>";
                    }?>
                    <p>Dark Mode</p>
                    <div class="switch switch--horizontal">
                        <input id="radio-a" type="radio" name="first-switch" class="radio"/>
                        <input id="radio-b" type="radio" name="first-switch" class="radio"/>
                        <span class="toggle-outside"><span class="toggle-inside"></span></span>
                    </div>
                </div>
                <span <?php if(isset($_GET['page'])){ if($_GET['page']=="admin" || $_GET['page']=="moderator"){ echo "class='adminModeratorHeaderColor'";}}?> id="meniLinkOpen">
                <div id="hamburger">
                    <div class="hamburger darkEmptyBackgroundWhite"></div>
                    <div class="hamburger darkEmptyBackgroundWhite"></div>
                    <div class="hamburger darkEmptyBackgroundWhite"></div>
                </div> </span>
                <?php 
                // if(isset($_SESSION['korisnik'])) :?> 
                <div id="ulogovan">
                    <?php if(isset($_SESSION['korisnik_id'])){
                        $id=$_SESSION['korisnik_id'];
                        $user=getUserName($id);
                        if(isset($_GET['page'])){
                            if($_GET['page']=="admin" || $_GET['page']=="moderator"){
                                    echo "<div id='logIme' class='adminModeratorHeaderColor darkEmptyTextWhite'><p>".$user->name." ".$user->lastName."</p></div>";    
                            }else{
                                echo "<div id='logIme' class='darkEmptyTextWhite'><p>".$user->name." ".$user->lastName."</p></div>";    
                            }
                        }else{
                            echo "<div id='logIme' class='darkEmptyTextWhite'><p>".$user->name." ".$user->lastName."</p></div>";    
                        }
                        
                        }?>
                    </li>
                    <?php if(isset($_SESSION['korisnik'])): ?>
                    
                    <div class="dropdown">
                        <div class="dropbtn"><img id="slikaKorisnik" src="assets/images/user.png" alt="slika"/></div>
                        <div id="myDropdown" class="dropdown-content darkEmptyLightBackground darkEmptyTextWhite">
                            <?php if($_SESSION['korisnik']->idRole == 1){
                                    echo"<a href='index.php?page=admin'>Admin</a>";
                                }elseif($_SESSION['korisnik']->idRole == 3){
                                    echo"<a href='index.php?page=moderator'>Moderator</a>";
                                }elseif($_SESSION['korisnik']->idRole == 4){
                                    echo"<a href='index.php?page=admin'>Admin</a>";
                                }else{
                                    echo"<a href='index.php?page=user'>User</a>";
                                } ?>
                            <a href="index.php?page=logout&id=<?=$id?>">Logout</a>
                        </div>
                    </div>
                        
                    <?php endif; 
                    if(isset($_SESSION['korisnik'])):
                    if(($_SESSION['korisnik']->idRole ==2 || $_SESSION['korisnik']->idRole ==4)):?> 
                    <a id="cart_link" href="index.php?page=cart">
                        <i id="korpa"  class="<?php if(isset($_GET['page'])){ if($_GET['page']=="admin" || $_GET['page']=="moderator"){ echo "adminModeratorHeaderColor";}}?> darkEmptyTextWhite fa fa-shopping-cart"></i>
                        <span class="badge_cart">
                            
                        </span>
                        
                    </a>            
                    <?php endif; else: //endif;?>
                        <a id="cart_link" href="index.php?page=cart">
                        <i id="korpa" class="darkEmptyTextWhite fa fa-shopping-cart"></i>
                        <span class="badge_cart">
                            
                        </span>
                        </a>          
                    <?php endif; //endif;?>             
                </div>
            </div>
        </div>
    </header>
    <div class="dropbtn blokiraj"></div>
    <div id="info"></div>
        