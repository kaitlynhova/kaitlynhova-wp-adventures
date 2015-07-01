<div class="hidden-sidebar">

	<div class="widget">
		<h6><?php _e( 'Menu', 'bean' ); ?></h6>
		<?php if ( function_exists('wp_nav_menu') ) {
			wp_nav_menu( array(
				'theme_location' => 'primary-menu'
			));
		} ?>
	</div><!-- END .widget -->	
	
	<?php dynamic_sidebar( 'Hidden Sidebar' ); ?>	

</div><!-- END .hidden-sidebar -->