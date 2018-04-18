export default {
	init() {
		// JavaScript to be fired on all pages

		// ISOTOPE ***
		var $grid = $('.grid').isotope({
			itemSelector: '.item',
			percentPosition: true,
			stagger: 30,
			masonry: {
				columnWidth: '.grid-sizer',
			},
		});
		// layout Isotope after each image loads
		$grid.imagesLoaded().progress(function() {
			$grid.isotope('layout');
		});

		// BOTONES ***
		var scrollToElement = require('scroll-to-element');
		var scrollHacia;
		// trailer
		$(document).delegate("a.trailer", "click", function() {
			scrollToElement('#trailer-content', { offset: -60, ease: 'in-out-expo', duration: 1000 });
			var url_trailer="/trailer/ #content";
			$('#trailer-content').addClass('trailer-loading');
			$('#trailer-content').load(url_trailer, function(response, status, xhr) {
				if (status == "error") {
					var msg = "Sorry but there was an error: ";
					$("#error").html(msg + xhr.status + " " + xhr.statusText);
				}
				$('#trailer-content').removeClass('trailer-loading');
				$('iframe').reframe();
			});
			return false;
		});
		// cerrar trailer
		$(document).delegate("#trailer-content .cerrar", "click", function() {
			location.hash="portfolio";
			$("#trailer-content article").slideUp("slow", function() {
				$("#trailer-content").empty();
				$grid.isotope('layout');
				scrollToElement('#portfolio', { offset: 1, ease: 'in-out-expo', duration: 1000 });
			});
			return false;
		});
		// portfolio
		$(document).delegate(".ir-portfolio", "click", function() {
			scrollToElement('#portfolio', { offset: $('nav.sticky-top').height()/1.5*-1, ease: 'in-out-expo', duration: 1000 });
		});
		// nosotros
		$(document).delegate(".ir-nosotros", "click", function() {
			scrollToElement('#nosotros', { offset: $('nav.sticky-top').height()/1.5*-1, ease: 'in-out-expo', duration: 1000 });
		});
		// contacto
		$('.boton-contacto').click(function() {
			scrollToElement('#contacto', { offset: $('nav.sticky-top').height()/1.5*-1, ease: 'in-out-expo', duration: 1000 });
		});
		// menu mobile cerrar
		$(document).delegate(".nav-link", "click", function() {
			$('.navbar-collapse').collapse('hide');
		});

		// toggle card
		$(document).delegate(".toggler", "click", function() {
			scrollHacia='nada';
			$(this).closest('article').toggleClass('active'); //marca la entrada que se esta viendo
			$(this).closest('article').find('.collapse').on('shown.bs.collapse', function () {$grid.isotope('layout');});
			$(this).closest('article').find('.collapse').on('hidden.bs.collapse', function () {$grid.isotope('layout');});
			$(this).closest('article').find('.collapse').collapse('toggle');
			return false;
		});

		// PORTFOLIO ***
		// filtrar por categoría
		$('.filters').on('click', 'button', function() {
			scrollHacia='nada';
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
		// cargar proyecto
		$(document).delegate("a.ver_proyecto", "click", function() {
			//alert(location.hash);
			if (location.hash) cerrarProyecto();
			location.hash = this.pathname;
			$(window).trigger('hashchange');
			return false;
		});
		// cargar hash
		var id;
		jQuery(window).hashchange(function() {
			var url = window.location.hash.substring(1);
			// alert(url);
			if (url != "") {
				id = "#"+window.location.hash.slice(2, -1); // mejorar nombre
				scrollHacia='single';
				$(id).addClass('loading');
				url = url + " #content";

				$(id+" .ajax-content").load(url, function(response, status, xhr) {
					if (status == "error") {
						var msg = "Sorry but there was an error: ";
						$("#error").html(msg + xhr.status + " " + xhr.statusText);
					}

					$(id+" .poster").hide();
					$(id).addClass('w-100').removeClass('loading');
					$grid.on('layoutComplete', function() { moverEntrada(id) } );

					$(id).imagesLoaded( function() {
							$('#slick').slick({
								dots: true,
								arrows: false,
								// adaptiveHeight: true,
								speed: 500,
								cssEase: 'ease',
							});
							$grid.isotope('layout');
					});

					$('#slick').on('init', function(){
						$grid.isotope('layout');
					});

					$('.entry-content-asset iframe').reframe();
				});
			}

		});

		var moverEntrada = function(aid) {
			if (scrollHacia=='entrada') {
				scrollToElement(aid, { offset: -80, ease: 'in-out-expo', duration: 1000 });
			} else if (scrollHacia=='single') {
				scrollToElement(aid, { offset: -60, ease: 'in-out-expo', duration: 1000 });
			}
		}
		// cerrar entrada
		$(document).delegate(".cerrar", "click", function() {
			scrollHacia = 'entrada';
			$(id+" .ajax-content article").slideUp("slow", function() {
				cerrarProyecto();
			});
			return false;
		});

		// FUNCTIONS ***
		var cerrarProyecto = function() {
			id = "#"+window.location.hash.slice(2, -1); // mejorar nombre
			if (id != undefined) {
				$(id+" .ajax-content").empty();
				$(id).removeClass('w-100');
				$(id+" .poster").show();
				$grid.isotope('layout');
				// location.hash = "";
			}
		}

	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
		$(window).trigger('hashchange'); //dispara el hash al cargar la url
	},
};
