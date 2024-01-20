<?php

header('Content-Type: application/json');

require_once "../../config/connection.php";

$product = getAllParamProducts();
echo json_encode($product);
