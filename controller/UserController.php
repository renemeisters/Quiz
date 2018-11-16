<?php

require_once '../repository/UserRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
        $userRepository = new UserRepository();

        $view = new View('user_index');
        $view->title = 'Benutzer';
        $view->heading = 'Benutzer';
        $view->users = $userRepository->read();
        $view->display();
    }

    //öffnet Registrationsseite
    public function create()
    {
        $view = new View('user_create');
        $view->title = 'Registrieren';
        $view->heading = 'Registrieren';
        $view->display();
    }

    //erstellt repository zum Registrieren
    public function doCreate()
    {
        if ($_POST['send']) {



            $email = $_POST['email'];
            $pwd = $_POST['pwd'];
            $pwd2 = $_POST['pwd2'];



            $userRepository = new UserRepository();
          //  $view->users = $userRepository->readAll();
            $userRepository->create($email, $pwd,$pwd2);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        if(isset($_SESSION["registriert"])){
        header('Location: /user/login');
      }
    }


//öffnet Loginseite
    public function login(){
      $view = new View('user_login');
      $view->title = 'Login';
      $view->heading = 'Login';
      $view->display();
    }

// erstellt Repository fürs Login
    public function doLogin(){
        if(isset($_POST["email"]) && isset($_POST["pwd"])){



            $email = $_POST["email"];
            $pwd = $_POST["pwd"];


            $userRepository = new UserRepository();
            $userRepository->login($email,$pwd);

        }
        if(isset($_SESSION["id"])){
        header('Location: /');
      }


    }
    //logt den user aus
    public function logout(){
        session_destroy();
        session_start();
        header('Location: /');
    }

  public function toTeacher(){
        $userRepository = new UserRepository();
        $id = $_POST['id'];

        $userRepository->makeTeacher($id);
        header('Location: /user');
  }
}
