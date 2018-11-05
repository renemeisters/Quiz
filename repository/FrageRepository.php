<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class FrageRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'frage';



    public function addQuestion($question,$a,$b,$c,$d,$answer,$qid){
     // var_dump($question,$a,$b,$c,$d,$answer,$qid);die;
      $query = "INSERT INTO $this->tableName (frage,a,b,c,d,antwort,qid,hatMangel) VALUES (?,?,?,?,?,?,?,?)";
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $mangel = 0;
      $statement->bind_param('ssssssii',$question,$a,$b,$c,$d,$answer,$qid,$mangel);

      if (!$statement->execute()) {
          throw new Exception($statement->error);
      }

      return $statement->insert_id;
    }

    public function getQuestionsByID($qid){
      $query = "SELECT * FROM $this->tableName where qid = ?";

      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('i',$qid);
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

    public function countQuestionsByID($qid){
      $query = "SELECT COUNT(frage) as numbers FROM $this->tableName where qid = ?";
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('i',$qid);
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

    public function updateQuestions($fid,$frage,$a,$b,$c,$d,$answer,$qid){
      $query = "UPDATE $this->tableName set frage=?,a=?,b=?,c=?,d=?,antwort=?,qid=?,hatMangel=? WHERE id = ?";
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $mangel = 0;
      $statement->bind_param('ssssssiii',$frage,$a,$b,$c,$d,$answer,$qid,$mangel,$fid);

      if (!$statement->execute()) {
          throw new Exception($statement->error);
      }

      return $statement->insert_id;

    }


    public function delete($fid){
      $query = "DELETE FROM $this->tableName where id = ?";
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $mangel = 0;
      $statement->bind_param('i',$fid);

      if (!$statement->execute()) {
          throw new Exception($statement->error);
      }

      return $statement->insert_id;
    }

    public function setMangel($fid){
      $query = "UPDATE $this->tableName set hatMangel=? WHERE id = ?";
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $mangel = 1;
      $statement->bind_param('ii',$mangel,$fid);

      if (!$statement->execute()) {
          throw new Exception($statement->error);
      }

      return $statement->insert_id;
    }


    public function getFragenWithMangel(){
      $query = "SELECT * FROM $this->tableName where hatMangel = ?";
      $mangel = 1;
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('i',$mangel);
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
