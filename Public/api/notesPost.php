<?php

$notes = new Notes($_POST);

$notes->create();

echo json_encode($notes);
