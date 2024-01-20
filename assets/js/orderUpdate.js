$(document).ready(function(){
    $(document).on('click','#changeStatus',changeStatus);
    
})

function changeStatus(){
    var id = $(this).data('id');
    let value= $("#statusOrder").val();
    $.ajax({
        url: "models/moderator/order/statusChange.php",
        method: "POST",
        data: {
            id: id,
            value:value
        },
        success: function(){
            showStatus(id);
            
        },
        error: function(xhr, greska, status){
            alert(greska);
        }
    })
    
}

function showStatus(id){

    
    $.ajax({
        url: 'models/moderator/order/getStatus.php',
        method: 'GET',
        data: {
            id: id
        },
        success: function(items){
            status(items);
            console.log(items.status);
            
        }, 
        error: function(xhr, greska, status){
            console.log(xhr);
            console.log(greska);
            console.log(status);
            
        }
    })
}

function status(items){
    let upis;
    if(items.idOrderStatus==1){
        upis="Processing in progress <span class='wait'><i class='fa fa-circle'></i></span>";
    }else if(items.idOrderStatus==2){
        upis="Delivered <span class='sell'>  <i class='fa fa-circle'></i></span>";
    }else{
        upis="Canceled <span class='error'><i class='fa fa-circle'></i></span>";
    }
    $("#status").html(upis);
}