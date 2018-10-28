<?php

require_once '../repository/GalerieRepository.php';
require_once '../repository/ImageRepository.php';


/**
 * Siehe Dokumentation im DefaultController.
 */
class GalerieController
{
  public function create()
  {
      $view = new View('galerie_create');
      $galerieRepository = new GalerieRepository();
      $view->title = '';

      $view->heading = '';
      $view->heading = '';
      $view->display();
  }

  public function index()
  {
      $view = new View('galerie_index');
      $public = 0;
      $galerieRepository = new GalerieRepository();
      $view->galeries = $galerieRepository->read($public);
      $view->title = 'test';
      $view->heading = '';
      $view->display();
  }
  public function doCreate(){
      unset($_SESSION['fill_galerie']);
      $galerieRepository = new GalerieRepository();
      if(!isset($_POST['galeriename'])){
        $_SESSION['fill_galerie'] = "true";
        header('Location: /galerie/create');
      }
      if(isset($_POST['public'])){
        $isChecked = 1;
      }else{
        $isChecked = 0;
      }

      $name = $_POST['galeriename'];
      if(!isset($_POST['beschreibung'])){
        $description = " ";
      }else{
      $description = $_POST['beschreibung'];
    }
      $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
      $description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
      if (!file_exists("../public/images/$name")) {

          mkdir("../public/images/$name", 0777, true);
              mkdir("../public/images/$name/thumbnail", 0777, true);

      }
      $galerieRepository->create($name,$description,$isChecked);
      header('Location: /galerie/index');

  }

  public function showGalerie(){
    if(isset($_POST['id']) && isset($_POST['galeriename']) && isset($_POST['public'])){
    $id = $_POST['id'];
    $oldName = $_POST['galeriename'];
    $public = $_POST['public'];
  }else{
    $id = NULL;
    $public = null;
    $oldName = null;
  }
    $view = new View('galerie_show');
    $view->public = $public;
    $galerie = $oldName;
    $view->galerie = $galerie;
    $imageRepository = new ImageRepository();

    $view->images = $imageRepository->read($id);
    $view->oldName = $oldName;
    $view->id = $id;
    $view->title = 'test';
    $view->heading = '';
    $view->display();

  }

  public function setPublic(){
    $id = $_POST['id'];

    $galerieRepository = new GalerieRepository();
    $galerieRepository->setPublic($id);
    header('Location: /galerie/index');

  }

  public function addImage(){
      $imageRepository = new ImageRepository();
    unset($_SESSION['toLarge']);
    $imgname = $_POST['imgname'];
    $galeriename = $_POST['galeriename'];
    $gid = $_POST['gid'];
    $place = $_POST['place'];

  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];



    if($fileError === 0){
      if($fileSize < 4000000){
        $fileDestination = "../public/images/$galeriename/$fileName";
        $thumbnailDestination = "../public/images/$galeriename/thumbnail/$fileName";
        move_uploaded_file($fileTmpName, $fileDestination);

        $imageRepository->setThumbnail($fileDestination,$thumbnailDestination);



        $imageRepository->uploadImage($fileName,$imgname,$gid);
        if($place == "galerie"){
        header('Location: /galerie/index');
          }
          if($place == "home"){
          header('Location: /');
        }
      }else{
          $_SESSION['toLarge'] = "true";
          if($place == "galerie"){
          header('Location: /galerie/index');
        }
        if($place == "home"){
        header('Location: /');
      }
      }

    }else{
      $_SESSION['error'] = "Es gab einen error mit dem file";
    }


  }/// Fürs Freitag erstele ordner beim Erstellen einer Galerie


  public function update(){

    if(!isset($_POST['galeriename'])){
      $_SESSION['fill_galerie'] = "true";
      header('Location: /');
    }

    $name = $_POST['galeriename'];
    if(!isset($_POST['beschreibung'])){
      $description = " ";
    }else{
    $description = $_POST['beschreibung'];
    }
    $id = $_POST['id'];
    $oldName = $_POST['oldname'];
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
    rename("../public/images/$oldName", "../public/images/$name");

    $galerieRepository = new GalerieRepository();
    $galerieRepository->doUpdate($id,$name,$description);

  }

  public function delete(){

      $galerie = $_POST['galerie'];
      $img = $_POST['img'];
      $id = $_POST['id'];
      $file = "../public/images/$galerie/$img";
      $thumbnail = "../public/images/$galerie/thumbnail/$img";
      $imageRepository = new ImageRepository();
      $imageRepository->deleteImage($file,$thumbnail,$img,$id);

      header('Location: /');
  }


}
