export default {
	init() {
		// JavaScript to be fired on all pages
		var $grid = $('.grid').isotope({
			itemSelector: '.item',
			//percentPosition: true,
			masonry: {
				columnWidth: '.grid-sizer',
			},
		});
		// layout Isotope after each image loads
		$grid.imagesLoaded().progress(function() {
			$grid.isotope('layout');
		});

	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};
