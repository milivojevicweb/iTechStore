<?php
  include "models/authentication/functions.php";
  checkLoginUser();
?>
<div id="registration" class="darkEmptyLightBackground">
    <div id="registrationContainer">
        <label for="name" class="darkEmptyTextWhite"><b>Name</b></label>
        <input type="text" class="darkEmptyBackround darkEmptyTextWhite" id="fname" placeholder="Enter Name" name="imeReg">

        <label for="lastname" class="darkEmptyTextWhite"><b>Last name</b></label>
        <input type="text" class="darkEmptyBackround darkEmptyTextWhite" id="lname" placeholder="Enter Last Name" name="prezimeReg">

        <label for="email" class="darkEmptyTextWhite"><b>Email</b></label>
        <input type="text" class="darkEmptyBackround darkEmptyTextWhite" id="regEmail" placeholder="Enter Email" name="emailReg">

        <label for="address" class="darkEmptyTextWhite"><b>Address</b></label>
        <input type="text" class="darkEmptyBackround darkEmptyTextWhite" id="regAddress" placeholder="Enter Address" name="addressReg">

        <label for="city" class="darkEmptyTextWhite"><b>City</b></label>
        <input type="text" class="darkEmptyBackround darkEmptyTextWhite" id="regCity" placeholder="Enter City" name="cityReg">

        <label for="city" class="darkEmptyTextWhite"><b>Zip code</b></label>
        <input type="text" class="darkEmptyBackround darkEmptyTextWhite" id="regZipCode" placeholder="11420" name="cityReg">

        <label for="countryReg" class="darkEmptyTextWhite"><b>Country</b></label>
        <select id="regContry" class="darkEmptyBackround darkEmptyTextWhite" name="countryReg">
            <?php $country=registrationContry();
            foreach($country as $item):?>
                <option value=<?=$item->idCountry?> ><?=$item->name?></option>
            <?php endforeach;?>
        </select>

        <label for="psw" class="darkEmptyTextWhite"><b>Password</b></label>
        <input type="password" class="darkEmptyBackround darkEmptyTextWhite" id="regPassword" placeholder="Enter Password" name="passwordReg">
        <div id="feedback"></div>

        <label for="psw" class="darkEmptyTextWhite"><b>Repeat Password</b></label>
        <input type="password" class="darkEmptyBackround darkEmptyTextWhite" id="regRepeatPassword" placeholder="Enter repeat Password" name="passwordReg">
        <div id="feedback"></div>
        <input type="hidden" id="recaptcha"/>
        <button type="button" class="registerbtn" id="registrationButton" name="submitReg">Register</button>
    </div>
    <div id="registrationLinks">
        <p>Already have an account? <a href="index.php?page=login" class="btn1">Sign in</a></p>
    </div>

</div>

           
        
<script src="https://www.google.com/recaptcha/api.js?render=6Lf_0NAUAAAAAOSzKHPSp2ijQCxCKuHef7T7LNCu"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Lf_0NAUAAAAAOSzKHPSp2ijQCxCKuHef7T7LNCu', {action: 'homepage'}).then(function(token) {
        document.querySelector("#recaptcha").value=token
        });
    });
</script>
<script type="text/javascript" src="assets/js/cekiran.js"></script>  
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/registration.js"></script> 

