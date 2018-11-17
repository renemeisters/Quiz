<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class NotenRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repossitory verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'noten';

    public function setMark($qid,$note,$uid){
      $query = "INSERT INTO $this->tableName (note, uid, qid) VALUES (?,?,?)";
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('dii',$note,$uid,$qid);

      if (!$statement->execute()) {
          throw new Exception($statement->error);
      }

      return $statement->insert_id;

    }



    public function getUserMarks($qid){
      $query = "SELECT MAX(note) as note FROM $this->tableName where uid = ? and qid = ?";
      $uid = $_SESSION['id'];
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('ii',$uid,$qid);
      $statement->execute();

      $result = $statement->get_result();

      if (!$result) {
          throw new Exception($statement->error);
      }
      $rows = array();
      while ($row = $result->fetch_object()) {
          $rows[] = $row;
      }
      $statement->close();
      return $rows;

    }

}
