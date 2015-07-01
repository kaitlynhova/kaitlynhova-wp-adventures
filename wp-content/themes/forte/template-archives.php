<?php
/**
 * Template Name: Post Archives
 * The template for displaying the post archives template.
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
	<?php } ?>
<?php } ?>

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
			
			<?php the_content(); ?>

			<div class="archives-list">
				
				<h3><?php _e( 'Lastest', 'bean' );?></h3>

				<ul>
					<?php $archive_30 = get_posts('numberposts=30');
					foreach($archive_30 as $post) : ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
					<?php endforeach; ?>
				</ul>

				<h3><?php _e( 'Monthly', 'bean' );?></h3>

				<ul><?php wp_get_archives('type=monthly'); ?></ul>

				<h3><?php _e( 'Categories', 'bean' );?></h3>

				<ul><?php wp_list_categories( 'title_li=' ); ?></ul>

			</div><!-- END .archives-list --> 

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