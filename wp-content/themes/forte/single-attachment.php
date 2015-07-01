<?php
/**
 *  The template for displaying the singular attachment/media pages.
 *
 * 
 *  @package WordPress
 *  @subpackage Forte
 *  @author ThemeBeans
 *  @since Forte 1.0
 */

get_header(); ?>
	
	<div class="entry-content-media">	
		<?php $image_info = getimagesize($post->guid); ?>
		<img src="<?php echo $post->guid; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" <?php echo $image_info[3]; ?> />
	</div><!-- END .entry-content-media-->

	<div class="entry-content">
		<h3 class="entry-title"><?php the_title(); ?></h3>		
		<p><?php _e( 'Uploaded ', 'bean' ); ?><?php the_time(get_option('date_format')); ?></p>
	</div><!-- END .entry-content-->

<?php get_footer();