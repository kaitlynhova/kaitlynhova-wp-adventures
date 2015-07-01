<?php
/**
 * The template for displaying the Mailbag shortcode on single posts.
 * 
 * @package WordPress
 * @subpackage Forte
 * @author ThemeBeans
 * @since Forte 1.0
 */

//CHECK FOR MAILBAG PLUGIN
if (is_plugin_active('mailbag/mailbag.php')) 
{ 

if( post_password_required() ) return; ?> 
	
	<div class="subscribe">
		
		<h3><?php echo get_theme_mod( 'mailbag_title' ); ?></h3>
		
		<p><?php echo get_theme_mod( 'mailbag_desc' ); ?></p>
		
		<?php //SHORTCODE SWITCHER FOR MAILBAG
		$mailbag_select = get_theme_mod( 'mailbag_select' );
		if( $mailbag_select != '' ) 
		{
			switch ( $mailbag_select ) 
			{
			case 'mailchimp':
				echo do_shortcode('[mailbag_mailchimp]');
				break;
			case 'campaign_monitor':
				echo do_shortcode('[mailbag_mailchimp]');
				break;
			}
		}
		?>

	</div><!-- END .subscribe -->	

<?php } //END if (is_plugin_active('mailbag/mailbag.php'))	