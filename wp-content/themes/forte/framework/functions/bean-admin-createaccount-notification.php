<?php 
/**
 * The functions for displaying the plugin admin notices.
 * Plugins are added via the theme functions.php file
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.0
 */

/*===================================================================*/
/* 1. BEAN PLUGIN NOTIFICATION	
/*===================================================================*/
add_action('admin_notices', 'bean_createaccount_admin_notice');

function bean_createaccount_admin_notice() {
	global $pagenow;
	
	if (( $pagenow == 'index.php' )) 
	{
		if( bean_theme_supports( 'plugins', 'notice' )) 
		{
			
			global $current_user ;
			$user_id = $current_user->ID;
			
			if ( !get_user_meta($user_id, 'bean_createaccount_ignore_notice') ) 
			{
				echo '<div class="updated bean-plugin-notification">'; 
				echo '<p>'; 
					printf(__('<a target="_blank" href="http://themebeans.com/register/?level=2/?ref=theme_notice_createaccount">Create a free ThemeBeans account</a> to access all our free themes and plugins. <a class="dismiss-notice" href="%1$s">Dismiss</a>'), '?bean_createaccount_ignore=0');
				echo '</p>'; 
				echo "</div>";
			}
		
		} //END if( bean_theme_supports( 'plugins', 'notice' )) 
		
	}//END if (( $pagenow == 'index.php' ))
	
} //END 


//DISMISS NOTIFICATION 
add_action('admin_init', 'bean_createaccount_ignore');

function bean_createaccount_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['bean_createaccount_ignore']) && '0' == $_GET['bean_createaccount_ignore'] ) {
             add_user_meta($user_id, 'bean_createaccount_ignore_notice', 'true', true);
	}
}