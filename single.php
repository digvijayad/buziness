<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Buziness
 */

$post_banner_image = get_theme_mod('buziness_post_banner_image');

get_header(); 

if(!empty($post_banner_image)){
	$banner_image = $post_banner_image;
}
else {
	$banner_image = "http://localhost/sbdc/wp-content/uploads/2017/10/banner.jpg";
}
$post_comment = get_theme_mod('buziness_activate_post_activate_comment', 1);
$attachment_id = attachment_url_to_postid($banner_image);
$image_array = wp_get_attachment_image_src($attachment_id, 'buziness_banner_image_size');

$layout_class = buziness_sidebar_layout_class();

?>
<!-- Breadcrumb-start -->
		<section class="breadcrumb" <?php echo (!empty($image_array[0])) ? 'style="background: url(' . esc_url($image_array[0]) .');': ''; ?>">
<!-- <section class="breadcrumb" style="background: url( 'http://localhost/sbdc/wp-content/uploads/2017/10/banner.jpg' );"> -->
			<div class="wrapper">
				<div class="breadcrumb-menu">
					<div class="breadcrumb-title">
						<h2><?php the_title(); ?></h2>
					</div>
				</div>
			</div> 
		</section> 
<!-- Breadcrumb-end -->

		<div class="main-content">
			<div class="wrapper">
				<div class="content-page content-sep"> 	
					<div id="primary" class="content-area <?php echo esc_attr(buziness_sidebar_class($layout_class)); ?>">
						<main id="main" class="site-main">

							<div class="left-sidebar-content">
							<!-- Left Sidebar -->
							<?php if($layout_class == 'right-content' || $layout_class == 'content-middle-area') { ?>

								<aside id="secondary" class="widget-area left-sidebar" role="complementary">

									<?php if(is_active_sidebar('left-sidebar')){
										dynamic_sidebar('left-sidebar');
									}	?>
							
								</aside>
								<?php 
							} ?>

								<div class="content-post <?php echo esc_attr($layout_class)?>">
								<?php
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/content', get_post_type() );

									the_post_navigation();

									
									if( $post_comment == 1 ) : 
						            
										// If comments are open or we have at least one comment, load up the comment template.
										if ( comments_open() || get_comments_number() ) :
											comments_template();
										endif;
		
						         	endif; 

								endwhile; // End of the loop.
								?>
								</div>
							</div>
							<!-- Right Sidebar -->
						<?php  

						if ($layout_class == 'left-content' || $layout_class == 'content-middle-area') { ?>

							<aside id="secondary" class="widget-area right-sidebar" role="complementary">
								<?php 
									if(is_active_sidebar('right-sidebar')){
									dynamic_sidebar('right-sidebar');
									}
								?>
							</aside>
								<?php
						}

						?>

						</main><!-- #main -->
					</div><!-- #primary -->
                </div>
            </div>
        </div>
<?php
// get_sidebar();
get_footer();
