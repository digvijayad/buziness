<?php
class Buziness_Color_Scheme {
	
	public function __construct() {    
        add_action( 'customize_register', array( $this, 'customizer_register' ) );
        add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_js' ) );
        add_action( 'customize_controls_print_footer_scripts', array( $this, 'color_scheme_template' ) );
        add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'output_css' ) );
    }

    public function customizer_register( WP_Customize_Manager $wp_customize ) {

    	$wp_customize->add_section( 'colors', array(
		    'title' => __( 'Colors', 'buziness' ),
		) );

    	$wp_customize->add_setting( 'color_scheme', array(
		    'default' => 'default',
		    'transport' => 'postMessage',
		    'sanitize_callback' => 'buziness_sanitize_select',
		) );
		$color_schemes = $this->get_color_schemes();
		$choices = array();
		foreach ( $color_schemes as $color_scheme => $value ) {
		    $choices[$color_scheme] = $value['label'];
		}
		$wp_customize->add_control( 'color_scheme', array(
		    'label'   => __( 'Color scheme', 'buziness' ),
		    'section' => 'colors',
		    'type'    => 'select',
		    'choices' => $choices,
		) );

		$options = array(
	    	'link_color' => __( 'Primary color', 'buziness' ),
		    'button_background_color' => __( 'Secondary color', 'buziness' ),
		    'button_hover_background_color' => __( 'Third color', 'buziness' ),
		);

		foreach ( $options as $key => $label ) {
		    $wp_customize->add_setting( $key, array(
		        'sanitize_callback' => 'sanitize_hex_color',
		        'transport' => 'postMessage',
		    ) );
		    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
		        'label' => $label,
		        'section' => 'colors',
		        'setting' => $key,
		    ) ) );
		}

    }

    public $options = array(
	    'link_color',
	    'button_background_color',
	    'button_hover_background_color',
	);

	public function get_css( $colors ) {

	$css = '.main-navigation #primary-menu.menu li.current_page_item, 
		.main-navigation #primary-menu.menu li.current-menu-ancestor,
		.main-navigation #primary-menu.menu li:hover,
		.entry-content a:hover{
			border-color: %1$s;
		}

		/*#f7c651*/
		.main-navigation #primary-menu.menu li ul li.current-menu-item,
		.main-navigation ul ul li:hover > a, 
		.main-navigation ul ul li.focus > a,
		.main-navigation ul ul a:hover,
		.main-navigation ul ul li.current_page_item > a,
		#nav-icon span,
		input[type="submit"],
		.counter-area .title h2:after,
		.entry-content a:hover,
		.entry-footer a,
		.nav-links a ,
		.footer-area-bottom, 
		h2.widget-title:after,
		.section.cta,
		.title h2:after,
		.main-navigation .menu-cta-button a,
		.owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span,
		#scrollUp {
			background-color: %1$s;
		}

		.owl-theme .owl-nav [class*="owl-"]:hover{

			background-color:  %1$s !important;
		}


		.main-navigation li:hover > a,
		.main-navigation li.focus > a,
		li:hover.menu-item-has-children:after,
		.main-navigation li.current_page_ancestor a, 
		.main-navigation .current_menu_ancestor a ,
		a:hover,
		input[type="submit"]:hover,
		.footer-area-top .contact-name,
		.footer-area-top .widget-resources a,
		.footer-area-top .contacts li i,
		.blog-block:hover .blog-desc h4 a,
		.widget ul li a:hover,
		.entry-meta span a:hover  {
			color: %1$s; 
		}
		.main-navigation .menu-cta-button a:hover,
		.blog-desc h4 a:hover {
			color: %1$s !important;
		}


		.main-navigation ul ul a,
		.widget_search .search-form input[type="search"],
		.main-navigation ul ul a:hover ,
		.main-navigation li.current_page_ancestor ul a,
		.main-navigation ul ul li.current_page_item > a ,
		.counter-area .title h2,
		.breadcrumb-title,
		.counter-number, .counter-prefix, 
		.counter-description,
		.cta-block h1, .cta-block p,
		.dtl a ,
		.footer-area-top .footer-box,
		.footer-area-top .widget-title,
		#scrollUp{
			color: %2$s;
		}

		.dtl a {
			border-color: %2$s;
		}

		.blog-desc h4 a:hover{
			background-color:%2$s;
		}

		.main-banner,
		.widget_search .search-form input[type="search"]{
			background: %2$s;
		}

		.widget_search .search-form input[type="search"] {

			border-color:  #eee;
		} 

		.main-navigation .menu-cta-button a:hover,
		#drop::before,#drop::after,
		input[type="submit"]:hover,
		.cta .dtl a:hover,
		#scrollUp:hover {
			background-color: %3$s;
		}
		 .main-navigation ul ul li:hover > a,
		  .main-navigation ul ul li.focus > a,
		.entry-footer a ,
		.nav-links a ,
		.entry-content a:hover,
		.footer-area-bottom,
		.footer-area-bottom a {
			color: %3$s;
		}


		.main-navigation a,
		.entry-content a,
		a ,
		.title h2 ,
		h2.widget-title {
			color: #555; 
		}

		.entry-content a{
			border-color: #555;
		}

		.offer .description p {
			color: #777;
		}

		.title p {
			color: #777;
		}

		.widget ul li a {
			color: #777;
		}

		.nav-menu li li.menu-item-has-children > a:after {
		 color: #222;
		 }

		.search-form span i:hover { 
			color: #3498db;
		}

		.widget_search .search-form input[placeholder] {
			color: #666;
		}

		.widget ul li {
			border-bottom-color: #ccc;
		}
		.footer-area-top{
			background-color: #000;
		}
		header.site-header {
			background-color: #fff;
		}

		.entry-title a {
		    color: #373b44;
		}
		.entry-title a:hover {
		    color: #73c8a9;
		}
		@media screen and (max-width: 990px){


			ul.submenu li.menu-item:hover,
			ul li.menu-item:hover{
				background: %1$s;
			}

			ul.submenu li.menu-item:hover > a, ul li.menu-item:hover > a{
				color: %3$s;
			}

			ul li.menu-item, .bz-menuwrapper ul li { 
				border-top-color:  #444; 
			}

			.bz-menuwrapper ul, ul.bz-menu{
				background: #000;
			}

			.bz-menuwrapper ul li a, li.menu-item a {
				color: #fff;
			}

		}';

	    // More CSS
	    return vsprintf( $css, $colors );
	}


    
	public function customize_js() {
	   wp_enqueue_script( 'induspress-color-scheme', get_template_directory_uri() . '/js/color-scheme.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '', true );
	   wp_localize_script( 'induspress-color-scheme', 'IndusPressColorScheme', $this->get_color_schemes() );
	}
	    
    public function color_scheme_template() {
	    $colors = array(
	        'link_color'                    => '{{ data.link_color }}',
	        'button_background_color'       => '{{ data.button_background_color }}',
	        'button_hover_background_color' => '{{ data.button_hover_background_color }}',
	    );
	    ?>
	    <script type="text/html" id="tmpl-induspress-color-scheme">
	        <?php echo $this->get_css( $colors ); ?>
	    </script>
	<?php
    }
    public function customize_preview_js() {
   		wp_enqueue_script( 'induspress-color-scheme-preview', get_template_directory_uri() . '/js/color-scheme-preview.js', array( 'customize-preview' ), '', true );

    }
    
    public function output_css() {
		$colors = $this->get_color_scheme();
		    if ( $this->is_custom ) {
		        wp_add_inline_style( 'buziness-colors', $this->get_css( $colors ) );
	    }
    }

    public $is_custom = false;
	public function get_color_scheme() {
	    $color_schemes = $this->get_color_schemes();
	    $color_scheme  = get_theme_mod( 'color_scheme' );
	    $color_scheme  = isset( $color_schemes[$color_scheme] ) ? $color_scheme : 'default';

	    if ( 'default' != $color_scheme ) {
	        $this->is_custom = true;
	    }

	    $colors = array_map( 'strtolower', $color_schemes[$color_scheme]['colors'] );

	    foreach ( $this->options as $k => $option ) {
	        $color = get_theme_mod( $option );
	        if ( $color && strtolower( $color ) != $colors[$k] ) {
	            $colors[$k] = $color;
	        }
	    }
	    return $colors;
	}

	public function get_color_schemes() {
	    return array(
	        'default' => array(
	            'label'  => __( 'Default', 'buziness' ),
	            'colors' => array(
	                '#f7c651',
	                '#fff',
	                '#000',
	            ),
	        ),
	        'pink' => array(
	            'label'  => __( 'Pink', 'buziness' ),
	            'colors' => array(
	                '#d11241',
	                '#ededed',
	                '#002d62',

	            ),
	        ),
	        'green' => array(
	            'label'  => __( 'Green', 'buziness' ),
	            'colors' => array(
	                '#22bd3c',
	                '#ededed',
	                '#002d62',

	            ),
	        ),
	        // Other color schemes
	    );
	}
}


