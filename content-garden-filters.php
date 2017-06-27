<?php
	$filters_out = '';
	$filters = array(
		'typology' => array(
			'name' => __('Typology','_mbbasetheme'),
			'cols' => '6'
		),
		'district' => array(
			'name' => __('Districts','pparticipa'),
			'cols' => '6'
		)
	);
	foreach ( $filters as $f => $d ) {
		$args = array(
			'taxonomy' => $f
		);
		$termes = get_terms($args);
		if ( !is_wp_error($termes) ) {
			$terms_out = '<div class="col-md-'.$d['cols'].'"><div class="garden-filter-tit">'.$d['name'].'</div><ul class="garden-filter garden-filter-'.$f.' list-inline"><li><a data-filter="*" href="#">'.__('All','pparticipa').'</a></li>';
			foreach ( $termes as $t ) {
				if ( $f == 'typology') {
					$t_color = get_term_meta($t->term_id,"_typology_color",true);
					$t_bgcolor = get_term_meta($t->term_id,"_typology_bgcolor",true);
					$t_style = ' style="background-color: '.$t_bgcolor.'; color: '.$t_color.'"';
				} else { $t_style = ''; }
				$terms_out .= '<li><a '.$t_style.' data-filter=".'.$t->slug.'" href="#">'.$t->name.'</a></li>';
			
			}
			$terms_out .= '</ul></div>';
			$filters_out .= $terms_out;
		}
	}
	if ( $filters_out != '' ) $filters_out = '<div class="row garden-filters">'.$filters_out.'</div>';
echo $filters_out; 
?>
