<?php
require '../../app/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'notesPost.php';
  exit;
}
$clientId = intval($_GET['clientId'] ?? 0);
if ($clientId < 1) {
  throw new Exception('Invalid Client ID');
}


$notes = Notes::getNotesByClientsId($clientId);
$json = json_encode($notes, JSON_PRETTY_PRINT);
// 3. Print
header('Content-Type: application/json');
echo $json;
