@extends('layouts.app')

@section('content')


<div class="d-flex0 justify-content-between0 my-5 row">
	<div class="col text-center">
		<h1 id="portfolio" class="text-center text-lg-left container">Portfolio</h1>
	</div>
	<div class="col-lg-auto">
		<div id="filters" class="h6 filters d-flex flex-wrap justify-content-center aligncenter">
			@php $args= array('hide_empty' => true ); $tags = get_terms('category', $args);
			foreach ($tags as $tag){
				$tag_slug = $tag->slug;
				echo "<button role='button' class='mx-1 mb-2 btn btn-sm btn-primary text-uppercase' data-loading-text='{$tag->name}' data-filter='.{$tag->slug}'>{$tag->name}</button>";
			}
			@endphp
		</div>
	</div>
</div>

<img src="@asset('images/iso.png')" class="d-none">
<div class="grid" id="pack" >
	<div class="grid-sizer"></div>
  @while (have_posts()) @php(the_post())
    @include('partials.content-'.get_post_type())
  @endwhile
</div>

@endsection
