<?php
/**
 * @package _mbbasetheme
 */

$loop_prefix = 'actividad';
$img_size = 'thumb';

if ( has_post_thumbnail() ) {
	$loop_image = '<div class="col-md-4"><figure class="'.$loop_prefix.'-img">'.get_the_post_thumbnail($post->ID,$img_size,array('class' => 'img-responsive')).'</figure></div>';
} else { $loop_image = ""; }

$bd = get_post_meta($post->ID,'_act_date_begin',true);
$bd_raw = strtotime(pods_field_raw ( 'activity', $post->ID, '_act_date_begin', true ));
$bh = get_post_meta($post->ID,'_act_hour_begin',true);
$bh_raw = strtotime(pods_field_raw ( 'activity', $post->ID, '_act_hour_begin', true ));
$ed = get_post_meta($post->ID,'_act_date_end',true);
$ed_raw = strtotime(pods_field_raw ( 'activity', $post->ID, '_act_date_end', true ));
$eh = get_post_meta($post->ID,'_act_hour_end',true);
$eh_raw = strtotime(pods_field_raw ( 'activity', $post->ID, '_act_hour_end', true ));
$now = strtotime( date("Y-m-d") );
$all_day = get_post_meta($post->ID,'_act_all_day',true);

// when output
if ( $all_day == 1 ) {
	if ( $bd_raw == $ed_raw ) { $when_out = $bd; }
	else { $when_out = $bd.' - '.$ed; }
} else {
	if ( $bd_raw == $ed_raw ) {
		if ( $bh_raw == $eh_raw ) { $when_out = $bd.' <i class="fa fa-chevron-right"></i> '.$bh; }
		else { $when_out = $bd.' <i class="fa fa-chevron-right"></i> '.$bh.' - '.$eh; }
	} else {
		$when_out = $bd.' - '.$bh.' <i class="fa fa-chevron-right"></i> '.$ed.' - '.$eh;
	}
}

// where output
$garden = get_post_meta($post->ID,'_act_garden',true);
$where_out = ( is_array($garden) ) ? $garden['post_title'] : __('See content for details','_mbbasetheme');
// map if the activity is in a garden
$lat = get_post_meta($garden['ID'],'_garden_lat',true);
$lon = get_post_meta($garden['ID'],'_garden_lon',true);

// org output
$org = get_the_terms($post->ID,'organizer');
if ( $org !== false ) {
	$org_out = '';
	foreach ( $org as $t ) {
		$o_icon = get_term_meta( $t->term_id,'organize_icon',true );
		$org_out .= ( $o_icon != '' ) ? '<img class="actividad-org-i" src="'.$o_icon['guid'].'" alt="'.$t->name.'" /> '.sprintf(__('Organizer: %s','_mbbasetheme'),$t->name) : '';
	}
	$org_out = ( $org_out != '' ) ? '<li>'.$org_out.'</li>': '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>>
	<header class="entry-header row">
		<?php the_title( '<h1 class="entry-title col-sm-12">', '</h1>' ); ?>
		<div class="clearfix"></div>
		<div class="col-sm-8 entry-meta">
			<ul class="actividad-dates list-inline">
				<li><i class="fa fa-2x fa-calendar-o"></i> <?php echo $when_out; ?></li>
				<li><i class="fa fa-2x fa-map-marker"></i> <?php echo $where_out; ?></li>
				<?php echo $org_out; ?>
				<?php edit_post_link( __( 'Edit', '_mbbasetheme' ), '<li><span class="edit-link">', '</span></li>' ); ?>
			</ul>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="row">
		<div class="col-sm-8">
			<?php if ( is_array($garden) && $lat != '' && $lon != '' ) {
				$args = array(
					'center_lat' => $lat,
					'center_lon' => $lon,
					'zoom_ini' => '16',
					'post_in' => $garden['ID'],
					'post_type' => 'garden',
					'post_status' => "publish",
					'marker_type' => 'icon',
					'popup_text' => 'excerpt'
				);
				wpmap_showmap($args);
			} ?>
			<div class="entry-content"><?php the_content(); ?></div>
		</div>
		<?php echo $loop_image; ?>
	</div>
</article><!-- #post-## -->
