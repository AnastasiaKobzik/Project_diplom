$(document).ready(function(){
  $('.slick-slider').slick({
    infinite: true,
    rows:2,
    slidesToShow: 3,
    slidesToScroll: 2,
    speed: 1200,
    prevArrow: $('.prevArrow'),
    nextArrow: $('.nextArrow'),
    dots:true,
    
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
  });
});

