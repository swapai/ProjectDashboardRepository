<?php
require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'clientPost.php';
  exit;
}

$clients = Client::fetchAll();
$json = json_encode($clients, JSON_PRETTY_PRINT);
// 3. Print
header('Content-Type: application/json');
echo $json;
