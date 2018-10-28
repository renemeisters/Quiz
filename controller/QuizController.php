<?php

require_once '../repository/QuizRepository.php';
require_once '../repository/FachRepository.php';
require_once '../repository/FrageRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class QuizController
{

  public function index(){
    $view = new View('quiz_fach');

    $view->title = 'Fach auswählen';
    $view->heading = 'Fach auswählen';
    $view->display();
  }

  public function create()
  {
    $view = new View('quiz_create');

    $view->title = 'Quiz erstellen';
    $view->heading = 'Quiz erstellen';
    $view->display();

  }

  public function doCreate(){
    if(!isset($_POST['quizName']) || !isset($_POST['fach'])){
      $_SESSION['fehler'] = "true";
      header('Location: /quiz/create');
    }else
    {
      $name = $_POST['quizName'];
      $fach = $_POST['fach'];
      $fachRepository = new FachRepository();
      $fachid = $fachRepository->checkID($fach);
      foreach ($fachid as $fachi) {
        $fid = $fachi->fid;
      }

      $quizRepository = new QuizRepository();
      $quizRepository->createQuiz($name, $fid);
      header('Location: /quiz/user');
      }
  }

  public function user(){
    $view = new View('quiz_user');
    $quizRepository = new QuizRepository();
    $view->quizze = $quizRepository->getUserQuiz();
    $view->title = 'Meine Quizze';
    $view->heading = 'Meine Quizze';
    $view->display();

  }

  public function show(){
    $fach = $_GET['fach'];
    $view = new View('quiz_show');
    $fachRepository = new FachRepository();
    $fachid = $fachRepository->checkID($fach);
    foreach ($fachid as $fachi) {
      $fid = $fachi->fid;

    }


    $quizRepository = new QuizRepository();
    $view->quizze = $quizRepository->getFachQuiz($fid);

    $view->title = $fach;
    $view->heading = $fach;
    $view->display();
  }


  public function changeQuiz(){
    $view = new View('quiz_change');

    $quiz = $_GET['id'];
    $view->quizID = (int)$quiz;
  //  var_dump($view->quizID);die;
    $frageRepository = new FrageRepository();
    $qid = (int)$quiz;
    $view->questions = $frageRepository->getQuestionsByID($qid);
    $view->title = "Quiz ändern";
    $view->heading = '';
    $view->display();

  }

  public function addQuestion(){
    $view = new View("quiz_change");
    $question = $_POST['question'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $answer = $_POST['answer'];
    $qid = (int)$_POST['qid'];
    $mangel = 0;
    $frageRepository = new FrageRepository();
    $frageRepository->addQuestion($question,$a,$b,$c,$d,$answer,$qid);

  header('Location: /quiz/changeQuiz?id=4');
  }

  public function playQuiz(){
    $view = new View("quiz_play");
    $view->title = "Quiz Name";
    $view->heading ="Quiz Name";
    $qid = (int)$_GET['id'];
    $frageRepository = new FrageRepository();
    $frageID = $frageRepository->countQuestionsByID($qid);
    foreach ($frageID as $frage) {
      $fid = $frage->numbers;

    }
  
    $view->count = $fid;
    $view->questions = $frageRepository->getQuestionsByID($qid);
    $view->display();
  }



}
