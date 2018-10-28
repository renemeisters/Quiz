<div class="tz-gallery">
  <div class="row mb-3">


<?php
  foreach ($users as $user) {
      echo "<div class='col-sm-4'>";
      echo '<form action="/user/toTeacher" method="post">';
      echo "   <div class='panel panel-default'>
              <div class='panel-heading'>$user->email</div>
              <div class='panel-body'>Mit einem Klick auf zum Lehrer machen,<br>kannst du diesen Benutzer zum Lehrer machen</br>";
              echo "<input type='hidden' value=".$user->id." name='id'>";
            echo "<input type='hidden'  value=". $user->email." name='email'>";

            echo "<input type='submit' class='waves-effect waves-light btn' name='sum' value='Zum Lehrer machen'>";
          echo '</form>';

echo "</div>";
echo "</div>";
echo "</div>";


  }

 ?>
</div>
</div>
