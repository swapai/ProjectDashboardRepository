<?php

class TurbineDeployed
{
  public $turbineDeployedId;
  public $turbineId;
  public $siteId;
  public $serialNumber;
  public $deployedDate;
  public $totalFiredHours;
  public $totalStarts;
  public $lastPlannedOutageDate;
  public $lastUnplannedOutageDate;
  public $turbineName;
  public $turbineDescription;
  public $capacity;
  public $rampUpTime;
  public $maintenanceInterval;



  public function __construct($row) {
    $this->turbineDeployedId = isset($row['turbineDeployedId']) ? intval($row['turbineDeployedId']) : null;
    $this->turbineId = $row['turbineId'];
    $this->siteId = $row['siteId'];
    $this->serialNumber = $row['serialNumber'];
    $this->deployedDate = $row['deployedDate'];
    $this->totalFiredHours = $row['totalFiredHours'];
    $this->totalStarts = $row['totalStarts'];
    $this->lastPlannedOutageDate = $row['lastPlannedOutageDate'];
    $this->lastUnplannedOutageDate = $row['lastUnplannedOutageDate'];
    $this->turbineName = $row['turbineName'];
    $this->turbineDescription = $row['turbineDescription'];
    $this->capacity = intval($row['capacity']);
    $this->rampUpTime = intval ($row['rampUpTime']);
    $this->maintenanceInterval = intval ($row['maintenanceInterval']);
    }

    // public static function getTurbineDeployed() {
    //   // 1. Connect to the database
    //   $db = new PDO(DB_SERVER, DB_USER, DB_PW);
    //
    //   // 2. Prepare the query
    //   $sql = 'SELECT * FROM turbineDeployed';
    //   $statement = $db->prepare($sql);
    //
    //   // 3. Run the query
    //   $success = $statement->execute();
    //
    //   // 4. Handle the results
    //   $arr = [];
    //   while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    //     $theTurbineDeployed =  new TurbineDeployed($row);
    //     array_push($arr, $theTurbineDeployed);
    //   }
    //   return $arr;
    //   }
    //
    // public function create() {
    //   $db = new PDO(DB_SERVER, DB_USER, DB_PW);
    //   $sql = 'INSERT TurbineDeployed (turbineId, siteId, serialNumber, deployedDate, totalFiredHours, totalStarts, lastPlannedOutageDate, lastUnplannedOutageDate)
    //         VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    //   $statement = $db->prepare($sql);
    //   $success = $statement->execute([
    //         $this->turbineId,
    //         $this->siteId,
    //         $this->serialNumber,
    //         $this->deployedDate,
    //         $this->totalFiredHours,
    //         $this->totalStarts,
    //         $this->lastPlannedOutageDate,
    //         $this->lastUnplannedOutageDate
    //       ]);
    //
    //       $this->turbineDeployedId = $db->lastInsertId();
    //     }
    //
    //     public static function getTurbineDeployedByTurbineDeployedId(int $turbineDeployedId) {
    //       // 1. Connect to the database
    //       $db = new PDO(DB_SERVER, DB_USER, DB_PW);
    //       // 2. Prepare the query
    //       $sql = 'SELECT * FROM turbineDeployed WHERE turbineDeployedId = ?';
    //       $statement = $db->prepare($sql);
    //       // 3. Run the query
    //       $success = $statement->execute(
    //           [$turbineDeployedId]
    //       );
    //       // 4. Handle the results
    //       $arr = [];
    //       while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    //         // 4.a. For each row, make a new work object
    //         $turbineDeployedItem =  new TurbineDeployed($row);
    //         array_push($arr, $turbinDeployedeItem);
    //       }
    //         return $arr;
    //     }

        public static function getFullTurbineInformationFromSiteId( int $siteId){
          $db = new PDO(DB_SERVER, DB_USER, DB_PW);
          // 2. Prepare the query
          $sql = 'SELECT turbine.turbineId, turbineDeployedId, siteId, serialNumber, deployedDate, totalFiredHours, totalStarts, lastPlannedOutageDate, lastUnplannedOutageDate, turbineName, turbineDescription, capacity, rampUpTime, maintenanceInterval FROM  turbine INNER JOIN turbineDeployed ON turbine.turbineId = turbineDeployed.turbineId WHERE siteId= ?';
          $statement = $db->prepare($sql);
          // 3. Run the query
          $success = $statement->execute(
              [$siteId]
          );
          // 4. Handle the results
          $arr = [];
          while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            // 4.a. For each row, make a new work object
            $turbineDeployedItem =  new TurbineDeployed($row);
            array_push($arr, $turbinDeployedeItem);
          }
            return $arr;
        }


  }
