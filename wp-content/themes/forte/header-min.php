<?php
/**
 * The minimal header template for our theme.
 *
 * This is pulled on the RCP login/register/help pages and templates.
 *
 * @package WordPress
 * @subpackage Forte
 * @author ThemeBeans
 * @since Forte 1.0
 */
 ?>

<!DOCTYPE HTML>
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="no-js ie9" lang="en"><![endif]-->

<!-- BEGIN html -->
<html <?php language_attributes(); ?>>

<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php bean_meta_head(); ?>
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Hind' rel='stylesheet' type='text/css'>
	<?php echo get_theme_mod( 'google_analytics' ); ?>
	
	<?php bean_head(); wp_head(); ?>
</head>
			
<body <?php body_class(); ?>> <?php bean_body_start(); ?>

	<header id="header" class="header">

		<?php get_template_part( 'content', 'logo' ); ?>
		
	</header><!-- END #header -->