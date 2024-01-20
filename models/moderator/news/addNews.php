<?php
session_start();
ob_start();
if(isset($_POST['dodajVest'])){
    
    require_once "../../../config/connection.php";
    include "functions.php";

    $fajl_naziv = $_FILES['slikaVest']['name'];
    $fajl_tmpLokacija = $_FILES['slikaVest']['tmp_name'];
    $fajl_tip = $_FILES['slikaVest']['type'];
    $fajl_velicina = $_FILES['slikaVest']['size'];

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

        $novaSirina = 300;
        $novaVisina = ($novaSirina/$sirina) * $visina; // novaVisina : visina = novaSirina : sirina

        $novaSlika = imagecreatetruecolor($novaSirina, $novaVisina);

        imagecopyresampled($novaSlika, $postojecaSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);

        $naziv = time().$fajl_naziv;
        $putanjaNovaSlika = 'assets/images/users/nova_'.$naziv;

        switch($fajl_tip){
            case 'image/jpeg':
                imagejpeg($novaSlika, '../../../'.$putanjaNovaSlika, 75);
                break;
            case 'image/png':
                imagepng($novaSlika, '../../../'.$putanjaNovaSlika);
                break;
        }

        $putanjaOriginalnaSlika = 'assets/images/users/'.$naziv;

        $datum=date("Y/m/d");
        $naslov=$_POST['title'];
        $tekst=$_POST['tekstUpis'];
        if(move_uploaded_file($fajl_tmpLokacija, '../../../'.$putanjaOriginalnaSlika)){
            echo "Slika je upload-ovana na server!";

            try {


                $rezultat = insertNews($naslov,$tekst,$datum,$putanjaOriginalnaSlika,$putanjaNovaSlika,$_SESSION['korisnik_id']);

                if($rezultat){
                    $_SESSION['vesti_dobro']="Vest je dodata";
                    // header("Location: ../../index.php?page=moderator&p=dodajVest");
                }else{
                    $_SESSION['vesti_greska']="Nije dodata vest";
                }
                
            }catch(\PDOException $ex){
                echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
                http_response_code(500);
                upisGreskeIzBaze($ex);
            }
            
        }

        imagedestroy($postojecaSlika);
        imagedestroy($novaSlika);
        \header("Location: ../../../index.php?page=moderator");
    } else {
        $_SESSION['vesti_greska']=$greske;
        \header("Location: ../../../index.php?page=moderator");
    }
}
?>