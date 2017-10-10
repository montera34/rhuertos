<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _mbbasetheme
 */

get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php if ( have_posts() ) :
		$pt = get_post_type_object(get_post_type());
		$a_class = $pt->name;
		$a_tit = $pt->label;
	?>

		<section id="<?php echo $a_class ?>" class="block container">
			<header class="row">
				<h1 class="col-sm-12 page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', '_mbbasetheme' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', '_mbbasetheme' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', '_mbbasetheme' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', '_mbbasetheme' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', '_mbbasetheme' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', '_mbbasetheme' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', '_mbbasetheme' );

						elseif ( is_post_type_archive( array('activity','download','new') ) ) :
							printf(__( 'Archives of %s', '_mbbasetheme' ), $a_tit);
						else :
							_e( 'Archives', '_mbbasetheme' );

						endif;
					?>
				</h1>
				<?php
				// Show an optional term description.
				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				endif;
				?>
			</header><!-- .page-header -->

			<div class="row">
				<?php
				$c = 0;
				while ( have_posts() ) : the_post();

					get_template_part( 'content', get_post_type() );
					$c++;
					if ( $c == 4 ) {
						$c == 0;
						echo '<div class="clearfix"></div>';
					}

				endwhile; ?>
			</div>

			<?php _mbbasetheme_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</section><!-- #primary -->
</main><!-- #main -->

<?php get_footer(); ?>
