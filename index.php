<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package novus
 */

get_header();
?>

<section class="works">
	<div class="container">
		<div class="masonry masonry--h">

			<?php
			$work_args = [
				'category_name'  => 'work',
				'order'          => 'ASC',
				'posts_per_page' => 5
			];

			$works = new WP_Query( $work_args );

			if ( $works->have_posts() ) :
				while ( $works->have_posts() ) : $works->the_post();
					get_template_part( 'template-parts/content', 'work' );
				endwhile;
			endif;
			wp_reset_postdata();
			?>

		</div>
	</div>
</section>

<section class="slogan">
	<div class="container">
		<h2>
		Together is a full-service agency that <br> builds products, brands and websites <br> with ambitious tech companies.
		</h2>
	</div>
</section>

<section class="partners">
	<div class="container">
		<div class="row">

			<?php
			$partner_args = [
				'category_name'  => 'partner',
				'order'          => 'ASC',
				'posts_per_page' => -1
			];

			$works = new WP_Query( $partner_args );

			if ( $works->have_posts() ) :
				while ( $works->have_posts() ) : $works->the_post();
					get_template_part( 'template-parts/content', 'partner' );
				endwhile;
			endif;
			wp_reset_postdata();
			?>
			
		</div>
	</div>
</section>
<?php
get_footer();
