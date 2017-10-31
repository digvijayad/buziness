<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buziness
 */

?>

	</div><!-- #content -->
</div> <!-- #page -->
<?php if(is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') ||
	is_active_sidebar('footer-1-home') || is_active_sidebar('footer-2-home') || is_active_sidebar('footer-3-home') ) { ?>
	<footer id="colophon" class="site-footer">
		<div class="footer-area-top">
			<div class="footer-wrapper">
				<div class="footer-box col-3 wow fadeInUp">
					<?php 

					if( !is_front_page() && is_active_sidebar('footer-1')) {
						dynamic_sidebar('footer-1');
					}else {
						if (is_active_sidebar('footer-1-home')) {
							dynamic_sidebar('footer-1-home');
						}
					}?> 
				</div>
				<div class="footer-box col-3  wow fadeInUp">
					<?php 

					if( !is_front_page() && is_active_sidebar('footer-2')) {
						dynamic_sidebar('footer-2');
					}else {
						if (is_active_sidebar('footer-2-home')) {
							dynamic_sidebar('footer-2-home');
						}
					}

					?> 
				</div>
				<div class="footer-box col-3 wow fadeInUp">
					<?php 

					if( !is_front_page() && is_active_sidebar('footer-3')) {
						dynamic_sidebar('footer-3');
					}else {
						if (is_active_sidebar('footer-3-home')) {
							dynamic_sidebar('footer-3-home');
						}
					}

					?> 
                </div>
			</div>
		</div> 
		<?php if (is_active_sidebar('footer-middle')) { ?>
		<div class="footer-area-middle ">
        
		    <div class="footer-wrapper">
				<div class="footer-box  wow fadeInUp">
					<?php// if (is_active_sidebar('footer-middle')) { ?>
						<?php dynamic_sidebar('footer-middle'); ?>
					<?php//}?> 

				</div>
			</div>
		</div>
		<?php }?> 
	</footer><!-- #colophon -->
<?php } ?>

	<?php $copyright =  get_theme_mod( 'buziness_copyright_setting' ); ?>
		<div class="footer-area-bottom">
			<div class="footer-wrapper">
				<div class="copyright">
					<p><?php echo esc_html($copyright) ?></p> 
				</div> 
				<div class="site-info">
					<p>	
					<?php
						/* translators: 1: Theme name, 2: Theme author. */
						$my_theme = wp_get_theme();
						printf( esc_html__( 'Theme: %1$s by %2$s.', 'buziness' ), $my_theme->get('Name'), '<a href="'. esc_url( $my_theme->get( 'AuthorURI' ) ) .'" target="_blank">Digvijay Naruka</a>' );
					?>
						
					</p>
				</div><!-- .site-info -->
			</div>
		</div><!-- footer area bottom -->

<div id="scrollUp" class="scrollUp" style="position: fixed; z-index: 2147483647;">
	<span><i class="fa fa-arrow-up"></i></span></div>

<?php wp_footer(); ?>

</body>
</html>
