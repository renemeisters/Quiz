<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?> | Lehrer Quiz</title>

    <!-- Bootstrap core CSS -->
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">


    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



  </head>
  <body>
    <div class="bod">
    <!--nav class="navbar navbar-inverse navbar-fixed-top" id="head">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Lehrer Quiz</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">

              </div><!--/.nav-collapse -->
 </div>

</nav-->


<!--Title-->
<div class="upper">
  <div class="icon">
    <span class="open-slide">
      <a href="#" onclick="openSideMenu()">
        <svg width="30" height="30">
          <path d="M0,5 30,5" stroke="#fff" stroke-width="5"/>
          <path d="M0,14 30,14" stroke="#fff" stroke-width="5"/>
          <path d="M0,23 30,23" stroke="#fff" stroke-width="5"/>
        </svg>
      </a>
    </span>
  </div>

  <div class="upperCenter">
        <h1><?= $heading ?></h1>
  </div>
  <div class="bars" id="nav-action">
    <span class="bar"> </span>
  </div>
</div>
<!--Navbar Links-->
<nav class="navbar">

    <ul class="navbar-nav">
      


    </ul>

</nav>
<div class="side-nav" id="side-menu">
  <a href="#" class="btn-close" onclick="closeSideMenu()">&times;</a>
  <a href="/" >Home</a>  <?php

    if(isset($_SESSION['id'])){

    if($_SESSION['isTeacher'] == 0){
      echo  '<a href="/quiz">Quizze</a>';
    }

    if($_SESSION['isTeacher'] == 1){
        echo  '<a href="/quiz/create">Quiz erstellen</a>';
        echo  '<a href="/quiz/user">Meine Quizze</a>';
        echo '<a href="/fragen/meldung">Bemängelte Fragen</a>';
    }
    if($_SESSION['isTeacher'] == 2){
      echo '<a href="/user/">Accounts</a>';
    }
      echo'<a href="/user/logout">Logout</a>';
  }
  else{
  echo '<a href="/user/create">Registrieren</a>';
  echo'<a href="/user/login">Login</a>';
  }


  ?>
</div>

      <div class="content" id="main">
<script>
function openSideMenu(){
  document.getElementById('side-menu').style.width = '250px';
  document.getElementById('main').style.marginLeft = '250px';
}

function closeSideMenu(){
  document.getElementById('side-menu').style.width = '0';
  document.getElementById('main').style.marginLeft = '0';
}

</script>


      <div class="content">
