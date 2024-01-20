$(document).ready(function(){
    $(document).on("click","#editUserButton",editUser);
    $(document).on("keyup",".userValidation",userValidation);
    $(document).on("change","#roleUserEdit,#contryUserEdit",userValidation);
});

function editUser(){
    var idUser=$(this).data('iduser');
    var name=$("#firstNameUserEdit").val();
    var lastName=$("#lastNameUserEdit").val();
    var email=$("#emailUserEdit").val();
    var role=$("#roleUserEdit").val();
    var city=$("#cityUserEdit").val();
    var zip=$("#zipUserEdit").val();
    var address=$("#addressUserEdit").val();
    var contry=$("#contryUserEdit").val();
    
    $.ajax({
        url:"models/admin/user/userEdit.php",
        method:"POST",
        data:{
            idUser:idUser,
            name:name,
            lastName:lastName,
            email:email,
            role:role,
            zip:zip,
            city:city,
            address:address,
            contry:contry
        },
        success:function(){
            successData();
        },error:errorAjax
})
}

function errorAjax(error, status, statusText){
    console.error('ERROR AJAX: ');
    console.log(status);
    console.log(statusText);
    if(error.status == 500){
        console.log(error.parseJSON);
        alert(error.parseJSON.poruka);
    }
    else if(error.status == 400){
        alert('Niste poslali ispravno parametre!')
    } 
  }

  
function userValidation(){
    var name=$("#firstNameUserEdit");
    var lastName=$("#lastNameUserEdit");
    var email=$("#emailUserEdit");
    var role=$("#roleUserEdit");
    var city=$("#cityUserEdit");
    var zip=$("#zipUserEdit");
    var address=$("#addressUserEdit");
    var contry=$("#contryUserEdit");
    var button=$("#editUserButton");


    var reName=/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14})*$/;
    var reLastName=/^[A-Z][a-z]+$/;
    var reEmail=/^\w+([.-]?[\w\d]+)*@\w+([.-]?[\w]+)*(\.\w{2,4})+$/;
    var reAddress=/^[a-zA-Z0-9šŠđĐžŽčČćĆ\s \/\-\.]+$/;
    var reCity=/^([\w]+\D|[\w]+\s[\w]+\D)$/;
    var reZip=/^[\d]{5}$/;

    valid=true;


    if(name.val() == "") {
        valid = false;
        error(name);
      
    }else if(!reName.test(name.val())) {
        valid = false;
        error(name);
    }else {
        success(name);
    }

    if(lastName.val() == "") {
        valid = false;
        error(lastName);
    }else if(!reLastName.test(lastName.val())) {
        valid = false;
        error(lastName);
    }else {
        success(lastName);
    }

    
    if(email.val() == "") {
        valid = false;
        error(email);
    }else if(!reEmail.test(email.val())) {
        valid = false;
        error(email);
    }else {
        success(email);
    }


    if(city.val() == "") {
        valid = false;
        error(city);

    }else if(!reCity.test(city.val())) {
        valid = false;
        error(city);
    }else {
        success(city);
    }

    
    if(address.val() == "") {
        valid = false;
        error(address);

    }else if(!reAddress.test(address.val())) {
        valid = false;
        error(address.val());
    }else {
        success(address);
    }

    if(zip.val() == "") {
        valid = false;
        error(zip);

    }else if(!reZip.test(zip.val())) {
        valid = false;
        error(zip);
    }else {
        success(zip);
    }

    if(role.val()==0){
        valid = false;
        error(role);
    }else{
        success(role);
    }

    if(contry.val()==0){
        valid = false;
        error(contry);
    }else{
        success(contry);
    }

    if(valid==false){
        $(button).prop( "disabled", true );
        $(button).addClass("buttonDisable");
    }else{
        $(button).prop( "disabled", false );
        $(button).removeClass("buttonDisable");
    }

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