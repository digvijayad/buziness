<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Buziness
 */

$post_feature_image = get_theme_mod('buziness_activate_post_featured_image', 1);

$layout_class = buziness_sidebar_layout_class();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header wow fadeInDown">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php buziness_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content wow fadeInUp">
		<?php if( $post_feature_image == 1 ) : 
					?>

			<div class="entry-content-img"> 
						
				<?php the_post_thumbnail(); ?>
					<?php //endif; ?>
			</div>
		<?php endif; ?>
		<?php 
		if( is_single() ) {
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'buziness' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
		}else {
			?>
                       <p>
                       <?php
					 buziness_add_excerpt_length( apply_filters( 'buziness_service_excerpt_length', 100 ) );
                        the_excerpt();
                    buziness_remove_excerpt_length();
                                                  ?> 
                        </p> 
							
						<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'buziness' ); ?></a> 
                                                    <?php 
		}
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buziness' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php buziness_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
