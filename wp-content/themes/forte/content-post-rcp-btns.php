<?php
//RCP SUBSCRIBE & LOGIN BUTTONS
if( is_plugin_active( 'restrict-content-pro/restrict-content-pro.php' ) ) {
	global $user_ID;
	if(!rcp_is_active($user_ID)) { ?>
		<div class="rcp-access-btns">
			<?php if (get_theme_mod('register_page_selector')) { ?>
				<a class="btn rcp-subscribe" href="<?php echo get_page_link(get_theme_mod('register_page_selector')); ?>"><?php _e( 'Subscribe Today', 'bean' ); ?></a>
			<?php } ?>
			<?php if (get_theme_mod('login_page_selector')) { ?>
				<a class="btn rcp-login" href="<?php echo get_page_link(get_theme_mod('login_page_selector')); ?>"><?php _e( 'Login', 'bean' ); ?></a>
			<?php } ?>
		</div><!-- END .rcp-access-btns -->
	<?php } ?>
<?php } ?>