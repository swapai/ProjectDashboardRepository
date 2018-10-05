<?php

class Client{
  public $clientId;
  public $clientName;
  public $clientDescription;
  public $gicsSector;
  public $gicsSubIndustry;
  public $headquarters;

  public function __construct($data){
    $this->clientId = isset($data['clientId']) ? intval($data['clientId']) : null;
    $this->clientName = $data['clientName'];
    $this->clientDescription = $data['clientDescription'];
    $this->gicsSector = $data['gicsSector'];
    $this->gicsSubIndustry = $data['gicsSubIndustry'];
    $this->headquarters = $data['headquarters'];
  }

  public static function fetchAll(){
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);
  // 2. Prepare the query
    $sql = 'SELECT * FROM client';
    $statement = $db->prepare($sql);
  // 3. Run the query
    $success = $statement->execute();
  // 4. Handle the results
    $arr = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      $theClient =  new Client($row);
      array_push($arr, $theClient);
    }
    return $arr;
  }

  public static function getClientByClientId(int $clientId) {
    // 1. Connect to the database
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);
    // 2. Prepare the query
    $sql = 'SELECT * FROM client WHERE clientId = ?';
    $statement = $db->prepare($sql);
    // 3. Run the query
    $success = $statement->execute(
        [$clientId]
    );
    // 4. Handle the results
    $arr = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      // 4.a. For each row, make a new work object
      $clientItem =  new Client($row);
      array_push($arr, $clientItem);
    }
      return $arr;
  }


  public function create() {
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);
    $sql = 'INSERT into client (clientName, clientDescription, gicsSector,gicsSubIndustry,headquarters)
            VALUES (?,?,?,?,?)';
    $statement = $db->prepare($sql);
    $success = $statement->execute([
      $this->clientName,
      $this->clientDescription,
      $this->gicsSector,
      $this->gicsSubIndustry,
      $this->headquarters
    ]);
    $this->clientId = $db->lastInsertId();
  }

}
