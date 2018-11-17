<?php

require_once '../repository/QuizRepository.php';
require_once '../repository/FachRepository.php';
require_once '../repository/FrageRepository.php';
require_once '../repository/NotenRepository.php';

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

  header("Location: /quiz/changeQuiz?id=".$qid."");
  }

  public function playQuiz(){
    $view = new View("quiz_play");


    $qid = (int)$_GET['id'];
    $quizRepository = new QuizRepository();
    $frageRepository = new FrageRepository();
    $notenRepository = new NotenRepository();
    $frageID = $frageRepository->countQuestionsByID($qid);
    foreach ($frageID as $frage) {
      $fid = $frage->numbers;

    }
    $quizNamen =$quizRepository->getName($qid);

    foreach ($quizNamen as $quizName){
      $quiz = $quizName->name;
    }
    $view->title = $quiz;
  
    $view->heading = $quiz;
    $view->marks = $notenRepository->getUserMarks($qid);
      //($qid);die;
      $view->quizN = $quiz;
    $view->qid = $qid;
    $view->count = $fid;
    $view->questions = $frageRepository->getQuestionsByID($qid);
    $view->display();
  }

  public function setMark(){
    $qid = (int)$_POST['qid'];
    $note = (double)$_POST['note'];
    $uid = (int)$_SESSION['id'];

    $notenRepository = new NotenRepository();

    $notenRepository->setMark($qid,$note,$uid);

    header('Location: /quiz');
  }

  public function changeQuestion(){
    $fid = $_POST['fid'];
    $frage = $_POST['question'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $answer = $_POST['answer'];
    $qid = $_POST['qid'];
    //var_dump($fid,$frage,$a,$b,$c,$d,$answer,$qid);die;
    $frageRepository = new FrageRepository();
    $frageRepository->updateQuestions($fid,$frage,$a,$b,$c,$d,$answer,$qid);
    header("Location: /quiz/changeQuiz?id=".$qid."");
  }

  public function deleteQuestion(){
    $fid = $_POST['fid'];
    $qid = $_POST['qid'];
    $frageRepository = new FrageRepository();
    $frageRepository->delete($fid);

    header("Location: /quiz/changeQuiz?id=".$qid."");
  }

  public function mangel(){
    $qid = (int)$_POST['qid'];
    $note = (double)$_POST['note'];
    $uid = (int)$_SESSION['id'];
    $frageRepository = new FrageRepository();
    if (isset($_POST['mangel']))
    {
      $mangelArr = $_POST['mangel'];
      $mangelSize= sizeof($mangelArr);
        for($i = 0; $i < $mangelSize; $i++){
          $fmid = (int)$mangelArr[$i];
        //  var_dump($fid);die;
          $frageRepository->setMangel($fmid);
        }
    }
    $notenRepository = new NotenRepository();

    $notenRepository->setMark($qid,$note,$uid);
    header("Location: /quiz");
  }


  public function doChange(){
    unset($_SESSION['changeQuizFilled']);
    $qid = (int)$_POST['qid'];

    if(!isset($_POST['name'])){
      $_SESSION['changeQuizFilled'] = "true";

    }
    else{
      $name =$_POST['name'];

      $quizRepository = new QuizRepository();
      $quizRepository->update($qid,$name);
    }
    header("Location: /quiz/changeQuiz?id=".$qid."");
  }

  public function delete(){
    $qid = (int)$_POST['qid'];
    $quizRepository = new QuizRepository();
    $quizRepository->delete($qid);
      header("Location: /quiz");
  }




}
