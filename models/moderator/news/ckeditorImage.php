<?php

if(isset($_FILES['upload']['name']))
{


    $fajl_naziv = $_FILES['upload']['name'];
    $fajl_tmpLokacija = $_FILES['upload']['tmp_name'];
    $fajl_tip = $_FILES['upload']['type'];
    $fajl_velicina = $_FILES['upload']['size'];

    $greske = [];

    $dozvoljeni_tipovi = ['image/jpg', 'image/jpeg', 'image/png'];

    if(!in_array($fajl_tip, $dozvoljeni_tipovi)){
        array_push($greske, "Pogresan tip fajla. - slika");
    }
    if($fajl_velicina > 3000000){
        array_push($greske, "Maksimalna velicina fajla je 3MB. - Profil slika");
    }


    if(count($greske) == 0){


        $naziv = time().$fajl_naziv;
        $putanjaNovaSlika = 'assets/images/users/nova_'.$naziv;

        

        $putanjaOriginalnaSlika = 'assets/images/users/'.$naziv;

        $datum=date("Y/m/d");
        $naslov=$_POST['title'];
        $tekst=$_POST['tekstUpis'];
        if(move_uploaded_file($fajl_tmpLokacija, '../../../'.$putanjaOriginalnaSlika)){
            $function_number = $_GET['CKEditorFuncNum'];
            $url = 'assets/images/users/'.$naziv;
            $message = '';
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
        }


    }
}

?>