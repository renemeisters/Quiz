
<h1>Neue Frage hinzfügen</h1>
<form action="/quiz/addQuestion" method="post" >
  <label>Frage</label><br>
  <input type="text" name="question"  required><br>
  <label>Antwort A:</label><br>
  <input type="text" name="a" required><br>
  <?php
  echo "<input type='hidden' name='qid' value=".$quizID.">";
  ?>
  <label>Antwort B:</label><br>
  <input type="text" name="b"  required><br>
  <label>Antwort C:</label><br>
  <input type="text" name="c" required><br>
  <label>Antwort D:</label><br>
  <input type="text" name="d" required><br>
  <label>Richtige Antwort</label><br>
  <input type="radio" name="answer" value="1" checked>
  <input type="radio" name="answer" value="2">
  <input type="radio" name="answer" value="3" >
  <input type="radio" name="answer" value="4"><br>
  <input type="submit" value="Frage hinzufügen" class="btn">
</form>

<h2>Ändere Fragen</h2>
<?php
foreach ($questions as $question) {
echo "<form action='/quiz/changeQuestion' method='post' >
  <label>Frage</label><br>
  <input type='text' name='question' value=".$question->frage." required><br>
  <label>Antwort A:</label><br>
  <input type='text' name='a' value=".$question->a." required><br>

  <input type='hidden' name='qid' value=".$quizID.">

  <label>Antwort B:</label><br>
  <input type='text' name='b'  value=".$question->b." required><br>
  <label>Antwort C:</label><br>
  <input type='text' name='c' value=".$question->c." required><br>
  <label>Antwort D:</label><br>
  <input type='text' name='d' value=".$question->d." required><br>
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
echo "<input type='submit' value='Frage ändern'>";
echo "</form>";
echo "<form action='/quiz/delete' method='post'>";
echo "<input type='hidden' name='qid' value=".$quizID.">";
echo "<input type='hidden' name='fid' value=".$question->id.">";
echo "<input type='submit' value='Frage löschen'>";
echo "</form>";

}


 ?>
