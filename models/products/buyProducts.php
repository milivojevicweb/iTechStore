<?php
    session_start();
    if(isset($_SESSION['korisnik']) && isset($_POST['prod'])) {

    require_once "../../config/connection.php";
    include "functions.php";
    
    try{

    $productCart = $_POST['prod'];
    $userId = $_SESSION['korisnik_id'];
    $status=$_POST['status'];
    $timeP = time();
    echo $userId;
    echo $timeP;

    insertOrder($userId,$timeP,$status);

    $purchaseId = purchaseId($timeP)->idOrders;

    foreach($productCart as $b) {
        $id = $b['id'];
        $q = $b['quantity'];

        insertOrderProduct($purchaseId,$id,$q);
        $curentQuantity=curentQuantity($id);
        $Quantity=(int)$curentQuantity->quantity-(int)$q;
        $updateQuantity=updateQuantity($Quantity,$id);

    }
 

         $lastId= lastId()->idOrders;
         $total=totalPrice($lastId)->total;
         updateOrdersPrice($total,$lastId);
         
    }catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
            upisGreskeIzBaze($ex);
    }

    echo "Uspešna kupovina";

}

?>
