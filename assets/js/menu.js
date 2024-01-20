$(document).ready(function() {
    document.querySelector("#meniLinkOpen").addEventListener("click",function(){
        document.querySelector("#mySidenav").style.width = "250px";
    });

    document.querySelector("#meniLinkClose").addEventListener("click",function(){
        document.querySelector("#mySidenav").style.width = "0";
    });
    console.log("meni");

    
       
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