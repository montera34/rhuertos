<?php
/**
 * Template Name: Blog Page
 *
 * Displays content for blog page layouts
 * incluing activities, news and downloads
 *
 * @package _mbbasetheme
 */

get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php
	// ACTIVITIES
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
	$activities = new WP_Query($args);
	if ( $activities->have_posts() ) :
	?>

		<section id="activities" class="block container">
			<header class="row"><h2 class="col-sm-12"><a href="/actividades"><?php _e('Activities','_mbbasetheme') ?></a></h2></header>
			<div class="row">
				<?php while ( $activities->have_posts() ) : $activities->the_post();
					get_template_part( 'content', 'actividad' );
				endwhile; // end of the loop. ?>
			</div>
		</section><!-- #news -->

	<?php
	endif;

	// NEWS
	////
	$args = array(
		'post_type' => 'new',
		'posts_per_page' => '4',
	);
	$news = new WP_Query($args);
	if ( $news->have_posts() ) :
	?>

		<section id="news" class="block container">
			<header class="row"><h2 class="col-sm-12"><a href="/noticias"><?php _e('News','_mbbasetheme') ?></a></h2></header>
			<div class="row">
				<?php while ( $news->have_posts() ) : $news->the_post();
					get_template_part( 'content', 'new' );
				endwhile; // end of the loop. ?>
			</div>
		</section><!-- #news -->

	<?php endif;

	// NEWS
	////
	$args = array(
		'post_type' => 'download',
		'posts_per_page' => '4',
	);
	$downloads = new WP_Query($args);
	if ( $downloads->have_posts() ) :
	?>

		<section id="downloads" class="block container">
			<header class="row"><h2 class="col-sm-12"><a href="/descargas"><?php _e('Downloads','_mbbasetheme') ?></a></h2></header>
			<div class="row">
				<?php while ( $downloads->have_posts() ) : $downloads->the_post();
					get_template_part( 'content', 'download' );
				endwhile; // end of the loop. ?>
			</div>
		</section><!-- #news -->

	<?php endif; ?>
</main><!-- #main -->


<?php get_footer(); ?>
