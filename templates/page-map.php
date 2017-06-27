<?php
/**
 * Template Name: Map Page
 *
 * Displays content for map page layouts
 *
 * @package _mbbasetheme
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<div id="garden-map" class="block container-fluid">
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
					'popup_text' => 'excerpt'
				);
				wpmap_showmap($args); ?>
			</div>
		</div>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'page' ); ?>

	<?php endwhile; // end of the loop. ?>
		<div class="row">
			<div class="col-sm-12"><div class="mapdown"><img src="<?php echo MB_BLOGTHEME; ?>/assets/images/mapa.huertos.comunitarios.madrid-v.161118-part.png" alt="<?php _e('Download the map in PDF format','mbbasetheme'); ?>" /><div class="mapdown-caption"><a href="<?php echo MB_BLOGTHEME; ?>/assets/images/mapa.huertos.comunitarios.madrid-v.161118.pdf"><i class="fa fa-5x fa-arrow-down"></i> <i class="fa fa-5x fa-map"></i><br /><?php _e('Download the map in PDF format','mbbasetheme'); ?></a></div></div></div>
		</div>

	</div><!-- #garden-map -->
</main><!-- #main -->

<?php get_footer(); ?>
