<?php 
/**
 * Admin functions for creating the update/license renewal links
 *
 *
 * @package WordPress
 * @subpackage Bean Framework
 * @author ThemeBeans
 * @since Bean Framework 2.2
 */


/*===================================================================*/
/*  PURCHASE/RENEWAL URLS	
/*===================================================================*/
// LICENSE STUFF
$license 	= get_option( 'edd_themebeans_theme_license_key' );

// THIS IS A LIST OF THE THEMES SETUP FOR LICENSE USE
$theme_title_clean = str_replace("Child","",$theme_title);
$theme_title_clean = preg_replace('/\s+/', '', $theme_title_clean);

if ($theme_title_clean == 'Atom') {
	$download_id = '52855';
}
elseif ($theme_title_clean == 'Acute') {
	$download_id = '62862';
}
elseif ($theme_title_clean == 'Blooog') {
	$download_id = '48616';
}
elseif ($theme_title_clean == 'Crate') {
	$download_id = '44871';
}
elseif ($theme_title_clean == 'Pinto') {
	$download_id = '23101';
}
elseif ($theme_title_clean == 'Snazzy') {
	$download_id = '21177';
}
elseif ($theme_title_clean == 'Emma') {
	$download_id = '54553';
}
elseif ($theme_title_clean == 'Spruce') {
	$download_id = '21168';
}
elseif ($theme_title_clean == 'Weblog') {
	$download_id = '21113';
}
elseif ($theme_title_clean == 'Folo') {
	$download_id = '21103';
}
elseif ($theme_title_clean == 'Wonder') {
	$download_id = '21067';
}
elseif ($theme_title_clean == 'Koi') {
	$download_id = '21061';
}
elseif ($theme_title_clean == 'Grille') {
	$download_id = '20784';
}
elseif ($theme_title_clean == 'Macho') {
	$download_id = '54570';
}
elseif ($theme_title_clean == 'Execute') {
	$download_id = '54571';
}
elseif ($theme_title_clean == 'Trim') {
	$download_id = '54568';
}
elseif ($theme_title_clean == 'Spaces') {
	$download_id = '53734';
}
elseif ($theme_title_clean == 'Forte') {
	$download_id = '56148';
}
elseif ($theme_title_clean == 'Bricks') {
	$download_id = '65497';
}
else {
	$download_id = '';
}

// CHECKOUT URLS
if ($license) {
	define( 'LICENSE_CHECKOUT_URL', 'http://themebeans.com/checkout/?edd_license_key='.$license.'&download_id='.$download_id.'' );
} else {
	define( 'LICENSE_CHECKOUT_URL', 'http://themebeans.com/?edd_action=add_to_cart&download_id='.$download_id.'' );
}

// LICENSE REQEUST URLS
if( bean_theme_supports( 'shop', 'tf' ) ) {
	define( 'LICENSE_REQUEST_URL', 'http://themebeans.com/themeforest' );
} else {
	define( 'LICENSE_REQUEST_URL', 'http://themebeans.com/themeforest' );
}