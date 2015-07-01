<?php
/**
 * The file is for creating the page post type meta. 
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 *  
 * @package WordPress
 * @subpackage Forte
 * @author ThemeBeans
 * @since Forte 1.0
 */
 
add_action('add_meta_boxes', 'bean_metabox_page');
function bean_metabox_page(){

$prefix = '_bean_';




/*===================================================================*/
/*  PAGE META SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'page-meta',
	'title' =>  __('Page Meta Settings', 'bean'),
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
			"name" => __('Subtitle:','bean'),
			"desc" => __('A page subtitle to appear below the page title.','bean'),
			"id" => $prefix."post_subtitle",
			"type" => "text",
			"std" => ''
			),
		array(
			'name'    	=> __('Activate Fullscreen Hero:', 'bean'),
			'id' 		=> $prefix.'hero',
			'type' 		=> 'checkbox',
			'desc'		=> __('Display a fullscreen hero area on this page.', 'bean'),
			'std' 		=> true 
			),
		array( 
			"name" => __('Hero Background & Overlay:','bean'),
			"desc" => __('Modify the overlay color and background color of the page hero area.','bean'),
			"id" => $prefix."post_cover_color",
			"type" => "color",
			"val" => '#000000',
			"std" => ''
			),
		array( 
			"name" 		=> __('Background Video URL:','bean'),
			"desc" 		=> __('Upload an video for the video background. ','bean'),
			"id" 		=> $prefix."video_background_upload",
			"type" 		=> "file",
			"std" 		=> ''
			),
		array( 
			"name" 		=> __('Background Video Embed:','bean'),
			"desc" 		=> __('Add a video embed iframe for the video background. ','bean'),
			"id" 		=> $prefix."embedded_background_upload",
			"type" 		=> "textarea",
			"std" 		=> ''
			),	
	)
);
bean_add_meta_box( $meta_box );

} // END function bean_metabox_page()