<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Buziness
 */
$post_feature_image = get_theme_mod('buziness_activate_featured_image', 1);

$layout_class = buziness_sidebar_layout_class();

?>
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
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title wow fadeInDown">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content wow fadeInUp">
					<?php if($post_feature_image == 1): 
					?>

					<div class="entry-content-img">
						<?php the_post_thumbnail(); ?>
					</div> 
				<?php endif ?>
				<?php
					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buziness' ),
						'after'  => '</div>',
					) );
				?>
				</div><!-- .entry-content -->

				<?php if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
							edit_post_link(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Edit <span class="screen-reader-text">%s</span>', 'buziness' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									get_the_title()
								),
								'<span class="edit-link">',
								'</span>'
							);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</article>
		</div> <!-- content-post -->

	</div> <!-- left-sidebar-content -->
	
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

<!-- #post-<?php the_ID(); ?> -->
