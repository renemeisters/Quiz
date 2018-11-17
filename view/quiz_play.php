
<div class="quiz-grid">




<div class="all">
<div class="quiz" id="quizContainer">

  <div class="title">
    <?php
    echo "<h2>".$quizN."</h2>";

     foreach ($marks as $mark){
      echo "<p class='mark'>Beste Note: ".$mark->note."<p>";

    }
     ?>

  </div>


<?php

  if($questions != null){


  echo'
  <div class="question" id="question"></div>

   <label class="option"><input type="radio" name="option" value="1" /><span id="opt1"></span></label>
    <label class="option"><input type="radio" name="option" value="2" /><span id="opt2"></span></label>
    <label class="option"><input type="radio" name="option" value="3" /><span id="opt3"></span></label>
    <label class="option"><input type="radio" name="option" value="4" /><span id="opt4"></span></label>
    <button id="nextButton" class="next-btn" onclick="loadNextQuestion();">nächste Frage</button>';
}else{
  echo "<h2>Es sind leider noch keine Fragen vorhanden</h2>
  <button><a href='/quiz'>Zurück</a></button>";

}


?>

</div>
<div id="result" style="display: none;">
  <h1>Das sind die richtigen Antworten und Ihr Ergebnis</h1>
  <form action="/quiz/mangel" method="post">
<?php
  foreach ($questions as $key => $question) {
echo "
    <div class='question' id='question'>".$question->frage."</div>";

      if($question->antwort == 1){
    echo"  <label class='option green set'><input type='radio' name='option' value='1' checked/><span id='opt1'>".$question->a."</span></label>
      <label class='option set'><input type='radio' name='option' value='2' /><span id='opt2'>".$question->b."</span></label>
      <label class='option set'><input type='radio' name='option' value='3' /><span id='opt3'>".$question->c."</span></label>
      <label class='option set'><input type='radio' name='option' value='4' /><span id='opt4'>".$question->d."</span></label>";
  }

      if($question->antwort == 2){
        echo"  <label class='option set'><input type='radio' name='option' value='1' /><span id='opt1'>".$question->a."</span></label>
          <label class='option green set'><input type='radio' name='option' value='2' checked/><span id='opt2'>".$question->b."</span></label>
          <label class='option set'><input type='radio' name='option' value='3' /><span id='opt3'>".$question->c."</span></label>
          <label class='option set'><input type='radio' name='option' value='4' /><span id='opt4'>".$question->d."</span></label>";
    }
    if($question->antwort == 3){
      echo"  <label class='option set'><input type='radio' name='option' value='1' /><span id='opt1'>".$question->a."</span></label>
        <label class='option set'><input type='radio' name='option' value='2' /><span id='opt2'>".$question->b."</span></label>
        <label class='option green set'><input type='radio' name='option' value='3' checked /><span id='opt3'>".$question->c."</span></label>
        <label class='option set'><input type='radio' name='option' value='4' /><span id='opt4'>".$question->d."</span></label>";
    }
    if($question->antwort == 4){
      echo"  <label class='option set'><input type='radio' name='option' value='1' /><span id='opt1'>".$question->a."</span></label>
        <label class='option set'><input type='radio' name='option' value='2' /><span id='opt2'>".$question->b."</span></label>
        <label class='option set'><input type='radio' name='option' value='3' /><span id='opt3'>".$question->c."</span></label>
        <label class='option green set'><input type='radio' name='option' value='4'  checked/><span id='opt4'>".$question->d."</span></label><br>";
    }

    echo "<br>";
    echo "<label>Diese Frage bemängeln</label>";
    echo "<input type='checkbox' name='mangel[]' value=".$question->id.">";
    echo "<input type='hidden' name='fid' value=".$question->id.">";


    echo "<input type='hidden' name='qid' value=".$qid."/>";
    echo "<input  id='noteInput2' type='hidden' name='note' value=''/>";


}

 ?>
<br>
<input type="submit" value="Ausgewählte Fragen bemängeln">

</form>

  <form class="" action="/quiz/setMark" method="post">

  <h2 id="noteText"><h2>
  <input  id="noteInput" type="hidden" name="note" value=""/>

  <?php
   echo "<input type='hidden' name='qid' value=".$qid."/>";
  ?>

  <input type="submit" name="test" value="Zurück zu Quizze">


  </form>
</div>
</div>
</div>
<script type="text/javascript">
  var questions = [
    <?php
    foreach ($questions as $question) {

    echo"      {
          'question': '".$question->frage."',
          'option1': '".$question->a."',
          'option2': '".$question->b."',
          'option3': '".$question->c."',
          'option4': '".$question->d."',
          'answer': '".$question->antwort."',
        },";
}
  ?>
];




var currentQuestion = 0;
var score = 0;


var container = document.getElementById('quizContainer');
var questionEl = document.getElementById('question');
var opt1 = document.getElementById('opt1');
var opt2 = document.getElementById('opt2');
var opt3 = document.getElementById('opt3');
var opt4 = document.getElementById('opt4');
var nextButton = document.getElementById('nextButton');
var resultCont = document.getElementById('result');
var noteInput = document.getElementById('noteInput');
var noteInput2 = document.getElementById('noteInput2');
var noteText =document.getElementById('noteText');
var numbQuestions = document.getElementById('questionNumber');

function loadQuestion(questionIndex){
  var q = questions[questionIndex];
  questionEl.textContent = (questionIndex + 1) + '. ' + q.question;
  opt1.textContent = q.option1;
  opt2.textContent = q.option2;
  opt3.textContent = q.option3;
  opt4.textContent = q.option4;
}


function loadNextQuestion(){
  var selectedOption = document.querySelector('input[type=radio]:checked');

  if(!selectedOption){
    alert('Bitte wählen Sie eine Antwort aus!');
    return;
  }

  var answer = selectedOption.value;
  if(questions[currentQuestion].answer == answer){
    score += 1;
  }
  selectedOption.checked = false;
  currentQuestion++;

<?php
echo "  if(currentQuestion == ".$count."-1){
    nextButton.textContent = 'Quiz beenden';

  }";
  ?>
  <?php
echo "  if(currentQuestion == ".$count."){
    container.style.display = 'none';
    resultCont.style.display = '';
    calculate();
    noteText.textContent = 'Deine Note ist: ' + score;
      noteInput.value = score;
      noteInput2.value = score;

    return;
  }";
  ?>
  loadQuestion(currentQuestion);

}

loadQuestion(currentQuestion);

function calculate(){
  <?php
echo"  score = score/".$count." * 5 + 1;";

  ?>
  score = score.toFixed(2);
}

</script>
