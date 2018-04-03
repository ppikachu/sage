<article class="py-4 container border-bottom" id="content">

	<header>
		<h2 class="entry-title">{{ get_the_title() }}</h2>
	</header>

	<div class="entry-content">
		@php $videos = get_field('video'); if ($videos) : $videonum = 1 @endphp
				<ul id="light-slider">
				@php foreach($videos as $video) { echo "<li class='panel". $videonum++."'>". $video."</li>"; } @endphp
				</ul>
				@php endif;
		(the_content()) @endphp
	</div>

	<div class="row justify-content-center">
		<button class='btn btn-primary btn-block0 cerrar my-5'><i class='fas fa-times'></i> cerrar</button>
	</div>
</article>
