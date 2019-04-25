// Slide Top
function slideshow() {
  // clone
  $('.slider-1').clone().removeClass('slider-1').addClass('slider-2').insertAfter($('.slick_slider'));
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
function slick_slider_scale() {
  $('.slick_slider_scale').each(function(index, el) {
    var w = $(this).data('width');
    var h = $(this).data('height');
    var x = $(this).find('.slider-2');
    x.css('padding-bottom', x.width()*h/w);
    x.find('.item').css('padding-bottom', x.width()*h/w);
  });
};
_Bbc(function($){
  if ($('.page_home').length) {
    $('#bs-example-navbar-collapse-1 .navbar-nav .nav-link').first().addClass('active-nav');
  }
  slideshow();
  setInterval(function() {
    $('.slider-1 .slick-next').click();
  }, 4000);
  setTimeout(function() {
    slick_slider_scale();
  }, 2000);
  setTimeout(function() {
    slick_slider_scale();
  }, 5000);
  setTimeout(function() {
    $('.navbar-fixed-top').each(function(index, el) {
      $('<div style="height:'+$(this).height()+'px;width:100%;"></div>').insertAfter(this);
    });
  }, 200);
  $('.gallery_background_wrapper').each(function(index, el) {
    var elem = $(this);
    setInterval(function() {
      elem.find('.gallery_background').attr('src', elem.find('.slick-active img').attr('src'));
    }, 2000);
  });
  $('.statistik_group').children('div').each(function(index, el) {
    if ($(this).find('.statistik_group_item').length) {
      $(this).find('.statistik_group_item').appendTo('.statistik_group_item_list');
      $(this).find('.statistik_group_btn').appendTo('.statistik_group_btn_list');
      $(this).remove();
    }
  });
  $('.statistik_group_btn_list').on('click', '.statistik_group_btn', function(event) {
    event.preventDefault();
    var el = $(this);
    $('.statistik_group_btn.active').removeClass('active');
    el.addClass('active');
    $('.statistik_group_item.active').removeClass('active').fadeOut(200);
    setTimeout(function() {
      $('.statistik_group_item[data-id="'+el.data('id')+'"]').addClass('active').fadeIn(200);
    }, 200);
  });
  $('.statistik_group_btn').show();
  $('.statistik_group_btn').first().trigger('click');
});