<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package novus
 */

?>

<article id="post-<?php the_ID(); ?>" class="col-2">
	<?php the_content(); ?>
</article>
