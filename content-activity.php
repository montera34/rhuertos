<?php
$loop_prefix = 'actividad';
$img_size = 'medium';
$loop_classes = 'col-sm-3 '.$loop_prefix;

$loop_perma = get_permalink();
if ( has_post_thumbnail() ) {
	$loop_image = '<figure class="'.$loop_prefix.'-img"><a href="' .$loop_perma. '">'.get_the_post_thumbnail($post->ID,$img_size,array('class' => 'img-responsive')).'</a></figure>';
} else { $loop_image = ""; }

$loop_tit = get_the_title();
$fields = array(
//	'date' => get_post_meta($post->ID,'_act_date_end',true),
	'garden' => get_post_meta($post->ID,'_act_garden',true),
	'desc' => get_the_excerpt(),
	'org' => get_the_terms($post->ID,'organizer')
);
foreach ( $fields as $k => $f ) {
	switch ($k) {
		case 'org' :
			if ( $f === false ) break;
			$$k = '';
			foreach ( $f as $t ) {
				$o_icon = get_term_meta( $t->term_id,'organize_icon',true );
				$$k .= ( $o_icon != '' ) ? '<img src="'.$o_icon['guid'].'" alt="'.$t->name.'" />': '';
			}
			$$k = ( $$k != '' ) ? '<footer class="'.$loop_prefix.'-'.$k.'">'.$$k.'</footer>': '';
			break;
		case 'garden' :
			if ( $f != '' ) {
				$garden = '<div class="'.$loop_prefix.'-'.$k.'"><i class="fa fa-map-marker"></i> <strong>'.$f['post_title'].'</strong></div>';
			} else { $garden = '<div class="'.$loop_prefix.'-'.$k.'"><i class="fa fa-map-marker"></i> '.__('See content for details','_mbbasetheme').'</div>'; }
			break;
		default :
			$$k = ( $f != '' ) ? '<div class="'.$loop_prefix.'-'.$k.'">' .$f. '</div>': '';
			break;
	}
}

// date
$bd = get_post_meta($post->ID,'_act_date_begin',true);
$bd_raw = strtotime(pods_field_raw ( 'activity', $post->ID, '_act_date_begin', true ));
$ed = get_post_meta($post->ID,'_act_date_end',true);
$ed_raw = strtotime(pods_field_raw ( 'activity', $post->ID, '_act_date_end', true ));
$now = strtotime( date("Y-m-d") );
$all_day = get_post_meta($post->ID,'_act_all_day',true);

if ( $bd_raw == $ed_raw ) { $date = '<i class="fa fa-calendar-o"></i> '.$bd; }
else { $date = '<i class="fa fa-calendar-o"></i> '.$bd.' <i class="fa fa-chevron-right"></i> '.$ed; }
?>

<article class="<?php echo $loop_classes; ?>">
	<?php echo $loop_image ?>
	<div class="<?php echo $loop_prefix; ?>-text">
		<header class="<?php echo $loop_prefix; ?>-heading">
			<a href="<?php echo $loop_perma ?>"><h3 class="<?php echo $loop_prefix; ?>-tit"><?php echo $loop_tit ?></h2></a>
			<?php echo $date; ?>
			<?php echo $garden; ?>
		</header>
		<?php echo $desc; ?>
		<?php echo $org; ?>
	</div>
	
</article>

