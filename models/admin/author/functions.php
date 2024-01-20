<?php

function editAuthor($name,$text,$id){
    return uidPrepared("UPDATE author SET nameLastName = ?, text = ? WHERE idAuthor = ?",[$name,$text,$id]);
}