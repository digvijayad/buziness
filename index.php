<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Buziness
 */

get_header(); 
$post_banner_image = get_theme_mod( 'buziness_page_banner_image' );

if(!empty($post_banner_image)){
	$banner_image = $post_banner_image;
}
else {
	$banner_image = "http://localhost/sbdc/wp-content/uploads/2017/10/banner.jpg";
}
$attachment_id = attachment_url_to_postid( $banner_image );
$image_array = wp_get_attachment_image_src( $attachment_id, 'buziness_banner_image_size' );

?>

		<!-- Breadcrumb-start -->
		
		<section class="breadcrumb" <?php echo (!empty($image_array[0])) ? 'style="background: url(' . esc_url($image_array[0]) .');': ''; ?>">
<!-- <section class="breadcrumb" style="background: url( 'http://localhost/sbdc/wp-content/uploads/2017/10/banner.jpg' );"> -->
			<div class="wrapper">
				<div class="breadcrumb-menu">
					<div class="breadcrumb-title">
						<h2 ><?php echo esc_html(get_bloginfo( 'site-title' )); ?></h2>
					</div>
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


		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" class="post"> 
	<header class="entry-header wow fadeInDown"> 

	<?php 

	$post_title = get_the_title();

	if ( $post_title ) : ?> 

		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>		
	
	<?php endif; 								
	?>	
	
		<div class="entry-meta">
		
			<span><i class="fa fa-calendar"></i><a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')));  ?>"><?php echo esc_attr(get_the_date());   ?></a></span>
		
			<span><i class="fa fa-user"></i><a href="<?php echo esc_url(get_the_author_link()); ?>"><?php the_author(); ?></a></span>
			<span><i class="fa fa-comment"></i><a href="<?php echo esc_url(get_comments_link()); ?>"><?php comments_number( __('no responses','buziness'), __('one response','buziness'), __('% responses','buziness') ); ?></a></span>
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
					<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php } ?>
				</div>

		<?php endif; ?>
				<p> <?php buziness_add_excerpt_length( apply_filters( 'buziness_service_excerpt_length', 100 ) );
                the_excerpt();
                buziness_remove_excerpt_length();
              ?> </p> 
				
				<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'buziness' ); ?></a> 
	</div> 
</article> 

								<?php endwhile; ?> 

			<nav class="navigation post-navigation" role="navigation">
				<?php the_posts_navigation(); ?>
			</nav>
			<?php 
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

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
// get_sidebar();
get_footer();
