<article class="py-4 container0 border-bottom" id="content">

<div class="row">
	<header class="col-10">
		<h2 class="entry-title">{{ get_the_title() }}</h2>
	</header>
	<div class="col-2 text-right">
		<button class='btn btn-info cerrar'><i class='fas fa-times'></i></button>
	</div>
</div>

	<div class="entry-content">
		@php $videos = get_field('video'); if ($videos) : $videonum = 1 @endphp
				<ul id="light-slider">
				@php foreach($videos as $video) { echo "<li class='panel". $videonum++."'>". $video."</li>"; } @endphp
				</ul>
				@php endif;
		(the_content()) @endphp
	</div>

</article>
