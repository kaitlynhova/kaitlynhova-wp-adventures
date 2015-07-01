<?php
/**
 * This is just a demonstration of how theme licensing works with
 * Easy Digital Downloads.
 *
 * @package WordPress
 * @subpackage EDD Theme Updater
 */

// This is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
define( 'EDD_SL_STORE_URL', 'http://themebeans.com' ); // add your own unique prefix to prevent conflicts

$theme = wp_get_theme();
$name = $theme->get( 'Name' );
$name = str_replace("Child","",$name);
$name = preg_replace('/\s+/', '', $name);

// The name of your product. This should match the download name in EDD exactly
define( 'EDD_SL_THEME_NAME', $name ); // add your own unique prefix to prevent conflicts



/***********************************************
* This is our updater
***********************************************/
if ( !class_exists( 'EDD_SL_Theme_Updater' ) ) {
	include( dirname( __FILE__ ) . '/EDD_SL_Theme_Updater.php' );
}

function edd_sl_sample_theme_updater() {

	$test_license = trim( get_option( 'edd_themebeans_theme_license_key' ) );

	$theme = wp_get_theme();
	$name = $theme->get( 'Name' );
	$name = str_replace("Child Theme","",$name);
	$name = preg_replace('/\s+/', '', $name);

	$theme = wp_get_theme($name);
	$version = $theme->get( 'Version' );

	$edd_updater = new EDD_SL_Theme_Updater( array(
			'remote_api_url' 	=> EDD_SL_STORE_URL, 	// Our store URL that is running EDD
			'version' 		=> $version, 			// The current theme version we are running
			'license' 		=> $test_license, 		// The license key (used get_option above to retrieve from DB)
			'item_name' 		=> EDD_SL_THEME_NAME,	// The name of this theme
			'author'			=> 'ThemeBeans'		// The author's name
		)
	);
}
add_action( 'admin_init', 'edd_sl_sample_theme_updater' );



/***********************************************
* Add our menu item
***********************************************/
function edd_themebeans_theme_license_menu() {
	add_theme_page( 'Theme License', 'Theme License', 'manage_options', 'themebeans-license', 'edd_themebeans_theme_license_page' );
}
add_action('admin_menu', 'edd_themebeans_theme_license_menu');



/***********************************************
* Sample settings page, substitute with yours
***********************************************/
function edd_themebeans_theme_license_page() {
	$license 	= get_option( 'edd_themebeans_theme_license_key' );
	$status 	= get_option( 'edd_themebeans_theme_license_key_status' );
	
	$theme = wp_get_theme();
	$name = $theme->get( 'Name' );
	$name = str_replace("Child","",$name);
	$name = preg_replace('/\s+/', '', $name);
	?>

	<div class="wrap">
		<h2><?php _e( 'Theme License', 'bean' ); ?></h2>
		<p><?php _e( 'In order to access support and updates for '.$name.' WordPress theme, you will need to enter a valid license key. Need help finding your license key? <a href="http://themebeans.com/support/locating-your-license-key/">Click here for instructions &rarr;</a>', 'bean' ); ?></p>
		<br/>

		<form method="post" action="options.php">

			<?php settings_fields('edd_themebeans_theme_license'); ?>
			<h3 style="font-size: 15px; font-weight: 600; color: #222; margin-bottom: 10px;"><?php _e( 'Details', 'bean' ); ?></h3>
			<p><?php _e( 'It is important to keep your license up to date in order to continue getting updates for '.$name.' and support for any issues you may encounter. Renewing your license grants you access to support and updates for another year, including all updates for bug fixes and feature introductions.', 'bean' ); ?></p>
			<?php if( false !== $license ) { ?>
				<?php if( $status !== false && $status == 'valid' ) { ?>
					<?php wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
					<p><?php _e( 'Don&#39;t let your license expire. Renew your license and <strong>Save 30%</strong> right off!', 'bean' ); ?></p>
				<?php } ?>
			<?php } ?>
			


			<?php //PHP PULL CONTENTS
			$jsonaddress = 'http://demo.themebeans.com/wp-content/themes/'.strtolower($name).'/changelog.txt';
			$version = @file_get_contents($jsonaddress, NULL, NULL, 0, 5); 

			$theme = wp_get_theme($name);
			$your_version = $theme->get( 'Version' );
			?>

			<br/>
			<h3 style="font-size: 15px; font-weight: 600; color: #222; margin-bottom: 10px;"><?php _e( ''.$name.' Info', 'bean' ); ?></h3>

			<p style="line-height:24px;">
			<strong><?php _e( 'Your Version:', 'bean' ); ?></strong> <?php echo nl2br($your_version); ?><br/>

			<strong><?php _e( 'Current Version:', 'bean' ); ?></strong> <?php echo nl2br($version); ?> <a href="<?php echo BEAN_THEME_CHANGELOG_URL?>" target="_blank"> (changelog)</a><br/>

			<strong><?php _e( 'License Key:', 'bean' ); ?></strong> <?php echo $license; ?><br/>

			<strong><?php _e( 'Status:', 'bean' ); ?></strong> <span style="text-transform: capitalize;"><?php echo $status; ?></span>
			</p>
	


			<br/>
			<h3 style="font-size: 15px; font-weight: 600; color: #222; margin-bottom: 10px;"><?php _e( 'License Key', 'bean' ); ?></h3>
							
			<input id="edd_themebeans_theme_license_key" name="edd_themebeans_theme_license_key" type="text" class="regular-text" value="<?php echo esc_attr( $license ); ?>" />

			<?php if( false !== $license ) { ?>
				<?php if( $status !== false && $status == 'valid' ) { ?>
					<?php wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
					<input type="submit" class="button-secondary" name="edd_theme_license_deactivate" value="<?php _e( 'Deactivate', 'bean' ); ?>"/>
					<span style="color:#FFF; position: relative; top: -2px; background-color: #3bc492; padding: 4px 8px 6px;; border-radius: 2px; "><?php _e('Active'); ?></span>
					<p><a href="<?php echo LICENSE_CHECKOUT_URL ?>" target="_blank"><?php _e( 'Renew your license for '.$name.'', 'bean' ); ?> &rarr;</a></p>
				<?php } else {
					wp_nonce_field( 'edd_sample_nonce', 'edd_sample_nonce' ); ?>
					<input type="submit" class="button-secondary" name="edd_theme_license_activate" value="<?php _e( 'Activate', 'bean' ); ?>"/>
						
					<?php if( bean_theme_supports( 'shop', 'tf' ) ) { ?>
						<p><?php _e( 'Did you purchase '.$name.' from ThemeForest? <a href="'.LICENSE_REQUEST_URL.'" target="_blank">Request a license key today &rarr;</a> ', 'bean' ); ?></p>
					<?php } elseif ( bean_theme_supports( 'shop', 'cm' ) ) { ?>
						<p><?php _e( 'Did you purchase '.$name.' from Creative Market? <a href="'.LICENSE_REQUEST_URL.'" target="_blank">Request a license key today &rarr;</a> ', 'bean' ); ?></p>
					<?php } else { ?>
						<p><?php _e( 'Need a license key for '.$name.'? ', 'bean' ); ?><a href="<?php echo LICENSE_CHECKOUT_URL ?>" target="_blank"><?php _e( 'Get one today &rarr;', 'bean' ); ?></a></p>
					<?php } ?>

				<?php } ?>
			<?php } ?>

			<?php submit_button(); ?>

		</form>
	<?php
}

function edd_themebeans_theme_register_option() {
	// creates our settings in the options table
	register_setting('edd_themebeans_theme_license', 'edd_themebeans_theme_license_key', 'edd_theme_sanitize_license' );
}
add_action('admin_init', 'edd_themebeans_theme_register_option');



/***********************************************
* Gets rid of the local license status option
* when adding a new one
***********************************************/
function edd_theme_sanitize_license( $new ) {
	$old = get_option( 'edd_themebeans_theme_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'edd_themebeans_theme_license_key_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}



/***********************************************
* Illustrates how to activate a license key.
***********************************************/
function edd_themebeans_theme_activate_license() {

	if( isset( $_POST['edd_theme_license_activate'] ) ) {
	 	if( ! check_admin_referer( 'edd_sample_nonce', 'edd_sample_nonce' ) )
			return; // get out if we didn't click the Activate button

		global $wp_version;

		$license = trim( get_option( 'edd_themebeans_theme_license_key' ) );

		$api_params = array(
			'edd_action' => 'activate_license',
			'license' => $license,
			'item_name' => urlencode( EDD_SL_THEME_NAME )
		);

		$response = wp_remote_get( add_query_arg( $api_params, EDD_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "active" or "inactive"

		update_option( 'edd_themebeans_theme_license_key_status', $license_data->license );

	}
}
add_action('admin_init', 'edd_themebeans_theme_activate_license');



/***********************************************
* Illustrates how to deactivate a license key.
* This will descrease the site count
***********************************************/
function edd_themebeans_theme_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_theme_license_deactivate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'edd_sample_nonce', 'edd_sample_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'edd_themebeans_theme_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( EDD_SL_THEME_NAME ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, EDD_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( 'edd_themebeans_theme_license_key_status' );

	}
}
add_action('admin_init', 'edd_themebeans_theme_deactivate_license');



/***********************************************
* Illustrates how to check if a license is valid
***********************************************/
function edd_themebeans_theme_check_license() {

	global $wp_version;

	$license = trim( get_option( 'edd_themebeans_theme_license_key' ) );

	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( EDD_SL_THEME_NAME )
	);

	$response = wp_remote_get( add_query_arg( $api_params, EDD_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

	if ( is_wp_error( $response ) )
		return false;

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if( $license_data->license == 'valid' ) {
		echo 'valid'; exit;
		// this license is still valid
	} else {
		echo 'invalid'; exit;
		// this license is no longer valid
	}
}