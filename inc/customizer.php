<?php
/**
 * Buziness Theme Customizer
 *
 * @package Buziness
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function buziness_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_setting( 'header_textcolor' );
	// $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'buziness_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'buziness_customize_partial_blogdescription',
		) );

	}

	  //Titles
    class Buziness_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top:30px;border:1px solid;padding:5px;color:#58719E;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    } 

	$buziness_options_categories = array();
    $buziness_options_categories_obj = get_categories();
    $buziness_options_categories[''] =  esc_html__('Select Category:', 'buziness');
    
    foreach ($buziness_options_categories_obj as $category) {
        $buziness_options_categories[absint($category->cat_ID)] = esc_attr($category->cat_name); 
    }


	/** Front page panel start */
	$wp_customize->add_panel( 'buziness_custom_frontpage_panel', array(
		'title' => esc_html__( 'Front page settings' , 'buziness'),
		'description' => esc_html__( 'Change Front page settings from here you want', 'buziness' ),
		'priority' => 10,
		'capability' => 'edit_theme_options',
		));

// Services Section Start

	$wp_customize->add_section('buziness_services_section', array(
		'title' 		=> esc_html__('Services Settings', 'buziness'),
		'panel'			=> 'buziness_custom_frontpage_panel',
		'priority'		=> 10,
	));

	$wp_customize->add_setting('buziness_services_setting_activate', array(
		'default'           => 1,
		'priority'			=> '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'buziness_checkbox_sanitize',
		));

	$wp_customize->add_control('buziness_services_setting_activate', array(
		'type'      => 'checkbox',
		'label'     => esc_html__('Check To Activate Services', 'buziness'),
		'section'   => 'buziness_services_section',
		'settings'  => 'buziness_services_setting_activate'
		));

	$wp_customize->add_setting('buziness_services_title',array(
		'default' => esc_html__('Title', 'buziness'),
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('buziness_services_title',
		array(
			'type' => 'text',
			'label' => esc_html__('Services title','buziness'),
			'description' => esc_html__('Type title for services', 'buziness'),
			'section' => 'buziness_services_section',
			'settings' => 'buziness_services_title'
		));

	$wp_customize->add_setting('buziness_services_desc',array(
		'default' => esc_html__('Description', 'buziness'),
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'buziness_sanitize_textarea',
	));

	$wp_customize->add_control('buziness_services_desc',
		array(
			'type' => 'textarea',
			'label' => esc_html__('Services Description','buziness'),
			'description' => esc_html__('Type description for services', 'buziness'),
			'section' => 'buziness_services_section',
			'settings' => 'buziness_services_desc'
		));

	$wp_customize->add_setting('buziness_services_dropdown_categories',array(
		// 'default' => esc_html__('Description', 'buziness'),

		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('buziness_services_dropdown_categories',
		array(
			'type' => 'select',
			'choices'=> $buziness_options_categories,
			'priority'=> 20,
			'label' => esc_html__('Services Categories','buziness'),
			'description' => esc_html__('Select category for services', 'buziness'),
			'section' => 'buziness_services_section',
			'settings' => 'buziness_services_dropdown_categories'
		));



/*Call to action Section Start*/
	$wp_customize->add_section('buziness_call_to_action_1', array(
		'title' 	=> esc_html__('Call To Action Setting', 'buziness'),
		'panel'	=> 'buziness_custom_frontpage_panel',
		'priority' => 300,
		));

	$wp_customize->add_setting('buziness_call_to_action_activate',array(
		'default' => 1,
		'priority' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'buziness_checkbox_sanitize',
	));

	$wp_customize->add_control('buziness_call_to_action_activate',
		array(
			'type' => 'checkbox',
			'label' => esc_html__('Check to activate call to action area','buziness'),
			'section' => 'buziness_call_to_action_1',
			'settings' => 'buziness_call_to_action_activate'
		));
	
	$wp_customize->add_setting('buziness_call_to_action_title',array(
		'priority' => 1,
		'default' => esc_html__('Title', 'buziness'),
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('buziness_call_to_action_title',
		array(
			'type' => 'text',
			'label' => esc_html__('Call to action title','buziness'),
			'description' => esc_html__('Type to change title', 'buziness'),
			'section' => 'buziness_call_to_action_1',
			'settings' => 'buziness_call_to_action_title'
		));

	$wp_customize->add_setting('buziness_call_to_action_desc',array(
		'type' => 'option',
		'default' => esc_html__('Description', 'buziness'),
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'buziness_sanitize_textarea',
	));

	$wp_customize->add_control('buziness_call_to_action_desc',
		array(
			'type' => 'textarea',
			'label' => esc_html__('CTA Description','buziness'),
			'description' => esc_html__('Type description for CTA', 'buziness'),
			'section' => 'buziness_call_to_action_1',
			'settings' => 'buziness_call_to_action_desc'
		));
	// $wp_customize->add_setting('buziness_call_to_action_bgcolor',array(
	// 	'default' => '#000',
	// 	'sanitize_callback' => 'sanitize_hex_color'
	// ));

	// $wp_customize->add_control( 
	// 	new WP_Customize_Color_Control( 
	// 		$wp_customize, 
	// 		'buziness_call_to_action_bgcolor', 
	// 		array(
	// 			'label'      => __( 'CTA Background Color', 'buziness' ),
	// 			'section'    => 'buziness_call_to_action_1',
	// 			'settings'   => 'buziness_call_to_action_bgcolor',
	// 		) ) 
	// );

	/*Counter Section Start*/
	$wp_customize->add_section('buziness_counter_section', array(
		'title' 	=> esc_html__('Counter Setting', 'buziness'),
		'panel'	=> 'buziness_custom_frontpage_panel',
		'priority' => 340,
		));

	$wp_customize->add_setting('buziness_counter_activate',array(
		'default' => 1,
		'priority' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'buziness_checkbox_sanitize',
	));

	$wp_customize->add_control('buziness_counter_activate',
		array(
			'type' => 'checkbox',
			'label' => esc_html__('Check to activate counter area','buziness'),
			'section' => 'buziness_counter_section',
			'settings' => 'buziness_counter_activate'
		));



	$wp_customize->add_setting('buziness_counter_1',array(
		'priority' => 1,
		'default' => esc_html__('Businesses Created | 237

Jobs Created | 324', 'buziness'),
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'buziness_sanitize_textarea',
	));

	$wp_customize->add_control('buziness_counter_1',
		array(
			'type' => 'textarea',
			'label' => esc_html__('Counter Area','buziness'),
			'description' => esc_html__('Counter Text and number pairs in the form of: TITLE | 333 
				, Separate each counter by entering the next one on a new line.', 'buziness'),
			'section' => 'buziness_counter_section',
			'settings' => 'buziness_counter_1'
		));

    $wp_customize -> add_setting( 'buziness_counter_background_image', 
         array(
            'priority' => 5,
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw'
         ) );
    $wp_customize -> add_control( new WP_Customize_Image_Control( $wp_customize, 'buziness_counter_background_image' ,
         array(
           'type' => 'image',
           'label' => esc_html__( 'Background Image' , 'buziness'),
           'description' => esc_html__('Upload image for background', 'buziness'),
           'section' => 'buziness_counter_section',
           'setting' => 'buziness_counter_background_image'
          )));
		  


/*********************************************************************************************************************/
 //Layout Option
/**********************************************************************************************************************/

	//Theme Options Panel
    $wp_customize->add_panel( 'buziness_theme_option_panel' ,array(
         'title' => esc_html__( 'Theme options' , 'buziness'),
         'description' => esc_html__( 'Customize your theme option', 'buziness' ),
         'priority' => 9,
         'capability' => 'edit_theme_options'
    ));

    $wp_customize->add_section('buziness_default_layout_setting', array(
	    'priority' => 3,
	    'title' => esc_html__('Layout Option', 'buziness'),
	    'panel'=> 'buziness_theme_option_panel'
  ));
    $wp_customize->add_section('buziness_footer_setting', array(
	    'priority' => 3,
	    'title' => esc_html__('Footer Options', 'buziness'),
	    'panel'=> 'buziness_theme_option_panel'
  ));

/*********************************************************************************************************************/
//Footer 
/*********************************************************************************************************************/

    $wp_customize->add_setting('buziness_copyright_setting',array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('buziness_copyright_setting',
		array(
			'type' => 'text',
			'label' => esc_html__('Copyright','buziness'),
			'description' => esc_html__('Enter Copyright info', 'buziness'),
			'section' => 'buziness_footer_setting',
			'settings' => 'buziness_copyright_setting'
		));
/*********************************************************************************************************************/
//singel Page option setting 
/*********************************************************************************************************************/
 $wp_customize->add_setting('buziness_page_layout_info', array(
      'default' => 0,
      'priority' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esc_attr'
      ));

  $wp_customize->add_control( new Buziness_Info( $wp_customize, 'buziness_page_layout_info', array(
    'label' => esc_html__('Page Layout', 'buziness'),
    'section' => 'buziness_default_layout_setting',
    'settings' => 'buziness_page_layout_info',      
  )));
    $wp_customize -> add_setting( 'buziness_page_banner_image', 
         array(
            'priority' => 5,
            'default-image' => get_template_directory_uri() . '/images/banner.jpg',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw'
         ) );
    $wp_customize -> add_control( new WP_Customize_Image_Control( $wp_customize, 'buziness_page_banner_image' ,
         array(
           'type' => 'image',
           'label' => esc_html__( 'Page banner image' , 'buziness'),
           'description' => esc_html__('Upload image for page Banner', 'buziness'),
           'section' => 'buziness_default_layout_setting',
           'setting' => 'buziness_page_banner_image'
          )));
    	
    $wp_customize -> add_setting('buziness_activate_featured_image', array(
    		'default' => 1,
    		'priority' => '',
    		'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'buziness_checkbox_sanitize'
    	));
    $wp_customize->add_control('buziness_activate_featured_image', array(
        'type' => 'checkbox',
        'label' => esc_html__('Display featured image', 'buziness'),
        'section' => 'buziness_default_layout_setting',
        'settings' => 'buziness_activate_featured_image',      
      ));

/***********************************************************************************************************/
  //Post option setting
/***********************************************************************************************************/
 $wp_customize->add_setting('buziness_post_layout_info', array(
      'default' => 0,
      'priority' => '',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esc_attr'
      ));

  $wp_customize->add_control( new Buziness_Info( $wp_customize, 'buziness_post_layout_info', array(
    'label' => esc_html__('Post Layout', 'buziness'),
    'section' => 'buziness_default_layout_setting',
    'settings' => 'buziness_post_layout_info',      
  )));
$wp_customize -> add_setting( 'buziness_post_banner_image', 
         array(
            'priority' => 7,
            'default-image' => get_template_directory_uri() . '/images/banner.jpg',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw'
         ) );
$wp_customize -> add_control( new WP_Customize_Image_Control( $wp_customize, 'buziness_post_banner_image' ,
     array(
       'type' => 'image',
       'label' => esc_html__( 'Post banner image' , 'buziness'),
       'description' => esc_html__('Upload image for post Banner', 'buziness'),
       'section' => 'buziness_default_layout_setting',
       'setting' => 'buziness_post_banner_image'
      )));
	
$wp_customize -> add_setting('buziness_activate_post_featured_image', array(
		'default' => 1,
		'priority' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'buziness_checkbox_sanitize'
	));
$wp_customize->add_control('buziness_activate_post_featured_image', array(
    'type' => 'checkbox',
    'label' => esc_html__('Display featured image', 'buziness'),
    'section' => 'buziness_default_layout_setting',
    'settings' => 'buziness_activate_post_featured_image',      
  ));
$wp_customize -> add_setting('buziness_activate_post_activate_comment', array(
		'default' => 1,
		'priority' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'buziness_checkbox_sanitize'
	));
$wp_customize->add_control('buziness_activate_post_activate_comment', array(
    'type' => 'checkbox',
    'label' => esc_html__('Display Post Comments', 'buziness'),
    'section' => 'buziness_default_layout_setting',
    'settings' => 'buziness_activate_post_activate_comment',      
  ));

$wp_customize->add_setting('buziness_single_post_layout', array(
        'default' => 'left_content',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'buziness_page_post_layout_sanitize'
      ));

$wp_customize->add_control( 'buziness_single_post_layout', array(
        'type' => 'radio',
        'label' => esc_html__('Layout for Single Post', 'buziness'),
        'section' => 'buziness_default_layout_setting',
        'settings' => 'buziness_single_post_layout',
        'choices' => array(
          'left_content' => esc_html__('Right Sidebar','buziness'),
          'right_content' => esc_html__('Left Sidebar','buziness'),
          'content_full_area' => esc_html__('No Sidebar Full width','buziness'),
          'content_middle_area' => esc_html__('Both Sidebar Centered content','buziness')
        )
      ));

/***********************************************************************************************************/
  //Header
/*********************************************************************************************************/

	$wp_customize->add_section('buziness_slider_section', array(
		'title' 		=> esc_html__('Slider Settings', 'buziness'),
		'panel'			=> 'buziness_custom_frontpage_panel',
		'priority'		=> 1,
	));
	$wp_customize->add_setting('buziness_slider_shortcode',array(
		'priority' => 1,
		'default' => esc_html__('', 'buziness'),
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('buziness_slider_shortcode',
		array(
			'type' => 'text',
			'label' => esc_html__('Slider Short Code','buziness'),
			'description' => esc_html__('Enter the shortcode for a slider', 'buziness'),
			'section' => 'buziness_slider_section',
			'settings' => 'buziness_slider_shortcode'
		));

	$wp_customize->add_section('buziness_testimonials_section', array(
		'title' 		=> esc_html__('Testimonial Settings', 'buziness'),
		'panel'			=> 'buziness_custom_frontpage_panel',
		'priority'		=> 1,
	));
	$wp_customize->add_setting('buziness_testimonial_shortcode',array(

		'default' => esc_html__('', 'buziness'),
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('buziness_testimonial_shortcode',
		array(
			'type' => 'text',
			'label' => esc_html__('Testimonial Shortcode','buziness'),
			'description' => esc_html__('Enter the shortcode for testimonials', 'buziness'),
			'section' => 'buziness_testimonials_section',
			'settings' => 'buziness_testimonial_shortcode'
		));
	$wp_customize->remove_section('header_image');
    // sanitization works
		require get_template_directory() . '/inc/customizer-helper.php';

}
add_action( 'customize_register', 'buziness_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function buziness_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function buziness_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function buziness_customize_preview_js() {
	wp_enqueue_script( 'buziness-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'buziness_customize_preview_js' );
