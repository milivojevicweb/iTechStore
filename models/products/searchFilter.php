<?php

header('Content-Type: application/json');

require_once "../../config/connection.php";
include "functions.php";
$price=$_POST['price'];
$product=$_POST['product'];
$cover=1;

    try{
        if(isset($_POST['value'])){
            $value=$_POST['value'];
        if($value==''){
            $proizvodi = getProductWithLimit($limit=6,$product,$price,1);
        }else{
            $query ="SELECT p.idProduct,i.path,i.alt,p.name,p.description,p.oldPrice,p.newPrice,k.name as knaziv from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where k.name='$product' AND i.cover=$cover  and p.name LIKE '%$value%'  and ( p.newPrice BETWEEN 0 AND $price ) ";
            if(isset($_POST['priceSort'])){

                if($_POST['priceSort']=="asc"){
                    $query.=" ORDER BY p.newPrice ASC ";
                }else {
                    $query.=" ORDER BY p.newPrice DESC ";
                }
            }
            $query.="  LIMIT 6";
        $proizvodi = executeQuery($query);
        }}

        echo json_encode($proizvodi);
    }catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }
    