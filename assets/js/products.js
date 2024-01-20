$(document).ready(function(){

  productNumber();
  range();
  menu();
  toggleFilters();

  document.querySelector("#search").addEventListener('keyup',pretraga);

  document.getElementById("myRange").addEventListener('change',filterCena);

  $("#pagination").on('click','#pag',pagination);

  $(".asc").click(function(){
    sortirajAsc()
  })

  $(".desc").click(function(){
    sortirajDesc()
  })




});//////

function range(){
    var slider = document.getElementById("myRange");
    var output = document.getElementById("demo");
    output.innerHTML = slider.value;
    
    slider.oninput = function() {
      output.innerHTML = this.value;
    }
}

function printPaginations(num_of_iphone,limit){
  let html = "";
  var pagId=document.querySelector("#pagId").value
  for(let i = 0; i < num_of_iphone; i++){
    if(limit==i){
    html+=`
    <a href="javascript:void(0)" id="movies-pagination" class="active" data-limit="${i}">
    <b> ${i+1}</b>
    </a>
    `;}else{
      html+=`
      <a href="javascript:void(0)" id="movies-pagination" data-limit="${i}">
      <b> ${i+1}</b>
      </a>
      `;
    }
  }
  $(".pagination").html(html);
}



function printProducts(data) {
  var html="";
  for(var item of data){
    getProductRating(item.idProduct);
    html+=`<div class="card">
      ${calculatePercent(parseInt(item.oldPrice),parseInt(item.newPrice))}
      <img src="${item.path}" alt="${item.alt}"/>
      <h2 class="naziv">${item.name}</h2>
      <div class="starsCard ratingProduct${item.idProduct}">
      </div>
      ${salePriceCheck(parseInt(item.oldPrice),parseInt(item.newPrice))}
      <p><a href="index.php?page=oneProduct&idProduct=${item.idProduct}" class="kupiProizvod">buy</a></p>
    </div>`;
  }
  document.querySelector("#p").innerHTML=html;
}

function printPagination(data){
  var limit=6;
  var active=document.querySelector("#pagFilter").value
  var total=Math.ceil(data.brojproizvoda/limit);
  
  var html="<div class='pagination'>";
  for(var i=1;i<=total;i++){
      if(active==i){
        html+=`<a href='javascript:void(0)' value=${i} data-id=${i} class="onePag  darkEmptyTextWhite  active "  id="pag">${i}</a>`;
      }else{
        html+=`<a href='javascript:void(0)' value=${i} data-id=${i} class="onePag darkEmptyTextWhite  " id="pag">${i}</a>`;
      }
  }
  $("#pagination").html(html);

  paginationActive();
  
}

function productNumber(){
  var id=0;
  var product=$("#page").val();
  $.ajax({
    url:"models/products/pagNumber.php",
    dataType:"json",
    method:"post",
    data:{
      id:id,
      product:product
    },
    success:function(data){
      printPagination(data)
      checkDarkMode();
    }})
}

function pagination(){
var product=$("#page").val();

var idpag=$(this).data('id');
document.querySelector("#pagFilter").value=idpag;
var price = document.getElementById("myRange").value;
var  value=$("#search").val();
var id=$("#filterlista").val();
var sendFilter=$("#sortAscDesc").val();
$.ajax({
    url:"models/products/pagination.php",
    dataType:"json",
    method:"post",
    data:{
      idpag:idpag,
      send:true,
      product:product,
      value:value,
      price:price,
      sendFilter:sendFilter
    },
    success:function(data){
      printProducts(data)
      checkDarkMode();
    
    },
    error:function(xhr,status,error){
        console.log(xhr,status,error)
    }
  })
}


function pretraga() {
  let product=$("#page").val();

  const value=this.value;
  var price = document.getElementById("myRange").value;
  var priceSort=$("#sortAscDesc").val();
  $('.onePag:first').addClass('active');

  paginationActive();
  $.ajax({
    url:"models/products/searchFilter.php",
    method:"POST",
    dataType:"JSON",
    data:{
      value:value,
      product:product,
      price:price,
      priceSort:priceSort
    },
    success:function(data){
      if(value!="" && data==""){
        document.getElementById("p").innerHTML="No Product!";
      }else{
        printProducts(data);
      }
    },
    error:function(error){
      console.log(error);
      
    }
  })

  $.ajax({
    url:"models/products/findPagination.php",
    dataType:"json",
    method:"post",
    data:{value:value,product:product,price:price},
    success:function(data){
      printPagination(data);
    },error:function(error){
      console.log(error);
    }
  })
}

function filterCena() {
  let product=$("#page").val();
  var price = document.getElementById("myRange").value;
  var  value=$("#search").val();
  var priceSort=$("#sortAscDesc").val();
  paginationActive();
  $.ajax({
    url:"models/products/searchFilter.php",
    method:"POST",
    dataType:"JSON",
    data:{
      price:price,
      product:product,
      value:value,
      priceSort:priceSort
    },
    success:function(data){
      printProducts(data);
    },
    error:function(error){
      console.log(error);
    }
  })

  $.ajax({
    url:"models/products/findPagination.php",
    dataType:"json",
    method:"post",
    data:{
      product:product,
      price:price,
      value:value
    },
    success:function(data){
      printPagination(data);
    },error:function(error){
      console.log(error);
      
    }
  })

}

function sortirajAsc(){
  var product=$("#page").val();
  var idpag=$("#pagFilter").val();
  var price = document.getElementById("myRange").value;
  var  value=$("#search").val();
  var sendFilter="asc";
  var id=$("#filterlista").val();
  $("#sortAscDesc").val(sendFilter);
  paginationActive();
  $.ajax({
    url:"models/products/pagination.php",
    dataType:"json",
    method:"post",    
    data:{
      value:value,
      send:true,
      idpag:idpag,
      price:price,
      product:product,
      sendFilter:sendFilter,
    },
    success:function(data){
      printProducts(data);
    },error:function(xhr,status,error){
        console.log(xhr,error,status)
    }})



  }

function sortirajDesc(){
  var product=$("#page").val();
  var idpag=$("#pagFilter").val();
  console.log("ovo je data id "+idpag);
  
  var price = document.getElementById("myRange").value;
  var value=$("#search").val();
  var sendFilter="desc";
  $("#sortAscDesc").val(sendFilter);
  $.ajax({
  url:"models/products/pagination.php",
  dataType:"json",
  method:"post",    
  data:{
      send:true,
      value:value,
      idpag:idpag,
      price:price,
      product:product,
      sendFilter:sendFilter
  },
  success:function(data){
    printProducts(data);
    paginationActive();
  },error:function(xhr,status,error){
      console.log(xhr,error,status)
  }})


}

function menu(){
  document.querySelector("#meniLinkOpen").addEventListener("click",function(){
      document.querySelector("#mySidenav").style.width = "250px";
  });

  document.querySelector("#meniLinkClose").addEventListener("click",function(){
      document.querySelector("#mySidenav").style.width = "0";
  });
}

function paginationActive(){
  var header = document.querySelector(".pagination");
  var btns = header.getElementsByClassName("onePag");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
    });
  }
}

function calculatePercent(oldPrice,newPrice){
  if((oldPrice>newPrice)&&newPrice>0){
    var percent=Math.round((oldPrice-newPrice)/oldPrice*100.0);
    var result="";
    if(percent<=20 && percent>=0){
      result="<span class='pricePercent greenPercent'>-"+percent+"%</span>";
    }else if(percent<=40 && percent>=0){
      result="<span class='pricePercent yellowPercent'>-"+percent+"%</span>";
    }else if(percent>40 && percent>=0){
      result="<span class='pricePercent redPercent'>-"+percent+"%</span>";
    }else{
      result="";
    }
    
    return result;

  }else{
    return "";
  }
}

function salePriceCheck(oldPrice,newPrice){
  var result="";
  if(oldPrice>newPrice){
      result="<p class='first precrtan '>&#36;"+oldPrice+".00</p> <p class='first nova'>&#36;"+newPrice+".00</p>";
  }else if(newPrice>oldPrice){
      result="<p class='first'>&#36;"+newPrice+".00</p>";
  }else{
      result="<p class='first'>&#36;"+oldPrice+".00</p>";
  }
  return result;
}


function checkDarkMode(){
  if ($("#radio-b").is(':checked')) 
  {
    addDark();
    console.log("ss");
      }
  else
  {
    vracanjeBoje();
    console.log("aaa");
      
  }
}

function addDark(){
  $('.darkEmptyBackround').addClass('darkBackground');
  $('.darkEmptyTextWhite').addClass('darkTextWhite');
  $('.darkEmptyBackgroundWhite').addClass('darkBackgroundWhite');
  $(".darkEmptyLightBackground").addClass("darkLightBackground");
  $("#slikaHeder a img").attr("src","assets/images/logoWhiteTransparent.png");
  
}

function removeDark(){
  $('.darkEmptyBackround').removeClass('darkBackground');
  $('.darkEmptyTextWhite').removeClass('darkTextWhite');
  $('.darkEmptyBackgroundWhite').removeClass('darkBackgroundWhite');
  $(".darkEmptyLightBackground").removeClass("darkLightBackground");
  $("#slikaHeder a img").attr("src","assets/images/logo3.png");
}

function toggleFilters(){
  $("#productsFilter").click(function(){
      $("#filteri").toggle("1000");
  });

}

function getProductRating(id){
  var result=0;
  $.ajax({
    url:"models/products/ratingOneProduct.php",
    method:"GET",
    dataType:"JSON",
    data:{
      id:id
    },success(data){
      result=Math.round(parseInt(data.avg));
      if(isNaN(result)){
        result=0;
      }      
      printProductRating(result,id)
    },error:function(){

    }
  })
  
}

function printProductRating(data,id){
  var html="";
  for(i=0;i<data;i++){
    html+=`<span class="fa fa-star checked"></span>`;
  }
  console.log(data);
  if(data<5){
    for(let i=1;i<=5-data;i++){
      html+=`<span class="fa fa-star nochecked" ></span>`;
    }
  }

  $(".ratingProduct"+id).html(html)
}