<?php
/**
 * _mbbasetheme theme functions definted in /lib/init.php
 *
 * @package _mbbasetheme
 */

/**
 * Set theme global vars
 */
function mb_theme_vars() {
	if (!defined('MB_BLOGNAME'))
	    define('MB_BLOGNAME', get_bloginfo('name'));

	if (!defined('MB_BLOGDESC'))
	    define('MB_BLOGDESC', get_bloginfo('description','display'));

	if (!defined('MB_BLOGURL'))
	    define('MB_BLOGURL', esc_url( home_url( '/' ) ));

	if (!defined('MB_BLOGTHEME'))
	    define('MB_BLOGTHEME', get_bloginfo('template_directory'));
}

/**
 * Set up image sizes and media options
 */
function mb_image_sizes() {

	// add extra sizes
	add_image_size( 'icon', 0, 36, false );
	add_image_size( 'mini', 263, 0, false );
	add_image_size( 'small', 446, 0, false );
	add_image_size( 'extralarge', 1140, 0, false );

	/* set up image sizes*/
	update_option('post-thumbnail_size_w', 1140);
	update_option('thumbnail_size_w', 360);
	update_option('thumbnail_size_h', 0);
	update_option('medium_size_w', 555);
	update_option('medium_size_h', 0);
	update_option('large_size_w', 750);
	update_option('large_size_h', 0);
}

function mb_image_sizes_names( $sizes ) {
	return array_merge( $sizes, array(
		'icon' => __('Icon 36px','_mbbasetheme'),
		'mini' => __('Mini 263px width','_mbbasetheme'),
		'larger' => __('Small 446px width','_mbbasetheme'),
		'extralarge' => __('Extra large 1140px width','_mbbasetheme'),
	) );
}

/**
 * Register Widget Areas
 */
function mb_widgets_init() {
	// Main Sidebar
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_mbbasetheme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	// Footer Widget Area
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', '_mbbasetheme' ),
		'id'            => 'epi-widgets',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-6">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

/**
 * Remove Dashboard Meta Boxes
 */
function mb_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

/** 
 * Remove Dashboard menu items
 */
add_action( 'admin_menu', 'mb_remove_dashboard_item' );
function mb_remove_dashboard_item() {
	//remove_menu_page( 'index.php' );                  //Dashboard
	remove_menu_page( 'edit.php' );                   //Posts
	//remove_menu_page( 'upload.php' );                 //Media
	//remove_menu_page( 'edit.php?post_type=page' );    //Pages
	//remove_menu_page( 'edit-comments.php' );          //Comments
	//remove_menu_page( 'themes.php' );                 //Appearance
	//remove_menu_page( 'plugins.php' );                //Plugins
	//remove_menu_page( 'users.php' );                  //Users
	//remove_menu_page( 'tools.php' );                  //Tools
	//remove_menu_page( 'options-general.php' );        //Settings
}

/**
 * Change Admin Menu Order
 */
function mb_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		// 'index.php', // Dashboard
		// 'separator1', // First separator
		// 'edit.php?post_type=page', // Pages
		// 'edit.php', // Posts
		// 'upload.php', // Media
		// 'gf_edit_forms', // Gravity Forms
		// 'genesis', // Genesis
		// 'edit-comments.php', // Comments
		// 'separator2', // Second separator
		// 'themes.php', // Appearance
		// 'plugins.php', // Plugins
		// 'users.php', // Users
		// 'tools.php', // Tools
		// 'options-general.php', // Settings
		// 'separator-last', // Last separator
	);
}

/**
 * Hide Admin Areas that are not used
 */
function mb_remove_menu_pages() {
	// remove_menu_page( 'link-manager.php' );
}

/**
 * Remove default link for images
 */
function mb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	if ( $image_set !== 'none' ) {
		update_option( 'image_default_link_type', 'none' );
	}
}

/**
 * Enqueue scripts
 */
function mb_scripts() {
	wp_enqueue_style( '_mbbasetheme-fonts', get_template_directory_uri().'/fonts.css' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/assets/fontawesome/css/font-awesome.min.css',array('_mbbasetheme-fonts'),'4.7.0' );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri().'/assets/bootstrap/css/bootstrap.min.css',array('_mbbasetheme-fonts'),'3.3.7' );
	wp_enqueue_style( '_mbbasetheme-style', get_stylesheet_uri(),array('bootstrap-css') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( !is_admin() ) {
	wp_dequeue_script('jquery');
	wp_dequeue_script('jquery-core');
	wp_dequeue_script('jquery-migrate');
	wp_enqueue_script('jquery', false, array(), false, true);
	wp_enqueue_script('jquery-core', false, array(), false, true);
	wp_enqueue_script('jquery-migrate', false, array(), false, true);
//		wp_enqueue_script( 'jquery' );
//		wp_enqueue_script( 'customplugins', get_template_directory_uri() . '/assets/js/plugins.min.js', array('wpmap-js'), NULL, true );
		wp_enqueue_script( 'customscripts', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), NULL, true );
		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array('jquery'), NULL, true );
	}
	if ( is_page_template('templates/page-gardens.php') ) {
		wp_enqueue_script( 'isotope-js', get_template_directory_uri() . '/assets/isotope/isotope.pkgd.min.js', array('jquery'), '3.0.4', true );
		wp_enqueue_script( 'page-gardens-js', get_template_directory_uri() . '/assets/js/page-gardens.min.js', array('isotope-js'), NULL, true );
	} elseif ( is_page_template('templates/page-map.php') ) {
		wp_enqueue_script( 'plugin-wpmap-additional', get_template_directory_uri() . '/assets/js/plugin-wpmap.min.js', array('wpmap-js'), NULL, true );
	}
}
/**
 * Remove Query Strings From Static Resources
 */
function mb_remove_script_version( $src ){
	$parts = explode( '?ver', $src );
	return $parts[0];
}

/**
 * Remove Read More Jump
 */
function mb_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ($offset) {
		$end = strpos( $link, '"',$offset );
	}
	if ($end) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
