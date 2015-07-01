<?php
/**
 * Template Name: Contact
 * The template for displaying the contact template.
 *
 *  @package WordPress
 *  @subpackage Forte
 *  @author ThemeBeans
 *  @since Forte 1.0
 */

get_header();

//CHECK META IF THIS IS A HERO AREA PAGE
$hero = get_post_meta($post->ID, '_bean_hero', true);

if( $hero == 'on' ) {
	get_template_part( 'content-page-hero' ); 
} else { ?>
	<?php if ( ( function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
		<div class="entry-content-media fadein">
			<?php the_post_thumbnail('post-full'); ?>
		</div><!-- END .entry-content-media -->
	<?php }
}

//CONTACT CODE
if(isset($_POST['submitted'])) {
		if(trim($_POST['contactName']) === '') {
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		if(trim($_POST['email']) === '')  {
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['comments']) === '') {
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		if(!isset($hasError)) {
		 	
		 	$site_name = get_bloginfo('name');
			$contactEmail = get_theme_mod( 'admin_custom_email');
			
			if (!isset($contactEmail) || ($contactEmail == '') ){
				$contactEmail = get_option('admin_email');
			}
			
			$subject = '['.$site_name.' Contact Form] ';
			$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
		
			$headers = 'Reply-To: ' . $email;
			/* 	
			By default, this form will send from wordpress@yourdomain.com in order to work with 
			a number of web hosts' anti-spam measures. If you want the from field to be the
			user sending the email, please uncomment the following line of code.
			*/
			//$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($contactEmail, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div class="row fadein">

		<div <?php post_class('entry-content'); ?>>
	
			<?php if( $hero == 'off' ) { ?>
				<h1 class="entry-title"><?php echo bean_page_title(); ?></h1>

				<?php $post_subtitle = get_post_meta($post->ID, '_bean_post_subtitle', true); ?>

				<?php if ( $post_subtitle ) { ?>
					<div class="entry-excerpt">
						<h5><?php echo esc_html( $post_subtitle ); ?></h5>
					</div><!-- END .entry-excerpt -->
				<?php } ?>
			<?php } //if( $hero == 'off' ) ?>

			<?php if(isset($emailSent) && $emailSent == true ) { ?>
				
				<div class="contact-alert success">
				
					<?php _e('Awesome! Your message has been sent!', 'bean') ?>
					
				</div><!-- END .alert alert-success -->
		
			<?php } // END SUCCESS ALERT ?>
	
			<?php if(isset($hasError) || isset($captchaError)) { ?>
			
				<div class="contact-alert fail">
				
					<?php _e('Well now... an error occured. Please try again.', 'bean') ?>
				
				</div><!-- END .alert alert-success -->
				
			<?php } // END FAIL ALERT ?>
			
			<?php the_content(); ?>	
			
			<script type="text/javascript">
				jQuery(document).ready(function(){ 
					jQuery("#BeanForm").validate({ errors: { contactName: '', email: { required: '', email: '' }, comments: '' } }); 
				});
			</script>
			
			<?php $required = '<span class="required">*</span>'; ?>
			
			<form action="<?php the_permalink(); ?>" id="BeanForm" class="comment-form" method="post">
					
					<p class="message">
						<label for="commentsText"><?php _e('Message ', 'bean'); echo $required ?></label>
						<textarea name="comments" id="commentsText" rows="8" cols="45" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
					</p>

					<p class="name">
						<label for="contactName"><?php _e('Name ', 'bean'); echo $required ?></label>
						<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
					</p>
					
					<p class="email">
						<label for="email"><?php _e('Email ', 'bean'); echo $required ?></label>
						<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
					</p>
		
					<p class="form-submit">
						<input type="hidden" name="submitted" id="submitted" value="true" />
						<button type="submit" class="button"><?php echo get_theme_mod( 'contact_button_text', 'Send Message', 'bean' ); ?></button>
					</p>

			</form><!-- END #BeanForm -->

		</div><!-- END .entry-content -->	
			
	</div><!-- END .row -->

	<?php 
	//COMMENTS
	if( bean_theme_supports( 'comments', 'posts' )) {
		bean_comments_start();
	 	comments_template('', true);
	 	bean_comments_end();
	} ?>

<?php endwhile; endif; ?>	

<?php get_footer();