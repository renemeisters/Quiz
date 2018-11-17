<div class="upp-img login">

<div class="center-form">


          <form action="/user/doLogin" method="post" class="login">
            <div class="form-group">
              <label for="email">E-mail Adresse</label><br>
            <input class="input-text" type="text" placeholder="E-Mail" name="email" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="email">Passwort</label><br>

            <input class="input-text" type="password" name="pwd" placeholder="Passwort" class="form-control" required>
          </div>



          <input type="submit" name="send" class="btn" value="Login"/>

          </form>
          <?php
        //fehlermeldungen
            if(isset($_SESSION['emailNotRegistered'])|| isset($_SESSION['passwordVarified'])){
          echo '<div class="isa_error">
             <i class="fa fa-times-circle"></i>
             Email oder Passwort ist falsch
          </div>
          ';}

           ?>
         </div>
        </div>
