// var slideIndex = 1;
// showDivs(slideIndex);

// function plusDivs(n) {
//   showDivs(slideIndex += n);
// }

// function showDivs(n) {
//   var i;
//   var x = document.getElementsByClassName("mySlides");
//   if (n > x.length) {slideIndex = 1}
//   if (n < 1) {slideIndex = x.length}
//   for (i = 0; i < x.length; i++) {
//      x[i].style.display = "none";  
//   }
//   x[slideIndex-1].style.display = "block";  
// }

// Product Slider
$(document).ready(function(){
    $(".wish-icon i").click(function(){
      $(this).toggleClass("fa-heart fa-heart-o");
    });
  }); 


// Slide Top
function slideshow() {
  // clone
  $('.slider-1').clone().removeClass('slider-1').addClass('slider-2').insertAfter($('.slider'));

  // set first
  $('.slider-1').slick({
    draggable: false,
    dots: false,
    infinite: true,
    responsive: true,
    asNavFor: '.slider-2',
    touchThreshold: 20,
    speed: 1000,
    fade: true
  });

  // set second
  $('.slider-2').slick({
    dots: true,
    infinite: true,
    responsive: true,
    asNavFor: '.slider-1',
    arrows: false,
    speed: 1000,
    easing: 'easeInOutQuart'
  });
}

$(function() {
  slideshow();
  setTimeout(function() {
    $('.slider-1 .slick-next').click();
  }, 1000);
})
