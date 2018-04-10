<article class="" id="content">

	<div class="row my-5">
		<header class="col-10">
			<h1 class="entry-title">{{ get_the_title() }}</h1>
		</header>
		<div class="col-2 text-right">
			<button class='btn btn-primary cerrar'><i class='fas fa-times'></i></button>
		</div>
	</div>

	<div class="entry-content pb-5">
		@if (types_render_field( "multi_embed"))
			<div id="slick">
				<div>
					@php echo types_render_field( "multi_embed", array("separator" => "</div><div>") ) @endphp
				</div>
			</div>
		@endif
		{{ the_content() }}
		{{-- @if (types_render_field( "cliente")) <p>Cliente: {{ types_render_field("cliente") }}.</p> @endif --}}
	</div>

</article>
