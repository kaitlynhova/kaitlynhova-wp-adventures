<?php 
/**
 * Admin functions for core framework features.
 * This file is the same contents as all themes using our framework
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.0
 *
 *
 * CONTENTS:  
 * 1. LOAD CONSTANTS
 * 2. PURCHASE/RENEWAL URLS	
 * 3. CONTEXTUAL HOOKS 
 * 4. LOAD ADMIN CSS 
 * 5. LOAD ADMIN JS
 * 6. LOAD ADMIN META
 * 7. LOAD CUSTOMIZER FONTS
 * 8. MISC ADMIN FUNCTIONS
 * 9. LOAD FREE THEME FUNCTIONS
 */
 
/*===================================================================*/
/* 1. LOAD CONSTANTS
/*===================================================================*/
// DEFINE FRAMEWORK VERSION
define( 'BEAN_FRAMEWORK_VERSION', '2.2.5' );


// DEFINE THEME DIRECTORY LOCATION CONSTANTS
define( 'PARENT_DIR', get_template_directory() );
define( 'CHILD_DIR', get_stylesheet_directory() );


// DEFINE THEME URL LOCATION CONSTANTS
define( 'PARENT_URL', get_template_directory_uri() );
define( 'CHILD_URL', get_stylesheet_directory_uri() );


// DEFINE THEME INFO CONSTANTS
$theme = wp_get_theme();
$theme_title = $theme->name;
$theme_version = $theme->version;
$cl_theme_title = str_replace("Child","",$theme_title);
$cl_theme_title = preg_replace('/\s+/', '', $cl_theme_title);
$changelog_url = 'http://demo.themebeans.com/wp-content/themes/'.strtolower($cl_theme_title).'/changelog.txt';

define( 'BEAN_THEME_SLUG', get_template() );
define( 'BEAN_THEME_NAME', $theme_title );
define( 'BEAN_THEME_VER', $theme_version );
define( 'BEAN_THEME_CHANGELOG_URL', $changelog_url );

// DEFINE STD URLS
$author_url = 'http://themebeans.com';
$help_url  = 'http://themebeans.com/support';
$themes_url = 'http://themebeans.com/themes';
$plugins_url = 'http://themebeans.com/plugins';
$subscribe_url = 'http://themebeans.us6.list-manage.com/subscribe?u=e7267bfd563b8f29ef95ba846&id=739445b065';

define( 'THEMEBEANS_URL', $author_url );
define( 'BEAN_HELP_URL', $help_url );
define( 'BEAN_THEMES_URL', $themes_url );
define( 'BEAN_PLUGINS_URL', $plugins_url );
define( 'BEAN_SUBSCRIBE_URL', $subscribe_url );


// DEFINE BEAN PLUGIN URLS
define( 'BEAN_PORTFOLIO_PLUGIN_URL', 'http://themebeans.com/plugins/bean-portfolio/?ref=theme_notice' );
define( 'BEAN_SHORTCODES_PLUGIN_URL', 'http://themebeans.com/plugins/bean-shortcodes/?ref=theme_notice' );
define( 'BEAN_INSTAGRAM_PLUGIN_URL', 'http://themebeans.com/plugins/bean-instagram/?ref=theme_notice' );
define( 'BEAN_SOCIAL_PLUGIN_URL', 'http://themebeans.com/plugins/bean-social/?ref=theme_notice' );
define( 'BEAN_TWEETS_PLUGIN_URL', 'http://themebeans.com/plugins/bean-tweets/?ref=theme_notice' );
define( 'BEAN_PRICINGTABLES_PLUGIN_URL', 'http://themebeans.com/plugins/bean-pricing-tables/?ref=theme_notice' );
define( 'BEAN_MODALS_PLUGIN_URL', 'http://themebeans.com/plugin/bean-modals/?ref=theme_notice' );
define( 'BEAN_500PX_PLUGIN_URL', 'http://themebeans.com/plugins/bean-500px//?ref=theme_notice' );
define( 'BEAN_DRIBBBLE_PLUGIN_URL', 'http://themebeans.com/plugins/bean-dribbble/?ref=theme_notice' );
define( 'BEAN_REGISTRY_PLUGIN_URL', 'http://themebeans.com/plugins/bean-registry/?ref=theme_notice' );
define( 'BEAN_TEAM_PLUGIN_URL', 'http://themebeans.com/plugins/bean-team/?ref=theme_notice' );
define( 'BEAN_TESTIMONIALS_PLUGIN_URL', 'http://themebeans.com/plugins/bean-testimonials/?ref=theme_notice' );


// DEFINE GENERAL CONSTANTS
define( 'BEAN_IMAGES_DIR', PARENT_DIR . '/assets/images' );
define( 'BEAN_INC_DIR', PARENT_DIR . '/inc' );
define( 'BEAN_JS_DIR', PARENT_DIR . '/assets/js' );
define( 'BEAN_CSS_DIR', PARENT_DIR . '/assets/css' );
define( 'BEAN_FUNCTIONS_DIR', BEAN_INC_DIR . '/functions' );
define( 'BEAN_CONTENT_DIR', BEAN_INC_DIR . '/content' );
define( 'BEAN_LANGUAGES_DIR', BEAN_INC_DIR . '/languages' );
define( 'BEAN_CUSTOMIZER_DIR', BEAN_INC_DIR . '/customizer' );

define( 'BEAN_STYLES_URL', PARENT_URL . '/assets/styles' );
define( 'BEAN_IMAGES_URL', PARENT_URL . '/assets/images' );
define( 'BEAN_INC_URL', PARENT_URL . '/inc' );
define( 'BEAN_JS_URL', PARENT_URL . '/assets/js' );
define( 'BEAN_CSS_URL', PARENT_URL . '/assets/css' );
define( 'BEAN_FUNCTIONS_URL', BEAN_INC_URL . '/functions' );
define( 'BEAN_CUSTOMIZER_URL', BEAN_INC_URL . '/customizer' );


// DEFINE WIDGET CONSTANTS
define( 'BEAN_WIDGETS_DIR', BEAN_INC_DIR . '/widgets' );
define( 'BEAN_WIDGETS_URL', BEAN_INC_URL . '/widgets' );


// DEFINE FRAMEWORK CONSTANTS
define( 'BEAN_FRAMEWORK_DIR', PARENT_DIR . '/framework' );
define( 'BEAN_FRAMEWORK_FUNCTIONS_DIR', BEAN_FRAMEWORK_DIR . '/functions' );
define( 'BEAN_FRAMEWORK_IMAGES_DIR', BEAN_FRAMEWORK_DIR . '/assets/images' );
define( 'BEAN_FRAMEWORK_CSS_DIR', BEAN_FRAMEWORK_DIR . '/assets/css' );
define( 'BEAN_FRAMEWORK_JS_DIR', BEAN_FRAMEWORK_DIR . '/assets/js' );
define( 'BEAN_UPDATES_DIR', BEAN_FRAMEWORK_DIR . '/updates' );
	
define( 'BEAN_FRAMEWORK_URL', PARENT_URL . '/framework' );
define( 'BEAN_FRAMEWORK_FUNCTIONS_URL', BEAN_FRAMEWORK_URL . '/functions' );
define( 'BEAN_FRAMEWORK_IMAGES_URL', BEAN_FRAMEWORK_URL . '/assets/images' );
define( 'BEAN_FRAMEWORK_CSS_URL', BEAN_FRAMEWORK_URL . '/assets/css' );
define( 'BEAN_FRAMEWORK_JS_URL', BEAN_FRAMEWORK_URL . '/assets/js' );
define( 'BEAN_UPDATES_URL', BEAN_FRAMEWORK_DIR . '/updates' );




/*===================================================================*/
/* 2. THEME LICENSE/UPDATER CLASS
/*===================================================================*/
if( bean_theme_supports( 'primary', 'license' ) )
{
	require( BEAN_UPDATES_DIR . '/EDD_SL_Theme_Activation.php' );
	require( BEAN_UPDATES_DIR . '/EDD_SL_Downloads.php' );
	require( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-license-notification.php' );
}




/*===================================================================*/
/* 3. CONTEXTUAL HOOKS	
/*===================================================================*/
if(!function_exists('bean_do_contextual_hook'))
{
  function bean_do_contextual_hook($args = '')
  {
    do_action( $args );
  }
} 

//HEADER 
function bean_head() { bean_do_contextual_hook('bean_head'); }
function bean_meta_head() { bean_do_contextual_hook('bean_meta_head'); }
function bean_header_start() { bean_do_contextual_hook('bean_header_start'); }
function bean_header_end() { bean_do_contextual_hook('bean_header_end'); }
function bean_body_start() { bean_do_contextual_hook('bean_body_start'); }
function bean_content_start() { bean_do_contextual_hook('bean_content_start'); }

//COMMENTS
function bean_comments_start() { bean_do_contextual_hook('bean_comments_start'); }
function bean_comments_end() { bean_do_contextual_hook('bean_comments_end'); }

//FOOTER
function bean_content_end() { bean_do_contextual_hook('bean_content_end'); }
function bean_footer_start() { bean_do_contextual_hook('bean_footer_start'); }
function bean_footer_end() { bean_do_contextual_hook('bean_footer_end'); }
function bean_body_end() { bean_do_contextual_hook('bean_body_end'); }




/*===================================================================*/
/* 4. LOAD ADMIN CSS	
/*===================================================================*/
add_action('admin_enqueue_scripts', 'bean_admin_styles');
function bean_admin_styles() 
{	
	//DISPLAY META STYLESHEET IF TRUE
	if( bean_theme_supports( 'primary', 'meta' )) 
	{
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_style('bean-meta-css', BEAN_FRAMEWORK_CSS_URL .'/bean-meta.css');
		
	}
	//DISPLAY ADMIN STYLESHEET IF TRUE (CUSTOM CSS TO MAKE THINGS LOOK A BIT BETTER)
	if( bean_theme_supports( 'primary', 'adminstyles' )) 
	{
		wp_enqueue_style('bean-admin-css', BEAN_FRAMEWORK_CSS_URL .'/bean-admin.css');
		
	}
}




/*===================================================================*/
/* 5. LOAD ADMIN JS	
/*===================================================================*/
add_action('admin_enqueue_scripts', 'bean_admin_scripts');
function bean_admin_scripts() 
{
	wp_register_script('bean-framework-admin', BEAN_FRAMEWORK_JS_URL .'/bean-admin.js', array('jquery', 'wp-color-picker'));
	
	wp_enqueue_script('bean-framework-admin'); 
	wp_enqueue_script('jquery');
}




/*===================================================================*/
/* 6. LOAD ADMIN META
/*===================================================================*/
if( is_admin() ) {
	if( bean_theme_supports( 'primary', 'meta' )) 
	{
		require_once( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-metaboxes.php' );
	}  
}

//LOAD SEO META
if( bean_theme_supports( 'primary', 'seo' ))
{
	if( get_theme_mod( 'framework_seo' ) == true) {
		require( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-meta-seo.php' );
	}
}




/*===================================================================*/
/* 7. LOAD CUSTOMIZER FONTS
/*===================================================================*/
//DISPLAY META STYLESHEET IF TRUE
if( bean_theme_supports( 'primary', 'customizer' ) && bean_theme_supports( 'primary', 'fonts' )) 
{
	require_once( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-fonts-library.php' );
}




/*===================================================================*/
/* 8. MISC ADMIN FUNCTIONS
/*===================================================================*/
require( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-functions.php' );

if( !bean_theme_supports( 'primary', 'whitelabel' )) {
	require( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-createaccount-notification.php' );
	require( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-plugin-notification.php' );
}

//IF PORTFOLIO PLUGIN COMPATIBLE
if( bean_theme_supports( 'plugins', 'portfolio' )) {
	require( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-pointers.php' );
}

//IF WIDGET AREA SWITCHER
if( bean_theme_supports( 'primary', 'widgetareas' ))
{
	require( BEAN_FRAMEWORK_DIR . '/widget-areas/bean-admin-widget-areas.php' );
}




/*===================================================================*/
/* 9. LOAD FREE THEME FUNCTIONS
/*===================================================================*/
if( bean_theme_supports( 'primary', 'free' )) {
	require( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-theme-feed.php' );
	require( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-plugin-feed.php' );
}