<?php
require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'sensortimeseriesPost.php';
  exit;
}
$sensorDeployedId = intval($_GET['sensorDeployedId'] ?? 0);
if ($sensorDeployedId < 1) {
  throw new Exception('Invalid Sensor Deployed ID');
}
$kpiList = SensorTimeSeries::getSensorTimeSeriesBySensorDeployedId($sensorDeployedId);
$json = json_encode($kpiList, JSON_PRETTY_PRINT);
// 3. Print
header('Content-Type: application/json');
echo $json;
