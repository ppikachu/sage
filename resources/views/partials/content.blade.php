<article @php $categories = get_the_category(); $separator = ' '; $output = '';
	$output .= "item ";
	if($categories){
		foreach($categories as $category) {
			$output .= $category->category_nicename.$separator;
		}
	echo "class='ajax p-1 ".trim($output, $separator)."'";} @endphp id="<?php echo $post->post_name; ?>" role="article">
	<a class="d-block" href="{{ get_permalink() }}" data-toggle="tooltip" data-placement="bottom" title="{{ the_title() }}">
		@php(the_post_thumbnail('thumbnail', array('class' => 'rounded img-fluid')))
	</a>
</article>
