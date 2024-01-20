<?php
  include "models/authentication/functions.php";
  checkLoginUser();
?>

<div id="login" class="darkEmptyLightBackground">
  <div id="loginContainer">
    <h2 class="darkEmptyTextWhite">LOGIN</h2>
    <form method="POST" action="models/authentication/login.php">
    <label for="tbEmail" class="darkEmptyTextWhite">Email</label>
    <input type="text" name="tbEmail" class="input darkEmptyBackround darkEmptyTextWhite" placeholder="Email" required>
    <label for="tbLozinka" class="darkEmptyTextWhite">Password</label>
    <input type="password"  name="tbLozinka" class="input pss darkEmptyBackround darkEmptyTextWhite" placeholder="Password" required>
    <button type="submit" class="input" name="btnLogin">Login</button>

    </form>
  </div>

  <div id="loginLinks">
    <a href="index.php?page=registration" class="btn1">Sign up</a>
    <a href="index.php?page=resetPasswordEmail" class="btn1">Forgot password?</a>
  </div>

</div>


        
<script type="text/javascript" src="assets/js/cekiran.js"></script>  
<script type="text/javascript" src="assets/js/main.js"></script>