<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
		/** Add page slug if it doesn't exist */
		if (is_single() || is_page() && !is_front_page()) {
				if (!in_array(basename(get_permalink()), $classes)) {
						$classes[] = basename(get_permalink());
				}
		}

		/** Add class if sidebar is active */
		if (display_sidebar()) {
				$classes[] = 'sidebar-primary';
		}

		/** Clean up class names for custom templates */
		$classes = array_map(function ($class) {
				return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
		}, $classes);

		return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
		return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
		'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
		'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
		add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
		$data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
				return apply_filters("sage/template/{$class}/data", $data, $template);
		}, []);
		if ($template) {
				echo template($template, $data);
				return get_stylesheet_directory().'/index.php';
		}
		return $template;
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
		$comments_template = str_replace(
				[get_stylesheet_directory(), get_template_directory()],
				'',
				$comments_template
		);
		return template_path(locate_template(["views/{$comments_template}", $comments_template]) ?: $comments_template);
});


add_filter('sage/display_sidebar', function ($display) {
		static $display;

		isset($display) || $display = in_array(true, [
			// The sidebar will be displayed if any of the following return true
			//is_tax(),
			// ... more types
		]);

		return true; // $display
});

/* Filter parameters into oEmbed requests */
function add_param_oembed_fetch_url( $provider, $url, $args) {
	if ( strstr( $provider, 'vimeo.com' ) ) {
		$provider = add_query_arg( 'title', 0 , $provider );
		$provider = add_query_arg( 'byline', 0 , $provider );
		$provider = add_query_arg( 'portrait', 0 , $provider );
		$provider = add_query_arg( 'color', '806fff' , $provider );
	}
	return $provider;
}
add_filter( 'oembed_fetch_url', __NAMESPACE__ . '\\add_param_oembed_fetch_url', 10, 3);

function iweb_modest_player( $cache, $url, $attr, $post_id ) {
	if ( strstr( $cache, 'youtube.com' ) ) {
	// $cache = str_replace( '<iframe ', '<iframe class="my-class" ', $cache );
		$cache = str_replace( '?feature=oembed', '?feature=oembed&modestbranding=1&showinfo=0&rel=0&enablejsapi=1', $cache );
	}
	if ( strstr( $cache, 'vimeo.com' ) ) {
		$url = add_query_arg( array('title' => '0' ), $url );
		$cache = wp_oembed_get( $url );
	}
	return $cache;
}
add_filter( 'embed_oembed_html', __NAMESPACE__ . '\\iweb_modest_player', 10, 4 );
