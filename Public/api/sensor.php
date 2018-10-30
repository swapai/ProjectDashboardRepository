<?php
require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'sensorPost.php';
  exit;
}

$sensors = Sensor::fetchAll();
$json = json_encode($sensors, JSON_PRETTY_PRINT);
// 3. Print
header('Content-Type: application/json');
echo $json;
