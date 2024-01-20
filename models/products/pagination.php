<?php
require_once "../../config/connection.php";

 if(isset($_POST['send'])){
    $price=$_POST['price'];
    $strana=($_POST["idpag"]-1)*6;
    $product=$_POST['product'];
    $value=$_POST['value'];
    
    $cover=1;
    $limit = 6;
    if($value==""){
        $upit ="SELECT p.idProduct,i.path,i.alt,p.name,p.description,p.oldPrice,p.newPrice,k.name as knaziv from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where k.name='$product' AND i.cover=$cover  and ( p.newPrice BETWEEN 0 AND $price ) ";
    }else{
        $upit ="SELECT p.idProduct,i.path,i.alt,p.name,p.description,p.oldPrice,p.newPrice,k.name as knaziv from product p INNER JOIN category k on p.idCategory=k.idCategory INNER JOIN images i ON p.idProduct=i.idProduct where k.name='$product' AND i.cover=$cover  and p.name LIKE '%$value%' and ( p.newPrice BETWEEN 0 AND $price ) ";
    }
    if(isset($_POST['sendFilter']) && $_POST['sendFilter']!=""){

        if($_POST['sendFilter']=="asc"){
            $upit.=" ORDER BY p.newPrice ASC ";
        }else {
            $upit.=" ORDER BY p.newPrice DESC ";
        }
    }else{
          $upit.=" ORDER BY p.newPrice ASC ";
    }
    $upit.=" LIMIT 6 OFFSET $strana ";



    $da=$konekcija->prepare($upit);
    $sve=$da->execute();
    $svee=$da->fetchAll();
    try{

        echo json_encode($svee);
        http_response_code(200);

    }
    catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        http_response_code(500);
        upisGreskeIzBaze($ex);
    }
}
?>