<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package novus
 */

get_header();
?>

<section class="single-post-content">
	<div class="container">
		<h1><?php the_title(); ?></h1>

		<?php the_post_thumbnail( 'full' ) ?>

		<?php the_content(); ?>
	</div>
</section>

<?php
get_footer();
