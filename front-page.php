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
if( get_option( 'show_on_front' ) != 'posts' ): ?>
	
<?php 

// echo do_action('buziness_main_banner');
echo do_shortcode('[smartslider3 slider=3]');
?>
	<div id="main-content-section" class="main-content-section">
	<?php while(have_posts()) : the_post(); ?>

		<div class = "wrapper">
			
			<div class="main-content">
				<?php if(has_post_thumbnail()): ?>
				<div class="col-2 excerpt-image">

					<?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'buziness_about_us_image_size');
						if (!empty($image_url[0])) {
							?>
							<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute();?>">
				<?php 	}	?>
					
				</div>
				<?php endif?>
				<div class="col-2 excerpt">
					<div class="title " >
						<h2 class="wow fadeInLeft"><?php the_title(); ?></h2>
					</div>
					<?php the_content();?>
				</div>
				
			</div> <!-- main-content -->
		</div><!-- end of wrapper -->

	<?php endwhile; ?>

<!-- Services Start -->
<?php /*
	$services_active = absint(get_theme_mod('buziness_services_setting_activate',1));
	if($services_active == 1):

		$services_title = get_theme_mod( 'buziness_services_title', __( 'Title' , 'buziness') );
		$services_desc = get_theme_mod( 'buziness_services_desc', __( 'Services Description' , 'buziness') );
		$services_category = get_theme_mod( 'buziness_services_dropdown_categories');
		$services_char_count = get_theme_mod( 'buziness_services_char_count', 26 );
	?>
<!-- 	<div> <?php echo "Services ". $services_active; ?> </div>
	<div> <?php echo "Services Title- ". $services_title; ?> </div>
	<div> <?php echo "Services desc- ". $services_desc; ?> </div>
	<div> <?php echo "Services category- ". $services_category; ?> </div>
	<div> <?php echo "Services count- ". $services_char_count; ?> </div>
	 -->
	<section id="services" class="section services">
		<div class="wrapper">
			<div class= "title">
			<?php 
				if( $services_char_count != '' )
				{	
					$character_count = $services_char_count;
				}
				else{
					$character_count = '20';
				}
				if(!empty( $services_title )) 
				{ 
			?>
					<h2><?php echo esc_html($services_title); ?> </h2>
		<?php  	}

				if(!empty( $services_desc)) : 
			?>
				<p><?php echo esc_html($services_desc); ?> </p>
			<?php endif; ?>
				
			</div>
			<div class="service-row">

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

			 ?>
				<div class="service col-3 card">
				<?php if( has_post_thumbnail()) : ?>
					<div class="s-img">
					<?php
						$image_url = wp_get_attachment_image_src(
							get_post_thumbnail_id($post->ID),'thumbnail'
						);
						if(!empty($image_url[0])):
					?>
						<!-- <img src="http://localhost/sbdc/wp-content/uploads/2017/09/Hire-Sales-and-Business-Development-for-Startup.jpg"/> -->
						<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>"/>		
					<?php endif; ?>
					</div>
				<?php endif; ?>
					<div class="card-description">
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<?php buziness_add_excerpt_length(									apply_filters('buziness_service_excerpt_length', $character_count) );
								the_excerpt();
								buziness_remove_excerpt_length();
								 ?>	
					</div>
				</div><!-- service card End -->
			<?php 	endwhile;
				endif;
					wp_reset_postdata();
			endif;
			 ?>

			</div><!-- Service row -->
		</div> <!-- wrapper -->

	</section> 
<?php endif; */?>
<!-- Services End -->

<!-- offer -->
<?php 
$services_active = absint(get_theme_mod('buziness_services_setting_activate',1));
	if($services_active == 1):
		$services_category = get_theme_mod( 'buziness_services_dropdown_categories');

		?>

	<section id="offers" class="section offers">
		<div class="wrapper">
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
			 <!-- one offer start -->
				<div class="col-3 offer" style="border-color: #8DC63F;">
					<div class="wow fadeInLeft title">
						<h2><?php the_title();?></h2>
					</div>
					<div class="wow fadeInRight offer_img ">
						<!-- <img src="http://localhost/sbdc/wp-content/uploads/2017/10/gardening-tool-icons-01-01.png"> -->
						 <?php $image_id = get_post_meta($post_id, '_post_image_icon_id', true);
							$image_url = wp_get_attachment_image_src( $image_id,'buziness_offer_image_size');
						// var_dump($image_url);
						if (!empty($image_url[0])) :
						?>
						<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute();?>">
					<?php endif ?>
					</div>
					<div class="wow fadeInRight description">
						<p><?php echo esc_attr(get_post_meta($post_id, '_excerpt', true ));?></p>
					</div>
					<?php 
						$color_hex = get_post_meta($post_id, '_post_icon_color_hex', true);
						if(empty($color_hex))
							$color_hex = "#000";
					?>
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
<!-- <section id="offers" class="section offers">
	<div class="wrapper">
		<div class="section_clear">
			<div class="col-3 offer" style="border-color: #8DC63F;">
				<div class="wow bounceInUp title">
					<h2>Growing a Business</h2>
				</div>
				<div class="offer_img">
					<img src="http://localhost/sbdc/wp-content/uploads/2017/10/gardening-tool-icons-01-01.png">
				</div>
				<div class="description">
					<p>Business is good, but not growing. How can you take it to the next level?</p>
				</div>
				<div class="button-container">
					<a onmouseenter="this.style.borderColor='#8DC63F'; this.style.backgroundColor='#8DC63F'; this.style.color='#ffffff';" 
						onmouseleave="this.style.borderColor='#8DC63F'; this.style.backgroundColor='transparent'; this.style.color='#8DC63F'"
						style="border-color: rgb(141, 198, 63); color: rgb(141, 198, 63); background-color: transparent;"
						class="button-block"
						href="" >Get Started</a>
				</div>
			</div>		
			<div class="col-3 offer" style="border-color: #c32031;">
				<div class="title wow fadeInLeft">
					<h2>Starting a Business</h2>
				</div>
				<div class="offer_img">
					<img src="http://localhost/sbdc/wp-content/uploads/2017/10/icon_starting_red.jpg">
				</div>
				<div class="description">
					<p>It’s official. You’ve decided to start your own business. But, now what?</p>
				</div>
				<div class="button-container">
					<a onmouseenter="this.style.borderColor='#c32031'; this.style.backgroundColor='#c32031'; this.style.color='#ffffff';" 
						onmouseleave="this.style.borderColor='#c32031'; this.style.backgroundColor='transparent'; this.style.color='#c32031'"
						style="border-color: rgb(195, 32, 49); color: rgb(195, 32, 49); background-color: transparent;"
						class="button-block"
						href="" >Get Started</a>
				</div>
			</div>		
			<div class="col-3 offer" style="border-color: #754A75";>
				<div class="title wow fadeInRight">
					<h2>Get Online Training</h2>
				</div>
				<div class="offer_img">
					<img src="http://localhost/sbdc/wp-content/uploads/2017/10/icon_training_purple.png">
				</div>
				<div class="description">
					<p>Ready to become more knowledgeable about operating your business?</p>
				</div>
				<div class="button-container">
					<a onmouseenter="this.style.borderColor='#754A75'; this.style.backgroundColor='#754A75'; this.style.color='#ffffff';" 
						onmouseleave="this.style.borderColor='#754A75'; this.style.backgroundColor='transparent'; this.style.color='#754A75'"
						style="border-color: rgb(66, 33, 66); color: rgb(66, 33, 66); background-color: transparent;"
						class="button-block"
						href="" >Get Started</a>
				</div>
			</div>		

		</div>
		<div class="section_clear">
			<div class="col-3 offer" style="border-color: #0099DD;">
				<div class="title wow fadeInUp">
					<h2>Government Contracting</h2>
				</div>
				<div class="offer_img">
					<img src="http://localhost/sbdc/wp-content/uploads/2017/10/icon_contract_blue-01.png">
				</div>
				<div class="description">
					<p>Looking for a way to find a dealing with the Government? Find out How!</p>
				</div>
				<div class="button-container">
					<a onmouseenter="this.style.borderColor='#0099DD'; this.style.backgroundColor='#0099DD'; this.style.color='#ffffff';" 
						onmouseleave="this.style.borderColor='#0099DD'; this.style.backgroundColor='transparent'; this.style.color='#0099DD'"
						style="border-color: rgb(00,153,221); color: rgb(00,153,221); background-color: transparent;"
						class="button-block"
						href="" >Get Started</a>
				</div>
			</div><div class="col-3 offer" style="border-color: #FBAC42;">
				<div class="title wow fadeInUp">
					<h2>Veteran Entrepreneurs Initiative</h2>
				</div>
				<div class="offer_img">
					<img src="http://localhost/sbdc/wp-content/uploads/2017/10/graduation-2-01-01.png">
				</div>
				<div class="description">
					<p>Are you Veteran Entreprenuer? Don't worry we have special training programs for Veterans</p>
				</div>
				<div class="button-container">
					<a onmouseenter="this.style.borderColor='#FBAC42'; this.style.backgroundColor='#FBAC42'; this.style.color='#ffffff';" 
						onmouseleave="this.style.borderColor='#FBAC42'; this.style.backgroundColor='transparent'; this.style.color='#FBAC42'"
						style="border-color: rgb(251,172,66); color: rgb(251,172,66); background-color: transparent;"
						class="button-block"
						href="" >Get Started</a>
				</div>
			</div>		
			<div class="col-3 offer" style="border-color: #c32031;">
				<div class="title wow fadeInRight">
					<h2>Women Entrepreneurs Initiative</h2>
				</div>
				<div class="offer_img">
					<img src="http://localhost/sbdc/wp-content/uploads/2017/10/icon_starting_red.jpg">
				</div>
				<div class="description">
					<p>Looking for creative and innovative professional development workshops? Look no more!</p>
				</div>
				<div class="button-container">
					<a onmouseenter="this.style.borderColor='#c32031'; this.style.backgroundColor='#c32031'; this.style.color='#ffffff';" 
						onmouseleave="this.style.borderColor='#c32031'; this.style.backgroundColor='transparent'; this.style.color='#c32031'"
						style="border-color: rgb(195, 32, 49); color: rgb(195, 32, 49); background-color: transparent;"
						class="button-block"
						href="" >Get Started</a>
				</div>
			</div>		
			
		</div>
	</div>	
</section> -->

<?php endif; ?>
<!-- offer end -->
<!-- Counter-Start -->
	<?php
		$Counter_active = absint(get_theme_mod('buziness_counter_activate',1));
		$Counter_title = get_theme_mod( 'buziness_counter_title', __( 'Title' , 'buziness') );
		$Counter_1 = buziness_counter_json_content(get_theme_mod('buziness_counter_1'));
		$Counter_2_active = absint(get_theme_mod('buziness_counter_row_2_activate',1));
		$Counter_2 = buziness_counter_json_content(get_theme_mod('buziness_counter_2'));
		$Counter_background = get_theme_mod('buziness_counter_background_image');
	?> 
	<div> <?php// echo "Counter ". $Counter_active; ?> </div>
	<div><?php //echo "Counter 1 -  ". $Counter_title; ?> </div>
	<div> <?php //echo "Counter 2 Active ". $Counter_2_active; ?> </div>
	<div> <?php //echo "Counter Url ". $Counter_background; ?> </div>

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
						do_action('buziness_counter_row', $Counter_1); 
						if (1 == $Counter_2_active) do_action('buziness_counter_row', $Counter_2);
	    			?>

				</div> <!-- container -->
			</div> <!-- counter-overlay -->
		</section>
	<?php endif;?>
<!-- Counter End -->


<!-- CTA-start -->

	<?php $CTA_active = absint(get_theme_mod('buziness_call_to_action_activate',1));
		$CTA_title = get_theme_mod( 'buziness_call_to_action_title', __( 'Title' , 'buziness') );
	?>
	<div><?php// echo "CTA ". $CTA_active ?></div>
	<div><?php// echo "CTA Title". $CTA_title?></div>
	
	<?php if($CTA_active == 1): ?>
		<section class="section cta">
			<div class="wrapper">
				<div class="cta-block wow zoomIn"> 

					<h2>We are here to help your business grow!</h2>
					<h2>Do you have an amazing business idea?</h2>
					<p>But don't know how to proceed with it?</p>  
					<p>Join Us Today and get a free counseling session!</p> 

					<h2>Do you want to start a new Business?</h2>
					<p>Develop your idea into a full fledged busniss with us.</p>  
					<p>Join Us Today and get a free counseling session!</p> 

					<h2>Think of an Idea? we provide you with tools to succeed!</h2>

					<h2>You have a Vision. We have the tools you need.</h2>
					<p>Our team will help you on every cycle of your Business' life.</p>
				</div>
					<div class="dtl wow zoomIn">
						<a href="#">Get Started</a>
					</div>
				<div class="clearfix"></div>
			</div>
		</section>
	<?php endif; ?>
<!-- Cta End -->
	<?php 
echo do_shortcode('[smartslider3 slider=4]');
?> 
	</div> <!-- main content section -->
 	
	
<?php
endif;
get_footer();