_Bbc(function($){
	function slick_slider_scale() {
		$('.slick_slider_scale').each(function(index, el) {
			var w = $(this).data('width');
			var h = $(this).data('height');
			var x = $(this).find('.slider-2');
			x.css('padding-bottom', x.width()*h/w);
			x.find('.item').css('padding-bottom', x.width()*h/w);
		});
	};
	setTimeout(function() {
		slick_slider_scale();
	}, 2000);
	setTimeout(function() {
		slick_slider_scale();
	}, 5000);
});