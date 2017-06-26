<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package _mbbasetheme
 */

get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php
	// SLIDESHOW
	////
	get_template_part( 'content', 'carousel' );

	while ( have_posts() ) : the_post();

		get_template_part( 'content', 'page' );

		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // end of the loop. ?>

</main><!-- #main -->

<?php get_footer(); ?>
