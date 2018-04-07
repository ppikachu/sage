<!doctype html>
<html @php(language_attributes())>
	@include('partials.head')
	<body @php(body_class())>
		@php(do_action('get_header'))
		@include('partials.header')

		@php $args = array('pagename' => 'inicio'); $the_query = new WP_Query( $args ); $the_query->the_post(); @endphp
		<div id="gran_bloque" class="d-flex align-items-end justify-content-center" style="margin-top:-63px; height:100vh; overflow:hidden;">
			<video style="width:100%; height:100%; object-fit:cover;" autoplay muted loop poster="{{the_post_thumbnail_url('large')}}"><source src="{{types_render_field( "video")}}" type="video/mp4"></video>
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
				<div class="my-5">
					<h1 class="text-center entry-title">{{ get_the_title() }}</h1>
				</div>
			</div>
			<div class="py-5" style="background-image:url({{the_post_thumbnail_url('large')}}); background-size:cover; background-position:center;">
				<div class="container text-white">
					<div class="jumbotron bg-transparent border-0">
						{{ the_content() }}
					</div>
				</div>
			</div>
			@php wp_reset_postdata(); @endphp


		</div>

		@php(do_action('get_footer'))
		@include('partials.footer')
		@php(wp_footer())
	</body>
</html>
