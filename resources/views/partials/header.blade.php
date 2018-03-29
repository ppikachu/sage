@if (App\display_sidebar())
	<div id="contacto" style="display:none;">
		<div id="barras">
			<div id="yel" class="color"></div>
			<div id="cya" class="color"></div>
			<div id="gre" class="color"></div>
			<div id="pin" class="color"></div>
			<div id="red" class="color"></div>
			<div id="blu" class="color"></div>
		</div>
		<div class="container py-4">
			@include('partials.sidebar')
		</div>
	</div>
@endif

<nav class="navbar navbar-dark bg-dark sticky-top navbar-expand">
	<div class="container">
		<a class="navbar-brand" href="{{ home_url('/') }}" rel="nofollow">
			<img id="iso" src="@asset('images/luz.png')">
		</a>

		@if (has_nav_menu('primary_navigation'))
			{!! wp_nav_menu([
				'theme_location' => 'primary_navigation',
				'menu_class' => 'navbar-nav ml-auto',
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
        'walker'            => new WP_Bootstrap_Navwalker()
				]) !!}
		@endif

	</div>
</nav>

{{-- <div class="container-fluid"> --}}
	<div id="ajax-modal" class="position-absolute w-100"></div>
	<div id="error"></div>
{{-- </div> --}}
