<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package _mbbasetheme
 */
?>

	</div><!-- #content -->

	<footer id="epi" class="site-footer bargl" role="contentinfo">
		<?php $location = "footer";
		if ( has_nav_menu( $location ) ) { ?>
			<nav id="epi-menu" class="navbar navbar-default" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#epi-menu-collapse">
							<span class="sr-only"><?php _e('Show/hide menu','_mbbasetheme') ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="navbar-brand"><?php _e('More sites about urban gardens in Madrid','_mbbasetheme'); ?></div>
					</div>
					<div class="collapse navbar-collapse" id="epi-menu-collapse">

						<?php $args = array(
							'theme_location'  => $location,
							'container' => false,
							'menu_id' => 'navbar-footer',
							'menu_class' => 'nav navbar-nav navbar-left navbar-menu'
						);
						wp_nav_menu( $args ); ?>
					</div>
				</div>
			</nav>
		<?php } ?>
		<div id="epi-meta" class="container">
			<div class="row">
				<?php if ( is_active_sidebar( 'epi-widgets' ) ) {
					echo '<div class="col-sm-9 space">';
					dynamic_sidebar( 'epi-widgets' );
					echo '</div>';
					$widget_class = 'col-sm-3';
				} else { $widget_class = 'col-sm-3 col-sm-offset-9'; } ?>
				
				<div class="<?php echo $widget_class; ?> text-right">
					<img src="<?php echo MB_BLOGTHEME; ?>/assets/images/imago.huertos.madrid.png" alt="<?php echo __('Logo of the Program for urban community gardens in Madrid','_mbbasetheme'); ?>" />
				</div>
			</div>
		</div>
		<?php if ( is_active_sidebar( 'credits-widgets' ) ) {
			echo '<div id="credits-widgets" class="container" role="complementary"><div class="row">';
			dynamic_sidebar( 'credits-widgets' );
			echo "</div></div>";
		} ?>
		<div id="credits" class="barw">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 barw-brand"><strong><?php echo __('Madrid City Council','_mbbasetheme') ." ". date( "Y" ); ?></strong></div>
					<div class="col-sm-9">
						<nav id="credits-menu" class="navbar navbar-right navbar-inverse" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#credits-menu-collapse">
								<span class="sr-only"><?php _e('Show/hide menu','_mbbasetheme') ?></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse" id="credits-menu-collapse">
							<?php $location = "credits";
							if ( has_nav_menu( $location ) ) {
								$args = array(
									'theme_location'  => $location,
									'container' => false,
									'menu_id' => 'navbar-credits',
									'menu_class' => 'nav navbar-nav navbar-right navbar-menu'
								);
								wp_nav_menu( $args );
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- #credits -->
	</footer><!-- #epi -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
