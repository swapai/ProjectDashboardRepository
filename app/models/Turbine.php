<?php

class Turbine
{
  public $turbineId;
  public $turbineName;
  public $turbineDescription;
  public $capacity;
  public $ramupTime;
  public $maintenanceInterval;

  public function __construct($row) {
    $this->turbineId = isset($row['turbineId']) ? intval($row['turbineId']) : null;
    $this->turbineName = $row['turbineName'];
    $this->turbineDescription = $row['turbineDescription'];
    $this->capacity = intval($row['capacity']);
    $this->ramupTime = intval ($row['ramupTime']);
    $this->maintenanceInterval = intval ($row['maintenanceInterval']);
    }

    public static function getTurbine() {
      // 1. Connect to the database
      $db = new PDO(DB_SERVER, DB_USER, DB_PW);

      // 2. Prepare the query
      $sql = 'SELECT * FROM turbine';
      $statement = $db->prepare($sql);

      // 3. Run the query
      $success = $statement->execute();

      // 4. Handle the results
      $arr = [];
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $theTurbine =  new Turbine($row);
        array_push($arr, $theTurbine);
      }
      return $arr;
      }

    public function create() {
      $db = new PDO(DB_SERVER, DB_USER, DB_PW);
      $sql = 'INSERT into turbine (turbineName, turbineDescription, capacity, rampUpTime, maintenanceInterval)
            VALUES (?, ?, ?, ?, ?)';
      $statement = $db->prepare($sql);
      $success = $statement->execute([
            $this->turbineName,
            $this->turbineDescription,
            $this->capacity,
            $this->ramupTime,
            $this->maintenanceInterval
          ]);

          $this->turbineId = $db->lastInsertId();
        }

        public static function getTurbineByTurbineId(int $turbineId) {
          // 1. Connect to the database
          $db = new PDO(DB_SERVER, DB_USER, DB_PW);
          // 2. Prepare the query
          $sql = 'SELECT * FROM turbine WHERE turbineId = ?';
          $statement = $db->prepare($sql);
          // 3. Run the query
          $success = $statement->execute(
              [$turbineId]
          );
          // 4. Handle the results
          $arr = [];
          while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            // 4.a. For each row, make a new work object
            $turbineItem =  new Turbine($row);
            array_push($arr, $turbineItem);
          }
            return $arr;
        }


  }
