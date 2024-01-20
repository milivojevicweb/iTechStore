<?php

function getContakt(){
    return executeQuery("SELECT idContact,name,email,text,phone,status FROM contact ORDER BY idContact DESC LIMIT 6");
}

function getAuthor(){
   return executeQueryOneRow("SELECT idAuthor,nameLastName,text from author");
}

function contactNumber(){
    return rowCount("SELECT COUNT(idContact) from contact group by idContact");
}
function korisniciUloge(){
    return executeQuery("SELECT k.idUser, k.name as firstName,k.lastName,k.email,u.name,idCountry FROM user k INNER JOIN role u ON k.idRole = u.idRole ORDER BY k.idRole ASC LIMIT 6");
}
function role(){
    return executeQuery("SELECT idRole,name FROM role");
}

function statistikaFajl($naziv){
    $open=fopen(LOG_FAJL, "r");
    $file=file(LOG_FAJL);
    $niz1="";
    $niz2=[];
    foreach ($file as $key => $value){
        $ex=explode(SEPARTOR,$value);
        if(isset($ex[2]) && $ex[3]){
        if($ex[2]==date("Y/m/d")){
            $niz1.=$ex[3];
            $rez=substr_count($niz1,$naziv);
            $brojReci=str_word_count($niz1);
            $rezultat=round(($rez/$brojReci)*100);
        }
    }}?>
    <div class="rez">
        <div class="skills html" style="width:<?php echo $rezultat;?>%;"><div><?php echo $rezultat;?>%</div></div>
    </div><?php

}
function country(){
    return executeQuery("SELECT idCountry, name AS countryName FROM country");
}


function accessAllowAdmin(){
    if(!isset($_SESSION['korisnik'])){
        $_SESSION['greska'] = "NISTE ULOGOVANI!";
        header("Location: index.php");
    }
    if($_SESSION['korisnik']->idRole != 1 && $_SESSION['korisnik']->idRole != 4){
        $_SESSION['greska'] = "NISTE ADMIN!";
        header("Location: index.php");
    }
}
