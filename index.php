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
$attachment_id = attachment_url_to_postid( $post_banner_image );
$image_array = wp_get_attachment_image_src( $attachment_id, 'buziness_banner_image_size' );

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


	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile; ?>

			<nav class="navigation post-navigation" role="navigation">
				<?php the_posts_navigation(); ?>
			</nav>
			<?php 
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
