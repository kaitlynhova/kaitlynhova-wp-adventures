<?php
/**
 * This is the theme's functions.php file.
 * This file loads the theme's constants.
 * Please be cautious when editing this file, errors here cause big problems.
 *
 *
 * @package WordPress
 * @subpackage Forte
 * @author ThemeBeans
 * @since Forte 1.0
 *
 *
 * CONTENTS:
 * 1. THEME FEATURES FILTER
 * 2. LOAD FRAMEWORK
 * 3. GENERAL THEME SETUP
 * 4. ADD OUR SCRIPTS
 * 5. REGISTER WIDGET AREAS
 * 6. THEME SPECIFIC FUNCTIONS
 */




/*===================================================================*/
/* 1. THEME FEATURES FILTER
/*===================================================================*/
do_action( 'bean_pre' );

//FEATURE SETUP
if ( !function_exists( 'bean_feature_setup' ) )
{
	function bean_feature_setup()
	{
		$args = array(
			'primary' => array(
				'adminstyles'       => true,
				'customizer'        => true,
				'free'              => false,
				'fonts'             => false,
				'hideadminbar'      => false,
				'meta'              => true,
				'seo'               => true,
				'widgets'           => true,
				'widgetareas'       => true,
				'whitelabel'        => false,
				'updates'           => true, //ENABLES UPDATE NOTIFICATION/PROCESS
				'license'  		=> true, //ENABLES LICENSE ADMIN PAGE
				),
			'plugins' => array(
				'notice'            => true,
				'portfolio'         => false,
				'shortcodes'        => true,
				'twitter'           => true,
				'instagram'         => true,
				'social'            => true,
				'pricingtables'     => true,
				'500px'			=> true,
				'team'			=> true,
				'registry'          => false,
				),
			'comments' => array(
				'posts'             => true,
				'pages'             => false,
				'portfolio'         => false,
				),
			'debug' => array(
				'footer'            => false,
				'queries'           => false,
				),
			'shop' => array(
				'tf'            	=> true,
				),
			);

	return apply_filters( 'bean_theme_config_args', $args );
	}
add_action('bean_init', 'bean_feature_setup');
} //END if ( !function_exists( 'bean_feature_setup' ) )

// FEATURE SETUP RETURN
function bean_theme_supports( $group, $feature )
{
	$setup = bean_feature_setup();
	if( isset( $setup[$group][$feature] ) && $setup[$group][$feature] )
		return true;
	else {
	}
}




/*===================================================================*/
/* 2. LOAD FRAMEWORK
/*===================================================================*/
function bean_load_framework()
{
	do_action( 'bean_pre_framework' );

	// FRAMEWORK FUNCTIONS
	$tempdir = get_template_directory();
	require_once($tempdir .'/framework/functions/bean-admin-init.php');
	require_once($tempdir .'/inc/functions/init.php');

} //END function bean_load_framework()

add_action( 'bean_init', 'bean_load_framework' );

/* RUN THE BEAN_INIT HOOK */
do_action( 'bean_init' );

/* RUN THE BEAN_SETUP HOOK */
do_action( 'bean_setup' );




/*===================================================================*/
/* 3. GENERAL THEME SETUP
/*===================================================================*/
if ( !function_exists( 'bean_theme_setup' ) )
{
	function bean_theme_setup()
	{
		// MENUS
		register_nav_menus( array(
			'primary-menu' => __( 'Primary Navigation', 'bean' ),
			'mobile-menu'  => __( 'Mobile Navigation', 'bean' )
			));

		// TRANSLATION
		load_theme_textdomain( 'bean', get_template_directory() . '/languages' );

		// THUMBNAILS
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size( 140, 140 );
		add_image_size( 'sml-thumbnail', 50, 50, true );
		add_image_size( 'post-full', 9999, 9999, false ); 

		// FEED LINKS
		add_theme_support( 'automatic-feed-links' );

		// POST FORMATS
		add_theme_support('post-formats', array('audio', 'quote', 'video'));
	}
}
add_action('after_setup_theme', 'bean_theme_setup');


// CONTENT WIDTH
if ( ! isset( $content_width ) ) $content_width = 920;




/*===================================================================*/
/* 4. ADD OUR SCRIPTS
/*===================================================================*/
if ( !function_exists( 'bean_enqueue_scripts') )
{
	function bean_enqueue_scripts()
	{
		// STYLESHEETS
		wp_enqueue_style('main', get_stylesheet_directory_uri(). '/style.css', false, '1.0', 'all');
		wp_enqueue_style('mobile', get_stylesheet_directory_uri(). '/assets/css/mobile.css',false,'1.0','all');
		wp_enqueue_style('cabin', 'http://fonts.googleapis.com/css?family=Cabin:400,500,700' );
		wp_enqueue_style('merriweather', 'http://fonts.googleapis.com/css?family=Merriweather:400,300' );

		// REGISTER SCRIPTS
		wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9', true);
		wp_register_script('custom', get_template_directory_uri() . '/assets/js/custom.js', 'jquery', '1.0', TRUE);
		wp_register_script('custom-libraries', get_template_directory_uri() . '/assets/js/custom-libraries.js', 'jquery', '1.0', TRUE);
		wp_register_script('infinitescroll', get_template_directory_uri() . '/assets/js/infinitescroll.min.js', 'jquery', '1.0', TRUE);
		wp_register_script('retina', get_template_directory_uri() . '/assets/js/retina.js', 'jquery', '1.0', TRUE);

		// ENQUEUE SCRIPTS
		wp_enqueue_script('jquery');
		wp_enqueue_script('custom-libraries');
		wp_enqueue_script('custom');

		// LOCALIZE THE 'WP_TEMPLATE_DIRECTORY_URI' VARIABLE FOR USE BY THE JS
		wp_localize_script( 'custom', 'WP_TEMPLATE_DIRECTORY_URI', array( 0 => get_template_directory_uri() ) );

		//AJAX
		wp_localize_script('custom', 'bean', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('bean-ajax'),
			));

		// CONDITIONALLY LOADED ENQUEUE SCRIPTS
		if( get_theme_mod( 'infinitescroll' ) == true) {
			if ( is_home() OR is_archive() OR is_search() ) { 
				wp_enqueue_script('infinitescroll'); 
			}
		}

		if( get_theme_mod( 'retina_option' ) == true) {
			wp_enqueue_script('retina');
		}

		if ( is_page_template('template-contact.php') || is_singular('post') ) {
			wp_enqueue_script('validation');
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( is_page_template('template-team.php') ) {
			wp_enqueue_script('masonry');
		}

	} //END function bean_enqueue_scripts()

	add_action( 'wp_enqueue_scripts', 'bean_enqueue_scripts');

} //END if ( !function_exists( 'bean_enqueue_scripts') )




/*===================================================================*/
/* 5. REGISTER WIDGET AREAS	
/*===================================================================*/
if ( !function_exists( 'bean_widget_areas_init' ) ) 
{
	function bean_widget_areas_init() 
	{
		if( get_theme_mod( 'hidden_sidebar' ) == true) 
		{
			register_sidebar(array(
				'name' => __('Hidden Sidebar', 'bean'),
				'description' => __('Widget area for the hidden sidebar.', 'bean'),
				'id' => 'hidden-panel',
				'before_widget' => '<div class="widget %2$s clearfix">',
				'after_widget' => '</div>',
				'before_title' => '<h6 class="widget-title">',
				'after_title' => '</h6>',
			));
		} //END get_theme_mod( 'hidden_sidebar' ) == true) 

		register_sidebar(array(
			'name' => __('Footer Col 1', 'bean'),
			'description' => __('Widget area for the first footer area.', 'bean'),
			'id' => 'footer-col-1',
			'before_widget' => '<div class="widget %2$s clearfix">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		));

		register_sidebar(array(
			'name' => __('Footer Col 2', 'bean'),
			'description' => __('Widget area for the second footer area.', 'bean'),
			'id' => 'footer-col-2',
			'before_widget' => '<div class="widget %2$s clearfix">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		));

		register_sidebar(array(
			'name' => __('Footer Col 3', 'bean'),
			'description' => __('Widget area for the third footer area.', 'bean'),
			'id' => 'footer-col-3',
			'before_widget' => '<div class="widget %2$s clearfix">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		));

	} //END function bean_widget_areas_init()

	add_action( 'widgets_init', 'bean_widget_areas_init' );
	
} //END if ( !function_exists( 'bean_widget_areas_init' ) )








/*===================================================================*/
/*
/* 6. THEME SPECIFIC FUNCTIONS
/*
/*===================================================================*/

/*===================================================================*/
/*  HIDE ADMIN BAR FOR ALL NON ADMIN USERS
/*===================================================================*/
if ( is_user_logged_in() && !current_user_can( 'manage_options' ) ) {
    show_admin_bar(false); 
}




/*===================================================================*/           
/*  NO SINGLE VIEW FOR TEAM POSTS    
/*===================================================================*/
if ( !function_exists('bean_no_single_cpt_redirect') ) 
{
	function bean_no_single_cpt_redirect() 
	{
		$queried_post_type = get_query_var('post_type');
		if ( is_single() && 'team' ==  $queried_post_type ) {
			wp_redirect( home_url(), 301 );
			exit;
		}
	} //END function bean_no_single_cpt_redirect()
} //END if ( !function_exists( 'bean_no_single_cpt_redirect' ) )
add_action( 'template_redirect', 'bean_no_single_cpt_redirect' );




/*===================================================================*/
/* GENERAL PAGE TITLE FUNCTION
/*===================================================================*/
if( !function_exists( 'bean_page_title' ) ) 
{
	function bean_page_title() 
	{

		$page_title = '';
		
		if( is_singular() ) 
		{
			if( is_page() ) {
	            	$page_title = get_the_title();
	          } elseif( is_single() ) {
	            	$page_title = get_the_title();
	          }
	    } //END if( is_singular() ) 

	    else 

	    {
	    	if( is_archive() ) {
	    		if( is_category() ) {
	    			$page_title = sprintf( __( 'Posts in: %s', 'bean' ), single_cat_title('', false) );
	    		} elseif( is_tag() ) {
	    			$page_title = sprintf( __( 'Posts tagged: %s', 'bean' ), single_tag_title('', false) );
	    		} elseif( is_date() ) {
	    			if( is_month() ) {
	    				$page_title = sprintf( __( 'Archive for: %s', 'bean' ), get_the_time( 'F, Y' ) );
	    			} elseif( is_year() ) {
	    				$page_title = sprintf( __( 'Archive for: %s', 'bean' ), get_the_time( 'Y' ) );
	    			} elseif( is_day() ) {
	    				$page_title = sprintf( __('Archive for: %s', 'bean' ), get_the_time( get_option('date_format') ) );
	    			} else {
	    				$page_title = __('Archives', 'bean');
	    			}
	    		} elseif( is_author() ) {
	    			if(get_query_var('author_name')) {
	    				$curauth = get_user_by( 'login', get_query_var('author_name') );
	    			} else {
	    				$curauth = get_userdata(get_query_var('author'));
	    			}
	    			$author_name = $curauth->display_name;
	    			$title = sprintf( __( 'Posts by %s', 'bean' ), $author_name );
	    			$page_title = $title;
	    		} else {
	    			$page_title = single_term_title('', false);
	    		}

	    	} elseif( is_search() ) 
	    	{
	    		$page_title = sprintf( __( 'Results for &#8220;%s&#8221;', 'bean' ), get_search_query() );
	    	}

	    	elseif( is_home() ) 
	    	{
	    		$page_title = get_theme_mod( 'header_tagline');
	    	}

	    } //END else
	    return $page_title;

	} //END function bean_page_title() 
} //END if( !function_exists( 'bean_page_title' ) ) 




/*===================================================================*/
/*  PAGINATION FUNCTION
/*===================================================================*/
if(!function_exists('bean_index_pagination')) 
{
	function bean_index_pagination($pages = '') {
		global $paged;
		
		if(get_query_var('paged')) {
		     $paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
		     $paged = get_query_var('page');
		} else {
		     $paged = 1;
		}
		
		$output = "";
		$prev = $paged - 1;							
		$next = $paged + 1;	
		$range = 7; //EDIT THIS IF YOU WANT TO SHOW MORE PAGES
		$showitems = ($range * 2)+1;
		
		if($pages == '')
		{	
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages)
			{
				$pages = 1;
			}
		}
		
		$method = "get_pagenum_link";
		if(is_single())
		{
			$method = "bean_post_pagination_link";
		}
		
		$archive_nav= "bean_post_pagination_link";

		if(1 != $pages)
		{
			$output .= "<div class='index-pagination'>";
			
			$output .= ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<a href='".$method(1)."'></a>":"";

			$output .= ($paged < $pages ) ? "<a href='".$method($next)."' class='next'>Next</a>" : "<a href='".$method($next)."' class='next hidden'>Next</a>";			
			
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					$output .= ($paged == $i)? "<a href='".$method($i)."' class='current'>".$i."</a>":"<a href='".$method($i)."' class='inactive' >".$i."</a>"; 
				}
			}

			$output .= ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".$method($pages)."'></a>":"";

			$output .= ($paged > 1 )? "<a href='".$method($prev)."' class='prev'>Previous</a>" : "<a href='".$method($prev)."' class='prev hidden'>Previous</a>";
			
			$output .= "</div>\n";
		}
			
		return $output;
	}
	
	function bean_post_pagination_link($link){
		$url =  preg_replace('!">$!','',_wp_link_page($link));
		$url =  preg_replace('!^<a href="!','',$url);
		return $url;
	}
}




/*===================================================================*/
/*  ONLY SEARCH POSTS
/*===================================================================*/
function bean_search_filter($query)
{
	if ( !$query->is_admin && $query->is_search)
	{
		$query->set('post_type', array('page', 'post') );

		//UNCOMMENT BELOW TO SEARCH FOR POSTS ONLY
		//$query->set('post_type', 'post' );

		//UNCOMMENT BELOW TO SEARCH FOR PAGES ONLY
		//$query->set('post_type', 'page' );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'bean_search_filter' );




/*===================================================================*/
/*  PASSWORD PROTECTED FILTERS
/*===================================================================*/
add_filter('protected_title_format', 'blank');
function blank($title) 
{ 
	return '%s'; 
}

function bean_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p>' . __( 'To view this protected post enter the password below:', 'bean' ) . '</p>
    <label for="' . $label . '">' . __( "Password:" ) . ' </label><input name="post_password" id="' . $label . '" type="password" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'bean_password_form' );




/*===================================================================*/
/* RELATED POSTS
/*===================================================================*/
if ( !function_exists( 'bean_get_related_posts' ) ) 
{
	function bean_get_related_posts($post_id, $taxonomy, $args=array()) 
	{
		$terms = wp_get_object_terms($post_id, $taxonomy);

		if( count($terms) ) {
			$post = get_post($post_id);
			$our_terms = array();
			foreach ($terms as $term) {
				$our_terms[] = $term->slug;
			}

			$args = wp_parse_args($args, array(
				'post_type' => $post->post_type,
				'post__not_in' => array($post_id),
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy,
						'terms' => $our_terms,
						'field' => 'slug',
						'operator' => 'IN'
						)
					),
				'orderby' => 'rand'
				)
			);
			$query = new WP_Query($args);
			return $query;
		} else {
			return false;
		}
	} //END if ( function( 'bean_get_related_posts' ) )
} //END if ( !function_exists( 'bean_get_related_posts' ) )




/*===================================================================*/
/*  CUSTOM COMMENT OUTPUT
/*===================================================================*/
if ( !function_exists( 'bean_comment' ) )
{
	function bean_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="clearfix">

				<?php echo get_avatar($comment,$size='60'); ?>

				<header class="comment-header">
					<div class="comment-author vcard">
						<?php printf(__('<cite class="fn">%s</cite> ', 'bean'), get_comment_author_link()) ?>
					</div><!-- END .comment-author.vcard -->
					<div class="comment-meta commentmetadata subtext">
						<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'bean'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('Edit', 'bean'),' / ','') ?>  / <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
						<?php if ($comment->comment_approved == '0') : ?>
							<span class="moderation">&nbsp;&middot;&nbsp;&nbsp;<?php _e('Awaiting Moderation', 'bean') ?></span>
						<?php endif; ?>
					</div><!-- END .comment-meta.commentmetadata.subtext -->
				</header>

				<div class="comment-body">
					<?php comment_text() ?>
				</div><!-- END .comment-body -->

			</div><!-- END #comment-<?php comment_ID(); ?> -->
		</li>
		<?php
	} //END function bean_comment($comment, $args, $depth)
} //END if ( !function_exists( 'bean_comment' ) )




/*===================================================================*/
/*  CUSTOM PING OUTPUT
/*===================================================================*/
if ( !function_exists( 'bean_ping' ) )
{
	function bean_ping($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment; ?>

		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>

		<?php
	} //END //function bean_ping($comment, $args, $depth)
}//END if ( !function_exists( 'bean_ping' ) )




/*===================================================================*/
/*  COMMENTS FORM
/*===================================================================*/
function bean_custom_form_filters( $args = array(), $post_id = null )
{
	global $id;

	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';


	$fields =  array(

		'author' => '
		<p class="comment-form-author">
			<label for="author">' . __( 'Name', 'bean' ) . (' <span class="required">*</span>') . '</label>
			<input id="author" name="author" type="text" tabindex="2" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required/>
		</p>',

		'email'  => '
		<p class="comment-form-email">
			<label for="email">' . __( 'Email', 'bean' ) . (' <span class="required">*</span>') . '</label>
			<input id="email" name="email" type="text" tabindex="3" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" required/>
		</p>',

		'url'    => '
		<p class="comment-form-url">
			<label for="url">' . __( 'Website', 'bean') . '</label>
			<input id="url" name="url" type="text" tabindex="4" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"/>
		</p>',
		);

	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" tabindex="1" cols="45" rows="8" placeholder="Leave a comment here..." required></textarea></p><a href="#" id="cancel-comment">Cancel</a>','',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'bean' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as subtext">' . sprintf( __( 'Currently logged in as <a href="%1$s">%2$s</a> / <a href="%3$s" title="Log out of this account">Logout</a>', 'bean' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => null,
		'comment_notes_after'  => null,
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_submit'         => 'submit',
		'name_submit'          => 'submit',
		'submit_field'         => '<p class="form-submit">%1$s %2$s</a>',
		'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
		'title_reply'          => '',
		'title_reply_to'       => __( 'Leave a Reply to %s', 'bean' ),
		'cancel_reply_link'    => __( 'Cancel', 'bean' ),
		'label_submit'         => __( 'Submit Comment', 'bean' ),
		);

return $defaults;
}
add_filter( 'comment_form_defaults', 'bean_custom_form_filters' );