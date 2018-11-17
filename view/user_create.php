<div class="upp-img login">

<div class="center-form">


          <form action="/user/doCreate" method="post">
            <div class="form-group">
              <label for="email">Email Adresse</label><br>
            <input class="input-text" type="text" placeholder="E-Mail" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="email">Passwort</label><br>
            <input class="input-text" type="password" name="pwd" placeholder="Passwort" class="form-control"  required>
          </div>
          <div class="form-group">
            <label for="email">Passwort wiederholen</label><br>
            <input class="input-text" type="password" name="pwd2" placeholder="Passwort wiederholen" class="form-control" required>
          </div>
          <input type="submit" name="send" class="btn" value="Registrieren"/>

          </form>
          <?php
          //fehlermeldungen
            if(isset($_SESSION["email"])){
          echo '<div class="isa_error">
             <i class="fa fa-times-circle"></i>
             Diese Email ist bereits registriert
          </div>
          ';}
          if(isset($_SESSION['samePassword'])){
        echo '<div class="isa_error">
           <i class="fa fa-times-circle"></i>
           Die Passwörter ist unterschiedlich
        </div>
        ';}
        if(isset($_SESSION['unvalidEmail'])){
      echo '<div class="isa_error">
         <i class="fa fa-times-circle"></i>
         Diese Email ist ungültig
      </div>
      ';}
      if(isset($_SESSION['unvalidPasswort'])){
    echo '<div class="isa_error">
       <i class="fa fa-times-circle"></i>
       Das Passwort muss mindestes einen Grossbuchstaben, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen beinhalten
    </div>
    ';}
    if(isset($_SESSION['filled'])){
  echo '<div class="isa_error">
     <i class="fa fa-times-circle"></i>
     Bitte füllen sie alle Felder aus
  </div>
  ';}

           ?>

        </div>


      </div><!-- tab-content -->
