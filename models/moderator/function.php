<?php

function category() {
    return executeQuery("SELECT * FROM category");
}

function sumOrdersPrice(){
    return executeQueryOneRow("SELECT SUM(total) as total from orders");
}

function sumOrdersPriceMonth(){
    return executeQueryOneRow("SELECT SUM(total) as total from orders WHERE (MONTH(dateOrders) = MONTH(CURRENT_DATE()) AND YEAR(dateOrders) = YEAR(CURRENT_DATE()))");
}

function topProducts(){
    return executeQuery("SELECT COUNT(op.idProduct) as number, p.name FROM orders_products op INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN product p on op.idProduct=p.idProduct GROUP BY op.idProduct,p.name ORDER BY number DESC LIMIT 5");
}
function topProductsMonth(){
    return executeQuery('SELECT COUNT(op.idProduct) as number, p.name FROM orders_products op INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN product p on op.idProduct=p.idProduct WHERE (MONTH(o.dateOrders) = MONTH(CURRENT_DATE()) AND YEAR(o.dateOrders) = YEAR(CURRENT_DATE())) GROUP BY op.idProduct,p.name ORDER BY Number DESC LIMIT 5');
}

function numberSellProducts(){
    return executeQueryOneRow("SELECT COUNT(op.idProduct) as qu FROM orders o INNER JOIN orders_products op where o.idOrderStatus=2 AND YEAR(o.dateOrders) = YEAR(CURRENT_DATE()) ");
}

function numberSellProductsThisMonth(){
    return executeQueryOneRow("SELECT COUNT(op.idProduct) as qu FROM orders o INNER JOIN orders_products op  where o.idOrderStatus=2 AND (MONTH(o.dateOrders) = MONTH(CURRENT_DATE()) AND YEAR(o.dateOrders) = YEAR(CURRENT_DATE())) ");
}

function accessAllowModeratorMain(){
    if(!isset($_SESSION['korisnik'])){
        $_SESSION['greska'] = "NISTE ULOGOVANI!";
        header("Location: index.php");
    }
    if($_SESSION['korisnik']->idRole == 2){
        $_SESSION['greska'] = "NISTE MODERATOR!";
        header("Location: index.php");
    }
}

function orders(){
    return executeQuery("SELECT p.name as nazivProizvoda, p.newPrice as cenaProizvoda,o.idOrders,op.quantity,o.date,o.idOrderStatus,o.total,k.name,k.lastName,k.email FROM product p INNER JOIN orders_products op on p.idProduct=op.idProduct INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN user k on o.idUser=k.idUser");
}

function ordersInformation(){
    return executeQuery("SELECT DISTINCT opm.name AS payment, o.idOrders,o.dateOrders,o.idOrderStatus,o.total,k.name,k.lastName FROM product p INNER JOIN orders_products op on p.idProduct=op.idProduct INNER JOIN orders o on op.idOrders=o.idOrders INNER JOIN user k on o.idUser=k.idUser INNER JOIN order_payment_method opm ON o.idOrderPaymentMethod=opm.idOrderPaymentMethod order by o.idOrders desc LIMIT 6");
}

function proizvodi(){
    return executeQuery("SELECT p.idProduct,i.path,i.alt,p.name,p.Quantity ,p.description,p.oldPrice,p.newPrice,k.name as knaziv from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where i.cover=1 ORDER BY p.idProduct DESC LIMIT 6");
}

function homeProduct(){
    return executeQuery("SELECT * FROM home_product");
}
function news(){
    return executeQuery("SELECT idNews,title,text,date,bigImage,image,idUser FROM news  ORDER BY idNews DESC LIMIT 6");
}
function ordersNumber(){
    $rez=brojRedova("SELECT COUNT(idOrders) from orders where idOrderStatus=1 group by idOrders");
    return $rez;
}

function deleteImage($id){
    return uidPrepared("DELETE FROM images where idImages=?",[$id]);
}

function getCategory(){
    return executeQuery("SELECT idCategory,name FROM category ORDER BY idCategory LIMIT 6");
}

function getCountry(){
    return executeQuery("SELECT idCountry,name FROM country ORDER BY idCountry LIMIT 6");
}

function viewAllPoll(){
    return executeQuery("SELECT p.question,p.date,p.status,p.idPoll FROM poll p ORDER BY p.idPoll DESC LIMIT 6");
}

function pollUpdateStatus($status,$id){
    if($status==1){
        echo "<button type='button' data-idpoll=$id id='activeStatusPoll' class='changestatuspoll'><i class='fa fa-eye'></i></button>";
    }else{
        echo "<button type='button' data-idpoll=$id class='noActiveStatusPoll changestatuspoll'><i class='fa fa-eye-slash'></i></button>";
    }
}

function getStatus(){
    return executeQuery("SELECT idOrderStatus,name FROM order_status");
}

function getPaymentMethod(){
    return executeQuery("SELECT idOrderPaymentMethod,name FROM order_payment_method");
}

function pollResult(){
    $rowCount=executeQueryOneRow("SELECT COUNT(pa.idPollAnswer) AS rowNumber FROM poll p INNER JOIN poll_answer pa ON p.idPoll=pa.idPoll INNER JOIN poll_user_answer pua ON pa.idPollAnswer=pua.idPollAnswer WHERE p.status=1");

    $result="";
    $arrayIdAnswer=executeQuery("SELECT DISTINCT pa.idPollAnswer AS number FROM poll p INNER JOIN poll_answer pa ON p.idPoll=pa.idPoll WHERE p.status=1");
    $pollName=executeQueryOneRow("SELECT question FROM poll WHERE status=1");
    @$result="<h2>$pollName->question</h2>";
    foreach($arrayIdAnswer as $item){
        $oneAnswer=executePrepared("SELECT COUNT(pa.idPollAnswer) AS rowNumber,pa.answer FROM poll p INNER JOIN poll_answer pa ON p.idPoll=pa.idPoll INNER JOIN poll_user_answer pua ON pa.idPollAnswer=pua.idPollAnswer WHERE p.status=1 AND pa.idPollAnswer=?",[$item->number]);
    
        foreach($oneAnswer as $item){
            @$percent=round(($item->rowNumber/$rowCount->rowNumber)*100);
            if(is_nan($percent)){
                $percent=0;
            }
            $result.="<p class='darkEmptyTextWhite'>".$item->answer."</p>
            <div class='rez'>
                <div class='skills html' style='width:".$percent."%;'><p>".$percent."%</p></div>
            </div>";
        }
        }
    return $result;
}

function newsletterCount(){
    return executeQueryOneRow("SELECT COUNT(email) as number FROM newsletter_client");
}

function newUsersNewsletterCount(){
    return executeQueryOneRow("SELECT COUNT(email) as number  FROM `newsletter_client` WHERE DATE(date) = CURRENT_DATE");
}