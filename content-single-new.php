<?php
/**
 * @package _mbbasetheme
 */

$loop_prefix = 'new';
$img_size = 'thumb';

if ( has_post_thumbnail() ) {
	$loop_image = '<div class="col-md-4"><figure class="'.$loop_prefix.'-img">'.get_the_post_thumbnail($post->ID,$img_size,array('class' => 'img-responsive')).'</figure></div>';
} else { $loop_image = ""; }

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>>
	<header class="entry-header row">
		<?php the_title( '<h1 class="entry-title col-sm-12">', '</h1>' ); ?>
		<div class="clearfix"></div>
		<div class="col-sm-8 entry-meta">
			<ul class="list-inline">
				<li><?php _mbbasetheme_posted_on(); ?></li>
				<li><?php edit_post_link( __( 'Edit', '_mbbasetheme' ), '<span class="edit-link">', '</span>' ); ?></li>
			</ul>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="row">
		<div class="col-sm-8">
			<div class="entry-content"><?php the_content(); ?></div>
		</div>
		<?php echo $loop_image; ?>
	</div>
</article><!-- #post-## -->
