<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _mbbasetheme
 */

if ( ! function_exists( '_mbbasetheme_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function _mbbasetheme_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', '_mbbasetheme' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', '_mbbasetheme' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', '_mbbasetheme' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( '_mbbasetheme_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function _mbbasetheme_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', '_mbbasetheme' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', '_mbbasetheme' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     '_mbbasetheme' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( '_mbbasetheme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function _mbbasetheme_posted_on() {
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		$updated_string = '<time class="updated" datetime="%1$s">%2$s</time>';
	} else {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$updated_string = '';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	$updated_string = sprintf( $updated_string,
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		__( 'Posted on %s', '_mbbasetheme' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$updated_on = ( $updated_string != '' ) ? '<span class="updated-on"> ['.sprintf(
		__( 'updated on %s', '_mbbasetheme' ),
		$updated_string
	).']</span>' : '';

	$byline = sprintf(
		__( 'by %s', '_mbbasetheme' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'.$updated_on.'<span class="byline"> ' . $byline . '</span>';

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function _mbbasetheme_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( '_mbbasetheme_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( '_mbbasetheme_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so _mbbasetheme_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so _mbbasetheme_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in _mbbasetheme_categorized_blog.
 */
function _mbbasetheme_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( '_mbbasetheme_categories' );
}
add_action( 'edit_category', '_mbbasetheme_category_transient_flusher' );
add_action( 'save_post',     '_mbbasetheme_category_transient_flusher' );

if ( ! function_exists( '_mbbasetheme_get_searchform' ) ) :
/**
 * Outputs search form
 *
 * @param	string $post_type Optional. post type ID
 * @param	string $form_classes Optional.
 * @param	bool $submin_btn Optional.
 * @param	string $search_label Optional. Submit button label
 *
 * @return	search form HTML code
 */
function _mbbasetheme_get_searchform($post_type,$form_classes,$submit_btn,$search_label) {
	
	$filters_out = ( $post_type != false ) ? '<input type="hidden" name="post_type" value="'.$post_type.'" />' : '';
	$submit_out = ( $submit_btn != false ) ? '<input type="submit" id="searchsubmit" value="'.__('Search','_mbbasetheme').'" />' : '';

	if ( is_search() ) {
		$active_class = ' searched';
		$search_label = __('Search results: ','_mbbasetheme').' '.get_search_query();
	} else { $active_class = ''; }
	$form_out = '
	<form method="get" id="searchform" class="'.$form_classes.'" action="'.get_home_url().'/" role="search">
	<div class="form-group">
		'.$filters_out.'
		<label class="sr-only" for="s">'.$search_label.'</label>
		<input class="form-control input-sm'.$active_class.'" type="text" value="" name="s" id="s" placeholder="'.$search_label.'" />
		'.$submit_out.'
	</div>
	</form>
	';
	echo $form_out; return;
}
endif;

if ( ! function_exists( '_mbbasetheme_get_carousel' ) ) :
/**
 * Outputs a carousel of slides
 *
 * @param	string $post_id Required. post ID
 *
 * @return	A carousel HTML code
 */
function _mbbasetheme_get_carousel($post_id) {
	$carousel = get_post_meta($post_id,'_carousel',true);
	if ( $carousel == '' )
		return;

	// carousel vars
	$carousel_h = get_post_meta( $carousel['ID'],'_carousel_height',true);
	$autoplay = get_post_meta( $carousel['ID'],'_carousel_autoplay',true);
	$interval = get_post_meta( $carousel['ID'],'_carousel_interval',true);
	$interval_out = ( $autoplay ) ? $interval : 'false';
	// indicators and controls
	$indicators = get_post_meta($carousel['ID'],'_carousel_indicators',true);
	$controls = get_post_meta($carousel['ID'],'_carousel_controls',true);
	$indicators_out = ( $indicators == 1 ) ? '<!-- Indicators --><ol class="carousel-indicators">' : '';
	if ( $controls == 1 ) {
		$controls_out = '
			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-'.$carousel['post_slug'].'" role="button" data-slide="prev">
				<span class="icon-prev" aria-hidden="true"></span>
				<span class="sr-only">'._('Previous','_mbbasetheme').'</span>
			</a>
			<a class="right carousel-control" href="#carousel-'.$carousel['post_slug'].'" role="button" data-slide="next">
				<span class="icon-next" aria-hidden="true"></span>
				<span class="sr-only">'.__('Next','_mbbasetheme').'</span>
			</a>
		';
	}
	else {
		$controls_out = '';
	}

	// slides
	$slides = get_post_meta( $carousel['ID'],'_carousel_diapos',false);
	$slides_out = '<div class="carousel-inner" role="listbox">';
	$count = 0;
	foreach ( $slides as $s ) {
		$active_class = ( $count == 0 ) ? ' active' : '';
		$slide_desc = apply_filters( 'the_content', $s['post_content'] );
		$slide_bgcolor = get_post_meta( $s['ID'],'_slide_bgcolor',true);
		$slide_show_tit = get_post_meta( $s['ID'],'_slide_show_tit',true);
		$slide_tit = ( $slide_show_tit == 1 ) ? '<h3>'.$s['post_title'].'</h3>' : '';
		$slide_caption_bg = get_post_meta( $s['ID'],'_slide_caption_bg',true);
		$slide_caption_class = ( $slide_caption_bg == 1 ) ? '' : ' carousel-caption-bg';
		if ( has_post_thumbnail($s['ID']) ) {
			//$slide_img = get_the_post_thumbnail($s['ID'],'full',array('class' => 'img-responsive'));
			$slide_img = '';
			$slide_img_src = wp_get_attachment_image_src( get_post_thumbnail_id($s['ID']),'full' );
			$slide_style = ' style="height: '.$carousel_h.'px; background-image: url('.$slide_img_src[0].'); background-repeat: no-repeat; background-size: cover; background-position: center center;"';
		} else { $slide_img = ""; $slide_style = ' style="height: '.$carousel_h.'px; background-color: '.$slide_bgcolor.';"'; }
		// indicators
		$indicators_out .= ( $indicators == 1 ) ? '<li data-target="#carousel-'.$carousel['post_slug'].'" data-slide-to="'.$count.'" class="'.$active_class.'"></li>' : '';
		// slides
		$slides_out .= '
			<div class="item'.$active_class.'"'.$slide_style.'>
				'.$slide_img.'
				<div class="carousel-caption">
					<div class="carousel-caption-inner'.$slide_caption_class.'">
						'.$slide_tit.$slide_desc.'
					</div>
				</div>
			</div>
		';
		$count++;
	}
	$indicators_out .= '</ol>';
	$slides_out .= '</div>';

	// output
	echo '<div id="carousel-'.$carousel['post_slug'].'" class="carousel slide" data-ride="carousel" data-interval="'.$interval_out.'" data-pause="hover" data-wrap="true" data-keyboard="true">'.$indicators_out . $slides_out . $controls_out.'</div>';

}
endif;

if ( ! function_exists( '_mbbasetheme_get_updated_on_date' ) ) :
/**
 * Outputs the last modification data for a content
 *
 * @param	string $post_id Required. post ID
 *
 * @return	A HTML5 time code
 */
function _mbbasetheme_get_updated_on_date($post_id) {
	$updated_on = get_the_modified_date('Y-m-d');
	$updated_on_human = get_the_modified_date();
	return '<time datetime="'.$updated_on.'" itemprop="dateModified">'.sprintf(__('Content updated on %s','_mbbasetheme'),$updated_on_human).'</time>';
}
endif;
