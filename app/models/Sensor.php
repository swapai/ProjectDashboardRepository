<?php

class Sensor
{
  public $sensorId;
  public $sensorName;
  public $sensorDescription;
  public $primaryContact;
  public $manufacturer;
  public $totalLifeExpentancyHours;


  public function __construct($row) {
    $this->sensorId = isset($row['sensorId']) ? intval($row['sensorId']) : null;
    $this->sensorName = $row['sensorName'];
    $this->sensorDescription = $row['sensorDescription'];
    $this->primaryContact = $row['primaryContact'];
    $this->manufacturer = $row['manufacturer'];
    $this->totalLifeExpentancyHours = $row['totalLifeExpectancyHours'];
    }

    public static function fetchAll() {
      // 1. Connect to the database
      $db = new PDO(DB_SERVER, DB_USER, DB_PW);

      // 2. Prepare the query
      $sql = 'SELECT * FROM sensor';
      $statement = $db->prepare($sql);

      // 3. Run the query
      $success = $statement->execute();

      // 4. Handle the results
      $arr = [];
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $theSensor =  new Sensor($row);
        array_push($arr, $theSensor);
      }
      return $arr;
      }

    public function create() {
      $db = new PDO(DB_SERVER, DB_USER, DB_PW);
      $sql = 'INSERT into sensor (sensorName, sensorDescription, primaryContact, manufacturer, totalLifeExpentancyHours)
            VALUES (?, ?, ?, ?, ?)';
      $statement = $db->prepare($sql);
      $success = $statement->execute([
            $this->sensorName,
            $this->sensorDescription,
            $this->primaryContact,
            $this->manufacturer,
            $this->totalLifeExpentancyHours,
          ]);

          $this->sensorId = $db->lastInsertId();
        }

        public static function getSensorBySensorId(int $sensorId) {
          // 1. Connect to the database
          $db = new PDO(DB_SERVER, DB_USER, DB_PW);
          // 2. Prepare the query
          $sql = 'SELECT * FROM sensor WHERE sensorId = ?';
          $statement = $db->prepare($sql);
          // 3. Run the query
          $success = $statement->execute(
              [$sensorId]
          );
          // 4. Handle the results
          $arr = [];
          while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            // 4.a. For each row, make a new work object
            $sensorItem =  new Sensor($row);
            array_push($arr, $sensorItem);
          }
            return $arr;
        }


  }
