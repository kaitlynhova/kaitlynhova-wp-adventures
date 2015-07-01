<?php 
/**
 * Initiating file for core theme files.
 *
 *
 * @package WordPress
 * @subpackage Forte
 * @author ThemeBeans
 * @since Forte 2.0
 */
 

/*===================================================================*/
/* LOAD FUNCTIONS
/*===================================================================*/
// MEDIA FUNCTIONS
require( BEAN_FUNCTIONS_DIR . '/media.php' );


// LOAD POST LIKES
include( BEAN_FUNCTIONS_DIR . '/bean-likes.php' );


// LOAD WIDGETS
if( bean_theme_supports( 'primary', 'widgets' ))
{
	include( BEAN_WIDGETS_DIR . '/widget-flickr.php' );
	include( BEAN_WIDGETS_DIR . '/widget-video.php' );
}


// THEME META
if( is_admin() ) {
	if( bean_theme_supports( 'primary', 'meta' )) 
	{
		require_once( BEAN_INC_DIR . '/meta/meta-page.php');
		require_once( BEAN_INC_DIR . '/meta/meta-post.php');
		require_once( BEAN_INC_DIR . '/meta/meta-team.php');
	}  
}


// META SCRIPT
if( bean_theme_supports( 'primary', 'meta' )) 
{
	function bean_admin_meta_js() {
		wp_enqueue_script( 'admin-meta', BEAN_INC_URL . '/meta/js/meta.js', 'jquery', '1.0', true );
	}
	add_action( 'admin_enqueue_scripts', 'bean_admin_meta_js');
}


// CUSTOMIZER FONTS
if( bean_theme_supports( 'primary', 'customizer' ) && bean_theme_supports( 'primary', 'fonts' )) 
{
	require_once( BEAN_FUNCTIONS_DIR . '/bean-fonts.php' );
}