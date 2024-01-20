<?php
  include "models/moderator/news/functions.php";
  accessAllowModerator();
  $id = $_GET['idNews'];
  $korisnik2 = getNewsId($id); 

  if($korisnik2==null){
    header("Location: index.php?page=moderator");
  }
?>
<div class="omotac">
  <div class="container5 darkEmptyLightBackground darkEmptyTextWhite">
      <form action="models/moderator/news/editNews.php" method="post" enctype="multipart/form-data">
      <div class="row">
          <div class="col-25">

          </div>
          <div class="col-75" id="newsImageContainer">
            <img src='<?=$korisnik2->bigImage?>' alt="news"/>
          </div>
      </div>
    
      <div class="row">
          <div class="col-25">
            <label for="fname">Edit Image</label>
          </div>
          <div class="col-75">
              <button type="button" onclick="document.getElementById('profilePhoto2').click()" class="dugmeFile adminModeratorImageButton adminButtonTab">Edit photo</button>
              <span id="profilePhotoValue2"></span>
              <input type="file" name="imageNews" id="profilePhoto2" style="display:none;" onchange="document.getElementById('profilePhotoValue2').innerHTML=this.value;"/>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="fname">Title</label>
          </div>
          <div class="col-75">
            <input type="hidden" name="idSkriveno" value="<?= $korisnik2->idNews ?>"/>
            <input type="text" class="darkEmptyBackround darkEmptyTextWhite" id="editNewsTitle" id="fname" name="title" value="<?php echo $korisnik2->title; ?>"/>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Text</label>
          </div>
          <div class="col-75">
            <textarea class="form-control" id="summary-ckeditor" name="text"><?= $korisnik2->text ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-25">

          </div>
          <div class="col-75">
            <button type="submit" class="darkEmptyBackround darkEmptyTextWhite adminModeratorButtonColor adminButtonTab" id="editNewsButton" name="submit">Submit</button>
          </div>
      </div>
      </form>
  </div>
</div>
<script type="text/javascript" src="assets/js/cekiran.js"></script>  
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/editNews.js"></script>
<script src="assets/ckeditor/ckeditor.js"></script>
  <script>
        CKEDITOR.replace( 'summary-ckeditor', {
        filebrowserUploadUrl: 'models/moderator/news/ckeditorImage.php',
        filebrowserUploadMethod: 'form'
        });

        var e = CKEDITOR.instances['summary-ckeditor']
        e.on('change', function( e ){
          editNewsVailidation();
        });
</script>