<!doctype html>
<html @php(language_attributes())>
	@include('partials.head')
	<body @php(body_class())>

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W8SCVVG"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		@php(do_action('get_header'))
		@include('partials.header')

		@php $args = array('pagename' => 'inicio'); $the_query = new WP_Query( $args ); $the_query->the_post(); @endphp
		<div id="gran_bloque" class="d-flex align-items-end justify-content-center" style="margin-top:-63px; height:100vh; overflow:hidden;">
			<video style="width:100%; height:100%; object-fit:cover;" autoplay muted loop poster="{{the_post_thumbnail_url('large')}}"><source src="{{ types_render_field( "video", array("output" => "raw")) }}" type="video/mp4"></video>
				<div id="tv" class="position-absolute w-100 h-100"></div>
			<div class="position-absolute container text-white flex-column d-flex">
				{{ the_content() }}
				<a class="my-4 align-self-center trailer btn btn-primary btn-lg h4 text-uppercase" href="#trailer"><i class="fas fa-video"></i> ver trailer</a>
				<img class="align-self-center d-none d-md-inline-flex py-5" src="@asset('images/mouse-scroll.gif')" width="48">
				<img class="align-self-center d-md-none pb-5" src="@asset('images/scroll_up_mobile.gif')" width="96">
			</div>
		</div>
		<div id="trailer-content" class="container"></div>
		@php wp_reset_postdata(); @endphp

		<div id="contenido" role="document">

			<div id="portfolio" class="container pt-5">
				@yield('content')
			</div>

			@php $args = array('pagename' => 'quienes-somos'); $the_query = new WP_Query( $args ); $the_query->the_post(); @endphp
			<div id="nosotros" class="container pt-5">
				<h1 class="my-5 text-center entry-title">{{ get_the_title() }}</h1>
			</div>
			<div class="pb-5" @if (has_post_thumbnail()) style="background-image:url({{the_post_thumbnail_url('large')}}); background-size:cover; background-position:center;" @endif>
				<div class="container">
					<div class="jumbotron bg-transparent border-0">
						{{ the_content() }}
					</div>
				</div>
			</div>
			@php wp_reset_postdata(); @endphp

			@php $args = array('pagename' => 'contacto'); $the_query = new WP_Query( $args ); $the_query->the_post(); @endphp
			<div id="contacto" class="pt-5">
				<div class="container text-center">
					<h1 class="entry-title my-5">{{ get_the_title() }}</h1>
				</div>
				<div class="text-white position-relative">
					<div id="barras">
						<div id="cya" class="color"></div>
						<div id="gre" class="color"></div>
						<div id="pin" class="color"></div>
						<div id="red" class="color"></div>
						<div id="blu" class="color"></div>
						<div id="yel" class="color"></div>
					</div>
					<div class="container">
						<div class="container jumbotron bg-transparent">{{ the_content() }}</div>
					</div>
				</div>
			</div>
			@php wp_reset_postdata(); @endphp

		@php(do_action('get_footer'))
		@include('partials.footer')
		@php(wp_footer())
	</body>
</html>
