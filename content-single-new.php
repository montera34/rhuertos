<?php
/**
 * @package _mbbasetheme
 */

$loop_prefix = 'new';
$img_size = 'thumb';

$img_other = get_post_meta($post->ID,'_img_other',true);
if ( $img_other != '' ) {
	$src = wp_get_attachment_image_src( $img_other['ID'],$img_size );
	$loop_img_other = '<div class="col-sm-4"><figure class="'.$loop_prefix.'-img-other"><img class="img-responsive" src="'.$src[0].'" alt="'.get_the_title().'" /></figure></div>';
} else { $loop_img_other = ""; }
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
		<?php echo $loop_img_other; ?>
	</div>
</article><!-- #post-## -->
