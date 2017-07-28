<?php
/**
 * The template for displaying search results pages.
 *
 * @package _mbbasetheme
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<section id="gardens" class="block container">

		<?php if ( have_posts() ) : ?>

			<header class="row">
				<h1 class="col-md-12"><?php printf( __( 'Search Results for: %s', '_mbbasetheme' ), '<span class="search-string">' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .row -->

			<div class="row gardens">
				<?php
				$count = 0;
				$break = 0;
				$loop = "space";
				while ( have_posts() ) : the_post();
					$count++;$break++;

					get_template_part( 'content', 'garden' );

				endwhile; ?>
			</div>

			<?php _mbbasetheme_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</section><!-- #primary -->
</main><!-- #main -->

<?php get_footer(); ?>
