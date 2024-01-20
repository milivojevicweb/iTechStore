$(document).ready(function()
{
    if (localStorage.getItem("mode")=="dark"){
        console.log("dark mode je ukljucen");
        promenaBoje();
    }else{
        console.log("nijssse");
        vracanjeBoje();
    }
  function darkmode(){
        promenaBoje();
        localStorage.setItem("mode", "dark");
        $("#radio-b").prop("checked", true);
    }



function nodark(){
    vracanjeBoje();
    localStorage.setItem("mode", "light1");
}

  if(localStorage.getItem("mode")=="dark")
        darkmode();
        
  else
    nodark();

$('.radio').change(function(e){   

    if ($("#radio-b").is(':checked')) 
    {
        darkmode();

        console.log("cekiran");
        this.setAttribute("checked", "checked");
        this.checked = true;
        }
    else
    {
        nodark();
        e.preventDefault();
        this.checked = false;
        
    }

});

function promenaBoje(){
    $('.darkEmptyBackround').addClass('darkBackground');
    $('.darkEmptyBackroundTable').addClass('darkBackgroundTable');
    $('.darkEmptyTextWhite').addClass('darkTextWhite');
    $('.darkEmptyBackgroundWhite').addClass('darkBackgroundWhite');
    $(".darkEmptyLightBackground").addClass("darkLightBackground");
    $(".darkEmptyModeratorAdminButton").addClass("darkModeratorAdminButton");
    $('.darkEmptyLightBackroundTable').addClass('darkLightBackgroundTable');
    $("#googleMaps").addClass('darkMap');
    $(".colorLogo").attr("src","assets/images/logoWhiteTransparent.png");
    $("#pozadina img").attr("src","assets/images/iphone12.png");
    $(".moderatroAdminBody").addClass('darkLightBackground');
    $("#scrollToTop").addClass('darkLightBackground');
    $("#scrollToTop .fa").addClass('darkEmptyTextWhite');
    $("#pozadina").addClass("slajder");
    $(".diagonal").addClass("dijagonala");
    $("#siviTekst p").addClass("sivit");

    $(".switch--horizontal .toggle-outside").addClass("darkModeDugmeNapolje");
}

function vracanjeBoje(){
    $('.darkEmptyBackround').removeClass('darkBackground');
    $('.darkEmptyTextWhite').removeClass('darkTextWhite');
    $('.darkEmptyBackroundTable').removeClass('darkBackgroundTable');
    $('.darkEmptyBackgroundWhite').removeClass('darkBackgroundWhite');
    $(".darkEmptyLightBackground").removeClass("darkLightBackground");
    $(".darkEmptyModeratorAdminButton").removeClass("darkModeratorAdminButton");
    $('.darkEmptyLightBackroundTable').removeClass('darkLightBackgroundTable');
    $("#googleMaps").removeClass('darkMap');
    $(".colorLogo").attr("src","assets/images/logo3.png");
    $("#pozadina img").attr("src","assets/images/iphone12Silver.png");
    $(".moderatroAdminBody").removeClass('darkLightBackground');
    $("#scrollToTop").removeClass('darkLightBackground');
    $("#scrollToTop .fa").removeClass('darkEmptyTextWhite');
    $('body').removeClass('dark');
    $("#pozadina").removeClass("slajder");
    $(".diagonal").removeClass("dijagonala");
    $("#siviTekst p").removeClass("sivit");
    $(".switch--horizontal .toggle-outside").removeClass("darkModeDugmeNapolje");
}

});