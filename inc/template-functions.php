<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package novus
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function novus_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'novus_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function novus_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'novus_pingback_header' );

/**
 * Route for news
 */

function novusPostQuery( $params ) {

	$perpage  = 6;
	$offset   = ( isset( $params[ 'offset' ] ) ) ? $params[ 'offset' ] : 0;
	$orderby  = 'date';
	$order    = 'DESC';

	$args = [
		'post_type'   => 'post',
		// 'numberposts' => $perpage,
		'offset'      => $offset,
		'orderby'     => $orderby,
		'order'       => $order,
	];

	if ( isset( $params[ 'categories' ] ) ) {
		$args[ 'category__in' ] = explode( "," , $params[ 'categories' ] );
	}

	// get posts
	$posts = new WP_Query( $args );

	$data = [];
	$i = 0;

	// add custom field data to posts array
	foreach ($posts as $post) {
		// var_dump( $post );
		$thumbnail = get_the_post_thumbnail_url( $post->ID, 'thumb-370' );

		$data[ $i ][ 'id' ]              = $post->ID;
		$data[ $i ][ 'link' ]            = get_permalink( $post->ID );
		$data[ $i ][ 'title' ]           = $post->post_title;
		$data[ $i ][ 'date' ]            = $post->post_date;
		$data[ $i ][ 'thumbnail' ]       = $thumbnail;
		$data[ $i ][ 'excerpt' ]         = $post->post_excerpt;

		$i++;
	}
	return $data;
}

// register the endpoint
add_action( 'rest_api_init', function () {
	register_rest_route( 'novus/v1', 'posts/', [
		'methods' => 'GET',
		'callback' => 'novusPostQuery',
		'permission_callback' => '__return_true',
	] );
} );