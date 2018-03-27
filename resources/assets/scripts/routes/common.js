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
			location.hash = this.pathname;
			var el_hash = location.hash.substring(2, window.location.hash.length - 1);
			//console.log(el_hash);
			$('[data-toggle="tooltip"]').tooltip('hide');
			$("#pack .active").removeClass('active'); //desmarca la entrada que se esta viendo
			$('article#' + el_hash).addClass('active'); //marca la entrada que se esta viendo
			$(window).trigger('hashchange');
			return false;
		});

		// Bind an event handler.
		jQuery(window).hashchange(function() {
			var url = window.location.hash.substring(1);
			//console.log(url);
			url = url + " #content";
			preparar();

			$("#ajax-modal").load(url, function(response, status, xhr) {

				if (status == "error") {
					var msg = "Sorry but there was an error: ";
					$("#error").html(msg + xhr.status + " " + xhr.statusText);
				}

				var $mainContent = $("#ajax-modal #content");
				$(".entry-content-asset").addClass('embed-responsive embed-responsive-16by9');

				// $('.wp-playlist').each(function() {
				// 	return new WPPlaylistView({
				// 		el: this,
				// 	});
				// });

				$('#slick').slick({
					dots: true,
				});

				$("#ajax-modal #content").append("<button class='btn btn-primary btn-block cerrar'><span class='glyphicon glyphicon-chevron-up'></span> cerrar</button>");
				$mainContent.hide().slideDown("slow");
			});
		});

		var preparar = function() {
			$("#ajax-modal").append('<div id="loading" class="jumbotron">loading</div>');
			$('html, body').animate({
				scrollTop: 0,
			}, 400);
		};

		// cerrar entrada
		$(document).delegate(".cerrar", "click", function() {
			$("#pack .active").removeClass('active'); //desmarca la entrada que se esta viendo
			$("#ajax-modal #content").slideUp("slow", function() {
				$("#ajax-modal").empty();
				$('html, body').animate({
					scrollTop: 0,
				}, 200, function() {
					location.hash = "";
				});
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
