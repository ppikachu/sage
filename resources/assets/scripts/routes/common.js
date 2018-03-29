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

		// bind filter button click

		$('.filters').on('click', 'button', function() {

			// var $btn = $(this).button('loading');

			if ($(this).hasClass("active")) {
				filterValue = "*";
				$(this).removeClass('active');
			} else {
				var filterValue = $(this).attr('data-filter');
				$('.filters').find('.active').removeClass('active');
				$(this).addClass('active');
			}
			$grid.isotope({
				filter: filterValue,
			});

			// $grid.isotope('on', 'layoutComplete', function(laidOutItems) {
			// 	$btn.button('reset');
			// });

		});

		$(document).delegate(".ajax a", "click", function() {
			$("#pack .active").removeClass('active'); //desmarca la entrada que se esta viendo
			location.hash = this.pathname;
			var el_hash = location.hash.substring(2, window.location.hash.length - 1);
			$('article#' + el_hash).addClass('active'); //marca la entrada que se esta viendo
			//console.log(el_hash);
			$('[data-toggle="tooltip"]').tooltip('hide');
			$(window).trigger('hashchange');
			return false;
		});

		// Bind an event handler.
		jQuery(window).hashchange(function() {
			var url = window.location.hash.substring(1);
			//console.log(url);
			if (url!="") {
			preparar();
			url = url + " #content";

			$("#ajax-modal").load(url, function(response, status, xhr) {

				if (status == "error") {
					var msg = "Sorry but there was an error: ";
					$("#error").html(msg + xhr.status + " " + xhr.statusText);
				}

				var $mainContent = $("#ajax-modal #content");

				// $('.wp-playlist').each(function() {
				// 	return new WPPlaylistView({
				// 		el: this,
				// 	});
				// });

				$('iframe').reframe();

				$("#light-slider").lightSlider({
					item: 1,
					autoWidth: false,
					slideMove: 1, // slidemove will be 1 if loop is true
					slideMargin: 10,

					addClass: '',
					mode: "slide",
					cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
					easing: 'linear', //'for jquery animation',////

					speed: 400, //ms'
					loop: true,
					slideEndAnimation: true,

					keyPress: true,
					controls: true,
					prevHtml: '',
					nextHtml: '',

					rtl: false,
					adaptiveHeight: true,

					vertical: false,
					verticalHeight: 500,
					vThumbWidth: 100,

					thumbItem: 10,
					pager: true,
					gallery: false,
					galleryMargin: 5,
					thumbMargin: 5,
					currentPagerPosition: 'middle',

					enableTouch: true,
					enableDrag: true,
					freeMove: true,
					swipeThreshold: 40,
				});

				$("#ajax-modal").addClass('on');
				// $("#ajax-modal #content").append("<button class='btn btn-primary btn-block0 cerrar'><i class='fas fa-window-close'></i> cerrar</button>");
				$mainContent.hide().slideDown("slow", function() {
					// $('.main').removeClass('blur');
					$('#loading').remove();
				});
			});
		}
		});

		var preparar = function() {
			$('body').append('<div id="loading" class="loading"></div>');
			$('.main').addClass('blur');
			$('html, body').animate({
				scrollTop: 0,
			}, 400);
		};

		// cerrar entrada
		$(document).delegate(".cerrar", "click", function() {
			$("#ajax-modal #content").slideUp("slow", function() {
				location.hash = "";
				$("#ajax-modal").empty().removeClass('on');
				$('.main').removeClass('blur');
				$("#pack .active").removeClass('active'); //desmarca la entrada que se esta viendo
			});
			return false;
		});

		$('.boton-contacto').click(function() {
			$('#contacto').slideToggle('slow');
			$(this).toggleClass('cruz');
			//$( "#contacto-icono" ).toggleClass('fa-envelope-o fa-caret-up');
			return false;
		});

	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
		$(window).trigger('hashchange'); //dispara el hash al cargar la url
		$('[data-toggle="tooltip"]').tooltip(); // tooltips de las entradas
	},
};
