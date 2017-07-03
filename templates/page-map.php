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
	<div id="garden-map" class="block container">
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
	</div><!-- #garden-map -->
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'page' ); ?>

	<?php endwhile; // end of the loop. ?>

</main><!-- #main -->

<?php get_footer(); ?>
