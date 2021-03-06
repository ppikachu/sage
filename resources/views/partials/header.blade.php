<nav class="navbar navbar-dark bg-dark bg-primary0 sticky-top navbar-expand-md">
	<div class="container">
		<a class="navbar-brand" href="{{ home_url('/') }}" rel="nofollow">
			<img id="iso" width="190" src="@asset('images/tuboluz.png')">
			{{-- luznegra --}}
		</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fas fa-bars"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			@if (has_nav_menu('primary_navigation'))
				{!! wp_nav_menu([
					'theme_location' => 'primary_navigation',
					'menu_class' => 'navbar-nav ml-auto text-uppercase h6',
					'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
					'walker'            => new WP_Bootstrap_Navwalker()
					]) !!}
			@endif
		</div>
	</div>
</nav>

<div id="error"></div>
