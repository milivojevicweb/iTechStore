<?php

require_once "config.php";
require_once INIT;
$stripeDetails = array(
    "secretKey" => "sk_test_fkitzoLy7VHbBZxPE7PthBT300Gy8MZwcf",
    "publishableKey" => "pk_test_VjJOHhpOOuyZljJZCJc1fb8v00C0vkfuuA"
);

// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys


zabeleziPristupStranici();

try {
    $konekcija = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function executeQuery($query){
    global $konekcija;
    return $konekcija->query($query)->fetchAll();
}

function executeQueryOneRow($query){
    global $konekcija;
    return $konekcija->query($query)->fetch();
}
function brojRedova($query){
    global $konekcija;
    return $konekcija->query($query)->rowCount();
}

function rowCount($query){
    global $konekcija;
    return $konekcija->query($query)->rowCount();
}

function executePrepared(string $query, Array $params){
    global $konekcija;
    $prepare = $konekcija->prepare($query);
    $prepare->execute($params);
    return $prepare->fetchAll();
}
function executePreparedOne(string $query, Array $params){
    global $konekcija;
    $prepare = $konekcija->prepare($query);
    $prepare->execute($params);
    return $prepare->fetch();
}

function uidPrepared(string $query, Array $params){
    global $konekcija;
    $prepare = $konekcija->prepare($query);
    return $prepare->execute($params);
}

function zabeleziPristupStranici(){
    $open = fopen(LOG_FAJL, "a");
    if($open){
        if(isset($_GET['page'])){
            fwrite($open, $_SERVER['PHP_SELF']."\t".$_SERVER['REMOTE_ADDR']."\t".date("Y/m/d")."\t".$_GET["page"]."\n");
        }else{
            fwrite($open, $_SERVER['PHP_SELF']."\t".$_SERVER['REMOTE_ADDR']."\t".date("Y/m/d")."\t"."home"."\n");
        }

        fclose($open);
    }
}
function zabeleziGreske($email,$error){
    $open = fopen(ERROR, "a");
    if($open){
            fwrite($open, $_SERVER['PHP_SELF']."\t".$_SERVER['REMOTE_ADDR']."\t".date("Y/m/d")."\t".$email."\t".$error."\n");

        fclose($open);
    }
}

function upisGreskeIzBaze($greska){
    $open = fopen(GRESKEBAZA, "a");
    if($open){
            fwrite($open, $greska."\n");
        fclose($open);
    }
}

function getLastId(){
    global $konekcija;
    return $konekcija->lastInsertId();
}