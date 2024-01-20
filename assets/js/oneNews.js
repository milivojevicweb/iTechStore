$(document).ready(function(){
    $('.slideshow-container').slick({
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        prevArrow:$("#proLeft"),
        nextArrow:$("#proRight"),
        infinite: true,
        responsive:[
            {
              breakpoint:950,
              settings:{
                slidesToShow:3,
                slidesToScroll:3,
                infinite:true,
              }
            },
            {
                breakpoint:800,
                settings:{
                  slidesToShow:2,
                  slidesToScroll:2,
                  infinite:true,
                }
              },
              {
                breakpoint:540,
                settings:{
                  slidesToShow:1,
                  slidesToScroll:1,
                  infinite:true,
                }
              }        
          ]
    });
});