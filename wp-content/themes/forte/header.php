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
  				<script type="text/javascript" src="http://localhost:8888/wp-content/themes/forte/assets/js/modernizr.custom.js"></script>
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

  <div id="top-nav-static" class="hidden-xs tk-europa">
    <p class="top-logo">KAITLYN HOVA</p>
    <ul id="top-nav-ul">
      <li><a href="http://kaitlynhova.com/rightbrain/">ABOUT</a></li>
      <li> <a href="http://kaitlynhova.com/rightbrain/music">MUSIC </a></li>
      <li> <a href="http://kaitlynhova.com/rightbrain/video">VIDEO</a></li>
      <li> <a href="http://kaitlynhova.com/rightbrain/art">ART</a></li>
      <li> <a href="/">BLOG</a></li>
    </ul>
  </div>

  <div id="mobile-menu" class="visible-xs">
    <div class="mobile-menu-text">
      <p class="top-logo"><a href="http://www.kaitlynhova.com/">KAITLYN HOVA</a></p>
      <p id="trigger-overlay" class="mobile-menu-btn">menu</p>
    </div>
  </div>

  <div class="overlay overlay-hugeinc visible-xs">
    <button type="button" class="overlay-close">Close</button>
    <nav>
      <ul>
        <li><a href="http://kaitlynhova.com/rightbrain/">ABOUT</a></li>
        <li> <a href="http://kaitlynhova.com/rightbrain/music">MUSIC </a></li>
        <li> <a href="http://kaitlynhova.com/rightbrain/video">VIDEO</a></li>
        <li> <a href="http://kaitlynhova.com/rightbrain/art">ART</a></li>
        <li> <a href="/">BLOG</a></li>
      </ul>
    </nav>
  </div>

	<?php if ( !is_404() && !is_page_template('template-underconstruction.php')) { //HIDE THIS ON 404/UNDER CONSTRUCTION TEMPLATES ?>

		<div id="skrollr-body">

			<div id="theme-wrapper">

				<div id="page" class="hfeed site">


	<?php } //END if ( !is_404()...
