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
	get_template_part( 'content', 'carousel' );

	// NEWS
	////
	$args = array(
		'post_type' => array('activity','download','new'),
		'posts_per_page' => '4',
/*		'meta_query' => array(
			array(
				'key'     => '_act_date_end',
				'value'   => date( "Y-m-d" ),
				'compare' => '>',
			),
		)*/
	);
	$news = new WP_Query($args);
	if ( $news->have_posts() ) :
	?>

		<section id="news" class="block container">
			<header class="row"><h2 class="col-sm-12"><?php _e('Last publications','_mbbasetheme') ?></h2></header>
			<div class="row">
				<?php while ( $news->have_posts() ) : $news->the_post();
					get_template_part( 'content', get_post_type() );
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

		<section id="gardens" class="block container">
			<header class="row"><h2 class="col-sm-12"><?php _e('Last gardens','_mbbasetheme') ?></h2></header>
			<div class="row">
				<?php while ( $gardens->have_posts() ) : $gardens->the_post();
					get_template_part( 'content', 'garden' );
				endwhile; // end of the loop. ?>
			</div>
		</section><!-- #gardens -->
	<?php endif;

	// MAP
	////
	?>
		<section id="garden-map" class="block container">
			<header class="row"><h2 class="col-sm-12"><?php _e('Map of community gardens in Madrid','_mbbasetheme') ?></h2></header>
			<div class="row">
				<div class="col-sm-12">
					<?php $args = array(
						'post_type' => 'garden',
						'post_status' => "publish",
						'layers_by' => "post_type",
						'layers' => "garden",
						'colors' => "#ff0",
						'icons' => "",
						'marker_type' => 'icon',
						//'marker_radius' => 10,
						//'marker_opacity' => 0.5,
						//'marker_fillOpacity' => 0.5,
						'popup_text' => 'excerpt'
					);
					wpmap_showmap($args); ?>
				</div>
			</div>
		</section><!-- #map -->

</main><!-- #main -->

<?php get_footer(); ?>
