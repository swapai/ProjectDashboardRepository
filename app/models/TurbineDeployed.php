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
            $turbineDeployedItem =  new TurbineDeployed($row);
            array_push($arr, $turbineDeployedItem);
          }
            return $arr;
        }


  }
