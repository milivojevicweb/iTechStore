<?php
  include "models/authentication/functions.php";
  checkLoginUser();
  if(!isset($_GET['email']) && !isset($_GET['token'])){
    header("Location: index.php?page=home");
  }
?>
<div id="login" class="darkEmptyLightBackground">
  <div id="loginContainer">
    <h2 class="darkEmptyTextWhite">RESET PASSWORD</h2>
    <form method="POST"action="models/authentication/resetPassword.php">
        <input type="hidden" name="email" value='<?= $_GET['email']?>' />
        <input type="hidden" name="token" value='<?= $_GET['token']?>' />

            <input class="darkEmptyBackround darkEmptyTextWhite" id="passwordReset" placeholder="Password" type="password"  name="password" >

            <input class="darkEmptyBackround darkEmptyTextWhite" id="passwordResetRepeat" placeholder="Repeat Password" type="password"  name="rePassword"/>

            <button type="submit" id="resetPasswordButton" disabled  class="buttonDisable" name="submitPassword">Submit</button>


  </form>

  </div>
  <div id="loginLinks">
    <a href="index.php?page=registration" class="btn1">Sign up</a>
    <a href="index.php?page=login" class="btn1">Sign in</a>
  </div>

</div>


<script type="text/javascript" src="assets/js/resetPassword.js"></script>  
<script type="text/javascript" src="assets/js/cekiran.js"></script>  
<script type="text/javascript" src="assets/js/main.js"></script>