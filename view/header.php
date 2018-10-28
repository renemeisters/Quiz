<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?> | Lehrer Quiz</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
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
    <nav class="navbar navbar-inverse navbar-fixed-top" id="head">
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
                <?php
                  if(isset($_SESSION['id'])){

                  if($_SESSION['isTeacher'] == 0){
                    echo  '<li><a href="/quiz">Quizze</a></li>';
                  }

                  if($_SESSION['isTeacher'] == 1){
                      echo  '<li><a href="/quiz/create">Quiz erstellen</a></li>';
                      echo  '<li><a href="/quiz/user">Meine Quizze</a></li>';
                      echo '<li><a href="/fragen/meldung">Bemängelte Fragen</a></li>';
                  }
                  if($_SESSION['isTeacher'] == 2){
                    echo '<li><a href="/user/">Accounts</a></li>';
                  }
                }
                else{
                echo '<li><a href="/user/create">Registrieren</a></li>';
                echo'<li><a href="/user/login">Login</a></li>';
                }
                if(isset($_SESSION['id'])){
                echo'<li><a href="/user/logout">Logout</a></li>';
              }


                ?>
              </div><!--/.nav-collapse -->
 </div>

</nav>



    <div class="container">
      <div class="content">

    <h1><?= $heading ?></h1>
