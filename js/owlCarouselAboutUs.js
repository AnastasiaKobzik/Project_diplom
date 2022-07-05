$(function() {
  // Owl Carousel
  var owl = $(".owl-carousel");
  owl.owlCarousel({
    items:1,
    margin: 20,
    nav: false,
    smartSpeed: 2000,
    responsive:{
      0:{
        items:1
      },
      576:{
        items:2
      },
      768:{
        items:3
      },
      1180:{
        items:4
      }
    }
  });
});