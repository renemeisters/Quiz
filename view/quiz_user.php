
<div class="row">


<?php

foreach ($quizze as $quiz) {
  echo "<div class='col-sm-3'>";
  echo "<div class='card down'>
  <form  action='/quiz/changeQuiz' method='get'>
   <input type='hidden' value=".$quiz->id." name='id'/>
  <div class='card-header'><h3>".$quiz->name."</h3></div>
  <div class='card-body'>Fach: ".$quiz->fach."</div>
  <div class='card-footer'><input type='submit' value='Zum Quiz' class='btn'/></form></div>
</div></div>";

}



 ?>

</div>
