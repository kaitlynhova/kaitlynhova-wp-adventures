<?php
/**
 * The template for displaying the footer
 *
 *
 * @package WordPress
 * @subpackage Forte
 * @author ThemeBeans
 * @since Forte 1.0
 */


bean_body_end(); //PULLS DEBUG INFO ?>

	<?php if ( !is_404() && !is_page_template('template-underconstruction.php')) { //HIDE THIS ON 404/UNDER CONSTRUCTION TEMPLATES ?>

			</div><!-- END #page -->

			<footer id="footer" class="footer<?php if ( get_theme_mod( 'infinitescroll' ) == true ) { echo ' infinite'; } ?> <?php if ( comments_open() && is_page() && post_type_supports( get_post_type(), 'comments' ) ) { echo 'open-comments'; } ?>">
			  <div class="footer-content">
				  	<div class="large-6 medium-6 columns left-text">
				    	<a href="https://twitter.com/KaitlynHova" target="_blank"><i class="fa fa-twitter"></i></a>
				    	<a href="https://instagram.com/kaitlynhova/" target="_blank"><i class="fa fa-instagram"></i></a>
				    	<a href="https://www.facebook.com/KaitlynHova" target="_blank"><i class="fa fa-facebook"></i></a>
				    </div>
				    <div class="large-6  right-text">
							<ul id="footer-menu">
								<li>
									<a href="http://kaitlynhova.com/adventures/contact">CONTACT</a>
								</li>
								<li>
									<a href="http://www.kaitlynhova.com/rightbrain/press" target="_blank"><p class="press-button">PRESS</p></a>
								</li>
							</ul>
					  </div>
			  </div>

				<?php if( is_active_sidebar( 'footer-col-1' ) OR is_active_sidebar( 'footer-col-2' ) OR is_active_sidebar( 'footer-col-3' )) { ?>

					<div class="footer-widgets">

						<div class="footer-col footer-col-1">
							<?php dynamic_sidebar( 'Footer Col 1' );  ?>
						</div><!-- END .footer-col-1 -->

						<div class="footer-col footer-col-2">
							<?php dynamic_sidebar( 'Footer Col 2' );  ?>
						</div><!-- END .footer-col-2 -->

						<div class="footer-col footer-col-3">
							<?php dynamic_sidebar( 'Footer Col 3' );  ?>
						</div><!-- END .footer-col-2 -->

					</div><!-- END .widgets -->

				<?php } ?>

				<div class="footer-colophon">



				</div><!-- END .footer-colophon -->
				<script type="text/javascript" src="http://localhost:8888/wp-content/themes/forte/assets/js/classie.js"></script>
				<script type="text/javascript" src="http://localhost:8888/wp-content/themes/forte/assets/js/demo1.js"></script>
			</footer><!-- END #footer-->

		</div><!-- END #theme-wrapper -->

		<?php if( get_theme_mod( 'hidden_sidebar' ) == true) {
			get_template_part( 'content', 'hidden-sidebar' ); //GET CONTENT-HIDDEN-SIDEBAR.PHP
		} ?>

	</div><!-- END #skrollr-body -->

<?php } //END if ( !is_404()... ?>

<?php wp_footer(); ?>

</body>

</html>
