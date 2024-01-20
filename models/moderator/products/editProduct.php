<?php
session_start();
ob_start();


if(isset($_POST['submit'])){
  require_once "../../../config/connection.php";
  include "functions.php";

    $id = $_POST['id'];
    $naziv = $_POST['name'];
    $opis = $_POST['desc'];
    $alt=$_POST['alt'];
    $quantity=(int)$_POST['quantity'];
    $istaknut=$_POST['home'];
    $galerija=$_POST['category'];
    $greske=[];

    $reText="/[a-z]+/";
    $reNumber="/[0-9]+/";
    
    if(!preg_match($reText,$naziv)){
        array_push($greske, "Morate dodati naziv proizvoda");
    }
    if(!preg_match($reText,$opis)){
        array_push($greske, "Morate dodati opis proizvoda");
    }
    if(!preg_match($reText,$alt)){
        array_push($greske, "Morate dodati alt proizvoda");
    }
    if(!preg_match($reNumber,$quantity)){
        array_push($greske, "Morate dodati quantity proizvoda");
    }
    if($istaknut==0){
        array_push($greske, "Nije izabrana kategorija");
    }

    if($galerija==0){
        array_push($greske, "Nije izabrana kategorija");
        $_SESSION['xizmena_proizvod']=$greske;
    }
    if(count($greske)==0){

        // if($_FILES['profileImage']['tmp_name']!=''){
        if(isset($_FILES['profileImage'])){

            $fajl_naziv = $_FILES['profileImage']['name'];
            $fajl_tmpLokacija = $_FILES['profileImage']['tmp_name'];
            $fajl_tip = $_FILES['profileImage']['type'];
            $fajl_velicina = $_FILES['profileImage']['size'];
        
            $greske = [];
        
            $dozvoljeni_tipovi = ['image/jpg', 'image/jpeg', 'image/png'];
        
            if(!in_array($fajl_tip, $dozvoljeni_tipovi)){
                array_push($greske, "Pogresan tip fajla. - slika");
            }
            if($fajl_velicina > 3000000){
                array_push($greske, "Maksimalna velicina fajla je 3MB. - Profil slika");
            }
        
        
            if(count($greske) == 0){
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
        
                $imageName = time().$fajl_naziv;
                $putanjaNovaSlika = 'assets/images/users/nova_'.$imageName;
        
                switch($fajl_tip){
                    case 'image/jpeg':
                        imagejpeg($novaSlika, '../../../'.$putanjaNovaSlika, 100);
                        break;
                    case 'image/png':
                        imagepng($novaSlika, '../../../'.$putanjaNovaSlika);
                        break;
                }
        
                $putanjaOriginalnaSlika = 'assets/images/users/'.$imageName;
        
                if(move_uploaded_file($fajl_tmpLokacija, '../../../'.$putanjaOriginalnaSlika)){
                    try{
                        updateProductWithImage($naziv,$opis,$istaknut,$galerija,$putanjaNovaSlika,$cover=1,$id,$quantity,$alt,$id);
                    }catch(PDOException $e){
                        $e->getMessage();
                        upisGreskeIzBaze($e);
                    }
                    $_SESSION['vestIzmena_dobro']="Uspesno izmenjena vest sa slikom";

                }
        
        
            }


        }else{

            try{
            $rezultat=updateProductNoImage($naziv,$opis,$istaknut,$galerija,$quantity,$alt,$id);
            if($rezultat){
                $_SESSION['izmena_proizvod']="usepsno";

            }else{
                $_SESSION['xizmena_proizvod']="Greska";

            }
        }catch(PDOException $e){
            $e->getMessage();
            upisGreskeIzBaze($e);
        }
    }
}else{
    $_SESSION['xizmena_proizvod']=$greske;

    var_dump($greske);

}
}




if(isset($_POST['buttonName'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    
    $id=$_POST['idImages'];
    $idProduct = $_POST['idProduct'];
    $buttonName=$_POST['buttonName'];
    $alt=$_POST['alt'];

    if($buttonName=="updateImageButton"){
        $nameVariable="updateImage";
    }else{
        $nameVariable="insertImage";
    }

    $fajl_naziv = $_FILES[$nameVariable]['name'];
    $fajl_tmpLokacija = $_FILES[$nameVariable]['tmp_name'];
    $fajl_tip = $_FILES[$nameVariable]['type'];
    $fajl_velicina = $_FILES[$nameVariable]['size'];

    $greske = [];

    $dozvoljeni_tipovi = ['image/jpg', 'image/jpeg', 'image/png'];

    if(!in_array($fajl_tip, $dozvoljeni_tipovi)){
        array_push($greske, "Pogresan tip fajla. - slika");
    }
    if($fajl_velicina > 3000000){
        array_push($greske, "Maksimalna velicina fajla je 3MB. - Profil slika");
    }


    if(count($greske) == 0){

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

        if(move_uploaded_file($fajl_tmpLokacija, '../../../'.$putanjaOriginalnaSlika)){
            
            try{
                if($buttonName=="updateImageButton"){
                    updateProductMultipleImage($putanjaNovaSlika,$putanjaOriginalnaSlika,$cover=0,$id);
                }else{
                    insertProductImage($idProduct, $putanjaNovaSlika, $putanjaOriginalnaSlika, $cover=0,$alt);
                }
            }catch(PDOException $e){
                $e->getMessage();
                upisGreskeIzBaze($e);
            }
            $_SESSION['vestIzmena_dobro']="Uspesno izmenjena vest sa slikom";
        }else{
        }


    }

}

?>