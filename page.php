<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package novus
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();
?>
<section class="banner" style="background:url(<?php the_post_thumbnail_url( 'full' ) ?>) center / cover no-repeat">
	<div class="container">
		<h1>Barrier-free windows and doors</h1>
		<p>
			Windows flood living spaces with light, ensure a clear view and provide protection from the weather and environment. With their timeless design and intelligent technology, Schüco window systems create visual accents. Their excellent thermal insulation also saves on energy costs, increasing the value of your home and conserving the environment.
		</p>
	</div>
</section>

<section class="product-menu">
	<div class="container">
		<?php wp_nav_menu( ['theme_location' => 'menu-2'] ); ?>
	</div>
</section>

<?= novus_breadcrumbs(); ?>

<div class="container page-content">
	<?php the_content(); ?>
</div>

<?php endwhile; ?>
<?php
get_footer();
