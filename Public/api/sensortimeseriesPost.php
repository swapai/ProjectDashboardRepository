<?php

$sensortimeseries = new SensorTimeSeries($_POST);

$sensortimeseries->create();

echo json_encode($sensortimeseries);
