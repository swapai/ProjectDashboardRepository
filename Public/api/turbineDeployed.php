<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'turbineDeployedPost.php';
  exit;
}

//$Id = intval($_GET['id'] ?? 0);

//if ($Id < 1) {
  //throw new Exception('Invalid ID');
//}


// 1. Go to the database and get all work associated with the $taskId
$turbineDeployedArr = TurbineDeployed::getTurbineDeployed();
// 2. Convert to JSON
$json = json_encode($turbineDeployedArr, JSON_PRETTY_PRINT);
// 3. Print
header('Content-Type: application/json');
echo $json;
