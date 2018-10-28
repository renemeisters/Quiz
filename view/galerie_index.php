
<h1>Eigene Galerien</h1>
<div class="tz-gallery">
  <div class="row mb-3">


<?php
  foreach ($galeries as $galerie) {
      echo "<div class='col-sm-4'>";
      echo '<form action="/galerie/showGalerie" method="post">';
      echo "   <div class='panel panel-default'>
              <div class='panel-heading'>$galerie->name</div>
              <div class='panel-body'>$galerie->beschreibung<br>";

            echo "<input type='hidden'  value=". $galerie->id." name='id'>";
            echo "<input type='hidden'  value=". $galerie->freigabe." name='public'>";
            echo "<input type='hidden'  value=". $galerie->name." name='galeriename'>";
            echo "<input type='submit' class='waves-effect waves-light btn' name='sum' value='Zur Galerie'>";
          echo '</form>';
      echo "</div><div class='panel-footer'>
            <button type='button' class='btn btn-info' data-toggle='collapse' data-target='#$galerie->id'>Bild hinzufügen</button>
            <div id='$galerie->id' class='collapse'>
            <form action='/galerie/addImage' method='post' enctype='multipart/form-data'>
            <h5>Bildname</h5>
            <input type='text' name='imgname' placeholer='Name'>
            <input type='hidden' value=".$galerie->id." name='gid'>
            <input type='hidden' value=".$galerie->name." name='galeriename'>
            <input type='hidden' value='home' name='place'>
            <h5>Bild</h5>
            <input type='file' name='file' ><br><br>
            <input type='submit'  name='send' value='Bild hinzufügen'>

            </form></div>";
            if(isset($_SESSION['toLarge'])){
              echo '<div class="alert alert-danger">
                      <i class="fa fa-times-circle"></i>
                      Bild ist zu gross
                   </div>';
            }
echo "</div>";
echo "</div>";
echo "</div>";


  }

 ?>
</div>
</div>
