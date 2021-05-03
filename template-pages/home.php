<?php
/**
 * Template Name: Home
 */
get_header();

get_template_part( 'template-parts/home/banner' );
get_template_part( 'template-parts/home/intro' );
get_template_part( 'template-parts/home/news' );
get_template_part( 'template-parts/home/project' );
get_template_part( 'template-parts/home/product' );
get_template_part( 'template-parts/home/map' );

get_footer();