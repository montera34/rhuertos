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
		'post_type' => 'actividad',
		'posts_per_page' => '4',
		'meta_query' => array(
			array(
				'key'     => '_act_date_end',
				'value'   => date( "Y-m-d" ),
				'compare' => '>',
			),
		)
	);
	$news = new WP_Query($args);
	if ( $news->have_posts() ) :
	?>

		<section id="news" class="container-fluid">
			<header class="row"><h2 class="col-sm-12"><?php _e('Last news','_mbbasetheme') ?></h2></header>
			<div class="row">
				<?php while ( $news->have_posts() ) : $news->the_post();
					get_template_part( 'content', 'actividad' );
				endwhile; // end of the loop. ?>
			</div>
		</section><!-- #news -->

	<?php endif; ?>

</main><!-- #main -->

<?php get_footer(); ?>
