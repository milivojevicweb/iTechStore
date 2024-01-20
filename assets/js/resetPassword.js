$(document).ready(function() {
    $(document).on('keyup','input:text, input:password',validation);
});

function validation(){
    var password=$("#passwordReset").val();
    var repeat=$("#passwordResetRepeat").val();
    var button=$("#resetPasswordButton")
    var reLozinka = /^(?=.*\d)(?=.*[A-zČĆŽŠĐčćžšđ])(?=.*[~!@#$%^&*<>?]).{6,}$/;
    var status=true;

    if(password == "") {
        status = false; 
        error("#passwordReset");
    } else if(!reLozinka.test(password)) {
        status = false;
        error("#passwordReset");
    } else {
        success("#passwordReset");
    }

    if(repeat == "" || repeat!=password) {
        status = false; 
        error("#passwordResetRepeat");
    } else if(!reLozinka.test(repeat) || repeat!=password) {
        status = false;
        error("#passwordResetRepeat");
    } else if(reLozinka.test(repeat) && repeat==password){
        success("#passwordResetRepeat");
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