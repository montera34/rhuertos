<?php
/*
Template Name: Insert data script
*/
get_header();

$csv_filename = get_stylesheet_directory(). "/importer/data.csv"; // relative path to data filename
$line_length = "4096"; // max line lengh (increase in case you have longer lines than 1024 characters)
$delimiter = ","; // field delimiter character
$enclosure = '"'; // field enclosure character

$prefix = "_garden"; // prefix for custom fields and other contents
$user = 39; // user ID to asign the contents to

// open the data file
$fp = fopen($csv_filename,'r');

// get data and store it in array
if ( $fp !== FALSE ) { // if the file exists and is readable

	// data array generation
	$data = array();
	$line = 0;
	while ( ($fp_csv = fgetcsv($fp,$line_length,$delimiter,$enclosure)) !== FALSE ) { // begin main loop
		if ( $line == 0 ) {}
		else {
			// vars to do the inserts
			$tit = $fp_csv[1];
			$content = $fp_csv[13];

			//if ( $excerpt == '' ) { $excerpt == $content; }
			// CUSTOM FIELDS
			$fields = array(
				$prefix.'_num' => $fp_csv[2],
				$prefix.'_lat' => $fp_csv[3],
				$prefix.'_lon' => $fp_csv[4],
				$prefix.'_address' => $fp_csv[5],
				$prefix.'_contact_email' => $fp_csv[8],
				$prefix.'_contact_website' => $fp_csv[9],
				$prefix.'_date_begin' => $fp_csv[10],
				$prefix.'_area' => $fp_csv[14],
				$prefix.'_timetable' => $fp_csv[15],
				$prefix.'_community_members' => $fp_csv[16],
				$prefix.'_community_kernel' => $fp_csv[17],
				$prefix.'_collaborators' => $fp_csv[20],
				$prefix.'_updated' => $fp_csv[29],
			);

			// TAXONOMIES
			$districts = explode(",",$fp_csv[7]);
			$typologies = explode(",",$fp_csv[12]);
			$governances = explode(",",$fp_csv[19]);
			$equipments = explode(",",$fp_csv[28]);
			$taxs = array(
				'district' => $districts,
				'typology' => $typologies,
				'gobernance' => $governances,
				'equipment' => $equipments
			);

			// STATUS
			$status = ( $fp_csv[30] != '' ) ? $fp_csv[30] : 'publish';
			// INSERT POST
			$args = array(
				'post_type' => 'garden',
				'post_status' => $status,
				'post_author' => $user,
				'post_title' => $tit,
				'post_content' => $content,
				//'post_excerpt' => $excerpt,
				'meta_input' => $fields,
				'tax_input' => $taxs
			);
			$id = wp_insert_post($args);

			// get project id if already inserted
			//$project = get_page_by_title( $tit, OBJECT, 'montera34_project' );
			//$project_id = $project->ID;

			if ( $id != 0 && !is_wp_error($id) ) {
				$class = 'success';
				$feedback = '<p>Contenido importado correctamente bajo el identificador '.$id.'</p>';
				// insert custom fields
				//reset($fields);
				//foreach ( $fields as $key => $value ) {
				//	add_post_meta($project_id, $key, $value, TRUE);
				//}

				// insert terms
//				reset($terms);
//				foreach ( $terms as $value ) {
//					if ( $value != '' ) { // if is not an empty value
//						$term_id = term_exists( $value ); // return the term ID or 0 if doesn't exist
//						if ( $term_id == 0 ) { // if the term doesn't exist, then create it
//							$new_term = wp_insert_term( $value, $tax );
//							$term_id = $new_term['term_id'];
//						}
//						wp_set_post_terms( $project_id, $term_id, $tax );
//
//					echo "
//						<div>
//							<h2>Project " .$project_id. "</h2>
//							<p>" .$value. " inserted ok: ID = " .$term_id. "</p>
//						</div>
//					";
//					}
//				} // end foreach terms
//
			} else {
				$class = 'error';
				$feedback = '<p>La importación de este contenido ha fallado.</p><pre>'.$id->get_error_message().'</pre>';

			} // if project has been inserted

			$output = '<div class="import-item '.$class.'"><h2>'.$tit.'</h2>'.$feedback.'</div>';
			echo $output;

		} // end if not line 0
		$line++;
	}
	fclose($fp);

} else {
	echo "<h2>Error</h2>
		<p>File with contents not found or not accesible.</p>
		<p>Check the path: " .$csv_filename. ". Maybe it has to be absolute...</p>";

} // end if file exist and is readable

// STYLES
echo '
<style>
.success { background-color: green; color: white; }
.error { background-color: red; color: white; }
</style>
';
?>

<?php get_footer() ;?>
