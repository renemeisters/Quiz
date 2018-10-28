<form  action="/quiz/doCreate" method="post">

  <label for="name">Quiz Name</label>
  <input type="text" placeholder="Quiz Name" name="quizName" class="form-control"required>

  <label for="fächer">Fach</label>
  <input list="fach" name="fach" class="form-control">
    <datalist id="fach">
     <option value="Deutsch">
     <option value="Englisch">
     <option value="Finanz und Rechnungswesen">
     <option value="Französisch">
     <option value="Geschichte und Staatskunde">
     <option value="IKA">
     <option value="Mathematik">
     <option value="Technik und Umwelt">
     <option value="Wirtschaft und Recht">
   </datalist>
</br>
 <input type="submit" value="Quiz erstellen" class="btn">

</form>
