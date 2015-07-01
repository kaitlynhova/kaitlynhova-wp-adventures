<?php
/**
 * This template is used to display the profile editor with [rcp_profile_editor]
 */
global $current_user;

if ( is_user_logged_in() ):
	
	$user_id      = get_current_user_id();
	$first_name   = get_user_meta( $user_id, 'first_name', true );
	$last_name    = get_user_meta( $user_id, 'last_name', true );
	$display_name = $current_user->display_name;
	?>

	<div class="rcp_text logged-in">
		<?php if ( isset( $_GET['updated'] ) && $_GET['updated'] == 'true' ) { ?>
			<p class="rcp_success"><span><strong><?php _e( 'Success', 'bean'); ?>:</strong> <?php _e( 'Your profile has been updated.', 'bean' ); ?></span></p>
		<?php } else { ?>
			<p><?php _e( 'Edit your Account Information', 'bean'); ?></p>
			<?php rcp_show_error_messages(); ?>
		<?php } ?>
	</div>

	<form id="rcp_profile_editor_form" class="rcp_form" action="<?php echo rcp_get_current_url(); ?>" method="post">
		<fieldset>
			<legend><h6><?php _e("Personal Info", "bean") ?></h6></legend>
			<p id="rcp_profile_first_name_wrap">
				<label for="rcp_first_name"><?php _e( 'First Name', 'rcp' ); ?></label>
				<input name="rcp_first_name" id="rcp_first_name" class="text rcp-input" type="text" value="<?php echo $first_name; ?>" />
			</p>
			<p id="rcp_profile_first_name_wrap">
				<label for="rcp_last_name"><?php _e( 'Last Name', 'rcp' ); ?></label>
				<input name="rcp_last_name" id="rcp_last_name" class="text rcp-input" type="text" value="<?php echo $last_name; ?>" />
			</p>
			<p>
				<label for="rcp_email"><?php _e( 'Email Address', 'rcp' ); ?></label>
				<input name="rcp_email" id="rcp_email" class="text rcp-input required" type="email" value="<?php echo $current_user->user_email; ?>" />
			</p>

			<legend><h6><?php _e("Modify Password", "bean") ?></h6></legend>
			<p id="rcp_profile_password_wrap">
				<input name="rcp_new_user_pass1" id="rcp_new_user_pass1" class="password rcp-input" type="password"/>
			</p>
			<p id="rcp_profile_password_confirm_wrap">
				<input name="rcp_new_user_pass2" id="rcp_new_user_pass2" class="password rcp-input" type="password"/>
			</p>
			<p id="rcp_profile_submit_wrap">
				<input type="hidden" name="rcp_profile_editor_nonce" value="<?php echo wp_create_nonce( 'rcp-profile-editor-nonce' ); ?>"/>
				<input type="hidden" name="rcp_action" value="edit_user_profile" />
				<input type="hidden" name="rcp_redirect" value="<?php echo esc_url( rcp_get_current_url() ); ?>" />
				<input name="rcp_profile_editor_submit" id="rcp_profile_editor_submit" type="submit" class="rcp_submit btn" value="<?php _e( 'Save Changes', 'rcp' ); ?>"/>
			</p>
		</fieldset>

		<p class="rcp_text subtext"><?php _e( 'After changing your password, you must log back in', 'rcp' ); ?></p>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('input#rcp_new_user_pass1').attr('placeholder', '<?php _e("Enter a new password", "bean") ?>');
				$('input#rcp_new_user_pass2').attr('placeholder', '<?php _e("Confirm Password", "bean") ?>');
			}); 	
		</script>

	</form><!-- #rcp_profile_editor_form -->
	<?php
else:
	echo '<p class="rcp_text editor-notice">' . __( 'Login to edit your profile.', 'rcp' ) . '</p>';
	echo rcp_login_form_fields();
endif;