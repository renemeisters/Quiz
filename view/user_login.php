


          <h1>Login</h1>

          <form action="/user/doLogin" method="post">
            <div class="form-group">
              <label for="email">Email Adresse</label>
            <input type="text" placeholder="E-Mail" name="email" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="email">Passwort</label>

            <input type="password" name="pwd" placeholder="Passwort" class="form-control" required>
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


      </div><!-- tab-content -->

</div> <!-- /form -->
