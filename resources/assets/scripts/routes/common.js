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

		$(document).delegate(".ir-portfolio", "click", function() {
			$('html,body').animate({ scrollTop: $("#filters1").offset().top-85 },2000);
		});

		// bind filter button click

		$('.filters').on('click', 'button', function() {

			if ($(this).hasClass("active")) {
				filterValue = "*";
				$(this).removeClass('active');
			} else {
				var filterValue = $(this).attr('data-filter');
				$('.filters').find('.active').removeClass('active');
				$(this).addClass('active');
			}
			$grid.isotope({ filter: filterValue });
		});

		// abrir card
		$(document).delegate(".item", "click", function() {
			$(this).find('.collapse').on('shown.bs.collapse', function () {$grid.isotope('layout');});
			$(this).find('.collapse').collapse('show');
			$(this).addClass('active'); //marca la entrada que se esta viendo

			return false;
		});
		// cerrar card
		$(document).delegate(".item button", "click", function() {
			$(this).parents(find('.collapse')).on('hidden.bs.collapse', function () {$grid.isotope('layout');});
			$(this).parents(find('.collapse')).collapse('hide');
			$(this).closest('article').removeClass('active'); //marca la entrada que se esta viendo
			return false;
		});

		// cargar proyecto
		var id;

		$(document).delegate(".ajax a", "click", function() {
			location.hash = this.pathname;
			// $('[data-toggle="tooltip"]').tooltip('hide');
			$(window).trigger('hashchange');
			return false;
		});

		// Bind an event handler.
		jQuery(window).hashchange(function() {
			var url = window.location.hash.substring(1);
			id = "#"+window.location.hash.slice(2, -1);
			//console.log(id);
			if (url != "") {
				preparar();
				url = url + " #content";

				$(id+" .ajax-content").load(url, function(response, status, xhr) {

					if (status == "error") {
						var msg = "Sorry but there was an error: ";
						$("#error").html(msg + xhr.status + " " + xhr.statusText);
					}

					$(id+" .poster").hide();
					$(id).addClass('w-100').removeClass('loading');
					//$grid.on('layoutComplete', function() {$('html,body').scrollTop($(id).offset().top-80);} );

					$(id).imagesLoaded( function() {
							$("#light-slider").lightSlider({
								item: 1,
								keyPress: true,
								//adaptiveHeight: true,
								onSliderLoad: function () {
									$grid.isotope('layout');
								},
							});
							$grid.isotope('layout');
					});
					// $(id).removeClass('loading');

					$('iframe').reframe(function() {$grid.isotope('layout');});
				});
			}
		});

		var preparar = function() {
			$(id).addClass('loading');
			// $('.main').addClass('blur');
		};

		// cerrar entrada
		$(document).delegate(".cerrar", "click", function() {
			$(id+" .ajax-content article").slideUp("slow", function() {
				//location.hash = "";
				$(id+" .ajax-content").empty();
				$(id).removeClass('w-100');
				$(id+" .poster").show();
				$grid.isotope('layout');
				$("#pack .active").removeClass('active'); //desmarca la entrada que se esta viendo
			});
			return false;
		});

		$('.boton-contacto').click(function() {
			$('#contacto').slideToggle('slow');
			return false;
		});

	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
		$(window).trigger('hashchange'); //dispara el hash al cargar la url
		//$('[data-toggle="tooltip"]').tooltip(); // tooltips de las entradas
	},
};
