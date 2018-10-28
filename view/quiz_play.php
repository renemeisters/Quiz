<div class="quiz" id="quizContainer">
  <div class="title">

  </div>
  <div class="question" id="question"></div>
    <label class="option"><input type="radio" name="option" value="1" /><span id="opt1"></span></label>
    <label class="option"><input type="radio" name="option" value="2" /><span id="opt2"></span></label>
    <label class="option"><input type="radio" name="option" value="3" /><span id="opt3"></span></label>
    <label class="option"><input type="radio" name="option" value="4" /><span id="opt4"></span></label>
    <button id="nextButton" class="next-btn" onclick="loadNextQuestion();">nächste Frage</button>

</div>
<div class="container result" id="result" style="display: none;">

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
    resultCont.textContent = 'Deine Note ist: ' + score;
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
