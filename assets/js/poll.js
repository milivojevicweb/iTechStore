$(document).ready(function() {
    $(document).on('click', '#showResult', showResults);
    $(document).on('click', '#returnPoll', returnPoll);
    $(document).on('click', '#sendPoll', sendPoll);
    

    $(document).on('input','#numberAnswers',pollAnswers);
    $(document).on('click', '.deleteAnswer', deleteAnswer);



    $(document).on('click', '#sendPoll', answerStatistic);

    $(document).on('click', '#updatePollButton', editPoll);

    
    $(document).on('keyup','#editQuestion, .pollAddAnswers, .pollAnswerValidation',pollValidation);
    $(document).on('change','#numberAnswers',pollValidation);
    
});


document.querySelector("#returnPoll").style.display="none";
document.querySelector(".odgovori").style.display="none";

function showResults(){
  document.querySelector(".odgovori").style.display="block";
  document.querySelector("#anketa_form").style.display="none";
  document.querySelector("#showResult").style.display="none";
  document.querySelector("#returnPoll").style.display="block";

  
}

function returnPoll(){
    document.querySelector(".odgovori").style.display="none";
    document.querySelector("#anketa_form").style.display="block";
    document.querySelector("#returnPoll").style.display="none";
    document.querySelector("#showResult").style.display="block";

}

function sendPoll(){
    $(".poll_option").val();
    var radios = document.getElementsByName('anketa_vrednsot');
  
    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            var rez=radios[i].value;
            break;
        }
    }
    if(rez.length>1){
        document.querySelector(".odgovori").style.display="block";
        document.querySelector("#anketa_form").style.display="none";
        document.querySelector("#showResult").style.display="none";
        document.querySelector("#returnPoll").style.display="block";
        document.querySelector("#returnPoll").style.display="none";
        
    }


    $.ajax({
        url:'models/poll/sendPollUserAnswer.php',
        method:"POST",
        data:{
            poll:rez
        },
        success:function(data){

        },
        error:function(error){
          console.log(error);
          
        }
      })
    
}

function pollAnswers(){

    var number=parseInt($("#numberAnswers").val());
    var result="";
    for(var i=1; i<=number; i++){
        result+="<input type='text' class='darkEmptyBackround darkEmptyTextWhite  pollAnswers pollAddAnswers' name=answer"+i+" />";
    }
    
    $("#inputPoll").html(result);
    checkDarkMode();
}

function deleteAnswer(){

    var id=$(this).data('idanswer');

    $.ajax({
        url:"models/moderator/poll/deletePollAnswer.php",
        method:"POST",
        data:{
           id:id
        },
        success:function(){
            viewPollAnswer();
            successData();

        },error:errorAjax
    })

}



function editPoll(){
    var id=$(this).data('idpoll');
    var question=$("#editQuestion").val();
    answers=[];
    $(".pollAnswers").each(function () {                  
        var res = $(this).val();  
        if(res!=""){
            answers.push({name:res});
        }
        console.log(answers);

     });

     $.ajax({
         url:"models/moderator/poll/updatePoll.php",
         method:"POST",
         data:{
            id:id,
            question:question,
            answers:answers
         },
         success:function(){
            viewPollAnswer();
            successData();

         },error:errorAjax
     })


}

function  answerStatistic(){

    $.ajax({
        url:"models/poll/answerStatistic.php",
        method:"GET",
        dataType: 'json',
        success:function(data){
            $("#pollStatistic").html(data);
            $("#poll_result").html(data);
            console.log(data);
        },error:errorAjax
    })

}



function pollValidation(){
    var question=$("#editQuestion").val();
    var button= document.getElementById("updatePollButton");
    var pollStatus=$("#statusEditPoll");
    var status=true;


    
    if(question == "") {
        status=false;
    }
    

    $(".pollAddAnswers").each(function () {                  
        var res = $(this).val();
        if(res==""){
            status=false;
        }
    });



    $(".pollAnswerValidation").each(function () {                  
        var result = $(this).val();
        if(result==""){
            status=false;
        }
    });



    if(status==false){
        $(button).prop( "disabled", true );
        $(button).addClass("buttonDisable");
        pollStatus.html("Error!");
    }else{
        $(button).prop( "disabled", false );
        $(button).removeClass("buttonDisable");
        pollStatus.html("Success!");
    }
}

function viewPollAnswer(){
    var id=$("#pollId").val();
    $.ajax({
        url:"models/moderator/poll/getPollAnswers.php",
        method:"GET",
        dataType:"JSON",
        data:{
            id:id
        },
        success:function(data){
            printPollAnswer(data)
            successData();

        },error:errorAjax
    })

}

function  printPollAnswer(data){
    var html="";

    for(var item of data){
        html+=`
        <div class="row">
            <div class="col-25">
                <label>Answers</label>
            </div>
            <div class="col-75">    
                <input class='pollAnswers pollAnswerValidation pollInput' type="text" name="${item.answer}" value="${item.answer}"/><button  data-idanswer=${item.idPollAnswer} class="deleteAnswer f adminModeratorButton"><i class="fa fa-close"></i></button>
            </div>
        </div>
        `;
    }

    $("#pollAnswers").html(html);
}

function checkDarkMode(){
    if ($("#radio-b").is(':checked')) 
    {
      addDark();
        }
    else
    {
      removeDark();
    }
  }
  
  function addDark(){
    $('.darkEmptyBackround').addClass('darkBackground');
    $('.darkEmptyTextWhite').addClass('darkTextWhite');
  }
  
  function removeDark(){
    $('.darkEmptyBackround').removeClass('darkBackground');
    $('.darkEmptyTextWhite').removeClass('darkTextWhite');
  }

  function successData(){
    $("#info").html("<div id='notification' class='notificationColorGreen'>Successfully!</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
  }

  function errorAjax(greska, status, statusText){
    console.error('GRESKA AJAX: ');
    console.log(status);
    console.log(statusText);
    if(greska.status == 500){
        console.log(greska.parseJSON);
        alert(greska.parseJSON.poruka);
    }
    else if(greska.status == 400){
        alert('Niste poslali ispravno parametre!')
    } 
}  