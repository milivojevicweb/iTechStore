<?php

function stripeDescription(){
    return executeQueryOneRow("SELECT idOrders FROM orders ORDER BY idOrders DESC LIMIT 1");
}

function updateTotal($normalTotal){
    return uidPrepared("UPDATE orders o  set total=?  where idOrders = (SELECT idOrders FROM orders ORDER BY idOrders DESC LIMIT 1)",[$normalTotal]);
}