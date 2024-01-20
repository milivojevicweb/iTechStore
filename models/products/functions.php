<?php

function get_products($product){
    return executePrepared("SELECT p.idProduct,i.path,i.alt,p.name,p.description,p.oldPrice,p.newPrice,k.name as knaziv from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where k.name='$product' AND i.cover=1 ORDER BY p.newPrice ASC  LIMIT 6",[$product]);
}

function getProductWithLimit($limit,$value,$price,$cover){
    return executeQuery("SELECT p.idProduct,i.path,i.alt,p.name,p.description,p.oldPrice,p.newPrice,k.name as knaziv  from product p join category k on p.idCategory=k.idCategory inner join images i on p.idProduct=i.idProduct where  i.cover=$cover and k.name='$value' and ( p.newPrice BETWEEN 0 AND $price ) LIMIT $limit ");
}
    
function checkAddressRating($ip,$idProducts){
    return executePreparedOne("SELECT * from rating_product  where ipAddress=? and idProduct=? ",[$ip,$idProducts]);
}

function insertRating(int $idProducts,$rating,$ipAddress){
    return uidPrepared("INSERT INTO rating_product(idProduct,rating,ipAddress) VALUES(?,?,?)",[$idProducts,$rating,$ipAddress]);
}

function updateRating($rating,$idProducts,$ipAddress){
    return uidPrepared("UPDATE rating_product SET rating=? WHERE idProduct=? AND ipAddress=?",[$rating,$idProducts,$ipAddress]);
}

function retingForProductAvg($idProducts){
    return executePreparedOne("SELECT ROUND(AVG(rating),1) AS avg FROM rating_product WHERE idProduct=? ",[$idProducts]);
}

function getMaxPrice($name){
    return executePreparedOne("SELECT max(newPrice) as maxPrice from product p INNER JOIN category k on p.idCategory=k.idCategory where k.name=?",[$name]);
}

function calculatePercent($oldPrice,$newPrice){
    if(($oldPrice>$newPrice)&&$newPrice>0){
        $percent=round((($oldPrice-$newPrice)/$oldPrice*100.0),0);
        $result="";
        if($percent<=20){
            $result="<span class='pricePercent greenPercent'>-".$percent."%</span>";
        }else if($percent<=40){
            $result="<span class='pricePercent yellowPercent'>-".$percent."%</span>";
        }else{
            $result="<span class='pricePercent redPercent'>-".$percent."%</span>";
        }

        return $result;
    }
}

function salePriceCheck($oldPrice,$newPrice){
    $result="";
    if($newPrice>0 &&($oldPrice>$newPrice)){
        $result="<p class='first precrtan '>&#36;".$oldPrice.".00</p>
                <p class='first nova'>&#36;".$newPrice.".00</p>";
    }else if($newPrice>$oldPrice){
        $result="<p class='first'>&#36;".$newPrice.".00</p>";
    }else{
        $result="<p class='first'>&#36;".$oldPrice.".00</p>";
    }
    return $result;
}

function insertOrder($userId,$time,$status){
    return uidPrepared("INSERT INTO orders VALUES(null, ?, ?,1,?,0,NOW())",[$userId,$time,$status]);
}

function purchaseId($time){
    return executePreparedOne("SELECT idOrders FROM orders WHERE date = ?",[$time]);
}

function insertOrderProduct($purchaseId,$id,$quantity){
    return uidPrepared("INSERT INTO orders_products values(null,?, ?, ? )",[$purchaseId,$id,$quantity]);
}

function curentQuantity($id){
    return executePreparedOne("SELECT quantity FROM product where idProduct=?",[$id]);
}

function updateQuantity($quantity,$id){
    return uidPrepared("UPDATE product SET quantity=? WHERE idProduct=?",[$quantity,$id]);
}

function lastId(){
    return executeQueryOneRow("SELECT idOrders FROM orders ORDER BY idOrders DESC LIMIT 1");
}

function totalPrice($id){
    return executePreparedOne("SELECT sum(p.newPrice*op.quantity) as total from product p INNER JOIN orders_products op on p.idProduct=op.idProduct where op.idOrders=?",[$id]);
}

function updateOrdersPrice($total,$id){
    return uidPrepared("UPDATE orders set total=? where idOrders=?",[$total,$id]);
}

function deleteComment($id){
    return uidPrepared("DELETE from comments where idComment=?",[$id]);
}

function deleteCommentReplies($id){
    return uidPrepared("DELETE from comment_replies where idReplies=?",[$id]);
}

function getAllProducts(){
    return executeQuery("SELECT p.idProduct as id,p.Quantity,i.path,i.alt,p.name,p.description,p.oldPrice,p.newPrice,k.name as knaziv from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where  i.cover=1");
}

function filterProductsPrice($product,$price){
    return executePreparedOne("SELECT count(*) as brojproizvoda from product p join category k on p.idCategory=k.idCategory where k.name=? and ( p.newPrice BETWEEN 0 AND ? )",[$product,$price]);
}

function filterProductsPriceSearch($product,$value,$price){
    return executePreparedOne("SELECT count(*) as brojproizvoda from product p join category k on p.idCategory=k.idCategory where k.name=? and p.name LIKE '%$value%' and ( p.newPrice BETWEEN 0 AND ? )",[$product,$price]);
}

function paginationNumber($value){
    return executePreparedOne("SELECT count(*) as brojproizvoda from product p join category k on p.idCategory=k.idCategory where k.name=?",[$value]);
}

function insertComment($userId,$productId,$comment){
    return uidPrepared("INSERT into comments values(null,?,?,?,NOW())",[$userId,$productId,$comment]);
}

function insertCommentReplies($commentId,$comment){
    return uidPrepared("INSERT into comment_replies values(null,?,?,NOW())",[$commentId,$comment]);
}

function insertUserCommentReplies($user){
    return uidPrepared("INSERT into users_comment_replies values(null,?,(SELECT idReplies FROM comment_replies ORDER BY idReplies DESC LIMIT 1))",[$user]);
}

function getProducQuantity($id){
    return executePrepared("SELECT Quantity,idProduct AS id FROM product WHERE idProduct=?",[$id]);
}

function getOneProductQuantity($id){
    return executePreparedOne("SELECT Quantity,idProduct AS id FROM product WHERE idProduct=?",[$id]);
}