$(document).ready(function(){

    $(document).on('keyup','#emailnewsletter',emailValidation);
    $(document).on('click','#newsletterbutton',checkEmail);
    $(document).on('click','#updateNewsletterButton',updateNewsletter);
    $(document).on('click','#sendNewsletterButton',sendNewsletterUpdate);


    $("#titleNewsleterEdit, #textareaNewsletterEdit").keyup(function(){
        oneParamValidation("#titleNewsleterEdit","#updateNewsletterButton","#textareaNewsletterEdit");
      })
});

function checkEmail(){
    var email=$('#emailnewsletter').val();

    if(email == "") {
        errorData();
        document.getElementById("newsletterbutton").disabled = true;
    }else{
        $.ajax({
            url:'models/newsletter/userEmail.php',
            method:'GET',
            data:{
                checkEmail:email
            },
            success: function(data){
                console.log(data.number);
                if(parseInt(data.number)>=1){
                    error("#emailnewsletter")
                    errorData();
                }else{
                    success("#emailnewsletter")
                    sendEmail();
                    successData();
                }
            }, 
              error: errorAjax
        })

    }

}

function sendEmail(){
    var email=$('#emailnewsletter').val();

    $.ajax({
        url:"models/newsletter/userEmail.php",
        method:"POST",
        data:{
            sendEmail:email
        },
        success: function(){
            
        }, 
          error: errorAjax
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


function emailValidation(){
    var email=$('#emailnewsletter').val();
    var reEmail=/^\w+([.-]?[\w\d]+)*@\w+([.-]?[\w]+)*(\.\w{2,4})+$/;
    var button=$("#newsletterbutton");

    if(email == "") {
        error("#emailnewsletter");
        $(button).prop( "disabled", true );
        $(button).addClass("buttonDisable");
        
    } else if(!reEmail.test(email)) {

        error("#emailnewsletter");
        $(button).prop( "disabled", true );
        $(button).addClass("buttonDisable");

    } else {
        success("#emailnewsletter")
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
  

function updateNewsletter(){
    var id=$(this).data('idnewsletter');
    var title=$("#titleNewsleterEdit").val();
    var code=$("#textareaNewsletterEdit").val();

    $.ajax({
        url:'models/moderator/newsletter/editNewsletter.php',
        method:'POST',
        data:{
            title:title,
            code:code,
            idnewsletter:id
        },
        success: function(data){
            successData();
        }, 
          error: errorAjax
    })

}

function sendNewsletterUpdate(){

    var title=$("#titleNewsleterEdit").val();
    var code=$("#textareaNewsletterEdit").val();
    var idnewsletter= $(this).data('idnewsletter');
        $.ajax({
            url:'models/moderator/newsletter/sendNewsletter.php',
            method:'POST',
            data:{
                title:title,
                code:code,
                idnewsletter:idnewsletter
            },
            success: function(data){
                successData();
                console.log(data);
            }, 
              error: errorAjax
        })


}

function oneParamValidation(nameId,button,secondName){
    var name=$(nameId);
    var button=$(button)
    var reText=/[a-z]/;

    var status=true

    if(secondName!=""){

        var sName=$(secondName);
        if(sName.val() == "") {
            status = false;
            error(sName);
          
        }else if(!reText.test(sName.val())) {
            status = false;
            error(sName);
        }else {
            status = true;
            success(sName);
        }

    }

    if(name.val() == "") {
        status = false;
        error(nameId);
      
    }else if(!reText.test(name.val())) {
        status = false;
        error(nameId);
    }else {
        status = true;
        success(nameId);
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

function successData(){
    $("#info").html("<div id='notification' class='notificationColorGreen'>Successfully!</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
  }

function errorData(){
    $("#info").html("<div id='notification' class='notificationColorRed'>Email error!</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
}