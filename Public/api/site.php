<?php
require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'sitePost.php';
  exit;
}

// $clientId = intval($_GET['clientId'] ?? 0);
// if ($clientId >= 1) {
//   $clientArr = Client::getClientByClientId($clientId);
//   $json = json_encode($clientArr, JSON_PRETTY_PRINT);
//   // 3. Print
//   header('Content-Type: application/json');
//   echo $json;
//   exit;
// }
$sites = Site::getSiteByClientId($clientId);
$json = json_encode($sites, JSON_PRETTY_PRINT);
// 3. Print
header('Content-Type: application/json');
echo $json;
