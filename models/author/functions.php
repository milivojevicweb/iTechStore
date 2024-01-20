<?php
function author(){
    $rez=executeQueryOneRow("SELECT text,nameLastName from author");
    return $rez;
}