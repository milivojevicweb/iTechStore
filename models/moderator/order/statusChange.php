<?php
session_start();
if(isset($_POST['id']) && isset($_POST['value'])){
    require_once "../../../config/connection.php";
    include "functions.php";
    
    $id = $_POST['id']; 
    $value = $_POST['value'];
    try{
        changeStatus($value,$id);
    }catch(\PDOException $ex){
        echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
        \http_response_code(500);
        upisGreskeIzBaze($ex);
    }
    
  }