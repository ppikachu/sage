<nav class="navbar navbar-dark bg-dark sticky-top">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a class="navbar-brand" href="{{ home_url('/') }}" rel="nofollow">
        	<img id="iso" src="@asset('images/luz.png')">
        </a>
      </div>

	  <div class="nav navbar-nav navbar-right navbar-inverse" id="navbarSupportedContent">
	    @if (has_nav_menu('primary_navigation'))
	      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'navbar-nav mr-auto']) !!}
	    @endif
	  </div>

	</div>
</nav>
