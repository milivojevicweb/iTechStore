$(document).ready(function() {
  

  
  printCartCount();
  

  document.querySelector("#meniLinkOpen").addEventListener("click",function(){
    document.querySelector("#mySidenav").style.width = "250px";
  });
  document.querySelector("#meniLinkClose").addEventListener("click",function(){
      document.querySelector("#mySidenav").style.width = "0";
  });   

  document.querySelector(".dropbtn").addEventListener("click",function(){
  klikIkonica()
  function klikIkonica() {
  document.getElementById("myDropdown").classList.toggle("show");
  }

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}});


$(window).scroll(function(){

  var skrolovano = $(this).scrollTop();

  if(skrolovano > 700){
    $('#scrollToTop').fadeIn();
  } else {
    $('#scrollToTop').fadeOut();
  }

});
$('#scrollToTop').click(function(){
      
      $('html').animate({scrollTop: 0}, 2000);
  });



  function prikazProizvoda(){
    $(".prvi").click(function(){
      $("#proizvodiDesno").css("width","60%");
      $("#vrednost").html("2 items");
    });
    $(".drugi").click(function(){
    $("#proizvodiDesno").css("width","70%");
    $("#vrednost").html("3 items");
  });
  }
  prikazProizvoda();

  
});



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
function hasLS(name) {
  return localStorage.getItem(name) != null;
}
function clearCart() {
  localStorage.removeItem("products");
}
function getLS(name) {
  return JSON.parse(localStorage.getItem(name));
}
