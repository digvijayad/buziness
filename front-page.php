<?php 
/** 
 * 
 * Template to show front page
 * 
 * @package Buziness
 */
 get_header();
?>
<?php
if( get_option( 'show_on_front' ) == 'posts' ): 
	

$post_banner_image = get_theme_mod( 'buziness_post_banner_image' );

if(!empty($post_banner_image)){
	$banner_image = $post_banner_image;
}
else {
	$banner_image = get_template_directory_uri() . '/images/banner.jpg';
}

$attachment_id = attachment_url_to_postid( $banner_image );
$image_array = wp_get_attachment_image_src( $attachment_id, 'buziness_banner_image_size' );

?>
<!-- Breadcrumb-start -->
		<section class="breadcrumb" style="background: url( <?php echo (!empty($image_array[0])) ? esc_url($image_array[0]) .');': (get_template_directory_uri() . '/images/banner.jpg') . ');"' ?>">
<!-- <section class="breadcrumb" style="background: url( 'http://localhost/sbdc/wp-content/uploads/2017/10/banner.jpg' );"> -->
			<div class="wrapper">
				<div class="breadcrumb-menu">
					<div class="breadcrumb-title">
						<h2 ><?php echo esc_html(get_bloginfo( 'site-title' )); ?></h2>
					</div>
				</div>
			</div> 
		</section> 
<!-- Breadcrumb-end -->

<div class="main-content blog-archive">
			<div class="wrapper">
				<section id="primary" class="content-area">
					<main id="main" class="site-main" role="main"> 
						<div class="content-page content-sep">

							<div class="blog-page left-content"> 
                                <div id="cc-blog-page-jetpack">
								<?php 

									while( have_posts() ) : the_post(); 
								?>		

									<article id="post-<?php the_ID(); ?>" class="post"> 
										<header class="entry-header wow fadeInDown"> 

										<?php 

										$post_title = get_the_title();

										if ( $post_title ) : ?> 

											<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>		
										
										<?php endif; 								
										?>	
										
											<div class="entry-meta">
											
												<span><i class="fa fa-calendar"></i><a href="<?php the_permalink();  ?>"><?php echo esc_html(get_the_date());   ?></a></span>
											
												<span><i class="fa fa-user"></i><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a></span>
												<span><i class="fa fa-comment"></i><a href="<?php echo esc_url(get_comments_link()); ?>"><?php comments_number( __('no responses', 'buziness' ), __('one response', 'buziness'), __('% responses', 'buziness') ); ?></a></span>
											</div> 
										<?php  //endif; ?> 
										</header> 

									
										<div class="entry-content wow fadeInUp"> 
											<?php 
				                    			if ( has_post_thumbnail()) : 
				                     			 $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); 
				               					?>

													<div class="entry-content-img">
                                                        <?php if(!empty($image_url[0])){ ?>
														<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>"><!-- https://pixabay.com/en/turret-arch-snow-winter-sandstone-1364314/ --> 
                                                        <?php } ?>
													</div>

											<?php endif; ?>
													<p>
                                                    <?php buziness_add_excerpt_length( apply_filters( 'buziness_service_excerpt_length', 100 ) );
                                                    the_excerpt();
                                                    buziness_remove_excerpt_length();
                                                  ?> 
                                                    </p> 
													
													<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'buziness' ); ?></a> 
										</div> 
									</article> 

								<?php endwhile; ?> 
								</div>
								<nav class="navigation post-navigation" role="navigation">

									<?php the_posts_navigation(); ?>
								</nav>

							</div> 

						<aside id="secondary" class="widget-area right-sidebar" role="complementary">
							<?php 
								if(is_active_sidebar('right-sidebar')){
									dynamic_sidebar('right-sidebar');
								} 
							?>
					
						</aside> 
					</div> 
				</main>
			</section>
		</div>
	</div> 



<?php
else:


$slider_shortcode = get_theme_mod('buziness_slider_shortcode');

if(!empty($slider_shortcode)){ 
	echo do_shortcode($slider_shortcode);
}
?>
	<!-- <div id="main-content-section" class="main-content-section"> -->
	<?php while(have_posts()) : the_post(); ?>
		<?php if (get_the_content()): ?>
		<div class = "template-content wrapper">
			
			<div class="main-content">
				<?php if(has_post_thumbnail()): ?>
				<div class="col-2 excerpt-image">

					<?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'buziness_about_us_image_size');
						if (!empty($image_url[0])) {
							?>
							<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute();?>">
				<?php 	}	?>
					
				</div>
				<?php endif;
				if (get_the_title()):
				?>

				<div class="col-2 excerpt">
					<div class="title " >
						<h2 class="wow fadeInLeft"><?php the_title(); ?></h2>
					</div>
					<?php the_content();?>
				</div>

			<?php endif; ?>
				
			</div> <!-- main-content -->
		</div><!-- end of wrapper -->
	<?php endif; ?>
	<?php endwhile; ?>

<!-- offer -->
<?php 
	$services_active = absint(get_theme_mod('buziness_services_setting_activate',1));
	
	if($services_active == 1):
		$services_category = get_theme_mod( 'buziness_services_dropdown_categories');
		$services_title = get_theme_mod('buziness_services_title');
		$services_description = get_theme_mod('buziness_services_desc');

		?>

		<section id="offers" class="section offers">
			<div class="wrapper">

				<?php if(!empty($services_title)){ ?>
					<div class="title wow bounceInUp"><h2><?php echo $services_title ?></h2>
				<?php 
					if (!empty($services_description)) { ?>
							<p><?php echo $services_description; ?></p>
					<?php } ?>
					</div> <!-- .title -->

				<?php } ?>

				<div class="section_clear">
				<?php 
					if(!empty( $services_category)) : 
					$args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => 6,
						'cat' => absint($services_category)
					);

					$query = new WP_Query($args);

					if ( $query->have_posts() ) :
						if($query->post_count > 1){
							$query->posts = array_reverse($query->posts);
						}
						while ( $query->have_posts() ) : $query->the_post();
							$post_id = get_the_ID();
							

				 ?>
				 
				 <?php 
				$color_hex = get_post_meta($post_id, '_post_icon_color_hex', true);
				if(empty($color_hex))
					$color_hex = "#000";
						?>
				 <!-- one offer start -->
					<div class="col-3 offer" style="border-color: <?php echo $color_hex?>;">
						<div class="wow fadeInLeft title">
							<h2><?php the_title();?></h2>
						</div>
						<div class="wow fadeInRight offer_img ">

							 <?php $image_id = get_post_meta($post_id, '_post_image_icon_id', true);
								$image_url = wp_get_attachment_image_src( $image_id,'buziness_offer_image_size');
						
							if (!empty($image_url[0])) :
							?>
							<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute();?>">
						<?php endif ?>
						</div>
						<div class="wow fadeInRight description">
							<p><?php echo esc_attr(get_post_meta($post_id, '_excerpt', true ));?></p>
						</div>

						<div class="button-container">
							<a onmouseenter="this.style.borderColor='<?php echo $color_hex?>'; this.style.backgroundColor='<?php echo $color_hex?>'; this.style.color='#ffffff';" 
								onmouseleave="this.style.borderColor='<?php echo $color_hex?>'; this.style.backgroundColor='transparent'; this.style.color='<?php echo $color_hex?>'"
								style="border-color: <?php echo $color_hex?>; color: <?php echo $color_hex?>; background-color: transparent;"
								class="button-block"
								href="<?php the_permalink(); ?>">Get Started</a>
						</div>
					</div> <!-- offer end -->	
					<?php 	endwhile;
					endif;
						wp_reset_postdata();
				endif;
				 ?>	
				</div><!-- section_clear -->
			</div> <!-- wrapper -->
		</section>

<?php endif; ?>
<!-- offer end -->
<!-- Counter-Start -->
	<?php
		$Counter_active = absint(get_theme_mod('buziness_counter_activate',1));
		$Counter_title = get_theme_mod( 'buziness_counter_title', __( 'Title' , 'buziness') );
		$Counter_1 = get_theme_mod('buziness_counter_1');
		$Counter_background = get_theme_mod('buziness_counter_background_image');
	?> 

	<?php if(1 == $Counter_active && !empty($Counter_title) ) : ?>

		<section id="counter-area" class="counter-area parallax-image" <?php echo (!empty($Counter_background)) ? 'style="background-image: url('. esc_url($Counter_background) .');"': ''; ?> >
			<div class="counter-overlay ">
				<div class="wrapper">
					
					<div class="title wow bounceInUp">
						<?php if(!empty($Counter_title)): ?>
							<h2><?php echo esc_html($Counter_title); ?></h2>
						<?php endif; ?>
					</div> 

					<?php 
					echo '<div class="counter-row">';
						do_action('buziness_counter', $Counter_1); 
					echo '</div>';
						// "TRAINING EVENTS": "44", "TOTAL TRAINED":"811", "CAPITAL INFUSION":"2,766,000"
	    			?>

				</div> <!-- container -->
			</div> <!-- counter-overlay -->
		</section>
	<?php endif;?>
<!-- Counter End -->

<!-- CTA-start -->

	<?php $CTA_active = absint(get_theme_mod('buziness_call_to_action_activate',1));
		$CTA_title = get_theme_mod( 'buziness_call_to_action_title', __( 'Title' , 'buziness') );
		$CTA_descriptpon = get_option( 'buziness_call_to_action_desc', __( 'CTA title', 'buziness') );
		$CTA_bg_color = get_theme_mod('buziness_call_to_action_bgcolor');
	?>
	
	<?php if($CTA_active == 1): ?>
		<section class="section cta" style="background-color: <?php /*echo $CTA_bg_color;*/ ?>">
			<div class="wrapper">
				<div class="cta-block wow zoomIn"> 
				<?php 
					if(!empty( $CTA_title ))
					{
				?>
					<h1><?php echo esc_html($CTA_title); ?></h1>

				<?php  }
					if( !empty( $CTA_descriptpon ) ) {
					?>
					<p><?php echo esc_html($CTA_descriptpon); ?></p>
				<?php } ?>
				</div>
					<div class="dtl wow zoomIn">
						<a href="#">Get Started</a>
					</div>
				<div class="clearfix"></div>
			</div>
		</section>
	<?php endif; ?>

	<!-- CTA End -->
<!-- Testimonials -->
	<?php 
	$testimonial_active = absint(get_theme_mod( 'buziness_testimonials_setting_activate'),1);
	if ($testimonial_active == 1 ) {
		
		// use plugin's shortcode or theme's testimonials?
		$testimonials_selection = get_theme_mod('buziness_testimonials_selection');
		
		if($testimonials_selection == 'plugin'){

			$testimonial_shortcode = get_theme_mod('buziness_testimonial_shortcode');
			if(!empty($testimonial_shortcode)){ 
				echo do_shortcode($testimonial_shortcode);
			}
		}    //use theme's
		else {
			$testimonial_title = get_theme_mod( 'buziness_testimonials_title', __( 'Testimonials' , 'buziness') );
			$testimonial_category = get_theme_mod( 'buziness_testimonails_dropdown_categories' );
			$testimonials_background = get_theme_mod('buziness_testimonials_background_image');
			$testimonial_type = get_theme_mod('buziness_testimonails_dropdown_types', 2);


			if(!empty( $testimonial_category)) : 
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'cat' => absint($testimonial_category)
			);

			$query = new WP_Query($args);


						?>
			<section class="testimonials" >
				
				<?php if ($testimonial_type == 2) :  ?>
					<div class="parallax-image" <?php echo (!empty($testimonials_background)) ? 'style="background-image: url('. esc_url($testimonials_background) .');"': ''; ?> >
<!-- 
					 style="background: url(http://demo.codetrendy.com/codepress-corporate-lite/wp-content/uploads/2016/09/architecture-blue-building-business-41170-large.jpeg);"> -->
						<div class="bg-black"></div>
					</div>
				<?php endif; ?>

				<!-- <div class="wrapper"> -->

					<?php if(!empty($testimonial_title)) : ?>
						<div class="title wow fadeInDown"  >
							<h2 <?php if ($testimonial_type == 2) {	echo 'style="color: #fff";'; } ?>><?php echo esc_html($testimonial_title); ?></h2> 
						</div> 
					<?php endif; ?>			

						<div class="testimonial">
							<div id="testimonial-slider" class="owl-carousel owl-theme">

								<?php  
								 while( $query-> have_posts() ) : $query->the_post(); 
								?> 						 
									
									<div class="item client wow zoomIn <?php if ($testimonial_type == 1) :	echo 'grid-2-columns'; ?> " 
										<?php 
									else:
										echo '" style="color: #fff";';
									endif;	?>
									>
										<!-- Testimonial Type 1  -->
										<?php if ($testimonial_type == 1) :  ?>

											<div class="grid-1">
											
												<?php
												$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'buziness_about_us_image_size');
												 if(!empty($image_url[0])){ ?>
														<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?> ">
		                                        <?php } ?>
											</div>
											<div class="grid-2" style="align-self: center;">
												<div class="content"> 
													<p><?php the_content(); ?></p>
												</div>
													<h4 class="client-name"><?php the_title(); ?></h4>
													<h4 class="client-company"><?php  echo esc_attr(get_post_meta(get_the_ID(), '_excerpt', true )); ?></h4>
											</div>

										<?php else: ?>
											<!--Testimonial Type 2 -->
											<p><?php the_content(); ?></p>

												<?php if ( has_post_thumbnail()) :
							                     $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'buziness_about_us_image_size'); ?>

													<div class="client-img">
		                                            <?php if(!empty($image_url[0])){ ?>
														<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?> ">
		                                                <?php } ?>
													</div>

												<?php endif; ?>

											<h4 class="client-name"><?php the_title(); ?></h4>
											<h4 class="client-company"><?php echo esc_attr(get_post_meta(get_the_ID(), '_excerpt', true )); ?></h4>

										<?php endif; ?>
									</div> 	
				

								<?php endwhile; 
									wp_reset_postdata();
								?>

							</div>	
						</div>
				<!-- </div>	 -->
			</section>

			<?php endif;  //testimonial Category  

		} // if not shortcodde

	} ?> <!-- not active -->
<!-- Cta End -->
	
	
<?php
endif;
get_footer();