$(document).ready(function(){

    $("html,body").addClass('adminModeratorBg');

    togleElementsForOrdes();
    

    $(document).on('keyup','#inputOrder',searchOrderId);


    $(document).on('click','#newsletterButtonModerator, #sendNewsletter',sendNewsletter);
    $(document).on('click', '.deleteNewsletterButton', deleteNewsletter);

    $(document).on('input','#numberAnswers',pollAnswers);
    $(document).on('click','#insertPollButton',sendPoll);

    $(document).on('click', '.deletePoll', deletePoll);
    $(document).on('click', '.changestatuspoll', changeStatusPoll);

    $(document).on('keyup','#question, .pollAnswers',pollValidation);
    $(document).on('change','#numberAnswers',pollValidation);
    
    $(document).on('click','.pollStatistic',pollStatistic);
    
    $(document).on('click', '.changestatuspoll', activePollStatistic);

    $("#updateCategoryName").keyup(function(){
        oneParamValidation("#updateCategoryName","#editCategoryButton");
    })

    $("#categoryName").keyup(function(){
        oneParamValidation("#categoryName","#addCategoryButton");
    })
    
    $("#newsletterTitle, #newsletterCode").keyup(function(){
        oneParamValidation("#newsletterTitle","#newsletterButtonModerator","#newsletterCode");
    })
    
    
    $("#altInsertProduct,#nameInsertProduct,#descInsertProduct,#oldPriceInsertProduct,#newPriceInsertProduct,#quantityInsertProduct").keyup(checkInsertProduct);
    $(document).on('change','#profilePhoto,#multiProfilePhoto,#categoryInsertProduct,#homeInsertProduct',checkInsertProduct);

    $(document).on('keyup','#newsTitle',newsValidationModerator);
    $(document).on('change','#profilePhoto2',newsValidationModerator);

    $(document).on('click', '#insertProductButton', insertProductParametar);

    $(document).on('click', '#addCategoryButton', addCategory);

    $(document).on('click', '#editCategoryButton', editCategory);

    $(document).on('click', '.buttonCategory', fillCategoryInfo);

    
    $(document).on('click', '.deleteCategoryButton', deleteCategory);
    
    $(document).on('click', '.brisanjeProizvod', deleteProduct);
    
    $(document).on('click', '.brisanjeVesti', deleteNews);



    $(document).on('click', '.deleteContryButton', deleteContry);
    $(document).on('click', '.buttonContry', fillContryInfo);
    $(document).on('click', '#editContryButton', editContry);
    $(document).on('click', '#insertContryButton', addContry);
    
    $("#updateContryName").keyup(function(){
        oneParamValidation("#updateContryName","#editContryButton");
    })

    $("#contryNameInsert").keyup(function(){
        oneParamValidation("#contryNameInsert","#insertContryButton");
    })


    /////Pagination///////

    paginationNumberModerator("Products");
    $("#paginationModeratorProducts").on('click','.pagProducts',paginationModerator);

    paginationNumberModerator("News");
    $("#paginationModeratorNews").on('click','.pagNews',paginationModerator);

    paginationNumberModerator("Category");
    $("#paginationModeratorCategory").on('click','.pagCategory',paginationModerator);

    paginationNumberModerator("Newsletter");
    $("#paginationModeratorNewsletter").on('click','.pagNewsletter',paginationModerator);

    paginationNumberModerator("Poll");
    $("#paginationModeratorPoll").on('click','.pagPoll',paginationModerator);

    paginationNumberModerator("Contry");
    $("#paginationModeratorContry").on('click','.pagContry',paginationModerator);

    paginationNumberModerator("Order");
    $("#paginationModeratorOrder").on('click','.pagOrder',paginationModeratorOrder);

    $(document).on('click', '.ordersB', getStatus);
    $(document).on('click', '.paymentButton', getPaymentMethod);

    $(document).on('click', '#searchDate', dateSearch)

    $(document).on('click','.productStatus',statusProductPagination);
    
    $(document).on('click','.productCategory',categoryProductPagination);

    $(document).on('keyup','#productSearchInput',searchProductPagination);






      
    var close = document.getElementsByClassName("closebtn2");
    var i;
    
    for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
    }
    
});

function deleteProduct(){

    let id = $(this).data('id');

    $.ajax({
        url: 'models/moderator/products/deleteProduct.php',
        method: 'GET',
        data: {
            id: id
        },
        success: function(){
            var name="Products";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
        }, 
        error: prikaziGreskeAjax
    })
}

function productView(){
  $.ajax({
      url: 'models/moderator/products/getProducts.php',
      method: 'GET',
      dataType: 'json',
      success: function(data){
          products(data);
      }, 
      error: prikaziGreskeAjax
  })
}


function prikaziGreskeAjax(greska, status, statusText){
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
  

function deleteNews(){

    let idNews = $(this).data('idvest');

    $.ajax({
        url: 'models/moderator/news/deleteNews.php',
        method: 'POST',
        data: {
            idNews: idNews
        },
        success: function(){
            var name="News";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
        }, 
        error: prikaziGreskeAjax
    })
}


function getNews(){
  $.ajax({
      url: 'models/moderator/news/getNews.php',
      method: 'GET',
      dataType: 'json',
      success: function(podaci){
          news(podaci);
      }, 
      error: prikaziGreskeAjax
  })
}

function news(podaci){
let html = "", rb = 1;
for(let item of podaci){
    html += printNews(item);
    rb++;
}

$("#prikazVesti").html(html);
}

function printNews(item){
return `<tr><td data-label=""><img src="${item.image}" alt="${item.title}" class="slikaModerator"/></td>
        <td data-label="Title">${item.title.slice(0,30)}...</td>
        <td data-label="Date">${item.date}</td>
        <td data-label="Edit"><a class="plava" href="index.php?page=editNews&idNews=${item.idNews}"><i class="fa fa-cog"></i></a></td>
        <td data-label="Delete"><button type="button" class="f brisanjeVesti adminModeratorButton" data-idvest="${item.idNews}"><i class="fa fa-close"></i></button></td></tr>`;
}


function prikaziGreskeAjax(greska, status, statusText){
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

function getStatus(){
    var statusOrder=$(this).data('idstatus');
    var id=$("#inputOrder").val();
    var firstDate=$("#datumOd").val();
    var secondDate=$("#datumDo").val();
    $("#statusOrder").val(statusOrder);
    var payment=$("#paymentOrder").val();
    $.ajax({
      url:'models/moderator/pagination/searchFilterOrder.php',
      method:"GET",
      dataType:"JSON",
      data:{
            searchId:id,
            firstDate:firstDate,
            secondDate:secondDate,
            statusOrder:statusOrder,
            payment:payment

      },
      success:function(data){
        ordersView(data);
        updatePaginationOrder();
      },
      error:function(error){
        console.log(error);
        
      }
    })
}

function getPaymentMethod(){
    var payment=$(this).data('idpayment');
    var statusOrder=$("#statusOrder").val()
    var id=$("#inputOrder").val();
    var firstDate=$("#datumOd").val();
    var secondDate=$("#datumDo").val();
    $("#paymentOrder").val(payment);
    $.ajax({
      url:'models/moderator/pagination/searchFilterOrder.php',
      method:"GET",
      dataType:"JSON",
      data:{
            searchId:id,
            firstDate:firstDate,
            secondDate:secondDate,
            statusOrder:statusOrder,
            payment:payment

      },
      success:function(data){
        ordersView(data);
        updatePaginationOrder();
      },
      error:function(error){
        console.log(error);
        
      }
    })
}

function dateSearch(){
    var id=$("#inputOrder").val();
    var firstDate=$("#datumOd").val();
    var secondDate=$("#datumDo").val();
    var statusOrder=$("#statusOrder").val();
    var payment=$("#paymentOrder").val();
    $.ajax({
      url:'models/moderator/pagination/searchFilterOrder.php',
      method:"GET",
      dataType:"JSON",
      data:{
            searchId:id,
            firstDate:firstDate,
            secondDate:secondDate,
            statusOrder:statusOrder,
            payment:payment

      },
      success:function(data){
        ordersView(data);
        updatePaginationOrder();
      },
      error:function(error){
        console.log(error);
        
      }
    })

}
function searchOrderId() {
    var id=$("#inputOrder").val();
    var firstDate=$("#datumOd").val();
    var secondDate=$("#datumDo").val();
    var statusOrder=$("#statusOrder").val();
    var payment=$("#paymentOrder").val();
    $.ajax({
      url:'models/moderator/pagination/searchFilterOrder.php',
      method:"GET",
      dataType:"JSON",
      data:{
            searchId:id,
            firstDate:firstDate,
            secondDate:secondDate,
            statusOrder:statusOrder,
            payment:payment
      },
      success:function(data){
        ordersView(data);
        updatePaginationOrder();
      },
      error:function(error){
        console.log(error);
        
      }
    })
  }
function ordersView(data){
    var upis="";
    for(let item of data){
    upis+=`
    <tr>
        <td data-label="Orders Id">${item.idOrders}</td>
        <td data-label="Price">${item.total}</td>
        <td data-label="Date">${item.dateOrders}</td>
        <td data-label="User name">${item.name} ${item.lastName}</td>
        <td data-label="Payment Method">${item.payment}</td>
        <td data-label="Status">`;if(item.idOrderStatus==1){upis+=`${item.status} <span class='wait'><i class='fa fa-circle'></i></span>`}else if(item.idOrderStatus==2){upis+=`${item.status} <span class='sell'>  <i class='fa fa-circle'></i></span>`;}else{upis+=`${item.status} <span class='error'><i class='fa fa-circle'></i></span>`}upis+=`</td>
        <td data-label="Info" class="details"><a href="index.php?page=orderDetails&id=${item.idOrders}">Details</a></td>
    </tr>
    `;
    }
    $("#orderProducts").html(upis);
}

function togleElementsForOrdes(){
    $("#sortOrdersSection").hide();
    $("#statusButton").click(function(){
        $("#sortOrdersSection").toggle("1000");
    });

    $("#searchOrdersSection").hide();
    $("#searchButton").click(function(){
        $("#searchOrdersSection").toggle("1000");
    });

    $("#dateSection").hide();
    $("#dateOrdesButton").click(function(){
        $("#dateSection").toggle("1000");
    });

    $("#statisticHidden").hide();
    $("#statisticButton").click(function(){
        $("#statisticHidden").toggle("1000");
    });
    
    $("#paymentMethodOrderSection").hide();
    $("#paymentMethodButton").click(function(){
        $("#paymentMethodOrderSection").toggle("1000");
    });

    $("#productStatusSection").hide();
    $("#productStatusButton").click(function(){
        $("#productStatusSection").toggle("1000");
    });

    $("#productCategorySection").hide();
    $("#productCategoryButton").click(function(){
        $("#productCategorySection").toggle("1000");
    });

    $("#productSearchSection").hide();
    $("#productSearchButton").click(function(){
        $("#productSearchSection").toggle("1000");
    });

    
    $(".moderatorProductTab").hide();
    $("#moderatoProductButton").click(function(){
        $(".moderatorProductTab").toggle("1000");
    });

    $(".moderatorNewsTab").hide();
    $("#moderatoNewsButton").click(function(){
        $(".moderatorNewsTab").toggle("1000");
    });
    
    $(".moderatorCategoryTab").hide();
    $("#moderatoCategoryButton").click(function(){
        $(".moderatorCategoryTab").toggle("1000");
    });

    $(".moderatorNewsletterTab").hide();
    $("#moderatoNewsletterButton").click(function(){
        $(".moderatorNewsletterTab").toggle("1000");
    });

    $(".moderatorPollTab").hide();
    $("#moderatoPollButton").click(function(){
        $(".moderatorPollTab").toggle("1000");
    });

    $("#adminModeratorHiddenNav").click(function(){
        $("#sidebar").toggle("1000");
    });

    $(".moderatorContryTab").hide();
    $("#moderatoContryButton").click(function(){
        $(".moderatorContryTab").toggle("1000");
    });

}



function sendNewsletter(){

var title=$("#newsletterTitle").val();
var code=$("#newsletterCode").val();
var button= $("#newsletterButtonModerator").val();
    $.ajax({
        url:'models/moderator/newsletter/sendNewsletter.php',
        method:'POST',
        data:{
            title:title,
            code:code,
            button:button
        },
        success: function(data){
            var name="Newsletter";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
        }, 
            error: errorAjax
    })
}

function deleteNewsletter(){
    var id=$(this).data('idnewsletter');
    $.ajax({
        url:"models/moderator/newsletter/deleteNewsletter.php",
        method:"POST",
        data:{
            id:id
        },
        success:function(){
            var name="Newsletter";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
        },error:errorAjax
    })
}

function viewNewsletter(){
    $.ajax({
        url:"models/moderator/newsletter/getNewsletter.php",
        method:"GET",
        dataType:"JSON",
        success:function(data){
            newsletter(data);
        },error:errorAjax
    })
}

function newsletter(data){
    var result="";

    for(var item of data){
        result+=`
        <tr>
            <td data-label="Newsletter Id">${item.idNewsletter}</td>
            <td data-label="Title">${item.title}</td>
            <td data-label="Date">${item.date}</td>
            <td data-label="Edit"><a class="plava adminModeratorButton" href="index.php?page=editNewsletter&id=${item.idNewsletter}"><i class="fa fa-cog"></i></a></td>
            <td data-label="Delete"><button class="deleteNewsletterButton f adminModeratorButton " data-idnewsletter="${item.idNewsletter}"><i class="fa fa-close"></i></button></td>
        </tr>
        `;
    }

    $("#newsletterTbody").html(result);
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

function percent(){
    var oldPrice = parseInt($('#oldPriceEdit').val()); 
    var newPrice = parseInt($('#newPriceEdit').val());
    var perc="";
    if(isNaN(oldPrice) || isNaN(newPrice)){
        perc=" ";
    }else{
       perc = ((oldPrice/newPrice) * 100).toFixed(3);
    }

    $('#percent').val(perc);
}

function pollAnswers(){
var number=parseInt($("#numberAnswers").val());
var result="";
for(var i=1; i<=number; i++){
    result+="<input type='text' class='darkEmptyLightBackground darkEmptyTextWhite  pollAnswers' name=answer"+i+" />";
    
}
$("#inputPoll").html(result);
checkDarkMode();
}

function sendPoll(){
    var question=$("#question").val();
        answers=[];
        $(".pollAnswers").each(function () {                  
            var res = $(this).val();
            if(res!=""){
                answers.push({name:res});
            }
        });

        $.ajax({
            url:"models/moderator/poll/insertAnswer.php",
            method:"POST",
            data:{
                question:question,
                answers:answers
            },
            success:function(){
                var name="Poll";
                paginationNumberModerator(name);
                updatePaginationModerator(name);
                successData();
            },error:errorAjax
        })
}

function viewPoll(){
    $.ajax({
        url:"models/moderator/poll/getPoll.php",
        method:"GET",
        dataType:"JSON",
        success:function(data){
            poll(data);
        },error:errorAjax
    })
}

function poll(data){
    var result="";

    for(var item of data){
        result+=`
        <tr>
            <td data-label="Id">${item.idPoll}</td>
            <td data-label="Question">${item.question}</td>`;
            if(item.status==1){
                result+=`<td data-label="Active"><button type='button' data-idpoll=${item.idPoll} id='activeStatusPoll' class='changestatuspoll'><i class="fa fa-eye"></i></button></td>`;
            }else{
                result+=`<td data-label="Active"><button type='button' data-idpoll=${item.idPoll} class='noActiveStatusPoll changestatuspoll'><i class="fa fa-eye-slash"></i></button></td>`;
            }
            result+=`
            <td data-label="Statistic"><button onclick="document.getElementById('polStatisticModal').style.display='block'" class="plava pollStatistic adminModeratorButton" data-id=${item.idPoll}><i class="fa fa-bar-chart"></i></button></td>
            <td data-label="Edit"><a class="plava" href="index.php?page=editPoll&id=${item.idPoll}"><i class="fa fa-cog"></i></a></td>
            <td data-label="Delite"><button class="deletePoll f  adminModeratorButton" data-idpoll="${item.idPoll}"><i class="fa fa-close"></i></button></td>
        </tr>
        `;
    }

    $("#pollTableBody").html(result);
}
function deletePoll(){
    var id=$(this).data('idpoll');
    $.ajax({
        url:"models/moderator/poll/deletePoll.php",
        method:"POST",
        data:{
            id:id
        },
        success:function(){
            var name="Poll";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
        },error:errorAjax
    })
}

function changeStatusPoll(){
    var id=$(this).data('idpoll');
    $.ajax({
        url:"models/moderator/poll/changePollStatus.php",
        method:"POST",
        data:{
            id:id
        },
        success:function(){
            var name="Poll";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
        },error:errorAjax
    })
}


function pollValidation(){
    var question=$("#question").val();
    var button= document.getElementById("insertPollButton");
    var pollStatus=$("#pollStatus");
    var button= document.getElementById("insertPollButton");
    var error=true;

    if(question == "") {
        error=false;
        button.disabled = true;
    }
    
    $(".pollAnswers").each(function () {                  
        var res = $(this).val();
        if(res==""){
            error=false;
            button.disabled = true;
        }
    });

    if(error==false){
        $(button).prop( "disabled", true );
        $(button).addClass("buttonDisable");
        pollStatus.html("Error!");
    }else{
        $(button).prop( "disabled", false );
        $(button).removeClass("buttonDisable");
        pollStatus.html("Success!");
    }
}

function checkInsertProduct(){
var profilePhoto=$('#profilePhoto').val();
var multiProfilePhoto=$('#multiProfilePhoto').val();
var alt=$('#altInsertProduct').val();
var name=$('#nameInsertProduct').val();
var desc=$('#descInsertProduct').val();
var oldPrice=$('#oldPriceInsertProduct').val();
var newPrice=$('#newPriceInsertProduct').val();
var quantity=$('#quantityInsertProduct').val();
var category=$('#categoryInsertProduct').val();
var home=$('#homeInsertProduct').val();



var rePrice =/^[0-9]*$/;
var reText=/[a-z]/;

    valid=true;

    if(profilePhoto == "") {
        valid = false;
        error("#addImageProductModerator");
    }else {
        success("#addImageProductModerator");
      
    }

    if(multiProfilePhoto == "") {
        valid = false;
        error("#addImageMultiProductModerator");
    }else {
        success("#addImageMultiProductModerator");
      
    }

    if(name == "") {
        valid = false;
        error("#nameInsertProduct");
      
    }else if(!reText.test(name)) {
        valid = false;
        error("#nameInsertProduct");
    }else {
        success("#nameInsertProduct");
    }

    if(alt == "") {
        valid = false;
        error("#altInsertProduct");
    }else if(!reText.test(alt)) {
        valid = false;
        error("#altInsertProduct");
    }else {
        success("#altInsertProduct");
    }

    
    if(desc == "") {
        valid = false;
        error("#descInsertProduct");
    }else if(!reText.test(alt)) {
        valid = false;
        error("#descInsertProduct");
    }else {
        success("#descInsertProduct");
    }


    if(oldPrice == "") {
        valid = false;
        error("#oldPriceInsertProduct");

    }else if(!rePrice.test(oldPrice)) {
        valid = false;
        error("#oldPriceInsertProduct");
    }else {
        success("#oldPriceInsertProduct");
    }

    
    if(newPrice == "") {
        valid = false;
        error("#newPriceInsertProduct");

    }else if(!rePrice.test(newPrice)) {
        valid = false;
        error("#newPriceInsertProduct");
    }else {
        success("#newPriceInsertProduct");
    }

    if(quantity == "") {
        valid = false;
        error("#quantityInsertProduct");

    }else if(!rePrice.test(quantity)) {
        valid = false;
        error("#quantityInsertProduct");
    }else {
        success("#quantityInsertProduct");
    }

    if(category==0){
        valid = false;
        error("#categoryInsertProduct");
    }else{
        success("#categoryInsertProduct");
    }

    if(home==0){
        valid = false;
        error("#homeInsertProduct");
    }else{
        success("#homeInsertProduct");
    }

    if(valid==false){
        $("#insertProductButton").prop( "disabled", true );
        $("#insertProductButton").addClass("buttonDisable");
    }else{
        $("#insertProductButton").prop( "disabled", false );
        $("#insertProductButton").removeClass("buttonDisable");
    }

}

function newsValidationModerator(){
    var profilePhoto=$('#profilePhoto2').val();
    var newsTitle=$('#newsTitle').val();
    var text=$("#cke_1_contents iframe").contents().find("html body p").html();

    var reText=/[a-z]/;

    valid=true;

    if(profilePhoto == "") {
        valid = false;
        error("#addNewsImageModerator");
    }else {
        success("#addNewsImageModerator");
      
    }


    if(newsTitle == "") {
        valid = false;
        error("#newsTitle");
      
    }else if(!reText.test(newsTitle)) {
        valid = false;
        error("#newsTitle");
    }else {
        success("#newsTitle");
    }

    if(text == "<br>" || text=="" || text=="&nbsp;") {
        valid = false;
        error("#cke_1_contents");
    }else {
        success("#cke_1_contents");
    }

   

    if(valid==false){
        $("#addNewsModerator").prop( "disabled", true );
        $("#addNewsModerator").addClass("buttonDisable");
    }else{
        $("#addNewsModerator").prop( "disabled", false );
        $("#addNewsModerator").removeClass("buttonDisable");
    }
}




function insertProductParametar(){
    
    var alt=$('#altInsertProduct').val();
    var name=$('#nameInsertProduct').val();
    var desc=$('#descInsertProduct').val();
    var oldPrice=$('#oldPriceInsertProduct').val();
    var newPrice=$('#newPriceInsertProduct').val();
    var quantity=$('#quantityInsertProduct').val();
    var category=$('#categoryInsertProduct').val();
    var home=$('#homeInsertProduct').val();
    var addProduct="as";    

    var fd = new FormData();
    fd.append('alt',alt);
    fd.append('name',name);
    fd.append('desc',desc);
    fd.append('oldPrice',oldPrice);
    fd.append('newPrice',newPrice);
    fd.append('quantity',quantity);
    fd.append('category',category);
    fd.append('home',home);
    fd.append('addProduct',addProduct);
    
    var files = $('#profilePhoto')[0].files;
    fd.append('image',files[0]);

    var totalfiles = document.getElementById('multiProfilePhoto').files.length;
    for (var index = 0; index < totalfiles; index++) {
        fd.append("multiImage[]", document.getElementById('multiProfilePhoto').files[index]);
    }




    $.ajax({
        url: 'models/moderator/products/addProduct.php', 
        type: 'POST',
        data:fd,
        contentType: false,
        processData: false,
        success: function (response) {
            var name="Products";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
            successData();
        },error:errorAjax
            
    });
    
}


function addCategory(){

    var categoryName=$("#categoryName").val();

    $.ajax({
        url: 'models/moderator/category/addCategory.php', 
        method: 'POST',
        data:{
            categoryName:categoryName
        },
        success: function () {
            var name="Category";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
            successData();
        },error:errorAjax
            
    });
}

function editCategory(){
    var categoryName=$("#updateCategoryName").val();
    var categoryId=$("#categotyEditId").val();

    $.ajax({
        url: 'models/moderator/category/editCategory.php', 
        method: 'POST',
        data:{
            categoryName:categoryName,
            categoryId:categoryId
        },
        success: function () {
            var name="Category";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
            successData();
        },error:errorAjax
            
    });
}

function deleteCategory(){
    var categoryId=$(this).data('idcategory');

    $.ajax({
        url: 'models/moderator/category/deleteCategory.php', 
        method: 'POST',
        data:{
            categoryId:categoryId
        },
        success: function () {
            var name="Category";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
        },error:errorAjax
            
    });
}


function viewCategory(data){
    var result="";

    for( var item of data){
        result+=`
        <tr>
            <td data-label="Category Id">${item.idCategory}</td>
            <td data-label="Name">${item.name}</td>
            <td data-label="Edit"><button class="buttonCategory plava adminModeratorButton" data-idcategory=${item.idCategory} onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-cog"></i></button></td>
            <td data-label="Delete"><button class="deleteCategoryButton f adminModeratorButton " data-idcategory=${item.idCategory}  type="button"><i class="fa fa-close"></i></button></td>
        </tr>
        `;
    }

    $("#showCategory").html(result);

}

function fillCategoryInfo(){
    var id=$(this).data('idcategory');
    $("#categotyEditId").val(id);

    $.ajax({
        url: 'models/moderator/category/getCategoryInfo.php', 
        method: 'GET',
        dataType:"JSON",
        data:{
            id:id
        },
        success: function (data) {
            $("#updateCategoryName").val(data.name);
            console.log(data.name);
        },error:errorAjax
            
    });
    
}

function deleteContry(){
    var contryId=$(this).data('idcountry');

    $.ajax({
        url: 'models/moderator/country/deleteCountry.php', 
        method: 'POST',
        data:{
            contryId:contryId
        },
        success: function () {
            var name="Contry";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
        },error:errorAjax
            
    });
}

function fillContryInfo(){
    var id=$(this).data('idcountry');
    $("#contryEditId").val(id);
    $.ajax({
        url: 'models/moderator/country/getCountryInfo.php', 
        method: 'GET',
        dataType:"JSON",
        data:{
            id:id
        },
        success: function (data) {
            $("#updateContryName").val(data.name);

        },error:errorAjax
            
    });
    
}

function editContry(){
    var contryName=$("#updateContryName").val();
    var contryId=$("#contryEditId").val();

    $.ajax({
        url: 'models/moderator/country/editCountry.php', 
        method: 'POST',
        data:{
            contryName:contryName,
            contryId:contryId
        },
        success: function () {
            var name="Contry";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
            successData();
        },error:errorAjax
            
    });
}

function addContry(){
    var contryName=$("#contryNameInsert").val();

    $.ajax({
        url: 'models/moderator/country/addCountry.php', 
        method: 'POST',
        data:{
            contryName:contryName
        },
        success: function () {
            var name="Contry";
            paginationNumberModerator(name);
            updatePaginationModerator(name);
            successData();
        },error:errorAjax
            
    });
}


function contry(data){
    var result="";

    for( var item of data){
        result+=`
        <tr>
            <td data-label="Contry Id">${item.idCountry}</td>
            <td data-label="Name">${item.name}</td>
            <td data-label="Edit"><button class="buttonContry plava adminModeratorButton"  data-idcountry=${item.idCountry} onclick="document.getElementById('contryModal').style.display='block'"><i class="fa fa-cog"></i></button></td>
            <td data-label="Delete"><button class="deleteContryButton f adminModeratorButton " data-idcountry=${item.idCountry}  type="button"><i class="fa fa-close"></i></button></td>
        </tr>
        `;
    }

    $("#showContry").html(result);

}

function paginationNumberModerator(name){
    var productSearch=$("#productSearchInput").val();
    var productStatus=$("#productStatusInput").val();
    var productCategory=$("#productCategoryInput").val();
    $.ajax({
      url:"models/moderator/pagination/pagNumber.php",
      dataType:"JSON",
      method:"GET",
      data:{
        name:name,
        productStatus:productStatus,
        productSearch:productSearch,
        productCategory:productCategory
      },
      success:function(data){
          console.log(data);
        printPaginationModerator(data,name);
        checkDarkMode();
      }})
  }
  
  
  

  
  
  
  function paginationModerator(){
    var productSearch=$("#productSearchInput").val();
    var productStatus=$("#productStatusInput").val();
    var productCategory=$("#productCategoryInput").val();
    var name=$(this).data('name');
    var idpag=$(this).data('id');
    document.querySelector("#pagFilterModerator"+name).value=idpag;
    $.ajax({
        url:"models/moderator/pagination/pagination.php",
        dataType:"json",
        method:"post",
        data:{
          idpag:idpag,
          send:true,
          name:name,
          productStatus:productStatus,
          productSearch:productSearch,
          productCategory:productCategory
        },
        success:function(data){
          if(name=="Products"){
            products(data);
          }else if(name=="News"){
            news(data);
          }else if(name=="Category"){
            viewCategory(data);
          }else if(name=="Newsletter"){
            newsletter(data);
          }else if(name=="Poll"){
            poll(data);
          }else if(name=="Contry"){
            contry(data)
          }
          checkDarkMode();
        
        },
        error:function(xhr,status,error){
            console.log(xhr,status,error)
        }
      })
    }
  
  
  
    function updatePaginationModerator(name){
      var productSearch=$("#productSearchInput").val();
      var productStatus=$("#productStatusInput").val();
      var productCategory=$("#productCategoryInput").val();
      var name=name;
      var idpag=$("#pagFilterModerator"+name).val();
      $.ajax({
          url:"models/moderator/pagination/pagination.php",
          dataType:"json",
          method:"post",
          data:{
            idpag:idpag,
            send:true,
            name:name,
            productStatus:productStatus,
            productSearch:productSearch,
            productCategory:productCategory
          },
          success:function(data){
            if(name=="Products"){
                products(data);
            }else if(name=="News"){
              news(data);
            }else if(name=="Category"){
                viewCategory(data);
            }else if(name=="Newsletter"){
                newsletter(data);
            }else if(name=="Poll"){
                poll(data);
            }else if(name=="Contry"){
                contry(data);
            }
            
          
          },
          error:function(xhr,status,error){
              console.log(xhr,status,error)
          }
        })
      }
    

function paginationModeratorOrder(){
    var page=$(this).data('id');
    $("#pagFilterModeratorOrder").val(page);
    var id=$("#inputOrder").val();
    var firstDate=$("#datumOd").val();
    var secondDate=$("#datumDo").val();
    var statusOrder=$("#statusOrder").val();
    var payment=$("#paymentOrder").val();
    $.ajax({
      url:'models/moderator/pagination/filterOrder.php',
      method:"GET",
      dataType:"JSON",
      data:{
            searchId:id,
            firstDate:firstDate,
            secondDate:secondDate,
            statusOrder:statusOrder,
            page:page,
            payment:payment
      },
      success:function(data){
        ordersView(data);
      },
      error:function(error){
        console.log(error);
        
      }
    })
}
  
function updatePaginationOrder(){
    var id=$("#inputOrder").val();
    var firstDate=$("#datumOd").val();
    var secondDate=$("#datumDo").val();
    var statusOrder=$("#statusOrder").val();
    var payment=$("#paymentOrder").val();
    $.ajax({
      url:'models/moderator/pagination/countOrderPagination.php',
      method:"GET",
      dataType:"JSON",
      data:{
            searchId:id,
            firstDate:firstDate,
            secondDate:secondDate,
            statusOrder:statusOrder,
            payment:payment
      },
      success:function(data){
          var name="Order";
        printPaginationModerator(data,name);
        console.log(data);
      },
      error:errorAjax
    })
}

function printPaginationModerator(data,name){
    var limit=6;
    var active=document.querySelector("#pagFilterModerator"+name).value
    var total=Math.ceil(data.number/limit);
    
    var html="<div class='paginationModerator"+name+"'>";
    for(var i=1;i<=total;i++){
        if(active==i){
          html+=`<a href='javascript:void(0)' value=${i} data-name=${name} data-id=${i} class="darkEmptyTextWhite onePag active${name} pag${name}" >${i}</a>`;
        }else{
          html+=`<a href='javascript:void(0)' value=${i} data-name=${name} data-id=${i} class="darkEmptyTextWhite onePag pag${name}" >${i}</a>`;
        }
    }
    $("#paginationModerator"+name).html(html);
  
    paginationActiveModerator(name);
    
  }
  
  function paginationActiveModerator(name){
    var header = document.querySelector(".paginationModerator"+name);
    var btns = header.getElementsByClassName("onePag");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
      var current = document.getElementsByClassName("active"+name);
      current[0].className = current[0].className.replace(" active"+name, "");
      this.className += " active"+name;
      });
    }
    console.log(btns.length);
  }

function products(data){
    let html = "", rb = 1;
    for(let item of data){
        html+=`<tr><td data-label=""><img src="${item.path}" alt="${item.alt}" class="slikaModerator"/></td>
        <td data-label="">${item.name}</td>
        <td data-label="Description">${item.description}</td>
        <td data-label="New price">&#36;${item.newPrice}.00</td>
        <td data-label="Categories">${item.knaziv}</td><td data-label="Availability">`;
        if(item.Quantity>=1){
            html+=`In stock  <span class='sell'>  <i class='fa fa-circle'></i></span>`;
        }else{
            html+=`Out of stock <span class='wait'><i class='fa fa-circle'></i></span>`
        }
        html+=`<td data-label="Edit"><a class="plava" href="index.php?page=editProduct&idEditProduct=${item.idProduct}"><i class="fa fa-cog"></i></a></td>
        <td data-label="Edit price"><a class=" green plava" href="index.php?page=editPrice&id=${item.idProduct}"><i class="fa fa-dollar"></i></a></td>
        <td data-label="Delete"><button type="button" class="f brisanjeProizvod adminModeratorButton" data-id="${item.idProduct}"><i class="fa fa-close"></i></button></td></tr>`;
    }
    $("#prikazProizvoda").html(html);
    }

function statusProductPagination(){
    var status=$(this).data('idstatus');
    $("#productStatusInput").val(status);
    var name="Products";
    paginationNumberModerator(name);
    updatePaginationModerator(name);
}

function categoryProductPagination(){
    var category=$(this).data('idcategory');
    $("#productCategoryInput").val(category);
    var name="Products";
    paginationNumberModerator(name);
    updatePaginationModerator(name);
}

function searchProductPagination(){
    var name="Products";
    paginationNumberModerator(name);
    updatePaginationModerator(name);
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

function selectTab(evt, name) {
    var i, tabcontent, tablinks;
  
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" activeAdmin", "");
    }
  
    document.getElementById(name).style.display = "block";
    evt.currentTarget.className += " activeAdmin";
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
$('.darkEmptyBackgroundWhite').addClass('darkBackgroundWhite');
$(".darkEmptyLightBackground").addClass("darkLightBackground");

}

function removeDark(){
$('.darkEmptyBackround').removeClass('darkBackground');
$('.darkEmptyTextWhite').removeClass('darkTextWhite');
$('.darkEmptyBackgroundWhite').removeClass('darkBackgroundWhite');
$(".darkEmptyLightBackground").removeClass("darkLightBackground");
}

function pollStatistic(){
    var idPoll=$(this).data('id');
    $.ajax({
        url:"models/moderator/poll/pollStatistic.php",
        method:"GET",
        dataType:"JSON",
        data:{
            id:idPoll
        },
        success:function(data){
            $("#pollTable").html(data);
        },error:errorAjax
    })
}

function activePollStatistic(){
    var idPoll=$(this).data('idpoll');
    $.ajax({
        url:"models/moderator/poll/pollStatistic.php",
        method:"GET",
        dataType:"JSON",
        data:{
            id:idPoll
        },
        success:function(data){
            $("#pollModeratorStatistic").html(data);
        },error:errorAjax
    })
}

function successData(){
    $("#info").html("<div id='notification' class='notificationColorGreen'>Successfully!</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
  }