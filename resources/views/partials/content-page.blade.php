<article id="content">

	<div class="row my-5">
		<header class="col-10">
			<h1 class="entry-title">{{ get_the_title() }}</h1>
		</header>
		<div class="col-2 text-right">
			<button class='btn btn-primary cerrar'><i class='fas fa-times'></i></button>
		</div>
	</div>

	<div class="entry-content">
			{{ the_content() }}
	</div>

</article>
