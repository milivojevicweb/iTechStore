$(document).ready(function(){
    $(document).on('click','.buttonImage',getImageId);
    togleElement();

    $(document).on('click','#UpdateProducButton',updateProductInfo);
    $(document).on('click','.deleteMultiImageButton',deleteProductMultiImage);
    $(document).on('keyup','.editProductValidation',editProductValidation);
    $(document).on('change','.editProductSelectValidation',editProductValidation);
    $(document).on('change','#updateMain',editProductValidation);
    
    $(document).on('click','#updateImageButton',function(){
        updateProductMultiImage("updateImageButton");
    });
    $(document).on('click','#insertImageButton',function(){
        updateProductMultiImage("insertImageButton");
    });
});

function getImageId(){
  var id=$(this).data('idimages');
  $("#idImages").val(id);
}
function togleElement(){
    $("#tableProductImages").hide();
    $("#dugmeFile").click(function(){
        $("#tableProductImages").toggle(500);
    });
}


function updateProductInfo(){
    var id=$("#idProductEdit").val();
    var alt=$('#editProductAlt').val();
    var name=$('#editProductName').val();
    var desc=$('#editProductDesc').val();
    var quantity=$('#editProductQuantity').val();
    var category=$('#editProductCategory').val();
    var home=$('#editProductHome').val();

    var button="submit";
    

    var fd = new FormData();
    fd.append('id',id);
    fd.append('alt',alt);
    fd.append('name',name);
    fd.append('desc',desc);
    fd.append('quantity',quantity);
    fd.append('category',category);
    fd.append('home',home);
    fd.append('submit',button);

    
    var files = $('#updateMain')[0].files;
    fd.append('profileImage',files[0]);


    
    $.ajax({
        url: 'models/moderator/products/editProduct.php', 
        type: 'POST',
        data:fd,
        contentType: false,
        processData: false,
        success: function (response) {
            viewProductProfilePhoto();
            successData();
        },error:function(xhr,status,error){
            console.log(xhr,status,error)
        }
            
    });
}

function updateProductMultiImage(buttonName){

    var imageName="";
    var idProduct=$("#idProductInsertImage").val();
    var idImages=$("#idImages").val();
    var alt=$("#editProductAlt").val();
    var fd = new FormData();

    var files="";
    if(buttonName=="updateImageButton"){
        imageName="updateImage";
        files = $('#profilePhoto2')[0].files;
    }else if(buttonName=="insertImageButton"){
        imageName="insertImage";
        files = $('#insertImageProductEdit')[0].files;
    }
    


    fd.append(imageName,files[0]);
    fd.append('buttonName',buttonName);
    fd.append('idImages',idImages);
    fd.append('idProduct',idProduct);
    fd.append('alt',alt);

    $.ajax({
        url: 'models/moderator/products/editProduct.php', 
        type: 'POST',
        data:fd,
        contentType: false,
        processData: false,
        success: function (response) {
            viewProductMultiImages();
            successData();
        },error:function(xhr,status,error){
            console.log(xhr,status,error)
        }
    });

}

function viewProductProfilePhoto(){

    var idProduct=$("#idProductEdit").val();
    var profileImage=true;

    $.ajax({
        url: 'models/moderator/products/getProductImage.php', 
        method: 'GET',
        dataType:"JSON",
        data:{
            idProduct:idProduct,
            profileImage:profileImage
        },
        success: function (data) {
            viewPhoto(data);
        },error:function(xhr,status,error){
            console.log(xhr,status,error)
        }
            
    });    
}

function deleteProductMultiImage(){
    var idImages=$(this).data('idimagesdelete');

    $.ajax({
        url:"models/moderator/products/deleteProductMultiImage.php", 
        method:"POST",
        data:{
            idImages:idImages
        },
        success: function () {
            viewProductMultiImages();
        },error:function(xhr,status,error){
            console.log(xhr,status,error)
        }
            
    });    

}


function viewProductMultiImages(){

    var idProduct=$("#idProductEdit").val();
    var multiImage=true;

    $.ajax({
        url:"models/moderator/products/getProductImage.php", 
        method:"GET",
        dataType:"JSON",
        data:{
            idProduct:idProduct,
            multiImage:multiImage
        },
        success: function (data) {
            viewMultiImage(data);
        },error:function(xhr,status,error){
            console.log(xhr,status,error)
        }
            
    });    
}

function viewPhoto(data){

    var result="";

    result=`<img src="${data.path}" alt="${data.alt}" />`;

    $("#productProfileImage").html(result);
}

function viewMultiImage(data){

    var result="";
    
    for(var item of data){
        result+=`
        <tr>
            <td><img src="${item.path}" alt="${item.alt}"/></td>
            <td>  
            <button type="button" class="buttonImage plava" data-idimages=${item.idImages} onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="userButton"><i class="fa fa-cog"></i></button>
            </td>
            <td>
            <button   type="button" class="deleteMultiImageButton f  adminModeratorButton"  data-idimagesdelete=${item.idImages}><i class="fa fa-close"></i></button>
            </td>
        </tr>`;
    }

    $("#multiImageProductEdit").html(result);

}

function editProductValidation(){
    var name=$("#editProductName");
    var alt=$("#editProductAlt");
    var quantity=$("#editProductQuantity");
    var desc=$("#editProductDesc");
    var category=$("#editProductCategory");
    var home=$("#editProductHome");
    var reNumber =/^[0-9]*$/;
    var reText=/[a-z]/;
    var data = [];
    var status=true;

    var button=$("#UpdateProducButton");
  

    if(name.val() == "") {
        status = false;
        error(name);
      
    }else if(!reText.test(name.val())) {
        status = false;
        error(name);
    }else {
        success(name);
    }

    if(alt.val() == "") {
        status = false;
        error(alt);
    }else if(!reText.test(alt.val())) {
        status = false;
        error(alt);
    }else {
        success(alt);
    }

    
    if(quantity.val() == "") {
        status = false;
        error(quantity);
    }else if(!reNumber.test(quantity.val())) {
        status = false;
        error(quantity);
    }else {
        success(quantity);
    }


    if(desc.val() == "") {
        status = false;
        error(desc);

    }else if(!reText.test(desc.val())) {
        status = false;
        error(desc);
    }else {
        success(desc);
    }

    if(home.val()==0){
        status = false;
        error(home);
    }else{
        success(home);
    }

    if(category.val()==0){
        status = false;
        error(category);
    }else{
        success(category);
    }


    if(status==false){
      $(button).prop( "disabled", true );
      $(button).addClass("buttonDisable");
    }else{
        $(button).prop( "disabled", false );
        $(button).removeClass("buttonDisable");
    }
  
}


function validationInputField(name,regEx){
  var name=$(name);
  if(name.val() == "") {
    status = false; 
    error(name);
  }else if(!regEx.test(name.val())) {
    status = false;
    error(name);
  }else if(regEx.test(name.val())){
    status = true;
    success(name);
  } 
  console.log(name);
  console.log(status);

  return status;
}

function validationSelectField(name){
  var name=$(name);
  var status=true;
  if(name.val()==0){
    status=false;
    error(name);
  }else{
    success(name);
  }
  return status;
}

function error(name){
  $(name).addClass("errorReg");
  $(name).removeClass("successReg");
}

function success(name){
  $(name).removeClass("errorReg");
  $(name).addClass("successReg");
}

function successData(){
    $("#info").html("<div id='notification' class='notificationColorGreen'>Successfully!</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
  }