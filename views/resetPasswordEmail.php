<?php
  include "models/authentication/functions.php";
  checkLoginUser();
?>

<div id="login" class="darkEmptyLightBackground">
  <div id="loginContainer">
    <h2 class="darkEmptyTextWhite">RESET PASSWORD</h2>
            <form method="POST" action="models/authentication/sendEmailforgotPassword.php">
            <input type="email" name="email" class="input darkEmptyBackround" placeholder="Email" required>
            <button type="submit" class="input" name="sendEmail">sendEmail</button>

          </form>
  </div>
  <div id="loginLinks">
      <a href="index.php?page=registration" class="btn1">Sign up</a>
      <a href="index.php?page=login" class="btn1">Sign in</a>
  </div>

</div>

<script type="text/javascript" src="assets/js/cekiran.js"></script>  
<script type="text/javascript" src="assets/js/main.js"></script>