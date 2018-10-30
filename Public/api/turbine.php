<?php

require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'turbinePost.php';
  exit;
}


$turbineArr = Turbine::getTurbine();

$json = json_encode($turbineArr, JSON_PRETTY_PRINT);

header('Content-Type: application/json');
echo $json;
