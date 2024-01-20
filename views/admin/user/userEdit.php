<?php
  include "models/admin/user/functions.php";
  accessAllowAdmin();
	if(!isset($_GET['idUser'])){
		header("Location: index.php?page=admin");
	}

	$id = $_GET['idUser'];
  $korisnik2=getUser($id);

	if($korisnik2==null){
		header("Location: index.php?page=admin");
	}
?>
        
<div class="omotac">
  <div class="container5 darkEmptyLightBackground darkEmptyTextWhite">

        <div class="row">
          <div class="col-25">
            <label for="fname">First Name</label>
          </div>
          <div class="col-75">
            <input type="hidden" name="idSkriveno" value="<?= $korisnik2->idUser ?>"/>
            <input type="text" class="darkEmptyBackround darkEmptyTextWhite userValidation" id="firstNameUserEdit" name="ime" value="<?php echo $korisnik2->name; ?>"/>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Last Name</label>
          </div>
          <div class="col-75">
            <input type="text" class="darkEmptyBackround darkEmptyTextWhite userValidation" id="lastNameUserEdit" name="prezime" value="<?php echo $korisnik2->lastName ?>"/>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Email</label>
          </div>
          <div class="col-75">
            <input type="text" class="darkEmptyBackround darkEmptyTextWhite userValidation" id="emailUserEdit"  value="<?php echo $korisnik2->email ?>"/>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">City</label>
          </div>
          <div class="col-75">
            <input type="text" class="darkEmptyBackround darkEmptyTextWhite userValidation" id="cityUserEdit"  value="<?php echo $korisnik2->city ?>"/>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Address</label>
          </div>
          <div class="col-75">
            <input type="text" class="darkEmptyBackround darkEmptyTextWhite userValidation" id="addressUserEdit"  value="<?php echo $korisnik2->address ?>"/>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Zip</label>
          </div>
          <div class="col-75">
            <input type="text" class="darkEmptyBackround darkEmptyTextWhite userValidation" id="zipUserEdit"  value="<?php echo $korisnik2->zip ?>"/>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="country">Country</label>
          </div>
          <div class="col-75">
            <select class="darkEmptyBackround darkEmptyTextWhite "id="contryUserEdit">
              <?php
                    $contry = contry();
                    foreach($contry as $item):
                        if($item->idCountry == $korisnik2->idCountry) : ?>
                    <option selected value="<?= $item->idCountry ?>"><?= $item->countryName ?></option>
                <?php 
                    else: 
                ?>
                    <option value="<?= $item->idCountry ?>"><?= $item->countryName?></option>
                <?php
                    endif;
                    endforeach;?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="country">Uloga</label>
          </div>
          <div class="col-75">
            <select class="darkEmptyBackround darkEmptyTextWhite " id="roleUserEdit" name="uloga">
              <?php
                    $role = role();
                    foreach($role as $item):
                        if($item->idRole == $korisnik2->idRole) : ?>
                    <option selected value="<?= $item->idRole ?>"><?= $item->name ?></option>
                <?php 
                    else: 
                ?>
                    <option  value="<?= $item->idRole ?>"><?= $item->name ?></option>
                <?php
                    endif;
                    endforeach;?>
            </select>
          </div>
        </div>
        <div class="row">
          <span id="userEditStatus"></span>
        </div>
        <div class="row">
          <div class="col-25">

          </div>
          <div class="col-75">
            <button type="button" class="adminModeratorButtonColor adminButtonTab"  id="editUserButton" data-iduser=<?=$id?>>Edit</button>
          </div>
        </div>
      </form>
  </div>
</div>

<script type="text/javascript" src="assets/js/cekiran.js"></script>  
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/userEdit.js"></script>
