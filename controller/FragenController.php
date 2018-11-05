<?php

require_once '../repository/FrageRepository.php';
require_once '../repository/NotenRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class FragenController
{

  public function meldung(){
    $view = new View('fragen_gemeldet');
    $fragenRepository = new FrageRepository();
  //  $view->quizze = $quizRepository->getUserQuiz();
    $view->fragen = $fragenRepository->getFragenWithMangel();
    $view->title = 'Bemängelte Fragen';
    $view->heading = 'Bemängelte Fragen';
    $view->display();
  }

}

 ?>
