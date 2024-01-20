$(document).ready(function(){


  $("#newsPagination").on('click','.pagNews',paginationNews);


  paginationNumber();

});


function paginationNews(){
  var idpag=$(this).data('id');
  document.querySelector("#pagNews").value=idpag;
  $.ajax({
      url:"models/news/pagination.php",
      dataType:"json",
      method:"post",
      data:{
        idpag:idpag,
      },
      success:function(data){
        printNews(data);
        checkDarkMode();
      },
      error:errorAjax
  })
}

function paginationNumber(){

  $.ajax({
    url:"models/news/pagNumber.php",
    dataType:"JSON",
    method:"GET",
    success:function(data){
      printPagination(data);
      checkDarkMode();
  },error:errorAjax

})
}


function printPagination(data){
  var limit=4;
  var active=document.querySelector("#pagNews").value
  var total=Math.ceil(data.number/limit);
  var html="<div class='paginationNews'>";
  for(var i=1;i<=total;i++){
      if(active==i){
        html+=`<a href='javascript:void(0)' value=${i}  data-id=${i} class="darkEmptyTextWhite onePag activeNews pagNews " >${i}</a>`;
      }else{
        html+=`<a href='javascript:void(0)' value=${i}  data-id=${i} class="darkEmptyTextWhite onePag pagNews" >${i}</a>`;
      }
  }
  $("#newsPagination").html(html);

  paginationActive();
  
}

function paginationActive(){
  var header = document.querySelector(".paginationNews");
  var btns = header.getElementsByClassName("pagNews");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("activeNews");
    current[0].className = current[0].className.replace(" activeNews", "");
    this.className += " activeNews";
    });
  }

}

function printNews(data){
  var html="";
  for(var item of data){
    html+=`
    <div class="omotac">
    <a href="index.php?page=oneNews&id=${item.idNews}">
    <div class="vest darkEmptyLightBackground">
    
        <div class="vestLevo">
            <img src="${item.image}" alt=""/>
        </div>
        <div class="vestDesno darkEmptyTextWhite">
            <h2>${item.title}</h2>
            <p id="datum">News | ${item.date}</p>
            <p>${item.text.split(' ').slice(0,30).join(' ')}...</p>
            
        </div>
    </div></a>
    </div>
    `;
  }
  $("#news").html(html);
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
  $("#slikaHeder a img").attr("src","assets/images/logoWhiteTransparent.png");
  
}

function removeDark(){
  $('.darkEmptyBackround').removeClass('darkBackground');
  $('.darkEmptyTextWhite').removeClass('darkTextWhite');
  $('.darkEmptyBackgroundWhite').removeClass('darkBackgroundWhite');
  $(".darkEmptyLightBackground").removeClass("darkLightBackground");
  $("#slikaHeder a img").attr("src","assets/images/logo3.png");
}
