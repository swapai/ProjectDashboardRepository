<?php
require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'sitePost.php';
  exit;
}

$siteId = intval($_GET['siteId'] ?? 0);

if ($siteId < 1) {
  throw new Exception('Invalid Site ID');
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
