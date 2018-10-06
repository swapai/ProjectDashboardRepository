<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'turbinePost.php';
  exit;
}

//$Id = intval($_GET['id'] ?? 0);

//if ($Id < 1) {
  //throw new Exception('Invalid ID');
//}


// 1. Go to the database and get all work associated with the $taskId
$turbineArr = Turbine::getTurbine();
$turbineItem = Turbine::getTurbineByTurbineId();
// 2. Convert to JSON
$json = json_encode($turbineArr, JSON_PRETTY_PRINT);
$json = json_encode($turbineItem, JSON_PRETTY_PRINT);
// 3. Print
header('Content-Type: application/json');
echo $json;
