<?php

class Turbine
{
  public $turbineId;
  public $turbineName;
  public $turbineDescription;
  public $turbineContact;
  public $capacity;
  public $ramupTime;
  public $maintenanceInterval;

  public function __construct($row) {
    $this->turbineId = isset($row['turbineId']) ? intval($row['turbineId']) : null;
    $this->turbineName = $row['turbineName'];
    $this->turbineDescription = $row['turbineDescription'];
    $this->turbineContact = $row['turbineContact'];
    $this->capacity = $row['capacity'];
    $this->ramupTime = $row['ramupTime'];
    $this->maintenanceInterval = $row['maintenanceInterval'];

  public function create() {
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);

    $sql = 'INSERT Turbine (turbineName, turbineDescription, turbineContact, capacity, rampUpTime, maintenanceInterval)
            VALUES (?, ?, ?, ?, ?, ?)';

    $statement = $db->prepare($sql);
    $success = $statement->execute([
      $this->turbineName,
      $this->turbineDescription,
      $this->turbineContact,
      $this->capacity,
      $this->ramupTime,
      $this->maintenanceInterval
    ]);

    $this->turbineId = $db->lastInsertId();
  }

  public static function fectchAll() {
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
      // 4.a. For each row, make a new turbine object
      $theTurbine =  new Turbine($row);

      array_push($arr, $theTurbine);
    }

    // 4.b. return the array of turbine objects

    return $arr;
  }
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
    // 4.a. For each row, make a new turbine object
    $turbineItem =  new Turbine($row);
    array_push($arr, $turbineItem);
  }
    return $arr;
}
