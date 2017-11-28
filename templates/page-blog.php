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
	$home = esc_url( home_url( '/' ));
	// ACTIVITIES
	////
	$args = array(
		'post_type' => 'activity',
		'posts_per_page' => '4',
/*		'meta_query' => array(
			array(
				'key'     => '_act_date_end',
				'value'   => date( "Y-m-d" ),
				'compare' => '>',
			),
		)*/
	);
	$activities = new WP_Query($args);
	if ( $activities->have_posts() ) :
	?>

		<section id="activities" class="block container">
			<header class="row">
				<h2 class="col-sm-10"><?php _e('Last activities','_mbbasetheme') ?></h2>
				<div class="col-sm-2 text-right"><a href="<?php echo $home ?>actividades"><i class="fa fa-plus-square" aria-hidden="true"></i> <?php _e('See more activities','_mbbasetheme'); ?></a></div>
			</header>
			<div class="row">
				<?php while ( $activities->have_posts() ) : $activities->the_post();
					get_template_part( 'content', 'activity' );
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
			<header class="row">
				<h2 class="col-sm-10"><?php _e('Last news','_mbbasetheme') ?></h2>
				<div class="col-sm-2 text-right"><a href="<?php echo $home ?>noticias"><i class="fa fa-plus-square" aria-hidden="true"></i> <?php _e('See more news','_mbbasetheme'); ?></a></div>
			</header>
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
			<header class="row">
				<h2 class="col-sm-10"><?php _e('Last downloads','_mbbasetheme') ?></h2>
				<div class="col-sm-2 text-right"><a href="<?php echo $home ?>descargas"><i class="fa fa-plus-square" aria-hidden="true"></i> <?php _e('See more downloads','_mbbasetheme'); ?></a></div>
			</header>
			<div class="row">
				<?php while ( $downloads->have_posts() ) : $downloads->the_post();
					get_template_part( 'content', 'download' );
				endwhile; // end of the loop. ?>
			</div>
		</section><!-- #news -->

	<?php endif; ?>
</main><!-- #main -->


<?php get_footer(); ?>
