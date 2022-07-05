$(function() {
  // Owl Carousel
  var owl = $(".owl-carousel");
  owl.owlCarousel({
    items:1,
    margin: 10,
    loop: true,
    nav: false,
    autoplay: true,
    autoplayTimeout: 3000,
    smartSpeed: 2000,
    responsive:{
      0:{
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