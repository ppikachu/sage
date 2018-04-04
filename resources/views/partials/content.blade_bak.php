<article @php $categories = get_the_category(); $separator = ' '; $output = '';
	$output .= "item ";
	if($categories){
		foreach($categories as $category) {
			$output .= $category->category_nicename.$separator;
		}
	echo "class='ajax p-1 ".trim($output, $separator)."'";} @endphp id="<?php echo $post->post_name; ?>" role="article">
	<a class="d-block rounded" href="{{ get_permalink() }}" data-toggle="tooltip" data-placement="bottom" title="@php echo the_title(); if (has_excerpt()) { echo " - ".get_the_excerpt(); } @endphp">
		@php(the_post_thumbnail('thumbnail', array('class' => 'rounded img-fluid')))
	</a>
	<div class="ajax-content"></div>
</article>
