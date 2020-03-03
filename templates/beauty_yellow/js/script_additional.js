_Bbc(function($){
	function slick_slider_scale() {
		$('.slick_slider_scale').each(function(index, el) {
			$(this).fadeIn();
			var w = $(this).data('width');
			var h = $(this).data('height');
			var z = $(this).find('.slider-1');
			var x = $(this).find('.slider-2');
			x.css({
				'padding-bottom': x.width()*h/w,
				'height': 0
			});
			x.find('.item').css({
				'padding-bottom': x.width()*h/w,
				'height': 0
			});
			z.find('.item').css('height', '100%');
		});
	};
	$('.slick_slider_scale').hide();
	setTimeout(function() {
		slick_slider_scale();
	}, 2000);
	setTimeout(function() {
		slick_slider_scale();
	}, 5000);
	
	$('.carousel').on('slid.bs.carousel', function(event) {
		var w  = $(this).find('.carousel-inner');
		var h  = w.find('.item.active').height();
		if (h > 0) {
			var hc = w.data('height');
			if (hc == undefined || hc < h) {
				w.data('height', h).height(h);
			}
		}
	});
});