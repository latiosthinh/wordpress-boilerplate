<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package novus
 */

if ( ! function_exists( 'novus_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function novus_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date( 'd/m/Y' ) )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'novus' ),
			$time_string
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'novus_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function novus_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'novus' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'novus_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function novus_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'novus' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'novus' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'novus' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'novus' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'novus' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'novus' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'novus_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function novus_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

// Breadcrumbs
function vt_get_term_parents( $term_id = '', $taxonomy = 'category' ) {
	// Set up some default arrays.
	$list = array();

	// If no term ID or taxonomy is given, return an empty array.
	if ( empty( $term_id ) || empty( $taxonomy ) ) {
		return $list;
	}

	do {
		$list[] = $term_id;

		// Get next parent term.
		$term    = get_term( $term_id, $taxonomy );
		$term_id = $term->parent;
	} while ( $term_id );

	// Reverse the array to put them in the proper order for the trail.
	$list = array_reverse( $list );
	array_pop( $list );

	return $list;
}

function novus_breadcrumbs( $args = '' ) {
	if ( is_front_page() ) {
		return;
	}

	$args = wp_parse_args(
		$args,
		array(
			'separator'         => '<i>&gt;</i>',
			'home_label'        => esc_html__( 'Home', 'novus' ),
			'home_class'        => 'home',
			'before'            => '<section class="breadcrumbs-wrapper"><ul class="breadcrumbs container">',
			'after'             => '</ul></section>',
			'before_item'       => '<li class="breadcrumbs-item">',
			'after_item'        => '</li>',
			'taxonomy'          => 'category',
			'display_last_item' => true,
		)
	);

	$args = apply_filters( 'novus_breadcrumbs_args', $args );

	$items = array();

	$title = '';

	// HTML template for each item.
	$item_tpl_link = $args['before_item'] . '
		<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<a href="%s" itemprop="url"><span itemprop="title">%s</span></a>
		</span>
	' . $args['after_item'];
	$item_text_tpl = $args['before_item'] . '
		<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<span itemprop="title">%s</span>
		</span>
	' . $args['after_item'];

	// Home.
	if ( ! $args['home_class'] ) {
		$items[] = sprintf( $item_tpl_link, esc_url( home_url( '/' ) ), $args['home_label'] );
	} else {
		$items[] = $args['before_item'] . sprintf(
			'<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<a class="%s" href="%s" itemprop="url"><span itemprop="title">%s</span></a>
			</span>' . $args['after_item'],
			esc_attr( $args['home_class'] ),
			esc_url( home_url() ),
			$args['home_label']
		);
	}

	if ( is_home() && ! is_front_page() ) {
		$page = get_option( 'page_for_posts' );
		if ( $args['display_last_item'] ) {
			$title = get_the_title( $page );
		}
	} elseif ( is_post_type_archive() ) {
		// If post is a custom post type.
		$query     = get_queried_object();
		$post_type = $query->name;
		
		$post_type_object       = get_post_type_object( $post_type );
		$post_type_archive_link = get_post_type_archive_link( $post_type );
		$title                  = $post_type_object->labels->menu_name;
	} elseif ( is_single() ) {

		// If post is a custom post type.
		$post_type = get_post_type();
		if ( 'post' !== $post_type ) {
			$post_type_object       = get_post_type_object( $post_type );
			$post_type_archive_link = get_post_type_archive_link( $post_type );
			$items[]                = sprintf( $item_tpl_link, $post_type_archive_link, $post_type_object->labels->menu_name );
		}
		// Terms.
		$terms = get_the_terms( get_the_ID(), $args['taxonomy'] );
		if ( $terms && ! is_wp_error( $terms ) ) {
			$term    = current( $terms );
			$terms   = vt_get_term_parents( $term->term_id, $args['taxonomy'] );
			$terms[] = $term->term_id;
			foreach ( $terms as $term_id ) {
				$term    = get_term( $term_id, $args['taxonomy'] );
				$items[] = sprintf( $item_tpl_link, get_term_link( $term, $args['taxonomy'] ), $term->name );
			}
		}

		if ( $args['display_last_item'] ) {
			$title = get_the_title();

		}
	} elseif ( is_tax() || is_category() || is_tag() ) {
		$current_term = get_queried_object();
		$terms        = vt_get_term_parents( get_queried_object_id(), $current_term->taxonomy );
		foreach ( $terms as $term_id ) {
			$term    = get_term( $term_id, $current_term->taxonomy );
			$items[] = sprintf( $item_tpl_link, get_category_link( $term_id ), $term->name );
		}
		if ( $args['display_last_item'] ) {
			$title = $current_term->name;

		}
	} elseif ( is_search() ) {
		/* translators: search query */
		$title = sprintf( esc_html__( 'Search results for &quot;%s&quot;', 'novus' ), get_search_query() );
	} elseif ( is_404() ) {
		$title = esc_html__( 'Not found', 'novus' );
	} elseif ( is_author() ) {
		$author_obj = get_queried_object();
		// Queue the first post, that way we know what author we're dealing with (if that is the case).
		$title = '<span class="vcard">' . $author_obj->display_name . '</span>';
	} elseif ( is_day() ) {
		$title = sprintf( esc_html( '%s', 'novus' ), get_the_date() );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html( '%s', 'novus' ), get_the_date( 'F Y' ) );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html( '%s', 'novus' ), get_the_date( 'Y' ) );
	} else {
		$title = esc_html__( get_queried_object()->post_title, 'novus' );
	} // End if().
	$items[] = sprintf( $item_text_tpl, $title );

	echo wp_kses_post( $args['before'] . implode( $args['separator'], $items ) . $args['after'] );
}