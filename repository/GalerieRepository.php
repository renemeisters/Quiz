<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class GalerieRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'galerie';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     *
     *
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
     public function read($public)
      {
          if(isset($_SESSION['id'])){
            $uid = $_SESSION['id'];
          }

          $query = "SELECT * FROM $this->tableName where uid = ? AND freigabe = ?";
          $statement = ConnectionHandler::getConnection()->prepare($query);
          $statement->bind_param('ii',$uid,$public);
          $statement->execute();

          $result = $statement->get_result();
          if (!$result) {
              throw new Exception($statement->error);
          }

          // Datensätze aus dem Resultat holen und in das Array $rows speichern
          $rows = array();
          while ($row = $result->fetch_object()) {
              $rows[] = $row;
          }
          $statement->close();
          return $rows;
      }

      public function readAllPublic(){

        $query = "SELECT * FROM $this->tableName WHERE freigabe = 1";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }
        $statement->close();
        return $rows;
      }

      public function create($name,$description,$isChecked){
        $uid = $_SESSION['id'];
        unset($_SESSION['GalerieName']);

        $query = "SELECT * FROM $this->tableName WHERE name = ?";
         $statement = ConnectionHandler::getConnection()->prepare($query);
         $statement->bind_param('s',$name);

         if (!$statement->execute()) {
             $_SESSION['statement'] = "Statement nicht ausgeführt";
             throw new Exception($statement->error);
         }

           $result = $statement->get_result();


           $check = $result->num_rows;

         if($check > 0){
           //fehlermeldung
           $_SESSION['GalerieName'] = "Galerie bereits vorhanden";
           header('Location: /galerie/create');
       }
        //var_dump(ConnectionHandler::getConnection()->prepare($query));die;
        $query = "INSERT INTO $this->tableName (name,beschreibung,freigabe,uid) VALUES (?,?,?,?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);

      $statement->bind_param('ssii',$name,$description,$isChecked,$uid);

        if (!$statement->execute()) {
            throw new Exception($statement->error);

        }
             header('Location: /galerie/index');




      }

      public function setPublic($id){

        $query = "UPDATE $this->tableName set freigabe = 1 where id = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i',$id);


        if (!$statement->execute()) {
            throw new Exception($statement->error);

        }
             header('Location: /galerie/index');

      }

      public function doUpdate($id,$name,$description){
        unset($_SESSION['GalerieName']);


                $query = "SELECT * FROM $this->tableName WHERE name = ?";
                 $statement = ConnectionHandler::getConnection()->prepare($query);
                 $statement->bind_param('s',$name);

                 if (!$statement->execute()) {
                     $_SESSION['statement'] = "Statement nicht ausgeführt";
                     throw new Exception($statement->error);
                 }

                   $result = $statement->get_result();


                   $check = $result->num_rows;





                 if($check > 0){
                   //fehlermeldung
                   $_SESSION['GalerieName'] = "Galerie bereits vorhanden";
                   header('Location: /galerie/showGalerie');
               }



        $query = "UPDATE $this->tableName set name = ?, beschreibung = ?  where id = ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssi',$name,$description,$id);


        if (!$statement->execute()) {
            throw new Exception($statement->error);

        }
             header('Location: /');


      }

}
