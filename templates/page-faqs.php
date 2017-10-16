<?php
/**
 * Template Name: FAQs Page
 *
 * Displays content for a list of FAQs
 *
 * @package _mbbasetheme
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<?php while ( have_posts() ) : the_post();
		// containers
		$pages_loop = "";
		$pages_nav = "<ul class='list-unstyled scroll-smooth'>";
	
		// children pages query
		$args = array(
			'post_type' => 'page',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_parent' => $post->ID,
			'posts_per_page' => -1
		);
		$children = get_posts($args);	
	
		// parent page
		$parent_slug = $wp_query->query_vars['pagename'];
		$parent_tit = get_the_title();
		// $pages_nav .= "<li><a href='#" .$parent_slug. "'>" .$parent_tit. "</a></li>";
		if ( has_post_thumbnail() ) {
			$img_size = 'thumb';
			$parent_image = '<figure>'.get_the_post_thumbnail($post->ID,$img_size,array('class' => 'img-responsive')).'</figure>';
		} else { $parent_image = ""; }
	
		// children pages
		if( count($children) > 0 ) {
			foreach ( $children as $child ) {
				//print_r($child);
				$page_slug = $child->post_name;
				$page_tit = "<h2 class='child-tit'>" .$child->post_title. "</h2>";
				$page_desc = apply_filters( 'the_content', $child->post_content );
				$pages_loop .= "
					<section id='" .$page_slug. "' class='subpage'>
						<header>
						" .$page_tit. "
						</header>
						<div class='page-desc'>
						" .$page_desc. "
						</div><!-- .page-desc -->
					</section><!-- #" .$page_slug. " -->
				";
	
				// navbar
				$pages_nav .= "<li><a href='#" .$page_slug. "'>" .$child->post_title. "</a></li>";
	
			} // end loop children
	
			$pages_nav .= "</ul>";
		} else {
			$pages_nav = "";
		} //end if children pages
	?>

	<div id="<?php echo $parent_slug ?>" class="container">
		<div class="row">
			<div class="col-md-8 col-sm-9">
				<section class="hair">
					<header>
					<h1 class="parent-tit"><?php echo $parent_tit; ?></h1>
					</header>
	
					<div class="page-desc">
					<?php the_content(); ?>
					</div>
				</section>
	
				<?php // subpages
				echo $pages_loop; ?>
	
			</div><!-- .col-md-8 .col-sm-9 -->
	
			<nav id="faqs-nav" class="col-md-4 col-sm-3 hidden-xs">
				<?php //echo $pages_nav; ?>
				<?php echo $parent_image; ?>
			</nav>
		</div><!-- .row -->
	</div><!-- .container -->

	<?php endwhile; // end of the loop. ?>

</main><!-- #main -->

<?php get_footer(); ?>
