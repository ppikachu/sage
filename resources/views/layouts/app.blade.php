<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    @php(do_action('get_header'))
    @include('partials.header')

		<div id="gran_bloque" class="" style="margin-top:-63px; height:100vh; overflow:hidden;">
			@php $args = array('pagename' => 'inicio'); $the_query = new WP_Query( $args ); $the_query->the_post();
			//the_post_thumbnail('full', array('class' => 'img-fluid w-100'));
			echo '<video style="width:100%; height:100%; object-fit:cover;" autoplay muted loop0 id="myVideo" poster="'.get_the_post_thumbnail_url().'"><source src="'.types_render_field( "video").'" type="video/mp4"></video>';
			wp_reset_postdata();
			@endphp
		</div>

    <div class="wrap container" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
      </div>
    </div>
    @php(do_action('get_footer'))
    @include('partials.footer')
    @php(wp_footer())
  </body>
</html>
