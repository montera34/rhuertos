<?php
/**
 * The template for displaying all single posts.
 *
 * @package _mbbasetheme
 */

get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php
	$pt = get_post_type();
	if ( $pt == 'garden' ) {
		// SLIDESHOW
		////
		get_template_part( 'content', 'carousel' );
	}

	while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content-single', $pt ); ?>

		<?php //_mbbasetheme_post_nav(); ?>

		<?php
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() ) :
			comments_template();
		endif;
		?>

	<?php endwhile; // end of the loop. ?>

</main><!-- #main -->

<?php get_footer(); ?>
