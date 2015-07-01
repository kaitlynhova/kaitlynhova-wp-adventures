<?php 
/**
 * The functions for displaying the plugin admin notices.
 * Plugins are added via the theme functions.php file
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.2
 */

/*===================================================================*/
/* 1. BEAN PLUGIN NOTIFICATION	
/*===================================================================*/
add_action('admin_notices', 'bean_license_admin_notice');

function bean_license_admin_notice() {
	global $pagenow;
	
	if (( $pagenow == 'index.php' )) 
	{
		if( bean_theme_supports( 'plugins', 'notice' )) 
		{
			
			global $current_user ;
			$user_id = $current_user->ID;
			
			if ( !get_user_meta($user_id, 'bean_license_ignore_notice') ) 
			{
				echo '<div class="updated bean-license-notification">'; 
					echo '<p>'; 

					echo '<a href="'.admin_url('/themes.php?page=themebeans-license').'/">Enter your theme license key</a>'; 
						echo ' to recieve updates & support for '. BEAN_THEME_NAME .'. '; 
			
						printf(__('<a class="dismiss-notice" href="%1$s">Dismiss</a>'), '?bean_license_ignore=0');
						
					echo "</p>";
				echo "</div>";
			}
		
		} //END if( bean_theme_supports( 'plugins', 'notice' )) 
		
	}//END if (( $pagenow == 'index.php' ))
	
} //END 


//DISMISS NOTIFICATION 
add_action('admin_init', 'bean_license_ignore');

function bean_license_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['bean_license_ignore']) && '0' == $_GET['bean_license_ignore'] ) {
             add_user_meta($user_id, 'bean_license_ignore_notice', 'true', true);
	}
}