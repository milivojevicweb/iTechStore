<?php
require_once "../../../config/connection.php";
include "functions.php";

header('Content-Type: application/json');

try {
    $contact = getAllContact();
    \http_response_code(200);

}
catch(PDOException $ex){
    echo json_encode(['error'=> 'Database error: ' . $ex->getMessage()]);
    \http_response_code(500);
    upisGreskeIzBaze($ex);
}

echo json_encode($contact);
