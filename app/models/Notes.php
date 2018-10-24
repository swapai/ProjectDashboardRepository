<?php

class Notes{
  public $notesId;
  public $clientId;
  public $clientName;
  public $notes;


  public function __construct($data){
    $this->notesId = isset($data['notesId']) ? intval($data['notesId']) : null;
    $this->clientId = $data['clientId'];
    $this->clientName = $data['clientName'];
    $this->notes = $data['notes'];
  }

  public static function fetchAll(){
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);
  // 2. Prepare the query
    $sql = 'SELECT * FROM notes';
    $statement = $db->prepare($sql);
  // 3. Run the query
    $success = $statement->execute();
  // 4. Handle the results
    $arr = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      $theNotes =  new Notes($row);
      array_push($arr, $theNotes);
    }
    return $arr;
  }

  public static function getNotesByClientsId(int $clientId) {
    // 1. Connect to the database
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);
    // 2. Prepare the query
    $sql = 'SELECT * FROM notes WHERE clientId = ?';
    $statement = $db->prepare($sql);
    // 3. Run the query
    $success = $statement->execute(
        [$clientId]
    );
    // 4. Handle the results
    $arr = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      // 4.a. For each row, make a new work object
      $notesItem =  new Notes($row);
      array_push($arr, $notesItem);
    }
      return $arr;
  }


  public function create() {
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);
    $sql = 'INSERT into notes (clientId, clientName, notes)
            VALUES (?,?,?)';
    $statement = $db->prepare($sql);
    $success = $statement->execute([
      $this->clientId,
      $this->clientName,
      $this->notes
    ]);
    $this->notesId = $db->lastInsertId();
  }

}
