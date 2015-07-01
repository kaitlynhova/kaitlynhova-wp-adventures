<?php
/**
 * Template Name: Team Members
 * The template for displaying the team template.
 *
 *  @package WordPress
 *  @subpackage Forte
 *  @author ThemeBeans
 *  @since Forte 1.0
 */

get_header();

//CHECK META IF THIS IS A HERO AREA PAGE
$hero = get_post_meta($post->ID, '_bean_hero', true);
$hero_header = false;

if( $hero == 'on' ) {
	get_template_part( 'content-page-hero' );
	$hero_header = true;
} else { ?>
	<?php if ( ( function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
		<?php $hero_header = true; ?>
		<div class="entry-content-media fadein">
			<?php the_post_thumbnail('post-full'); ?>
		</div><!-- END .entry-content-media -->
	<?php } ?>
<?php } ?>

<div class="row bean-team fadein <?php if( $hero_header == true ) { echo 'hero'; } ?>">

	<?php 
	//CHECK IF BEAN TEAM PLUGIN IS INSTALLED
	if (is_plugin_active('bean-team/bean-team.php') OR is_plugin_active('bean-team-members/bean-team.php') ) { 
		get_template_part( 'content', 'team' );
	} else {
		if ( is_user_logged_in() ) { ?>
			<div class="entry-content" style="text-align: center; padding-top: 0">
				<h2 style="margin-bottom: 20px;"><?php _e( 'Plugin Not Found', 'bean' ); ?></h2>
				<p><?php _e( 'It looks like you have not installed or activated the Bean Team plugin.', 'bean' ); ?></p>
			</div><!-- END .entry-content -->	
		<?php }
	} ?>	

</div><!-- END .row -->

<?php get_footer();