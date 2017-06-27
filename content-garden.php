<?php
$loop_prefix = 'garden';
$img_size = 'medium';
$loop_classes = 'col-sm-3 '.$loop_prefix;

$loop_perma = get_permalink();
if ( has_post_thumbnail() ) {
	$loop_image = '<a href="' .$loop_perma. '">'.get_the_post_thumbnail($post->ID,$img_size,array('class' => 'img-responsive')).'</a>';
} else { $loop_image = ""; }

$loop_tit = get_the_title();
$fields = array(
	'address' => get_post_meta($post->ID,'_garden_address',true),
	'district' => get_the_terms($post->ID,'district'),
//	'desc' => get_the_excerpt(),
	'typo' => get_the_terms($post->ID,'typology'),
	'icon' => get_post_meta($post->ID,'_garden_icon',true)
);
foreach ( $fields as $k => $f ) {
	switch ($k) {
		case 'typo' :
			if ( $f === false ) break;
			foreach ( $f as $t ) {
				$loop_classes .= ' '.$t->slug;
				$loop_color = get_term_meta( $t->term_id,'_typology_color',true );
				$loop_color = ( $loop_color == '' ) ? '#2b3423': $loop_color;
				$loop_bgcolor = get_term_meta( $t->term_id,'_typology_bgcolor',true );
				$loop_bgcolor = ( $loop_bgcolor == '' ) ? '#fff': $loop_bgcolor;
				$loop_style = ' style="background-color: '.$loop_bgcolor.'; color: '.$loop_color.';"';
			}
			break;
		case 'icon' :
			$$k = ( $f != '' ) ? '<figure class="'.$loop_prefix.'-img"'.$loop_style.'>'.$loop_image.'<figcaption><img class="'.$loop_prefix.'-'.$k.'" src="'.$f['guid'].'" alt="'.$f['post_title'].'" /></figcaption></figure>': '';
			break;
		case 'district' :
			if ( $f === false ) break;
			foreach ( $f as $t ) {
				$loop_classes .= ' '.$t->slug;
				$$k = '<div class="'.$loop_prefix.'-'.$k.'"><div class="'.$loop_prefix.'-'.$k.'-inner">' .$t->name. '</div></div>';
			}
			break;
		default :
			$$k = ( $f != '' ) ? '<div class="'.$loop_prefix.'-'.$k.'">' .$f. '</div>': '';
			break;
	}
}
?>

<article class="<?php echo $loop_classes; ?>">
	<?php echo $icon; ?>
	<div class="<?php echo $loop_prefix; ?>-text"<?php echo $loop_style; ?>>
		<header class="<?php echo $loop_prefix; ?>-heading">
			<a href="<?php echo $loop_perma ?>"><h3 class="<?php echo $loop_prefix; ?>-tit"<?php echo $loop_style ?>><?php echo $loop_tit ?></h2></a>
		</header>
		<?php //echo $address; ?>
		<?php echo $district; ?>
	</div>
	
</article>

