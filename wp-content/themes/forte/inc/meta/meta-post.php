<?php
/**
 * The file is for creating the blog post type meta. 
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 *  
 * @package WordPress
 * @subpackage Forte
 * @author ThemeBeans
 * @since Forte 1.0
 */
 
add_action('add_meta_boxes', 'bean_metabox_post');
function bean_metabox_post(){

$prefix = '_bean_';




/*===================================================================*/
/*  PAGE META SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'page-meta',
	'title' =>  __('Post Meta Settings', 'bean'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
			"name" => __('Subtitle:','bean'),
			"desc" => __('A post subtitle to appear below the post title.','bean'),
			"id" => $prefix."post_subtitle",
			"type" => "text",
			"std" => ''
			),
		array( 
			"name" => __('Hero Background & Overlay:','bean'),
			"desc" => __('Modify the overlay color and background color of the post hero area.','bean'),
			"id" => $prefix."post_cover_color",
			"type" => "color",
			"val" => '#000000',
			"std" => ''
			),
		array( 
			"name" 		=> __('Background Video URL:','bean'),
			"desc" 		=> __('Upload or link to a video for the video background. ','bean'),
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




/*===================================================================*/              							
/*  AUDIO POST FORMAT SETTINGS						   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean-meta-box-audio',
	'title' =>  __('Audio Post Format Settings', 'bean'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
			"name" 		=> __('MP3 File URL:','bean'),
			"desc" 		=> __('Upload or link to an MP3 file.','bean'),
			"id" 		=> $prefix."audio_mp3",
			"type"		=> "file",
			"std" 		=> ''
			),
	),
);
bean_add_meta_box( $meta_box );




/*===================================================================*/	
/*  GALLERY POST FORMAT SETTINGS						   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean-meta-box-gallery',
	'title' => __('Image/Gallery Post Format Settings', 'bean'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
			'name' 		=> 'Gallery Images:',
			'desc' 		=> 'Upload images here for your gallery post. Once uploaded, drag & drop to reorder.',
			'id' 		=> $prefix .'post_upload_images',
			'type' 		=> 'images',
			'std' 		=> __('Browse & Upload', 'bean')
			),		
		array(
			'name'    	=> __('Randomize Gallery:', 'bean'),
			'id' 		=> $prefix.'post_randomize',
			'type' 		=> 'checkbox',
			'desc'		=> __('Randomize the gallery on page load.', 'bean'),
			'std' 		=> false 
			),		
    )
);
bean_add_meta_box( $meta_box ); 




/*===================================================================*/               							
/*  LINK POST FORMAT SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean-meta-box-link',
	'title' =>  __('Link Post Format Settings', 'bean'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Link Title:','bean'),
				"desc" => __('The title for your link.','bean'),
				"id" => $prefix."link_title",
				"type" => "text",
				"std" => ''
			),
		array( "name" => __('Link URL:','bean'),
				"desc" => __('ex: http://themebeans.com','bean'),
				"id" => $prefix."link_url",
				"type" => "text",
				"std" => 'http://'
			),
	),
	
);
bean_add_meta_box( $meta_box );




/*===================================================================*/               							
/*  QUOTE POST FORMAT SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean-meta-box-quote',
	'title' =>  __('Quote Post Format Settings', 'bean'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Quote Text:','bean'),
				"desc" => __('Insert your quote into this textarea.','bean'),
				"id" => $prefix."quote",
				"type" => "textarea",
				"std" => ''
			),
		array( "name" => __('Quote Source:','bean'),
				"desc" => __('Who said the quote above?','bean'),
				"id" => $prefix."quote_source",
				"type" => "text",
				"std" => ''
			),	
	),
	
);
bean_add_meta_box( $meta_box );




/*===================================================================*/               							
/*  VIDEO POST FORMAT SETTINGS						   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'bean-meta-box-video',
	'title' =>  __('Video Post Format Settings', 'bean'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Embeded Code:','bean'),
				"desc" => __('Include your video embed code here.','bean'),
				"id" => $prefix."video_embed",
				"type" => "textarea",
				"std" => ''
			),
	)
);
bean_add_meta_box( $meta_box );
} // END function bean_metabox_post()