<?php


 if(isset($_POST['send'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    $page=($_POST["idpag"]-1)*6;
    $name=$_POST['name'];
    $productSearch=$_POST['productSearch'];
    $category=$_POST['productCategory'];
    $status=$_POST["productStatus"];
    try{

        if($name=="Products"){

            $query="SELECT p.idProduct,i.path,i.alt,p.name ,p.Quantity,p.description,p.oldPrice,p.newPrice,k.name as knaziv from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where p.name LIKE '%$productSearch%' AND  i.cover=1 ";
            if($status=="1"){
                $query.=" AND p.quantity>0 ";
            }
            if($status=="0"){
                $query.=" AND p.quantity<1 ";
            }
            if($category!=""){
                $query.=" AND k.idCategory=$category ";
            }
            $query.="  ORDER BY p.idProduct DESC LIMIT 6 OFFSET $page";

            $result=executeQuery($query);
            
        }elseif($name=="News"){
            $result=getAllNewsPagination($page);
        }elseif($name=="Category"){
            $result=getAllCategoryPagination($page);
        }elseif($name=="Newsletter"){
            $result=getAllNewsletterPagination($page);
        }elseif($name=="Poll"){
            $result=getAllPollPagination($page);
        }elseif($name=="Contry"){
            $result=getAllContryPagination($page);
        }

        echo json_encode($result);
        http_response_code(200);
    }
    catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }
}
?>