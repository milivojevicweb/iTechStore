$(document).ready(function() {
    slickSlider();
    $(document).on("click",'.sliverCircle',changeToSilverMac);
    $(document).on("click",'.grayCircle',changeToGrayMac);
});
    function slickSlider(){
      $('#slide-container').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        prevArrow:$("#proLeft"),
        nextArrow:$("#proRight"),
        responsive:[
          {
            breakpoint:1200,
            settings:{
              slidesToShow:3,
              slidesToScroll:3,
              infinite:true,
            }
          },
          {
            breakpoint:900,
            settings:{
              slidesToShow:2,
              slidesToScroll:2,
              infinite:true,
            }
          },
          {
            breakpoint:600,
            settings:{
              slidesToShow:1,
              slidesToScroll:1,
              infinite:true,
            }
          },
          
        ]
      });
    }

function changeToSilverMac(){
  $("#macHomeImg img").attr("src","assets/images/ar_silver.jpg");
  $(".circle1").addClass("circleBorder");
  $('.circle2').removeClass('circleBorder');
}

function changeToGrayMac(){
  $("#macHomeImg img").attr("src","assets/images/ar_gray.jpg");
  $(".circle2").addClass("circleBorder");
  $('.circle1').removeClass('circleBorder');
}