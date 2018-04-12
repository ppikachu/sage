@php $categories = get_the_category(); $separator = ' '; $output = '';
	$output .= "item ";
	if($categories){
		foreach($categories as $category) {
			$output .= $category->category_nicename.$separator;
		}
	} @endphp

<article class="toggler p-1 {{ $output }}" id="<?php echo $post->post_name; ?>">
	<div class="ajax-content"></div>
	<div class="poster toggler" data-toggle="tooltip" data-placement="bottom">
		<div class="shadow toggler">
			@php(the_post_thumbnail('thumbnail', array('class' => 'toggler card-img-top rounded img-fluid')))
		</div>
		<div class="dropdown collapse w-100 bg-light" id="cont-{{ $post->post_name }}">
			<div class="card-body ajax">

				<h5>{{ the_title() }}</h5>
				<p class="small">{{ get_the_excerpt() }}</p>
				{{-- @if (types_render_field( "cliente")) <p class="small">Cliente: {{ types_render_field("cliente") }}.</p> @endif --}}
				<div class="row no-gutters">
					<div class="col">
						<a href="{{ get_permalink() }}" class="ver_proyecto h6 text-uppercase btn btn-sm btn-primary">ver</a>
					</div>
					<div class="col text-right">
						<button class="btn btn-sm btn-primary click toggler"><i class='fas fa-times'></i></button>
					</div>
				</div>

			</div>
		</div>

	</div>
</article>
