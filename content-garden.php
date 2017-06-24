<?php
$loop_prefix = 'garden';
$img_size = 'medium';
$loop_classes = 'col-sm-3 '.$loop_prefix;

$loop_perma = get_permalink();
if ( has_post_thumbnail() ) {
	$loop_image = '<figure class="'.$loop_prefix.'-img"><a href="' .$loop_perma. '">'.get_the_post_thumbnail($post->ID,$img_size,array('class' => 'img-responsive')).'</a></figure>';
} else { $loop_image = ""; }

$loop_desc = get_the_excerpt();
$loop_tit = get_the_title();
$fields = array(
	'address' => get_post_meta($post->ID,'_garden_address',true),
	'district' => get_post_meta($post->ID,'_garden_district',true),
	'desc' => get_the_excerpt(),
	'icon' => get_post_meta($post->ID,'_garden_icon',true)
);
foreach ( $fields as $k => $f ) {
	switch ($k) {
		case 'icon' :
			$$k = ( $f != '' ) ? '<footer class="'.$loop_prefix.'-'.$k.'"><img src="'.$f['guid'].'" alt="'.$f['post_title'].'" /></footer>': '';
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
			<?php echo $address; ?>
			<?php echo $district; ?>
		</header>
		<?php echo $desc; ?>
		<?php echo $icon; ?>
	</div>
	
</article>

