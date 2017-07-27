<?php
/**
 * @package _mbbasetheme
 */

$loop_prefix = 'download';
$img_size = 'thumb';

$img_other = get_post_meta($post->ID,'_img_other',true);
if ( $img_other != '' ) {
	$src = wp_get_attachment_image_src( $img_other['ID'],$img_size );
	$loop_img_other = '<div class="col-sm-4"><figure class="'.$loop_prefix.'-img-other"><img class="img-responsive" src="'.$src[0].'" alt="'.get_the_title().'" /></figure></div>';
} else { $loop_img_other = ""; }

$f = get_post_meta($post->ID,'_download_file',true);
if ( $f != '' ) {
	$f_mime = $f['post_mime_type'];
	if (strpos($f_mime, 'audio') !== false) { $f_mime_i = 'file-audio-o';}
	elseif (strpos($f_mime, 'image') !== false) { $f_mime_i = 'file-image-o';}
	elseif (strpos($f_mime, 'pdf') !== false) { $f_mime_i = 'file-pdf-o';}
	elseif (strpos($f_mime, 'text') !== false) { $f_mime_i = 'file-text-o';}
	elseif (strpos($f_mime, 'video') !== false) { $f_mime_i = 'file-video-o';}
	else { $f_mime_i = 'file-archive-o';}
	$f_url = $f['guid'];
	$f_out = '<div class="col-md-2"><div class="'.$loop_prefix.'-file"><a href="'.$f_url.'"><i class="fa fa-2x fa-arrow-down"></i> <i class="fa fa-2x fa-'.$f_mime_i.'"></i></a></div></div>';
}
$c = get_the_content();
$c_out = ( $c != '' ) ? '<div class="col-sm-6"><div class="entry-content">'.apply_filters('the_content',$c).'</div></div>' : '';

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
		<?php echo $c_out; ?>
		<?php echo $f_out; ?>
		<?php echo $loop_img_other; ?>
	</div>
</article><!-- #post-## -->
