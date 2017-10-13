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
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

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
			'description' => esc_html__('Type title for services', 'business'),
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
			'description' => esc_html__('Type description for services', 'business'),
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
			'description' => esc_html__('Select category for services', 'business'),
			'section' => 'buziness_services_section',
			'settings' => 'buziness_services_dropdown_categories'
		));

	$wp_customize->add_setting('buziness_services_char_count',array(
		'default' => 20,
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control('buziness_services_char_count',
		array(
			'type' => 'number',
			'priority'=> 25,
			'label' => esc_html__('Number Of Charecter To Show','buziness'),
			'description' => esc_html__('Enter no. to limit post charecter', 'business'),
			'section' => 'buziness_services_section',
			'settings' => 'buziness_services_char_count'
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
			'description' => esc_html__('Type to change title', 'business'),
			'section' => 'buziness_call_to_action_1',
			'settings' => 'buziness_call_to_action_title'
		));

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

	$wp_customize->add_setting('buziness_counter_title',array(
		'priority' => 1,
		'default' => esc_html__('Title', 'buziness'),
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('buziness_counter_title',
		array(
			'type' => 'text',
			'label' => esc_html__('Counter title','buziness'),
			'description' => esc_html__('Type to change title', 'business'),
			'section' => 'buziness_counter_section',
			'settings' => 'buziness_counter_title'
		));

	$wp_customize->add_setting('buziness_counter_1',array(
		'priority' => 1,
		'default' => esc_html__('"title1": 0, "title2":0, "title3":0', 'buziness'),
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('buziness_counter_1',
		array(
			'type' => 'textarea',
			'label' => esc_html__('Counter Row 1','buziness'),
			'description' => esc_html__('Type to counter Text and number pairs in the form of => "title1": 0, "title2":0,"title3": 0', 'business'),
			'section' => 'buziness_counter_section',
			'settings' => 'buziness_counter_1'
		));


	$wp_customize->add_setting('buziness_counter_row_2_activate',array(
		'default' => 1,
		'priority' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'buziness_checkbox_sanitize',
	));

	$wp_customize->add_control('buziness_counter_row_2_activate',
		array(
			'type' => 'checkbox',
			'label' => esc_html__('Check to activate counter row 2','buziness'),
			'section' => 'buziness_counter_section',
			'settings' => 'buziness_counter_row_2_activate'
		));

	$wp_customize->add_setting('buziness_counter_2',array(
		'priority' => 1,
		'default' => esc_html__('"title1": 0, "title2":0, "title3":0 ', 'buziness'),
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('buziness_counter_2',
		array(
			'type' => 'textarea',
			'label' => esc_html__('Counter Row 2','buziness'),
			'description' => esc_html__('Type to counter Text and number pairs in the form of => "title1": 0, "title2":0,"title3": 0', 'business'),
			'section' => 'buziness_counter_section',
			'settings' => 'buziness_counter_2'
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

/*********************************************************************************************************************/
//singel Page option setting 
/*********************************************************************************************************************/

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
