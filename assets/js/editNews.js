$(document).ready(function(){
    $(document).on('keyup','#editNewsTitle',editNewsVailidation);
});
function editNewsVailidation(){

  var newsTitle=$('#editNewsTitle').val();
  var text=$("#cke_1_contents iframe").contents().find("html body p").html();
  var reText=/[a-z]/;

  var data = [];
  var status=true;
  var button=$("#editNewsButton");


  if(newsTitle == "") {
      status = false;
      error("#editNewsTitle");
    
  }else if(!reText.test(newsTitle)) {
      status = false;
      error("#editNewsTitle");
  }else {
      success("#editNewsTitle");
  }

  if(text == "<br>" || text=="" || text=="&nbsp;") {
      status = false;
      error("#cke_1_contents");
  }else {
      success("#cke_1_contents");
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
