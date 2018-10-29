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
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'note';

    public function setMark($qid,$note,$uid){
      $query = "INSERT INTO $this->tableName (note, uid, qid) VALUES (?,?,?)";
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('dii',$note,$uid,$qid);

      if (!$statement->execute()) {
          throw new Exception($statement->error);
      }

      return $statement->insert_id;

    }

}
