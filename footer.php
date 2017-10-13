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

	<footer id="colophon" class="site-footer">
		<div class="footer-area-top">
			<div class="footer-wrapper">
				<div class="footer-box widget-col-3">
					<?php if (is_active_sidebar('footer-1')) {
						dynamic_sidebar('footer-1');
					}?> 
<!-- 					<img src="http://localhost/sbdc/wp-content/uploads/2017/09/sba_logo.png">
					<p>Funded in part through a cooperative agreement with the U.S Small Business Administration. All opinions, conclusions or recommendations expressed are those of the author(s) and do not necessarily reflect the views of the SBA. SBDC programs are open to the public and all services are provided on a nondiscriminatory basis without regard to race, color, religion, sex, age, disability, or national origin. Accommodations are made for individuals with disabilities. Accredited member of the Association of Small Business Development Centers. </p> -->
				</div>
				<div class="footer-box widget-col-3">
					<?php if (is_active_sidebar('footer-2')) {
						dynamic_sidebar('footer-2');
					}?> 
				</div>
				<div class="footer-box widget-col-3">
					<?php if (is_active_sidebar('footer-3')) {
						dynamic_sidebar('footer-3');
					}?> 
                    <!-- <h3>Information</h3>
                    <ul class="contacts">
                    	<span class="contact-name">Andrea Rogers Mosley </span> 
                    	<span class="contact-designation">Director</span>
                    	<li><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    	<a href="mailto:arprice@alasu.edu">arprice@alasu.edu</a>
                    	</li>
                 	</ul>
                 	<ul class="contacts">
                 		<span class="contact-name" >Lataya Flowers </span>
                 		<span class="contact-designation">Administrative Secretary</span>
                    	<li><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    		<a href="mailto:lflowers@alasu.edu">lflowers@alasu.edu</a>
                    	</li>
                 	</ul>
                 	<ul class="contacts">
                 		 <span class="contact-name">Thomas Taylor </span>
                 		 <span class="contact-designation">PTAC Procurement Specialist/Senior Small Business Advisor</span>
                    	<li><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    		<a href="mailto:ttaylor@alasu.edu">ttaylor@alasu.edu</a>
                    	</li>
                 	</ul>
                 	<ul class="contacts">
                    	<li><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+1-334-229-4138">334-229-4138</a></li>
                    	<li><i class="fa fa-fax" aria-hidden="true"></i><a href="tel:+1-334-229-4129">334-229-4129</a></li>
                 	</ul> -->
                </div>
			</div>
		</div>

		<div class="footer-area-middle">
        
    <div class="footer-wrapper" style="margin-left: 50px;margin-right: 50px;padding-top: 30px;">
		<div class="footer-box">
			<?php if (is_active_sidebar('footer-middle-1')) {
				dynamic_sidebar('footer-middle-1');
			}?> 

		</div>
	</div>
		<div class="footer-area-bottom">
			
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'buziness' ) ); ?>"><?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'buziness' ), 'WordPress' );
				?></a>
				<span class="sep"> | </span>
				<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'buziness' ), 'buziness', '<a href="http://underscores.me/">Digvijay Naruka</a>' );
				?>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
