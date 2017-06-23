<?php
/**
 * The template for displaying the front page.
 *
 * This is the template that displays on the front page only.
 *
 * @package _mbbasetheme
 */

get_header(); ?>


<main id="main" class="site-main" role="main">

	<?php
	// NEWS
	////
	$args = array(
		'post_type' => ';post',
		'posts_per_page' => '4'
	);
	$news = new WP_Query($args);
	if ( $news->have_posts() ) :
	?>

		<section id="news" class="container-fluid">
			<header class="row"><h2 class="col-sm-12"><?php _e('Last news','_mbbasetheme') ?></h2></header>
			<div class="row">
				<?php while ( $news->have_posts() ) : $news->the_post();
					get_template_part( 'content', 'post' );
				endwhile; // end of the loop. ?>
			</div>
		</section><!-- #news -->

	<?php endif; ?>

</main><!-- #main -->

<?php get_footer(); ?>
