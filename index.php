<?php
session_start();
ob_start();
  require_once "config/connection.php";
  include "views/fixed/head.php";
  include "views/fixed/heder.php";
  include_once "models/home/functions.php";

  if(!isset($_GET['page'])){
    include "views/home.php";
  }
  else {
      if(checkCategory($_GET['page'])){
        include "views/products.php";
      }else{
        switch($_GET['page']){
            case 'home':
                include "views/home.php";
                break;
            case 'author':
                include "views/author.php";
                break;
            case 'contact':
                include "views/contact.php";
                break;
            case 'userEdit':
                include "views/admin/user/userEdit.php";
                break;
            case 'user':
                include "views/user.php";
                break;
            case 'login':
                include "views/login.php";
                break;
            case 'logout':
                include "models/authentication/logout.php";
                break;
            case 'moderator':
                include "views/moderator.php";
                break;
            case 'admin':
                include "views/admin.php";
                break;
            case 'news':
                include "views/news.php";
                break;
            case 'oneProduct':
                include "views/oneProduct.php";
                break;
            case 'editProduct':
                include "views/moderator/products/editProduct.php";
                break;
            case 'registration':
                include "views/registration.php";
                break;
            case 'editNews':
                include "views/moderator/news/editNews.php";
                break;
            case 'oneNews':
                include "views/oneNews.php";
                break;
            case 'cart':
                include "views/cart.php";
                break;
            case 'buyCartPage':
                include "views/buyCartPage.php";
                break;
            case 'orderDetails':
                include "views/moderator/order/orderDetails.php";
                break;
            case 'resetPasswordEmail':
                include "views/resetPasswordEmail.php";
                break;
            case 'resetPassword':
                include "views/forgotPassword.php";
                break;
            case 'editPrice':
                include "views/moderator/products/editPrice.php";
                break;
            case 'editPoll':
                include "views/moderator/poll/editPoll.php";
                break;
            case 'editNewsletter':
                include "views/moderator/newsletter/editNewsletter.php";
                break;
            case 'successBuy':
                include "views/successBuy.php";
                break;
            case '404':
                include "views/404.php";
                break;
            case '403':
                include "views/403.php";
                break;
            case '301':
                include "views/301.php";
                break;
            default: 
                include "views/404.php";
                break;
        }
    }

  }
  
  if(isset($_GET['page'])){
      if($_GET['page']!="admin" &&
        $_GET['page']!="moderator" &&
        $_GET['page']!="userEdit"  &&
        $_GET['page']!="editProduct" &&
        $_GET['page']!="editNews"  &&
        $_GET['page']!="orderDetails" &&
        $_GET['page']!="editPrice" &&
        $_GET['page']!="editPoll" &&
        $_GET['page']!="editNewsletter" ){
        include "views/fixed/footer.php";
      }
  }else{
    include "views/fixed/footer.php";
  }


   

    
      

      

