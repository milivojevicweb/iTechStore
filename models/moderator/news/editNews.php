<?php
session_start();
if(isset($_POST['submit'])){
    require_once "../../../config/connection.php";
    include "functions.php";

    $id = $_POST['idSkriveno']; 
    $naslov = $_POST['title'];
    $tekst = $_POST['text'];
    try{
        if($_FILES['imageNews']['tmp_name']!=''){


            $fajl_naziv = $_FILES['imageNews']['name'];
            $fajl_tmpLokacija = $_FILES['imageNews']['tmp_name'];
            $fajl_tip = $_FILES['imageNews']['type'];
            $fajl_velicina = $_FILES['imageNews']['size'];
        
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
        

                if(move_uploaded_file($fajl_tmpLokacija, '../../../'.$putanjaOriginalnaSlika)){
                    updateNewsWithImage($naslov,$tekst,$putanjaOriginalnaSlika,$putanjaOriginalnaSlika,$id);
                    $_SESSION['vestIzmena_dobro']="Uspesno izmenjena vest sa slikom";
                }
        
        
            }


        }else{
            updateNewsNoImage($naslov,$tekst,$id);
            $_SESSION['vestIzmena_dobro']="Uspesno izmenjena vest bez slike";
        }
        
        header("Location: ../../../index.php?page=editNews&idNews=$id");
    }catch(PDOException $greska){
          echo $greska;
          $_SESSION['vestIzmena_lose']="Vest nije izmenjena";
          upisGreskeIzBaze($greska);
    }
  }