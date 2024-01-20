<?php
session_start();
if(isset($_POST['totall'])){
    require_once "../../config/connection.php";
    include "functions.php";
    require_once INIT;
    $normalTotal=$_POST['totall'];
    $total1=$_POST['totall']."00";
    $total=(int)$total1;
    $description = stripeDescription();

    $kon="idOrders: $description->idOrders";


    $updateTotal=updateTotal($normalTotal);
    // Set your secret key: remember to change this to your live secret key in production
    // See your keys here: https://dashboard.stripe.com/account/apikeys

    \Stripe\Stripe::setApiKey('sk_test_fkitzoLy7VHbBZxPE7PthBT300Gy8MZwcf');

    // Token is created using Checkout or Elements!
    // Get the payment token ID submitted by the form:
    $token = $_POST['stripeToken'];

    $charge = \Stripe\Charge::create([
        'amount' => $total,
        'currency' => 'usd',
        'description' => $kon,
        'source' => $token,
    ]);
    header("Location: ../../index.php?page=successBuy");
}else{
    header("Location: ../../index.php?page=cart");
}