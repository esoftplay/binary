_Bbc(function($){	
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