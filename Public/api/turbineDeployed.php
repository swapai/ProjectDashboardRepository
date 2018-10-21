<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'turbineDeployedPost.php';
  exit;
}

$siteId = intval($_GET['siteId'] ?? 0);
if ($siteId < 1) {
  throw new Exception('Invalid Client ID');
}


// 1. Go to the database and get all work associated with the $taskId
$turbineDeployedArr = TurbineDeployed::getFullTurbineInformationFromSiteId($siteId);
// 2. Convert to JSON
$json = json_encode($turbineDeployedArr, JSON_PRETTY_PRINT);
// 3. Print
header('Content-Type: application/json');
echo $json;
