<?php
$loop_prefix = 'download';
$img_size = 'medium';
$loop_classes = 'col-sm-3 '.$loop_prefix;

$loop_perma = get_permalink();
if ( has_post_thumbnail() ) {
	$loop_image = '<figure class="'.$loop_prefix.'-img"><a href="' .$loop_perma. '">'.get_the_post_thumbnail($post->ID,$img_size,array('class' => 'img-responsive')).'</a></figure>';
} else { $loop_image = ""; }

$loop_desc = get_the_excerpt();
$loop_tit = get_the_title();
$loop_date = get_the_time('d\/m\/Y');
$fields = array(
	'desc' => get_the_excerpt(),
	'file' => get_post_meta($post->ID,'_download_file',true),
);
foreach ( $fields as $k => $f ) {
	switch ($k) {
		case 'file' :
			if ( $f == '' ) break;
			$f_mime = $f['post_mime_type'];
			if (strpos($f_mime, 'audio') !== false) { $f_mime_i = 'file-audio-o';}
			elseif (strpos($f_mime, 'image') !== false) { $f_mime_i = 'file-image-o';}
			elseif (strpos($f_mime, 'pdf') !== false) { $f_mime_i = 'file-pdf-o';}
			elseif (strpos($f_mime, 'text') !== false) { $f_mime_i = 'file-text-o';}
			elseif (strpos($f_mime, 'video') !== false) { $f_mime_i = 'file-video-o';}
			else { $f_mime_i = 'file-archive-o';}
			$f_url = $f['guid'];
			$$k = '<footer class="'.$loop_prefix.'-'.$k.'"><a href="'.$f_url.'"><i class="fa fa-2x fa-arrow-down"></i> <i class="fa fa-2x fa-'.$f_mime_i.'"></i></a></footer>';
			break;
		default :
			$$k = ( $f != '' ) ? '<div class="'.$loop_prefix.'-'.$k.'">' .$f. '</div>': '';
			break;
	}
}

?>

<article class="<?php echo $loop_classes; ?>">
	<?php echo $loop_image ?>
	<div class="<?php echo $loop_prefix; ?>-text">
		<header class="<?php echo $loop_prefix; ?>-heading">
			<a href="<?php echo $loop_perma ?>"><h3 class="<?php echo $loop_prefix; ?>-tit"><?php echo $loop_tit ?></h2></a>
			<?php echo $date ?>
		</header>
		<div class="<?php echo $loop_prefix; ?>-desc">
			<?php echo $desc; ?>
			<?php echo $file; ?>
		</div>
	</div>
	
</article>

