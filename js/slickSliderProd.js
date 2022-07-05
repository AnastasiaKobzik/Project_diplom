 
$(document).ready(function(){
  $('.slick-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slick-slider'
  });
  $('.slick-slider').not('.slick-initialized').slick({
    centerMode: true,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slick-for',
    dots: true,
    arrows: false,
    //centerMode: true,
  focusOnSelect: true,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        //centerMode: true,
        dots:true 
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
  });
});
