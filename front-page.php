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
	// SLIDESHOW
	////
	?>
		<section id="featured" class="home-block container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php _mbbasetheme_get_carousel($post->ID); ?>
				</div>
			</div>
		</section>

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

		<section id="news" class="home-block container-fluid">
			<header class="row"><h2 class="col-sm-12"><?php _e('Last news','_mbbasetheme') ?></h2></header>
			<div class="row">
				<?php while ( $news->have_posts() ) : $news->the_post();
					get_template_part( 'content', 'actividad' );
				endwhile; // end of the loop. ?>
			</div>
		</section><!-- #news -->

	<?php endif;

	// GARDENS
	////
	$args = array(
		'post_type' => 'garden',
		'posts_per_page' => '4',
	);
	$gardens = new WP_Query($args);
	if ( $gardens->have_posts() ) :
	?>

		<section id="gardens" class="home-block container-fluid">
			<header class="row"><h2 class="col-sm-12"><?php _e('Last published gardens','_mbbasetheme') ?></h2></header>
			<div class="row">
				<?php while ( $gardens->have_posts() ) : $gardens->the_post();
					get_template_part( 'content', 'garden' );
				endwhile; // end of the loop. ?>
			</div>
		</section><!-- #gardens -->

	<?php endif;?>

</main><!-- #main -->

<?php get_footer(); ?>
