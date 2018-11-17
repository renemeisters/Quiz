<div class="form">
  <h2>Quiz bearbeiten</h2>
  <form action="/quiz/doChange" method="post">
    <label>Neuer Quiz Name</label><br>
    <input type="text" class="change-input" name="name" required><br>

    <?php
    echo "<input type='hidden' name='qid' value=".$quizID.">";
    ?>
    <input type="submit" class="btn" value="Ändere Quiz">
    <?php
      if(isset($_SESSION['changeQuizFilled'])){
        echo "<div class='isa_error'>
              Bitte füllen Sie alle angeforderten Felder aus!
              </div>";
      }
     if(isset($_SESSION['succChangeQuiz'])){
        echo "<div class='isa_success'>
              Name wurde Erfolgreich geändert
              </div>";
      }
     ?>
  </form>
  <form  action="/quiz/delete" method="post">
    <?php
    echo "<input type='hidden' name='qid' value=".$quizID.">";
    ?>
    <input type="submit" class="btn"value="Lösche Quiz">
  </form>

</div>

<div class="form">
<h1>Neue Frage hinzfügen</h1>
<form action="/quiz/addQuestion" method="post" >
  <label>Frage</label><br>
  <input type="text" name="question" class="change-input"  required><br>
  <label>Antwort A:</label><br>
  <input type="text" name="a" class="change-input" required><br>
  <?php
  echo "<input type='hidden' name='qid' value=".$quizID.">";
  ?>
  <label>Antwort B:</label><br>
  <input type="text" name="b"  class="change-input" required><br>
  <label>Antwort C:</label><br>
  <input type="text" name="c"  class="change-input"required><br>
  <label>Antwort D:</label><br>
  <input type="text" name="d" class="change-input" required><br>
  <label>Richtige Antwort</label><br>
  <input type="radio" name="answer" value="1" checked>
  <input type="radio" name="answer" value="2">
  <input type="radio" name="answer" value="3" >
  <input type="radio" name="answer" value="4"><br>
  <input type="submit" value="Frage hinzufügen" class="btn">
</form>
</div>

<h2 style="text-align:center;">Ändere Fragen</h2>
<?php
foreach ($questions as $question) {
  echo "<div class='form'>";
echo "<form action='/quiz/changeQuestion' method='post' >
  <label>Frage</label><br>
  <input type='text' class='change-input' name='question' value=".$question->frage." required><br>
  <label>Antwort A:</label><br>
  <input type='text' name='a'  class='change-input'value=".$question->a." required><br>

  <input type='hidden' name='qid'  value=".$quizID.">

  <label>Antwort B:</label><br>
  <input type='text' name='b'  value=".$question->b." class='change-input' required><br>
  <label>Antwort C:</label><br>
  <input type='text' name='c' value=".$question->c." class='change-input' required><br>
  <label>Antwort D:</label><br>
  <input type='text' name='d' value=".$question->d." class='change-input' required><br>
  <label>Richtige Antwort</label><br>";

  if($question->antwort == "1"){
    echo  "<input type='radio' name='answer' checked value='1'>";
      echo "<input type='radio' name='answer' value='2'>";
    echo  "<input type='radio' name='answer' value='3'>";
    echo  "<input type='radio' name='answer' value='4'><br>";
  }
  elseif ($question->antwort == "2") {
    echo  "<input type='radio' name='answer' value='1'>";
      echo "<input type='radio' name='answer' value='2' checked>";
    echo  "<input type='radio' name='answer' value='3'>";
    echo  "<input type='radio' name='answer' value='4'><br>";
  }
  elseif ($question->antwort == "3") {
    echo  "<input type='radio' name='answer' value='1'>";
      echo "<input type='radio' name='answer' value='2'>";
    echo  "<input type='radio' name='answer' value='3'checked'>";
    echo  "<input type='radio' name='answer' value='4'><br>";
  }
  elseif ($question->antwort == "4") {
    echo  "<input type='radio' name='answer' value='1'>";
      echo "<input type='radio' name='answer' value='2'>";
    echo  "<input type='radio' name='answer' value='3'>";
    echo  "<input type='radio' name='answer' value='4' checked><br>";
  }
echo "<input type='hidden' name='fid' value=".$question->id.">";
echo "<input type='submit' class='btn' value='Frage ändern'>";
echo "</form>";
echo "<form action='/quiz/deleteQuestion' method='post'>";
echo "<input type='hidden' name='qid' value=".$quizID.">";
echo "<input type='hidden' name='fid' value=".$question->id.">";
echo "<input type='submit' class='btn'value='Frage löschen'>";
echo "</form>";
echo "</div>";
}


 ?>
