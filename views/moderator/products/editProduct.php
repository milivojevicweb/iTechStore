<?php
include "models/moderator/products/functions.php";
accessAllowModerator();
if(!isset($_GET['idEditProduct'])){
  header("Location: index.php?page=moderator");
}
$id = $_GET['idEditProduct'];
$proizvodi2=dohvatiProizvodId($id);
if($proizvodi2==null){
  header("Location: index.php?page=moderator");
}
?>

<div class="omotac">
  <div class="container5 darkEmptyLightBackground darkEmptyTextWhite">
    <form method="post"  enctype="multipart/form-data">
      <div class="row">
        <div class="col-25">

        </div>
        <div class="col-75">
          <div  id="productProfileImage">
              <img src="<?=$proizvodi2->path?>" alt="slika"/>
          </div>      
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="fname">Edit master photo</label>
        </div>
        <div class="col-75">
          <button type="button" onclick="document.getElementById('updateMain').click()" class="dugmeFile adminModeratorImageButton adminButtonTab">Edit photo</button>
          <span id="profilePhotoValueupdateMain"></span>
          <input type="file" name="updateMainImage" id="updateMain" style="display:none;" onchange="document.getElementById('profilePhotoValueupdateMain').innerHTML=this.value;"/>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="fname">Edit all photos </label>
        </div>
        <div class="col-75">
          <div class="adminModeratorImageButton adminButtonTab" id="dugmeFile">edit all photos <i class="fa fa-sort-down"></i></div>
        </div>
      </div>

      <div class="row" id="tableProductImages">
        <div class="col-25">
            <label for="fname">Add Image</label>
        </div>
        <div class="col-75">
          <input type="hidden" id="idProductInsertImage"  value="<?=$proizvodi2->idProduct?>" name="idProduct"  />
          <button type="button"  onclick="document.getElementById('insertImageProductEdit').click()" class="adminModeratorImageButton adminButtonTab dugmeFile">Add Images</button>
          <span id="profilePhotoValueInsert"></span>
          <input type="file" name="insertImage" id="insertImageProductEdit" style="display:none;" onchange="document.getElementById('profilePhotoValueInsert').innerHTML=this.value;"/>
        </div>
        <div class="col-25">
        </div>
        <div class="col-75">
          <button type="button" class="darkEmptyBackround darkEmptyTextWhite adminModeratorButtonColor adminButtonTab" name="insertImageButton" id="insertImageButton">Submit</button>
        </div>
        <div class="col-25">
          <label for="fname">Edit all photos</label>
        </div>
        <div class="col-75">
          <table  class="darkEmptyBackroundTable darkEmptyTextWhite tableAdminModerator">
            <tbody id="multiImageProductEdit">
              <?php $allImages=getAllimages($id);
                foreach($allImages as $item):
              ?>
              <tr>
                <td><img src="<?=$item->path?>" alt="<?=$item->alt?>"/></td>
                <td>  
                <button type="button" class="buttonImage plava" data-idimages=<?=$item->idImages?> onclick="document.getElementById('editImageProduct').style.display='block'" style="width:auto;" class="userButton"><i class="fa fa-cog"></i></button>
                </td>
                <td>
                  <button  type="button" class="deleteMultiImageButton f  adminModeratorButton"  data-idimagesdelete=<?=$item->idImages?> ><i class="fa fa-close"></i></button>
                </td>
              </tr>
                <?php endforeach;?>
            </tbody> 
        </table>
      </div>
    </div>

      <div id="editImageProduct" class="modal">
        <div class="modalAdminModerator container5 darkEmptyLightBackground darkEmptyTextWhite">
            <div class="row">
            <span onclick="document.getElementById('editImageProduct').style.display='none'" class="close" title="Close Modal"><i class="darkEmptyTextWhite fa fa-close"></i></span> 
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">Edit Image</label>
                </div>
                <div class="col-75">
                  <input type="hidden" id="idImages" name="idImages" />
                  <button type="button" onclick="document.getElementById('profilePhoto2').click()" class="adminModeratorImageButton adminButtonTab dugmeFile">Edit photo</button>
                  <span id="profilePhotoValue2"></span>
                  <input type="file" name="updateImage" id="profilePhoto2" style="display:none;" onchange="document.getElementById('profilePhotoValue2').innerHTML=this.value;"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">

                </div>
                <div class="col-75">
                  <input type="button" class="darkEmptyBackround darkEmptyTextWhite  adminModeratorButtonColor adminButtonTab" id="updateImageButton" name="updateImageButton" value="Update image"/>
                </div>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="fname">Name</label>
        </div>
        <div class="col-75">
          <input type="hidden" id="idProductEdit" name="idSkriveno" value="<?= $proizvodi2->idProduct ?>"/>
          <input type="text"  class="darkEmptyBackround darkEmptyTextWhite editProductValidation" id="editProductName"  name="naziv" value="<?= $proizvodi2->name; ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Alt</label>
        </div>
        <div class="col-75">
          <input type="text" class="darkEmptyBackround darkEmptyTextWhite editProductValidation" id="editProductAlt" name="alt" value="<?= $proizvodi2->alt ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Quantity</label>
        </div>
        <div class="col-75">
          <input type="number" class="darkEmptyBackround darkEmptyTextWhite editProductValidation" id="editProductQuantity" name="quantity" value="<?= $proizvodi2->quantity ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Description</label>
        </div>
        <div class="col-75">
          <input type="text" class="darkEmptyBackround darkEmptyTextWhite editProductValidation" id="editProductDesc" name="opis" value="<?= $proizvodi2->description ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
            <label for="country">Categories</label>
        </div>
        <div class="col-75">
            <select class="darkEmptyBackround darkEmptyTextWhite editProductSelectValidation"  id="editProductCategory" name="kategorije">
              <?php
              $category=productsCategory(); 
                foreach($category as $item):
                  if($item->idCategory==$proizvodi2->idCategory):?>
                  <option selected value='<?=$item->idCategory?>' ><?=$item->name?></option>
                  <?php else:?>
                    <option value='<?=$item->idCategory?>' ><?=$item->name?></option>
                <?php endif; endforeach;?>  
            </select>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="country">Add to home page</label>
        </div>
          <div class="col-75">
          <select  id="editProductHome" class="darkEmptyBackround darkEmptyTextWhite editProductSelectValidation" name="istaknut">
            <?php
                $istaknut = homeProduct();
                foreach($istaknut as $item):
                    if($item->idHomeProduct == $proizvodi2->idHomeProduct) : ?>
                <option selected value="<?= $item->idHomeProduct ?>"><?= $item->name ?></option>
            <?php 
                else: 
            ?>
                <option  value="<?= $item->idHomeProduct ?>"><?= $item->name ?></option>
            <?php
                endif;
                endforeach;?>
          </select>
          </div>
      </div>
      <div class="row">
        <span id="updateProductStatus"></span>
      </div>
      <div class="row">
        <div class="col-25">

        </div>
        <div class="col-75">
            <button type="button" id="UpdateProducButton" disabled  class="buttonDisable darkEmptyBackround darkEmptyTextWhite adminModeratorButtonColor adminButtonTab" name="submit" >Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript" src="assets/js/cekiran.js"></script>  
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/editProduct.js"></script>

