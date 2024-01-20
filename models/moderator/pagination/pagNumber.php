<?php

if(isset($_GET['name'])){
    header('Content-Type: application/json');
    require_once "../../../config/connection.php";
    include "functions.php";

    $name=$_GET['name'];
    $productSearch=$_GET['productSearch'];
    $status=$_GET["productStatus"];
    $category=$_GET['productCategory'];
    try{

        if($name=="Products"){

            $query="SELECT COUNT(p.idProduct) AS number from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where p.name LIKE '%$productSearch%' AND  i.cover=1 ";
            if($status=="1"){
                $query.=" AND p.quantity>0 ";
            }
            if($status=="0"){
                $query.=" AND p.quantity<1 ";
            }
            if($category!=""){
                $query.=" AND k.idCategory=$category ";
            }


            $count=executeQueryOneRow($query);
           
        }elseif($name=="News"){
            $count=countNews();
        }elseif($name=="Category"){
            $count=countCategory();
        }elseif($name=="Newsletter"){
            $count=countNewsletter();
        }elseif($name=="Poll"){
            $count=countPoll();
        }elseif($name=="Order"){
            $count=["number"=>countOrder()];
        }elseif($name=="Contry"){
            $count=countContry();
        }

            \http_response_code(200);
            echo json_encode($count);

    }
    catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }
}