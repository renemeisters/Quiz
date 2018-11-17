<form  action="/quiz/doCreate" method="post" class="creator">

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
<div class="upp-img login">

<div class="center-form">


          <form action="/quiz/doCreate" method="post" class="login">
            <div class="form-group">
              <label for="email">Quiz Namen</label><br>
            <input class="input-text" type="text" placeholder="Quiz Namen" name="quizName" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="email">Fach</label><br>

            <input list="fach" name="fach" class="input-text">
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
          </div>



          <input type="submit" name="send" class="btn" value="Quiz erstellen"/>

          </form>

         </div>
        </div>
