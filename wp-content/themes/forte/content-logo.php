<?php
/**
 * The file for displaying the uploaded branding.
 * Utilize the theme customizer for displaying either the text logo or uploaded logo.
 *
 *  
 * @package WordPress
 * @subpackage Forte
 * @author ThemeBeans
 * @since Forte 1.0
 */
 ?>
 
<div class="logo" <?php if ( is_singular('post') ) { echo 'data-0="opacity:.25;" data-50="opacity:.0;"'; } ?> >
	
	<?php 
	//WITH LOGO IMAGE
	if( get_theme_mod( 'img-upload-logo' )) { ?>  
	  	<a href="<?php echo home_url(); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'img-upload-logo' )?>" class="logo-uploaded" alt="logo"/></a>
	<?php }
	
	//WITHOUT LOGO IMAGE 
	else { ?>  
	  	<a href="<?php echo home_url(); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home"><h1 class="logo_text"><?php bloginfo( $name ); ?></h1></a>
	<?php } ?>

	<?php 
	if ( !is_404() ) {
		global $post;
		$postid = $post->ID;
	}

	//PAGE TITLE / SUBTITLE - THEME CUSTOMIZER VALUE 
	$page_title = get_theme_mod( 'header_tagline'); 
	$post_subtitle = get_post_meta($post->ID, '_bean_post_subtitle', true); ?>
	
	<?php if ( is_archive() ) { 
		echo '<h5>'.bean_page_title().'</h5>';
	} elseif ( is_search() ) { 
		echo '<h5>'.bean_page_title().'</h5>';
	} elseif ( is_page_template('template-rcp.php') ) { 
		if ( !is_user_logged_in() ) {
			echo '<p>'.$post_subtitle.'</p>';
		}
	} elseif ( is_page_template('template-rcp-lostpass.php') ) { 
		if ( !is_user_logged_in() ) {
			echo '<p>'.$post_subtitle.'</p>';
		}
	} else {
		if ( $page_title ) { ?>
		<h5><?php echo esc_html( $page_title ); ?></h5>
	<?php }
	} ?>

	

</div><!-- END .logo -->