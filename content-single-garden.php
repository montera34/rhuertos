<?php
/**
 * @package _mbbasetheme
 */

$loop_prefix = 'garden';
$img_size = 'thumb';

$g_img_other = get_post_meta($post->ID,'_garden_img_other',true);
if ( $g_img_other != '' ) {
	$src = wp_get_attachment_image_src( $g_img_other['ID'],$img_size );
	$loop_img_other = '<figure class="'.$loop_prefix.'-img-other"><img class="img-responsive" src="'.$src[0].'" alt="'.get_the_title().'" /></figure>';
} else {
	$loop_img_other = "";
}

// header card
$fields = array(
	'address' => get_post_meta($post->ID,'_garden_address',true),
	'district' => get_the_terms($post->ID,'district'),
	'entity' => get_post_meta($post->ID,'_garden_entity',true),
	'email' => get_post_meta($post->ID,'_garden_contact_email',true),
	'website' => get_post_meta($post->ID,'_garden_contact_website',true),
	'date_begin' => get_post_meta($post->ID,'_garden_date_begin',true),
	'area' => get_post_meta($post->ID,'_garden_area',true),
	'timetable' => get_post_meta($post->ID,'_garden_timetable',true),
	'members' => get_post_meta($post->ID,'_garden_community_members',true),
	'kernel' => get_post_meta($post->ID,'_garden_community_kernel',true),
	'governance' => get_the_terms($post->ID,'governance'),
	'collaborators' => get_post_meta($post->ID,'_garden_collaborators',true),
//	'typo' => get_the_terms($post->ID,'typology'),
	'equipment' => get_the_terms($post->ID,'equipment'),
	'icon' => get_post_meta($post->ID,'_garden_icon',true),
	'updated' => get_post_meta($post->ID,'_garden_updated',true)
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
		case 'equipment' :
			if ( $f === false ) break;
			$loop_eq = '<ul class="list-inline">';
			foreach ( $f as $t ) {
				$eq = $t->name;
				$eq_icon = get_term_meta( $t->term_id,'_equipment_icon',true );
				$loop_eq .= '<li class="equipment"><img src="'.$eq_icon['guid'].'" alt="'.$eq.'" /><div class="equipment-label">'.$eq.'</div></li>';
			}
			$loop_eq .= '</ul>';
			break;
		case 'district' : case 'governance' :
			if ( $f === false ) break;
			foreach ( $f as $t ) {
				$loop_classes .= ' '.$t->slug;
				$$k = '<span class="'.$loop_prefix.'-'.$k.'">' .$t->name. '</span>';
			}
			break;
		case 'website' :
			$$k = ( $f != '' ) ? $f: '';
			break;
		case 'icon' :
			$$k = ( $f != '' ) ? '<img class="'.$loop_prefix.'-'.$k.'" src="'.$f['guid'].'" alt="'.$f['post_title'].'" />': '';
			break;
		default :
			$$k = ( $f != '' ) ? '<span class="'.$loop_prefix.'-'.$k.'">' .$f. '</span>': '';
			break;
	}
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>>
	<header class="entry-header row">
		<?php the_title( '<h1 class="entry-title col-sm-12">', '</h1>' ); ?>
		<div class="clearfix"></div>
		<dl class="entry-meta col-md-3">
			<?php if ($address != '' || $district != '' ) echo '<dt>'.__('Address','_mbbasetheme').'</dt><dd>'.$address.' '.$district.'</dd>'; ?>
			<?php echo '<dt>'.__('Entity','_mbbasetheme').'</dt><dd>'.$entity.'</dd>'; ?>
			<?php if ($email != '' ) echo '<dt>'.__('Email','_mbbasetheme').'</dt><dd>'.$email.'</dd>'; ?>
			<?php if ($website != '' ) echo '<dt>'.__('Website','_mbbasetheme').'</dt><dd><a href="'.$website.'">'.$website.'</a></dd>'; ?>
			<?php if ($date_begin != '' ) echo '<dt>'.__('Begin data','_mbbasetheme').'</dt><dd>'.$date_begin.'</dd>'; ?>
		</dl><!-- .entry-meta -->
		<dl class="entry-meta col-md-5">
			<?php if ($governance != '' ) echo '<dt>'.__('Governance','_mbbasetheme').'</dt><dd>'.$governance.'</dd>'; ?>
			<?php if ($timetable != '' ) echo '<dt>'.__('Open time','_mbbasetheme').'</dt><dd>'.$timetable.'</dd>'; ?>
			<?php if ($members != '' ) echo '<dt>'.__('Participants','_mbbasetheme').'</dt><dd>'.$members.'</dd>'; ?>
			<?php if ($kernel != '' ) echo '<dt>'.__('People in kernel group','_mbbasetheme').'</dt><dd>'.$kernel.'</dd>'; ?>
			<?php if ($collaborators != '' ) echo '<dt>'.__('Collaborators','_mbbasetheme').'</dt><dd>'.$collaborators.'</dd>'; ?>
			<?php if ($area != '' ) echo '<dt>'.__('Area','_mbbasetheme').'</dt><dd>'.$area.' m2</dd>'; ?>
		</dl><!-- .entry-meta -->
		<div class="col-md-4">
			<h2 class="entry-subtitle"><?php _e('Equipment','_mbbasetheme'); ?></h2>
			<?php echo $loop_eq ?>
		</div>
	</header><!-- .entry-header -->

	<div class="row">
		<div class="col-sm-8">
			<div class="entry-content"><?php the_content(); ?></div>
			<?php
			$lat = get_post_meta($post->ID,'_garden_lat',true);
			$lon = get_post_meta($post->ID,'_garden_lon',true);
			if ( $lat != '' && $lon != '' ) {
				echo '<h2 class="entry-subtitle">'.__('Location','_mbbasetheme').'</h2>';
				$args = array(
					'center_lat' => $lat,
					'center_lon' => $lon,
					'zoom_ini' => '16',
					'post_in' => $post->ID,
					'post_type' => 'garden',
					'post_status' => "publish",
					'marker_type' => 'icon',
					'popup_text' => 'excerpt'
				);
				wpmap_showmap($args);
			} ?>
		</div>
		<div class="col-sm-4">
			<?php echo $loop_img_other; ?>
			<footer class="entry-footer text-center">
				<div><?php echo $icon; ?></div>

				<?php the_title( '<div class="entry-title">', '</div>' ); ?>
				<?php if ( $updated != '' ) printf(__('Data collected on %s','_mbbasetheme'),$updated); ?>
				<?php edit_post_link( __( 'Edit', '_mbbasetheme' ), '<span class="edit-link">', '</span>' ); ?>
			</footer>
		</div>
	</div>
</article><!-- #post-## -->
