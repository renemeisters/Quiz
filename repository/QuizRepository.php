<?php


require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class QuizRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'quiz';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     *
     *
     * @param $email Wert für die Spalte email
     * @param $pwd Wert für die Spalte passwort
    * @param $pwd2 ist das Wiederholte Passwort
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
     public function createQuiz($name, $fid)
     {

       $uid = $_SESSION['id'];
       $query = "INSERT INTO $this->tableName (name, uid, fid) VALUES (?,?,?)";
       $statement = ConnectionHandler::getConnection()->prepare($query);
       $statement->bind_param('sii',$name,$uid,$fid);

       if (!$statement->execute()) {
           throw new Exception($statement->error);
       }

       return $statement->insert_id;

     }

     public function getUserQuiz(){
       $query = "SELECT * FROM $this->tableName as q JOIN fach as f on q.fid=f.fid where uid = ? ";
       $uid = $_SESSION['id'];
       $statement = ConnectionHandler::getConnection()->prepare($query);
       $statement->bind_param('i',$uid);
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


     public function getFachQuiz($fid){
       $query = "SELECT * FROM $this->tableName where fid = ?";

       $statement = ConnectionHandler::getConnection()->prepare($query);
       $statement->bind_param('i',$fid);
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

     public function getName($qid){
       $query = "SELECT * FROM $this->tableName where id = ?";

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

     public function update($qid,$name){
       $query = "UPDATE $this->tableName set name=? WHERE id=?";

       $statement = ConnectionHandler::getConnection()->prepare($query);

       $statement->bind_param('si',$name,$qid);

       if (!$statement->execute()) {
           throw new Exception($statement->error);
       }
       $_SESSION['succChangeQuiz'] = "true";
       return $statement->insert_id;

     }

     public function delete($qid){
       $query = "DELETE FROM $this->tableName where id = ?";
       $statement = ConnectionHandler::getConnection()->prepare($query);
       $mangel = 0;
       $statement->bind_param('i',$qid);

       if (!$statement->execute()) {
           throw new Exception($statement->error);
       }

       return $statement->insert_id;
     }






}
