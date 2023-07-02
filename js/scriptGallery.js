// галерея
$('.slick-slider.gallery').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    prevArrow: $('.bg-white-popular .owl-nav button.owl-prev'),
    nextArrow: $('.bg-white-popular .owl-nav button.owl-next'),
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 1100,
            settings: {
                arrows: false,
                dots: true,
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 746,
            settings: {
                arrows: false,
                dots: true,
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                dots: true,
                slidesToShow: 1,
            }
        }
    ]
    
    
});
    // autoplay: true,autoplaySpeed: 1000

//отзывы
$('.slick-slider.reviews').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    prevArrow: $('.bg-white-reviews .owl-nav button.owl-prev'),
    nextArrow: $('.bg-white-reviews .owl-nav button.owl-next'),
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
        {
            breakpoint: 1100,
            settings: {
                arrows: false,
                dots: true,
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 992,
            settings: {
                arrows: false,
                dots: true,
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 576,
            settings: {
                arrows: false,
                dots: true,
                slidesToShow: 1,
            }
        }
    ]
});

//контакты
$('.slick.block-specialist').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    
});