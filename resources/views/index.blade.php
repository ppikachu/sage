@extends('layouts.app')

@section('content')
  {{-- @include('partials.page-header') --}}

<div id="filters1" class="filters btn-group btn-group-toggle d-flex0 my-4 d-none d-md-flex">
	@php $args= array('hide_empty' => true ); $tags = get_terms('category', $args);
	foreach ($tags as $tag){
		$tag_slug = $tag->slug;
		echo "<button role='button' class='btn btn-primary w-100' data-loading-text='{$tag->name}' data-filter='.{$tag->slug}'>{$tag->name}</button>";
	}
	@endphp
</div>

<div id="filters2" class="filters btn-group-sm btn-group-vertical btn-group-toggle d-flex my-3 d-md-none">
	@php $args= array('hide_empty' => true ); $tags = get_terms('category', $args);
	foreach ($tags as $tag){
		$tag_slug = $tag->slug;
		echo "<button role='button' class='btn btn-primary w-100' data-loading-text='{$tag->name}' data-filter='.{$tag->slug}'>{$tag->name}</button>";
	}
	@endphp
</div>

<div class="grid" id="pack" style="min-height:70vh;" >
	<div class="grid-sizer"></div>
  @while (have_posts()) @php(the_post())
    @include('partials.content-'.get_post_type())
  @endwhile
</div>

@endsection
