<?php
session_start();
ob_start();


if(isset($_POST['addProduct'])){
    require_once "../../../config/connection.php";
    include "functions.php";
    addProductParametar();
}

function addProductParametar(){

    $name=$_POST['name'];
    $desc=$_POST['desc'];
    $oldPrice = $_POST['oldPrice'];
    $newPrice = $_POST['newPrice'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $home=$_POST['home'];

    $error = [];

    $reText="/[a-z]+/";
    $reNumber="/[0-9]+/";
    if(!preg_match($reText,$name)){
        array_push($error, "Morate dodati naziv proizvoda");
    }
    if(!preg_match($reText,$desc)){
        array_push($error, "Morate dodati opis proizvoda");
    }
    if(!preg_match($reNumber,$oldPrice)){
        array_push($error, "Morate dodati staru cenu proizvoda");
    }
    if(!preg_match($reNumber,$newPrice)){
        array_push($error, "Morate dodati novu cenu proizvoda");
    }
    if($category==0){
        array_push($error, "Nije izabrana kategorija");
    }

    if(count($error)==0){

        try{
            $UserId = $_SESSION['korisnik_id'];
            $insertProduct=insertProduct($name,$desc,$oldPrice,$newPrice,$category,$UserId,$home,$quantity);
            if($insertProduct){
                addProfilePhoto();
            }
        }catch( PDOException $e){
            $e->getMessage();
            upisGreskeIzBaze($e);
        }
    }
}


function addProfilePhoto(){


    $error = [];
    $reText="/[a-z]+/";
    $fajl_naziv = $_FILES['image']['name'];
    $fajl_tmpLokacija = $_FILES['image']['tmp_name'];
    $fajl_tip = $_FILES['image']['type'];
    $fajl_velicina = $_FILES['image']['size'];
    $dozvoljeniFormati = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
    $alt=$_POST['alt'];

    if(!in_array($fajl_tip,$dozvoljeniFormati)){
        array_push($error, "Tip fajla nije validan. Dozvoljeni: jpg, jpeg, png, gif.");
    }
    if(!preg_match($reText,$alt)){
        array_push($error, "Morate dodati alt proizvoda");
    }

    if($fajl_velicina > 3000000){
        array_push($error, "Velicina fajla ne sme biti veca od 2MB!");
    }

    if(count($error)==0){
        try{

        list($sirina, $visina) = getimagesize($fajl_tmpLokacija);
        
        $postojecaSlika = null;
        switch($fajl_tip){
            case 'image/jpeg':
                $postojecaSlika = imagecreatefromjpeg($fajl_tmpLokacija);
                break;
            case 'image/png':
                $postojecaSlika = imagecreatefrompng($fajl_tmpLokacija);
                break;
        }

        $novaSirina = 500;
        $novaVisina = ($novaSirina/$sirina) * $visina; // novaVisina : visina = novaSirina : sirina

        $novaSlika = imagecreatetruecolor($novaSirina, $novaVisina);

        imagecopyresampled($novaSlika, $postojecaSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);

        $naziv = time().$fajl_naziv;
        $putanjaNovaSlika = 'assets/images/users/nova_'.$naziv;

        switch($fajl_tip){
            case 'image/jpeg':
                imagejpeg($novaSlika, '../../../'.$putanjaNovaSlika, 100);
                break;
            case 'image/png':
                imagepng($novaSlika, '../../../'.$putanjaNovaSlika);
                break;
        }

        $putanjaOriginalnaSlika = 'assets/images/users/'.$naziv;

        $datum=date("Y/m/d");
        if(move_uploaded_file($fajl_tmpLokacija, '../../../'.$putanjaOriginalnaSlika)){
            

            $_SESSION['proizvod_dobro']="Slika je upload-ovana na server!!";           

            $cover=1;
            $productId=getProductId();
            $insertImage=insertProductImage($productId->idProduct,$putanjaNovaSlika,$putanjaOriginalnaSlika,$cover,$alt);

            if($insertImage){
                addMultiPhoto();
            }
            $_SESSION['proizvod_dobro']="Uspesan unos u bazu.";


        } else {
            $_SESSION['greska_proizvod']="Nije uploadovana slika na server.";
        }
    }catch( PDOException $e){
        $e->getMessage();
        upisGreskeIzBaze($e);
    }
    } else {
        $_SESSION['greska_proizvod']=$error;

    }
    

}

function addMultiPhoto(){

    $error = [];

    $dozvoljeniFormati = ["image/jpg", "image/jpeg", "image/png", "image/gif"];
    $alt=$_POST['alt'];
    $reText="/[a-z]+/";
    $multiImages=$_FILES['multiImage'];


    foreach($_FILES['multiImage']['tmp_name'] as $key => $val){
        $fileNameMulti = $_FILES['multiImage']['name'][$key];
        $fileMulti_tmpLokacija = $_FILES['multiImage']['tmp_name'][$key];
        $fileMulti_tip = $_FILES['multiImage']['type'][$key];
        $fileMulti_velicina = $_FILES['multiImage']['size'][$key];
        
    if(!in_array($fileMulti_tip,$dozvoljeniFormati)){
        array_push($error, "Tip fajla nije validan. Dozvoljeni: jpg, jpeg, png, gif.");
    }

    if(!preg_match($reText,$alt)){
        array_push($error, "Morate dodati alt proizvoda");
    }

    if($fileMulti_velicina > 3000000){
        array_push($error, "Velicina fajla ne sme biti veca od 2MB!");
    }

    if(count($error)==0){
        
        list($Multisirina, $Multivisina) = getimagesize($fileMulti_tmpLokacija);
        
        $MultipostojecaSlika = null;
        switch($fileMulti_tip){
            case 'image/jpeg':
                $MultipostojecaSlika = imagecreatefromjpeg($fileMulti_tmpLokacija);
                break;
            case 'image/png':
                $MultipostojecaSlika = imagecreatefrompng($fileMulti_tmpLokacija);
                break;
        }

        $novaSirinaMulti = 500;
        $novaVisinaMulti = ($novaSirinaMulti/$Multisirina) * $Multivisina; // novaVisina : visina = novaSirina : sirina

        $novaSlikaMulti = imagecreatetruecolor($novaSirinaMulti, $novaVisinaMulti);

        imagecopyresampled($novaSlikaMulti, $MultipostojecaSlika, 0, 0, 0, 0, $novaSirinaMulti, $novaVisinaMulti, $Multisirina, $Multivisina);

        $naziv = time().$fileNameMulti;
        $putanjaNovaSlikaMulti = 'assets/images/users/nova_'.$naziv;

        switch($fileMulti_tip){
            case 'image/jpeg':
                imagejpeg($novaSlikaMulti, '../../../'.$putanjaNovaSlikaMulti, 100);
                break;
            case 'image/png':
                imagepng($novaSlikaMulti, '../../../'.$putanjaNovaSlikaMulti);
                break;
        }

        $putanjaOriginalnaSlikaMulti = 'assets/images/users/'.$naziv;

        $datum=date("Y/m/d");
        if(move_uploaded_file($fileMulti_tmpLokacija, '../../../'.$putanjaOriginalnaSlikaMulti)){
                try{
                $cover=0;

                $productId=getProductId();
                insertProductImage($productId->idProduct,$putanjaNovaSlikaMulti,$putanjaOriginalnaSlikaMulti,$cover,$alt);
                }catch( PDOException $e){
                    $e->getMessage();
                    upisGreskeIzBaze($e);
                }

        }
    

    
        
    }
}

}

