<?php
require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'sensordeployedPost.php';
  exit;
}

$turbineDeployedId = intval($_GET['turbineDeployedId'] ?? 0);
if ($turbineDeployedId < 1) {
  throw new Exception('Invalid Turbine Deployed ID');
}

$sensorDeployed = SensorDeployed::fetchAllSensorsForTurbine($turbineDeployedId);
$json = json_encode($sensorDeployed, JSON_PRETTY_PRINT);
// 3. Print
header('Content-Type: application/json');
echo $json;
