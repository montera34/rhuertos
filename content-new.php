<?php
$loop_prefix = 'new';
$img_size = 'medium';
$loop_classes = 'col-sm-3 '.$loop_prefix;

$loop_perma = get_permalink();
if ( has_post_thumbnail() ) {
	$loop_image = '<figure class="'.$loop_prefix.'-img"><a href="' .$loop_perma. '">'.get_the_post_thumbnail($post->ID,$img_size,array('class' => 'img-responsive')).'</a></figure>';
} else { $loop_image = ""; }

$loop_desc = get_the_excerpt();
$loop_tit = get_the_title();
$loop_date = get_the_time('d\/m\/Y');
?>

<article class="<?php echo $loop_classes; ?>">
	<?php echo $loop_image ?>
	<div class="<?php echo $loop_prefix; ?>-text">
		<header class="<?php echo $loop_prefix; ?>-heading">
			<a href="<?php echo $loop_perma ?>"><h3 class="<?php echo $loop_prefix; ?>-tit"><?php echo $loop_tit ?></h2></a>
			<span class="<?php echo $loop_prefix; ?>-date"><?php echo $loop_date ?></span>
		</header>
		<div class="<?php echo $loop_prefix; ?>-desc">
			<?php echo $loop_desc; ?>
		</div>
	</div>
	
</article>

