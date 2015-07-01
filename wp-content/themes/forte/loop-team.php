<?php
/**
 * The content loop file for the team members grid.
 *
 *
 * @package WordPress
 * @subpackage Forte
 * @author ThemeBeans
 * @since Forte 1.0
 */

//META
$role = get_post_meta($post->ID, '_bean_team_role', true);
$quote = get_post_meta($post->ID, '_bean_team_quote', true);
$url = get_post_meta($post->ID, '_bean_team_url', true);
?>

<?php if ( ( function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>

	<li id="team-<?php the_ID(); ?>" class="team-member <?php if ($quote) { echo 'quoted'; } ?>">

		<div class="team <?php if ($quote) { echo 'quoted'; } ?>">

			<?php the_post_thumbnail('grid-feat'); ?>

			<?php if ($quote) { ?>
				<div class="overlay">
					<blockquote><?php echo $quote; ?></blockquote>
				</div>
			<?php } ?>

		</div>

		<div class="team-content">
			
			<?php if ($url) { ?>
				<h6><a href="<?php echo $url; ?>" target="_blank"><?php the_title(); ?></a></h6>
			<?php } else { ?>
				<h6><?php the_title(); ?></h6>
			<?php } ?>

			<span class="team-role">
				<?php if ($role) { echo $role ; } ?>
			</span>

			<?php the_content(); ?>

			<?php edit_post_link( __( '[Edit]', 'bean' ), '', ''); ?>
			
		</div><!-- END .team-content -->

	</li>

<?php } //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) )