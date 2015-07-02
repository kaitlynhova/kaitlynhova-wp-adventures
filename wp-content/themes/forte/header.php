<?php
/**
 * The Header template for our theme.
 *
 * Displays all of the <head> section that is pulled on every page.
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

<?php
$heroheader = '';
//ALTERNATE HEADER STYLES FOR HERO
if ( !is_404() ) {
	$hero = get_post_meta($post->ID, '_bean_hero', true);
	if ( is_singular() ) {
		if ( $hero == 'on' ) {
			$heroheader = 'hero-header';
		} else {
			$heroheader = 'no-hero';
		}
	}
} ?>

<body <?php body_class($heroheader); ?>> <?php bean_body_start(); ?>

  <div class=" hidden-sm hidden-xs">
    <div class="col-md-6">
      <p>Kaitlyn Hova</p>
    </div>
    <div class="col-md-6">
      <ul id="top-nav-ul">
        <li>ABOUT</li>
        <li>MUSIC</li>
        <li>VIDEO</li>
        <li>ART</li>
        <li>BOG</li>
      </ul>
    </div>
  </div>

	<?php if ( !is_404() && !is_page_template('template-underconstruction.php')) { //HIDE THIS ON 404/UNDER CONSTRUCTION TEMPLATES ?>

		<div id="skrollr-body">

			<div id="theme-wrapper">

				<div id="page" class="hfeed site">


	<?php } //END if ( !is_404()...
