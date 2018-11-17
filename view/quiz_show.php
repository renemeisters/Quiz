
<div class="row">



  <?php
    if(isset($_SESSION['id'])){
      foreach ($quizze as $quiz) {
        echo "<div class='col-sm-3'>";
        echo "<div class='card'>
        <form  action='/quiz/playQuiz' method='get'>
         <input type='hidden' value=".$quiz->id." name='id'/>
        <div class='card-header'><h3>".$quiz->name."</h3></div>

        <div class='card-footer'><input type='submit' value='Zum Quiz'/></form></div>
      </div></div>";

      }
}
else{
  echo "<div class='isa_warning'>
  Du musst dich anmelden um Quizze zu spielen </div>";
}

   ?>
</div>
