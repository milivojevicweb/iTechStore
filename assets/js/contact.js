$(document).ready(function() {
  $(document).on('keyup','input,textarea',checkContact);
  $(document).on('click','#sendContact',sendContact);
});
function checkContact(){
  var name=$('#name').val();
  var email=$('#email').val();
  var phone=$('#phone').val();
  var text=$('#textarea').val();
  var button=$("#sendContact")

  var reName=/^[A-ZŽŠĐČĆ][a-zžšđčć]{1,30}\s[A-ZŽŠĐČĆ][a-zžšđčć]{1,30}$/;
  var reEmail=/^\w+([.-]?[\w\d]+)*@\w+([.-]?[\w]+)*(\.\w{2,4})+$/;
  var rePhone =/^[0-9]*$/;

  var status=true;

  if(text == "") {
    status = false;
    error("#textarea");
  } else {
    success("#textarea");
      
  }

  if(name == "") {
    status = false;
      error("#name");
      
  } else if(!reName.test(name)) {
    status = false;
      error("#name");
  } else {
      success("#name");
  }

  if(email == "") {
    status = false;
      error("#email");
      
  } else if(!reEmail.test(email)) {
    status = false;
      error("#email");
  } else {
      success("#email");
  }

  if(phone == "") {
    status = false;
      error("#phone");
      
  } else if(!rePhone.test(phone)) {
    status = false;
      error("#phone");
  } else {
      success("#phone");
  }

  if(status==false){
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

function sendContact(){
    var name=$('#name').val();
    var email=$('#email').val();
    var phone=$('#phone').val();
    var text=$('#textarea').val();
    $.ajax({
        url:"models/contact/contact.php",
        method:"POST",
        data:{
            name:name,
            email:email,
            phone:phone,
            text:text,
            sendContact:true
        },success:function(){
            successData();
        },error:function(){

        }
    })
}

function successData(){
    $("#info").html("<div id='notification' class='notificationColorGreen'>Successfully!</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
  }