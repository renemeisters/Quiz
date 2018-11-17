<?php
foreach ($questions as $question) {
  echo "<div class='form'>";
echo "<form action='/quiz/changeQuestion' method='post' >
  <label>Frage</label><br>
  <input type='text' class='change-input' name='question' value=".$question->frage." required><br>
  <label>Antwort A:</label><br>
  <input type='text' name='a'  class='change-input'value=".$question->a." required><br>

  <input type='hidden' name='qid'  value=".$question->qid.">

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
echo "<input type='hidden' name='qid' value=".$question->qid.">";
echo "<input type='hidden' name='fid' value=".$question->id.">";
echo "<input type='submit' class='btn'value='Frage löschen'>";
echo "</form>";
echo "</div>";
}


 ?>
