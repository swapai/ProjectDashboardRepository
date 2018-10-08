<?php
require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'sensortimeseriesPost.php';
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
$sensortimeseries = SensorTimeSeries::fetchAll();
$json = json_encode($sensortimeseries, JSON_PRETTY_PRINT);
// 3. Print
header('Content-Type: application/json');
echo $json;
