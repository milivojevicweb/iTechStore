$(document).ready(function() {
    multiImage();
    $(document).on('click','#addComment',sendComment);
    $(document).on('click','#addReply',replyComment);
    $(document).on('click','.delComment',dellComment);
    $(document).on('click','.oneProductBuyButton',addToCart);
    $(document).on('click','.delReplies',dellReplyComment);
    $(document).on('click','.minus-one',minusQuantity);
    $(document).on('click','.plus-one',plusQuantity);

    $(document).on('click','.minus-one', getProductQuantity);
    $(document).on('click','.plus-one', getProductQuantity);
  
    console.log($(".productQuantity").html());
    reply();
    replyMoreToggle();
    showMore();
    ratingSystem();
    printCartCount();
});

function sendComment(){
    var comment=$("#commentValue").val();
    var userId=$("#userId").val();
    var productId=$("#productId").val();  
    if(comment !=""){
        $.ajax({
            url:'models/products/sendProductComments.php',
            method:"POST",
            data:{
                comment:comment,
                userId:userId,
                productId:productId
            },
            success:function(){
                console.log("uspesno uneto");
                
            },error:function(e,ee,eee){
                console.log(e);
                console.log(ee);
                console.log(eee);
                
                
                
            }
        })
        $("#noText").html("Send!");
    }else{
        $("#noText").html("unesi komentar");
    }
    
    
    
}
    


function reply(){
    $(".replayArea").hide();
    jQuery('.replyButton').on('click', function(event) {
        jQuery(this).closest('.comment').find('.replayArea').toggle(500);
    });
}
function replyComment(){
    var commentId=$(this).data('id');
    var textareaId=".replayValue"+commentId;
    var comment=$(textareaId).val();

    var userId=".userId"+commentId;
    var user=$(userId).val();

    if(comment !=""){
        $.ajax({
            url:'models/products/sendRepliesComments.php',
            method:"POST",
            data:{
                user:user,
                commentId:commentId,
                comment:comment
            },
            success:function(){
                console.log("uspesno uneto");
                
            },error:function(e,ee,eee){
                console.log(e);
                console.log(ee);
                console.log(eee);
                
                
                
            }
        })
        $(".noText").html("Send!");
    }else{
        $(".noText").html("unesi komentar");
    }
    
    
}
function replyMoreToggle(){
    $(".repliesComment").hide();
    jQuery('.moreRepliesButton').on('click', function(event) {
        jQuery(this).closest('.comment').find('.repliesComment').toggle(500);
    });
}

function showMore(){
    $(document).on('click','#showCommentButton',function(){
        var elems = document.getElementsByClassName('ko');
        for (var i=0;i<elems.length;i+=1){
             elems[i].style.display = 'block';
        }
        
        $("#showCommentButton").hide();
        

    })
    
}

function dellComment(){
    var commentId=$(this).data('idcomment');
        $.ajax({
            url:'models/products/deleteComment.php',
            method:"POST",
            data:{
                commentId:commentId,
            },
            success:function(){
                $(".delText"+commentId).html("Successfully Deleted!")
                
            },error:function(e,ee,eee){
                console.log(e);
                console.log(ee);
                console.log(eee);
                
                
                
            }
        })

}

function dellReplyComment(){
    var repliesId=$(this).data('idreplie');
    $.ajax({
        url:'models/products/deleteComment.php',
        method:"POST",
        data:{
            repliesId:repliesId,
        },
        success:function(){
            $(".delText"+repliesId).html("Successfully Deleted!")
            
        },error:function(e,ee,eee){
            console.log(e);
            console.log(ee);
            console.log(eee);
            
            
            
        }
    })
}

function multiImage(){

console.log("radddd");



var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}



$(document).on("click", '#prev', {'param': -1}, function(event){
    plusSlides(event.data.param)
});
$(document).on("click", '#next', {'param': 1}, function(event){
    plusSlides(event.data.param)
});

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
 
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" activee", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " activee";

}
}

function ratingSystem(){


    var ratedIndex=-1;

    $(document).on('click','.fa-star',function(){
        ratedIndex= parseInt($(this).data('index'));
        
        var idProducts=$("#productIdrating").val();
        sendParametar(ratedIndex,idProducts);

        for (var i=0;i<ratedIndex;i++){
           $(".fa-star:eq("+i+")").css('color','#ff4f4f');
       }
       $("#productRatingNumber").val(ratedIndex)

   });

    var initialRating=parseInt($("#initalRating").val());
    

    var productRatingNumber=parseInt($("#productRatingNumber").val());

        var rating=0;
        if(productRatingNumber==0){
            rating=initialRating
        }else{
            rating=productRatingNumber
        }

    if(productRatingNumber==0){
        ratedIndex=rating;
        for (var i=0;i<rating;i++){
            $(".fa-star:eq("+i+")").css('color','rgb(255, 166, 0)');
        }
    }else{
        ratedIndex=rating;
        for (var i=0;i<rating;i++){
            $(".fa-star:eq("+i+")").css('color','#ff4f4f');
        }
    }
    


    $(document).on('mouseover','.fa-star',function(){
        var productRatingNumber=parseInt($("#productRatingNumber").val());
        restartColors();
        var currentIndex= parseInt($(this).data('index'));
        if(productRatingNumber==0){
        for (var i=0;i<currentIndex;i++){
            $(".fa-star:eq("+i+")").css('color','rgb(255, 166, 0)');
        }
        }else{
            for (var i=0;i<currentIndex;i++){
                $(".fa-star:eq("+i+")").css('color','#ff4f4f');
            }
        }
        
    });
    $(document).on('mouseleave','.fa-star',function(){
        var productRatingNumber=parseInt($("#productRatingNumber").val());
        restartColors();
        if(ratedIndex!=-1){
            if(productRatingNumber==0){
                for (var i=0;i<ratedIndex;i++){
                    $(".fa-star:eq("+i+")").css('color','rgb(255, 166, 0)');
                }
            }else{
                for (var i=0;i<ratedIndex;i++){
                    $(".fa-star:eq("+i+")").css('color','#ff4f4f');
                }
            }
        }

    });

    function restartColors(){
        $(".fa-star").css('color','rgba(255, 166, 0, 0.411)');
    }

    function sendParametar(index,idProducts){
        $.ajax({
            url:"models/products/ratingSystem.php",
            method:"POST",
            data:{
                index:index,
                idProducts:idProducts
            },
            success:function(data){
                $("#ratingSpan").html("("+data+")");
            },error:function(){

            }
        })
    }



}



function productsInCart() {
    return JSON.parse(localStorage.getItem("products"));
}

function addToCart() {
    let id = $(this).data("idcart");
    let price = $(this).data("price");

    var quantity=parseInt($("#addProductToCartNumber").val());
        if(quantity!=0){
        console.log("quantity "+quantity);
            var products = productsInCart();
        
            if(products) {
                if(productIsAlreadyInCart()) {
                    updateQuantity();
                } else {
                    addToLocalStorage()
                }
            } else {
                addFirstItemToLocalStorage();
            }
            addToCartNotification();


            function productIsAlreadyInCart() {
                return products.filter(p => p.id == id).length;
            }

            function addToLocalStorage() {
                var quantity=parseInt($(".productQuantity").html());
                console.log(quantity);
                let products = productsInCart();
                products.push({
                    id : id,
                    quantity : quantity,
                    price:price
                });
                localStorage.setItem("products", JSON.stringify(products));
                printCartCount();
            }

            function updateQuantity() {
                let products = productsInCart();
                var quantity=parseInt($(".productQuantity").html());

                for(let i in products)
                {
                    if(products[i].id == id) {
                        var curentQunatity =products[i].quantity;
                        products[i].quantity=curentQunatity+quantity;
                        break;
                    }      
                }

                localStorage.setItem("products", JSON.stringify(products));
                printCartCount();
            }

            

            function addFirstItemToLocalStorage() {
                var quantity=parseInt($(".productQuantity").html());
                let products = [];
                products[0] = {
                    id :  id,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                    quantity : quantity,
                    price:price
                };
                localStorage.setItem("products", JSON.stringify(products));
                printCartCount();
            }

        
    }else{
        addToCartNotificationError();
    }
}



function clearCart() {
    localStorage.removeItem("products");
}
function getLS(name) {
  return JSON.parse(localStorage.getItem(name));
 }
 
function hasLS(name) {
  return localStorage.getItem(name) != null;
 }
 function printCartCount() {
  if (hasLS("products")) {
  let count = 0,
  books = getLS("products");
  for (let book of books) {
  count += book.quantity;
  }
  $(".badge_cart").text(count);
  } else {
  $(".badge_cart").text(0);
  }
}

function minusQuantity(){
    var quantity=parseInt($(".productQuantity").html());
    var html=0;
    if(quantity==0){
        html=0;
    }else{
        html=quantity-1;
    }
    $(".productQuantity").html(html);
    $("#addProductToCartNumber").val(html);
}

function plusQuantity(){
    var quantity=parseInt($(".productQuantity").html());
    $("#addProductToCartNumber").val(quantity);
    html=quantity+1;
    $(".productQuantity").html(html);
}

function getProductQuantity(){
    var quantity=parseInt($(".productQuantity").html());
    $("#addProductToCartNumber").val(quantity);
    var id=$(this).data('id');
    $.ajax({
        url:"models/products/getProductQuantity.php",
        method:"GET",
        dataType:"JSON",
        data:{
            oneProductId:id
        },
        success:function(data){

            if (quantity > parseInt(data.Quantity)) {
                $(".productQuantity").html(data.Quantity);
                $('.plus-one ').prop('disabled', true);
            }else{
                $('.plus-one ').prop('disabled', false);
            }
        
        },error:function(){

        }
    })
}


function addToCartNotification(){
    $("#info").html("<div id='notification' class='notificationColorGreen'>Cart successfully updated!</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
}
function addToCartNotificationError(){
    $("#info").html("<div id='notification' class='notificationColorRed'>select product number!</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
}