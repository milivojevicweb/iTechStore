$(document).ready(function(){
    $(document).on('input','#oldPriceEdit,#newPriceEdit',percent);
    $(document).on('input','#percent',changeNewPrice);
    percent();

    $(document).on('click','#sendPriceUpdate',updatePrice);
    
});

function percent(){
    var oldPrice = parseInt($('#oldPriceEdit').val()); 
    var newPrice = parseInt($('#newPriceEdit').val());
    var perc="";
    if(isNaN(oldPrice) || isNaN(newPrice)){
        perc=" ";
    }else{
    perc =((oldPrice-newPrice)/oldPrice*100.0).toFixed(0);

    }

    $('#percent').val(perc);
} 

function changeNewPrice(){
    var oldPrice = parseInt($('#oldPriceEdit').val()); 
    var percent = parseInt($('#percent').val())/100;
    var newPrice="";
    if(isNaN(oldPrice) || isNaN(newPrice)){
        newPrice=" ";
    }else{
    newPrice =(oldPrice-(oldPrice * percent)).toFixed(0);
    }

    $('#newPriceEdit').val(newPrice);
}

function updatePrice(){

    var oldPrice=$("#oldPriceEdit").val();
    var newPrice=$("#newPriceEdit").val();
    var id=$(this).data('id');

    var regEx=/^\d+$/;
    var error="";
    if(!regEx.test(oldPrice)){
        error="oldPrice";
    }
    if(!regEx.test(newPrice)){
        error="newPrice";
    }
    if(!regEx.test(id)){
        error="id";
    }

    if(error==""){
        $.ajax({
            url:"models/moderator/products/editPrice.php",
            method:"POST",
            data:{
                oldPrice:oldPrice,
                newPrice:newPrice,
                id:id
            },success:function(data){
                successData();

            },error:showErrorAjax
        })
    }else{
        $("#statusPriceUpdate").html("Error!");
    }
}

function showErrorAjax(greska, status, statusText){
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

function successData(){
    $("#info").html("<div id='notification' class='notificationColorGreen'>Successfully!</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
}