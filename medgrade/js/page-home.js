$(document).ready(function () {
  // slick banner on main page  https://kenwheeler.github.io/slick/
  $('#page-home .banners-desktop').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: '.slick-prev',
    nextArrow: '.slick-next',
    dots: true,
    autoplay: true, // default=false
    autoplaySpeed: 4000, // default=3000
    fade: true, // default=false
    speed: 1000, // default=300
  });
  $('#page-home .banners-mobile').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    autoplay: true, // default=false
    autoplaySpeed: 4000, // default=3000
    fade: true, // default=false
    speed: 1000, // default=300
  });
});