<?php
/**
 * This file contains the media functions for the theme (Audio).
 *
 *
 * @package WordPress
 * @subpackage Forte
 * @author ThemeBeans
 * @since Forte 1.0
 */


/*===================================================================*/
/*  AUDIO POST FORMAT FUNCTION
/*===================================================================*/
if ( !function_exists( 'bean_audio' ) )
{
	function bean_audio($postid)
	{
	    //MP3 FROM POST/PORTFOLIO
		$mp3 = get_post_meta($postid, '_bean_audio_mp3', TRUE); ?>

		<div id="jp_container_<?php echo esc_html( $postid ); ?>" class="jp-audio fullwidth" data-file="<?php echo esc_html( $mp3 ); ?>">
			<div id="jquery_jplayer_<?php echo esc_html( $postid ); ?>" class="jp-jplayer">
			</div><!-- END .jquery_jplayer -->
			<div class="jp-interface" style="display: none;">
				<ul class="jp-controls">
					<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span><?php _e( 'Play', 'bean' ); ?></span></a></li>
					<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span><?php _e( 'Pause', 'bean' ); ?></span></a></li>
				</ul><!-- END .jp-controls -->
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div><!-- END .jp-seek-bar -->
				</div><!-- END .jp-progress -->
			</div><!-- END .jp-interface -->
		</div><!-- END #jp_container-->

		<?php
	} // END function bean_audio($postid)

} // END if ( !function_exists( 'bean_audio' ) )