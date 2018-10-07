<?php

class SensorDeployed
{
  public $sensorDeployedId;
  public $sensorId;
  public $turbineDeployedId;
  public $serialNumber;
  public $deployedDate;


  public function __construct($row) {
    $this->sensorDeployedId = isset($row['sensorDeployedId']) ? intval($row['sensorDeployedId']) : null;
    $this->sensorId = $row['sensorId'];
    $this->turbineDeployedId = $row['turbineDeployedId'];
    $this->serialNumber = $row['serialNumber'];
    $this->deployedDate = $row['deployedDate'];
    }

    public static function fetchAll() {
      // 1. Connect to the database
      $db = new PDO(DB_SERVER, DB_USER, DB_PW);

      // 2. Prepare the query
      $sql = 'SELECT * FROM sensorDeployed';
      $statement = $db->prepare($sql);

      // 3. Run the query
      $success = $statement->execute();

      // 4. Handle the results
      $arr = [];
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $theSensorDeployed =  new SensorDeployed($row);
        array_push($arr, $theSensorDeployed);
      }
      return $arr;
      }

    public function create() {
      $db = new PDO(DB_SERVER, DB_USER, DB_PW);
      $sql = 'INSERT into sensorDeployed (sensorId, turbineDeployedId, serialNumber, deployedDate)
            VALUES (?, ?, ?, ?)';
      $statement = $db->prepare($sql);
      $success = $statement->execute([
            $this->sensorId,
            $this->turbineDeployedId,
            $this->serialNumber,
            $this->deployedDate,
          ]);

          $this->sensorDeployedId = $db->lastInsertId();
        }

        public static function getSensorDeployedBySensorDeployedId(int $sensorDeployedId) {
          // 1. Connect to the database
          $db = new PDO(DB_SERVER, DB_USER, DB_PW);
          // 2. Prepare the query
          $sql = 'SELECT * FROM sensorDeployed WHERE sensorDeployedId = ?';
          $statement = $db->prepare($sql);
          // 3. Run the query
          $success = $statement->execute(
              [$sensorDeployedId]
          );
          // 4. Handle the results
          $arr = [];
          while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            // 4.a. For each row, make a new work object
            $sensorDeployedItem =  new SensorDeployed($row);
            array_push($arr, $sensorDeployedItem);
          }
            return $arr;
        }


  }
