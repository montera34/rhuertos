<?php
/**
 * Template Name: Gardens Page
 *
 * Displays content for garden mosaic page layouts
 *
 * @package _mbbasetheme
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<section id="gardens" class="block container">
		<?php while ( have_posts() ) : the_post(); ?>
			<header class="row"><?php the_title( '<h1 class="col-sm-12 entry-title hidden">', '</h1>' ); ?></header>
		<?php endwhile; // end of this page loop

		// GARDENS
		//// 
		$args = array(
			'post_type' => 'garden',
			'nopaging' => 'true',
			'orderby' => 'meta_value_num',
			'meta_key' => '_garden_num',
			'order' => 'ASC'
		);
		$items = new WP_Query($args);
		if ( $items->have_posts() ) :
			// FILTERS
			get_template_part( 'content', 'garden-filters' ); ?>
	
			<div class="row gardens">
				<?php
				$count = 0;
				$break = 0;
				$loop = "space";
				while ( $items->have_posts() ) : $items->the_post();
					$count++;$break++;
					get_template_part('content','garden');
				endwhile; // end of gardens loop
				wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>
	</section>
</main><!-- #main -->

<?php get_footer(); ?>
