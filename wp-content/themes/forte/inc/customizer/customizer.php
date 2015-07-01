<?php 
/*===================================================================*/                							
/*  LIVE PREVIEW EDITING (JS) - GRABS THE JS		                							
/*===================================================================*/
add_action( 'customize_preview_init', 'bean_customizer_live_preview' );
function bean_customizer_live_preview() {
	wp_enqueue_script('customizer', BEAN_CUSTOMIZER_URL . '/js/customizer-preview.js', 'jquery', '1.0', true);
}



/*===================================================================*/                							
/*  THEME CUSTOMIZER FUNCTIONS		                							
/*===================================================================*/
add_action( 'customize_register', 'Bean_Customize_Register' );
function Bean_Customize_Register( $wp_customize ) 
{


//REQUIRE CUSTOM CONTROLS
require_once( BEAN_FRAMEWORK_FUNCTIONS_DIR . '/bean-admin-customizer-controls.php' );




/*===================================================================*/         	
/*  MOVE STUFF TO OTHER SECTIONS               							
/*===================================================================*/	
//SITE TITLE/DESC
$wp_customize->get_control( 'blogname' )->section='logo';
$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
$wp_customize->get_control( 'blogname' )->priority=1;

$wp_customize->get_control( 'blogdescription' )->section='logo';
$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
$wp_customize->get_control( 'blogdescription' )->priority=2;




/*===================================================================*/         	
/*  LOGO SECTION			                							
/*===================================================================*/	
$wp_customize->add_section( 'logo', array(
	'title' => __( 'Title & Tagline', 'bean' ),
	'priority' => 1,
	)
);
	
	$wp_customize->add_setting('header_tagline',array( 'default' => 'My Blog',));
	$wp_customize->add_control('header_tagline',
		array(
			'label' => __( 'Header Tagline', 'bean' ),
			'section' => 'logo',
			'type' => 'text',
			'priority' => 7,
			)
		);




/*===================================================================*/         	
/*  THEME SETTINGS SECTION			                							
/*===================================================================*/	
$wp_customize->add_section( 'theme_settings', array(
	'title' => __( 'Site Settings', 'bean' ),
	'priority' => 2,
	)
);

	$wp_customize->add_setting( 'retina_option', array( 'default' => false ) );
	$wp_customize->add_control( 'retina_option',
		array(
			'type' => 'checkbox',
			'label' => __( 'Enable Retina.js', 'bean' ),
			'section' => 'theme_settings',
			'priority' => 1,
			)
		);

	$wp_customize->add_setting( 'framework_seo', array( 'default' => true ) );
	$wp_customize->add_control( 'framework_seo',
		array(
			'type' => 'checkbox',
			'label' => __( 'Enable Framework SEO', 'bean' ),
			'section' => 'theme_settings',
			'priority' => 2,
			)
		);

	$wp_customize->add_setting( 'hidden_sidebar', array( 'default' => true ) );
	$wp_customize->add_control( 'hidden_sidebar',
	    array(
	        'type' => 'checkbox',
	        'label' => 'Enable Hidden Sidebar',
	        'section' => 'theme_settings',
	        'priority' => 5,
	    )
	);






/*===================================================================*/         	
/*  GENERAL SETTINGS SECTION			                							
/*===================================================================*/		
$wp_customize->add_section( 'general_settings', array(
	'title' => __( 'General', 'bean' ),
	'priority' => 3,
	)
);

	$wp_customize->add_setting( 'img-upload-login-logo', array() );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img-upload-login-logo', array(
		'label' 	=> __( 'Login Logo', 'bean' ),
		'section' 	=> 'general_settings',
		'settings' 	=> 'img-upload-login-logo',
		'priority' 	=> 2
		) ) );

	$wp_customize->add_setting( 'img-upload-logo', array() );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img-upload-logo', array(
		'label' 	=> __( 'Logo', 'bean' ),
		'section' 	=> 'general_settings',
		'settings' 	=> 'img-upload-logo',
		'priority' 	=> 1
		) ) );

	$wp_customize->add_setting( 'img-upload-favicon', array() );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img-upload-favicon', array(
		'label' 	=> __( 'Favicon', 'bean' ),
		'section' 	=> 'general_settings',
		'settings' 	=> 'img-upload-favicon',
		'priority' 	=> 4
		) ) );

	$wp_customize->add_setting( 'img-upload-apple_touch', array() );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img-upload-apple_touch', array(
		'label' 	=> __( 'Apple Touch Icon', 'bean' ),
		'section' 	=> 'general_settings',
		'settings' 	=> 'img-upload-apple_touch',
		'priority' 	=> 5
		) ) );

	$wp_customize->add_setting( 'twitter_profile', array('default' => ''));
	$wp_customize->add_control( 'twitter_profile',
		array(
			'label' => __( 'Twitter Username (eg:ThemeBeans)', 'bean' ),
			'section' => 'general_settings',
			'type' => 'text',
			'priority' => 6,
			)
		);


	$wp_customize->add_setting( 'footer_copyright', array( 'default' => '' ) );
	$wp_customize->add_control( new Bean_Customize_Textarea_Control( $wp_customize, 'footer_copyright', array(
		'label' => __( 'Footer Alt Text', 'bean' ),
		'section' => 'general_settings',
		'settings' => 'footer_copyright',
		'priority' => 8
		) ) );

	$wp_customize->add_setting( 'google_analytics', array( 'default' => '' ) );
	$wp_customize->add_control( new Bean_Customize_Textarea_Control( $wp_customize, 'google_analytics', array(
		'label' => __( 'Google Analytics Script', 'bean' ),
		'section' => 'general_settings',
		'settings' => 'google_analytics',
		'priority' => 9
		) ) );	




/*===================================================================*/                							
/*  BACKGROUND SECTION			                							
/*===================================================================*/
$wp_customize->add_section( 'background', array(
	'title' => __( 'Background', 'bean' ),
	'priority' => 6,
	)
);




/*===================================================================*/                							
/*  COLORS SECTION			                							
/*===================================================================*/
$wp_customize->add_section( 'custom_styles', array(
	'title' => __( 'Styles', 'bean' ),
	'priority' => 7,
	)
);

	$wp_customize->add_setting( 'wrapper_background_color', array(
		'default' => '#FFF',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wrapper_background_color', array(
		'label'   	=> __( 'Background', 'bean' ),
		'section' 	=> 'custom_styles',
		'settings'  	=> 'wrapper_background_color',
		'priority' 	=> 1
	) ) );


	$wp_customize->add_setting( 'theme_accent_color', array(
		'default' => '#F54452',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_accent_color', array(
		'label'   	=> __( 'Accent Color', 'bean' ),
		'section' 	=> 'custom_styles',
		'settings'  	=> 'theme_accent_color',
		'priority' 	=> 2
		) ) );

	$wp_customize->add_setting( 'post_css_filter', array( 'default' => 'none' ) );
	$wp_customize->add_control( 'post_css_filter',
	array(
		'type' => 'select',
		'label' => __( 'Article CSS3 Filter', 'bean' ),
		'section' => 'custom_styles',
		'priority' => 9,
		'choices' => array(
			'none' => 'None',
			'grayscale' => 'Black & White',
			'sepia' => 'Sepia Tone',
			'saturation' => 'High Saturation',
			),
		)
	);




/*===================================================================*/         	
/*  BLOG SETTINGS SECTION			                							
/*===================================================================*/		
$wp_customize->add_section( 'blog_settings', array(
	'title' => __( 'Blog', 'bean' ),
	'priority' => 12,
	)
);
	
	
	$wp_customize->add_setting( 'infinitescroll', array( 'default' => false, ) );
	$wp_customize->add_control( 'infinitescroll',
	    array(
	        'type' => 'checkbox',
	        'label' => __( 'Activate Infinite Scrolling', 'bean' ),
	        'section' => 'blog_settings',
	        'priority' => 1,
	    )
	);	

	$wp_customize->add_setting( 'show_related_posts', array( 'default' => true, ) );
	$wp_customize->add_control( 'show_related_posts',
	    array(
	        'type' => 'checkbox',
	        'label' => __( 'Display Related Posts', 'bean' ),
	        'section' => 'blog_settings',
	        'priority' => 2,
	    )
	);	

	$wp_customize->add_setting( 'show_author', array( 'default' => true, ) );
	$wp_customize->add_control( 'show_author',
		array(
			'type' => 'checkbox',
			'label' => __( 'Display Author Byline', 'bean' ),
			'section' => 'blog_settings',
			'priority' => 3,
			)
		);

	$wp_customize->add_setting( 'post_likes', array( 'default' => true, ) );
	$wp_customize->add_control( 'post_likes',
		array(
			'type' => 'checkbox',
			'label' => __( 'Display Post Likes', 'bean' ),
			'section' => 'blog_settings',
			'priority' => 4,
			)
		);




/*===================================================================*/                						
/*  CONTACT TEMPLATE SECTION			                							
/*===================================================================*/		
$wp_customize->add_section( 'contact_settings', array(
	'title' => __( 'Contact', 'bean' ),
	'priority' => 13,
	)
);

	$wp_customize->add_setting( 'admin_custom_email',array( 'default' => '',));
	$wp_customize->add_control( 'admin_custom_email',
		array(
			'label' => __( 'Contact Form Email', 'bean' ),
			'section' => 'contact_settings',
			'type' => 'text',
			'priority' => 1,
			)
		);

	$wp_customize->add_setting('contact_button_text',array( 'default' => 'Send Message',));
	$wp_customize->add_control('contact_button_text',
		array(
			'label' => __( 'Contact Button Text', 'bean' ),
			'section' => 'contact_settings',
			'type' => 'text',
			'priority' => 2,
			)
		);




/*===================================================================*/         	
/*  MAILBAG SECTION		                							
/*===================================================================*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if (is_plugin_active('mailbag/mailbag.php')) 
{
		
	$wp_customize->add_section( 'mailbag_settings', array(
		'title' => __( 'Mailbag', 'bean' ),
		'priority' => 14,
		)
	);	

		$wp_customize->add_setting( 'mailbag_title',array( 'default' => 'Newsletter Subscribe',));
		$wp_customize->add_control( 'mailbag_title',
			array(
				'label' => __( 'Mailbag Title', 'bean' ),
				'section' => 'mailbag_settings',
				'type' => 'text',
				'priority' => 1,
				)
			);

		$wp_customize->add_setting( 'mailbag_desc', array( 'default' => 'Subscribe to our email newsletter and receive free stuff, updates & new releases - straight to your inbox.' ) );
		$wp_customize->add_control( new Bean_Customize_Textarea_Control( $wp_customize, 'mailbag_desc', array(
			'label' => __( 'Mailbag Paragraph', 'bean' ),
			'section' => 'mailbag_settings',
			'settings' => 'mailbag_desc',
			'priority' => 2
			) ) );

		$wp_customize->add_setting( 'mailbag_select', array( 'default' => 'mailchimp' ) );
		$wp_customize->add_control( 'mailbag_select',
		array(
			'type' => 'select',
			'label' => __( 'Select Email Service', 'bean' ),
			'section' => 'mailbag_settings',
			'priority' => 3,
			'choices' => array(
				'mailchimp' => 'MailChimp',
				'campaign_monitor' => 'Campaign Monitor',
				),
			)
		);
}




/*===================================================================*/                						
/*  RCP SECTION			                							
/*===================================================================*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if (is_plugin_active('restrict-content-pro/restrict-content-pro.php')) 
{

	$wp_customize->add_section( 'rcp_settings', array(
		'title' => __( 'RCP', 'bean' ),
		'priority' => 15,
		)
	);

	//PAGES ARRAY
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = '';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$wp_customize->add_setting('login_page_selector');
	$wp_customize->add_control( 'login_page_selector', array(
	    'settings' => 'login_page_selector',
	    'label'   => __( 'Login Page', 'bean' ),
	    'section' => 'rcp_settings',
	    'type'    => 'select',
	    'choices' => $options_pages,
	    'priority' => 1,
	));

	$wp_customize->add_setting('register_page_selector');
	$wp_customize->add_control( 'register_page_selector', array(
	    'settings' => 'register_page_selector',
	    'label'   => __( 'Register Page', 'bean' ),
	    'section' => 'rcp_settings',
	    'type'    => 'select',
	    'choices' => $options_pages,
	    'priority' => 1,
	));

	$wp_customize->add_setting('lostpass_page_selector');
	$wp_customize->add_control( 'lostpass_page_selector', array(
	    'settings' => 'lostpass_page_selector',
	    'label'   => __( 'Lost Page', 'bean' ),
	    'section' => 'rcp_settings',
	    'type'    => 'select',
	    'choices' => $options_pages,
	    'priority' => 1,
	));
}




/*===================================================================*/         	
/*  404 PAGE SECTION			                							
/*===================================================================*/		
$wp_customize->add_section( '404_settings', array(
	'title' => __( '404', 'bean' ),
	'priority' => 200,
	)
);	

	$wp_customize->add_setting( '404-img-upload', array() );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, '404-img-upload', array(
		'label' 	=> __( '404 Custom Image', 'bean' ),
		'section' 	=> '404_settings',
		'settings' 	=> '404-img-upload',
		'priority' 	=> 1
		) ) );

	$wp_customize->add_setting( 'error_text',array( 'default' => 'Sorry, that page does not exist' ));
	$wp_customize->add_control( 'error_text',
		array(
			'label' => __( '404 Text', 'bean' ),
			'section' => '404_settings',
			'type' => 'text',
			'priority' => 2,
			)
		);




/*===================================================================*/                						
/*  CUSTOM CSS SECTION			                							
/*===================================================================*/	
$wp_customize->add_section( 'tools', array(
	'title' => __( 'Tools CSS', 'bean' ),
	'priority' => 200,
	)
);

$default_css =
'/*
List your Custom CSS in this textarea. All your styles will be 
minimized and printed in the theme header. 
You are free to remove this note. Enjoy! 

CSS for Beginners: http://www.w3schools.com/css/
*/
';		

$wp_customize->add_setting( 'bean_tools_css', array( 'default' => $default_css ) );
$wp_customize->add_control( new Bean_Customize_Textarea_Control( $wp_customize, 'bean_tools_css', array(
	'label' => __( 'Custom CSS Editor', 'bean' ),
	'section' => 'tools',
	'settings' => 'bean_tools_css',
	'priority' => 8
	) ) );




/*===================================================================*/                							
/*  TRANSPORTS FOR LIVE PREVIEW EDITING		                							
/*===================================================================*/
	//LIVE HTML
$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
$wp_customize->get_setting( 'contact_button_text' )->transport = 'postMessage';
$wp_customize->get_setting( 'header_tagline' )->transport = 'postMessage';
}