<?php

define("BASE_URL", "http://localhost/sajt_diplomski");
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/sajt_diplomski");

define("ENV_FAJL", ABSOLUTE_PATH."/config/.env");
define("LOG_FAJL", ABSOLUTE_PATH."/data/log.txt");
define("GRESKEBAZA", ABSOLUTE_PATH."/data/errorsData.txt");
define("ERROR", ABSOLUTE_PATH."/data/errors.txt");
define("INIT", ABSOLUTE_PATH."/assets/stripe-php-7.5.0/init.php");
define("SEPARTOR", "\t");

define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));




function env($naziv){
    $open = fopen(ENV_FAJL, "r");
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach($podaci as $key=>$value){
        $konfig = explode("=", $value);
        if($konfig[0]==$naziv){
            $vrednost = trim($konfig[1]);
        }
    }
    return $vrednost;
    fclose($open);
}
