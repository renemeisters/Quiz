<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'users';

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
     public $error = "";
    public function create($email, $pwd,$pwd2)
    {
      $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
      $pwd = htmlspecialchars($pwd, ENT_QUOTES, 'UTF-8');
      $pwd2 = htmlspecialchars($pwd2, ENT_QUOTES, 'UTF-8');


      session_destroy();
      session_start();

      if($email == NULL ||$pwd == NULL|| $pwd2 == NULL){
        $_SESSION['filled'] = "true";
        header('Location: /user/create');
        return $statement->insert_id;
      }


      $query = "SELECT * FROM $this->tableName WHERE email = ?";
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('s',$email);

      if (!$statement->execute()) {
          $_SESSION['statement'] = "Statement nicht ausgeführt";
          throw new Exception($statement->error);
      }
      else{

        $result = $statement->get_result();


        $check = $result->num_rows;
        if($pwd !== $pwd2){
            $_SESSION['samePassword'] = "true";
            header('Location: /user/create');
            return $statement->insert_id;

        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $_SESSION['unvalidEmail'] = "Email bereits vorhanden";
          header('Location: /user/create');
          return $statement->insert_id;
        }
        // "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?])[A-Za-z\d$@$!%*?]{8,}"





      if($check > 0){
        //fehlermeldung
        $_SESSION['email'] = "Email bereits vorhanden";
          header('Location: /user/create');
      } else{

        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?])[A-Za-z\d$@$!%*?]{8,}/", $pwd)){

            $_SESSION['unvalidPasswort'] = "true";
            header('Location: /user/create');
            return $statement->insert_id;
        }


        $password = password_hash($pwd, PASSWORD_DEFAULT);

        $query = "INSERT INTO $this->tableName (email, pwd,isTeacher) VALUES (?, ?,?)";
        $test = 0;
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssi',$email, $password,$test);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $_SESSION["registriert"] = "true";
        return $statement->insert_id;
      }
    }
  }







//logt user ein
    public function login($email,$pwd){

      session_destroy();
      session_start();

      $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
      $pwd = htmlspecialchars($pwd, ENT_QUOTES, 'UTF-8');


      $query = "SELECT * FROM $this->tableName WHERE email = ?";
      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('s',$email);

      if (!$statement->execute()) {
          $_SESSION['statement'] = "Statement nicht ausgeführt";
          throw new Exception($statement->error);
      }
      else{

        $result = $statement->get_result();


        $check = $result->num_rows;





      if($check == 0){
        //fehlermeldung
        $_SESSION['emailNotRegistered'] = "Email nicht vorhanden";
        header('Location: /user/login');
        return $statement->insert_id;
      } else{
                $user = $result->fetch_object();



              $hashedPwdCheck = password_verify($pwd,/*row*/ $user->pwd);
                if(!$hashedPwdCheck){
                  //fehlermeldung
                  $error = "Passwort nicht varified";
                        $_SESSION['passwordVarified'] = "true";
                        header('Location: /user/login');
                        return $statement->insert_id;
                }
                else{
                    $_SESSION['isTeacher'] = $user->isTeacher;
                  $_SESSION['id'] = $user->id;

                $_SESSION['worked'] = "eingeloggt";

                        return $statement->insert_id;
            }



      }
    }




    }



    public function read()
     {


         $query = "SELECT * FROM $this->tableName where isTeacher = ?";
         $number = 0;
         $statement = ConnectionHandler::getConnection()->prepare($query);
         $statement->bind_param('i',$number);
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





    public function makeTeacher($id)
    {

      $query = "UPDATE $this->tableName set isTeacher = 1 WHERE id = ?";

      $statement = ConnectionHandler::getConnection()->prepare($query);
      $statement->bind_param('i', $id);
      $statement->execute();
            return $statement->insert_id;


    }





}
