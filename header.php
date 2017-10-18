<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buziness
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'buziness' ); ?></a>
	
		<header id="masthead" class="site-header" >
			<div class="main-header">
				<div class="site-branding">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) : ?>
						<!-- <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> -->
					<?php else : ?>
						<!-- <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p> -->
					<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<!-- <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p> -->
					<?php
					endif; ?>
				</div><!-- .site-branding -->
				<div class="navigation">

<!-- 					<div class="search-top">
							<div class="search-icon"><i class="fa fa-search"></i></div> 
							<form class="s-form" action="<?php echo site_url(); ?>" method="get" role="search"  id="searchform"> 
								<div class="search-form"> 
									<input type="text" id="" placeholder="<?php esc_attr_e( 'Search', 'buziness' ); ?>" value="<?php echo the_search_query(); ?>" name="s" >
								</div> 
							</form> 
						</div>  -->

					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php 
						// esc_html_e( 'Primary Menu', 'buziness' );  
						 // _e( '<i class="fa fa-navicon"></i>', 'buziness' );
						 echo '<div id="nav-icon"><span></span><span></span><span></span><span></span></div>'; 
						?></button>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							) );
						?>
					</nav><!-- #site-navigation -->
					<div id="bz-menu" class="bz-menuwrapper hide">
			        	<!-- <button class="bz-trigger" ><?php _e( '<i class="fa fa-navicon"></i>', 'buziness' ); ?></button> -->
			        			<?php wp_nav_menu( array( 
			        				'theme_location' => 'menu-1', 
			        				'container' => '', 
			        				'menu_id'        => 'primary-menu',
			        				'menu_class' => 'bz-menu' ) ); ?>  
			        </div>

				</div>
			</div>



			<!-- <div class="mobile-header">
				<div class="site-branding">
					<?php the_custom_logo(); ?>
				</div>
				<div id="bz-menu" class="bz-menuwrapper hide">
			       	<button class="bz-trigger" ><?php _e( '<i class="fa fa-navicon"></i>', 'buziness' ); ?></button>
			    		<?php wp_nav_menu( array( 
			        				'theme_location' => 'menu-1', 
			        				'container' => '', 
			        				'menu_class' => 'bz-menu' ) ); ?>  
			       </div>

			</div> -->
		</header><!-- #masthead -->
	<div id="content" class="site-content">
