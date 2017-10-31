<?php 


   // checkbox sanitization
   function buziness_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return '';
      }
   }
    //select sanitization function
	function buziness_sanitize_select( $input, $setting ){
	 
	    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
	    $input = sanitize_key($input);

	    //get the list of possible select options 
	    $choices = $setting->manager->get_control( $setting->id )->choices;
	                     
	    //return input if valid or return default option
	    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
	     
	}
 /** Sanitize textarea */ 
  function buziness_sanitize_textarea( $input ) {

  $buziness_allowedposttags = array(
    'a' => array(
        'href' => array(),
        'title' => array()
     ),

    'span' => array(
        'class' => array(),
        'id'    => array(),
        'style' => array(),
      ),

    'br' => array(),
    'em' => array(),
    'strong' => array(),
);
  
  $output = wp_kses_post( $input, $buziness_allowedposttags);
  return $output;
  }
  // add_filter( 'of_sanitize_textarea', 'buziness_sanitize_textarea' );


/** Sanitization google map */
  function buziness_sanitize_google_map( $input ) {

     $buziness_allowedposttags['iframe']=array(

      'align' => true,
      'width' => true,
      'height' => true,
      'frameborder' => true,
      'name' => true,
      'src' => true,
      'id' => true,
      'class' => true,
      'style' => true,
      'scrolling' => true,
      'marginwidth' => true,
      'marginheight' => true,

      );

  $output = wp_kses( $input, $buziness_allowedposttags);
  return $output;
  }
  //add_filter( 'of_sanitize_textarea', 'buziness_sanitize_textarea' );


  // Sanitize logo palcaement 

  function buziness_sanitize_logo_placement( $input ) {
    $valid = array(
        'left' => esc_html__('Left', 'buziness'),
        'right' => esc_html__('Right','buziness'),
        'center' => esc_html__('Center','buziness'),
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


/****************************************************************************************************************************/

//Single Post Layout

 function buziness_header_logo_sanitize( $input ) {
    $valid = array(
        'header_text_only' => esc_html__('Header Text Only', 'buziness'),
        'header_logo_only' => esc_html__('Header Logo Only', 'buziness'), 
        'show_both'        => esc_html__('Show Both','buziness'),
        'disable'          => esc_html__('Disable','buziness')
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}




 function buziness_woo_layout_sanitize( $input ) {
    $valid = array(
        'left_content'        => esc_html__('Right Sidebar','buziness'),
        'right_content'       => esc_html__('Left Sidebar','buziness'),
        'content_full_area'   => esc_html__('No Sidebar Full width','buziness'),
        'content_middle_area' => esc_html__('Both Sidebar Centered content','buziness')
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}



//Single Post Layout

 function buziness_page_post_layout_sanitize( $input ) {
    $valid = array(
        'left_content' => esc_html__('Right Sidebar','buziness'),
        'right_content' => esc_html__('Left Sidebar','buziness'),
        'content_full_area' => esc_html__('No Sidebar Full width','buziness'),
        'content_middle_area' => esc_html__('Both Sidebar Centered content','buziness')
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


/**********************************************************************************************************************************/

   //Number Sanitization
    function buziness_sanitize_number( $int ) {
      return absint( $int );
    } 

    //Email sanitization
    function buziness_sanitize_email( $email ) {
      if(is_email( $email )){
        return $email;
      }else{
        return '';
      }
    }

    // radio button sanitization
   function buziness_related_posts_sanitize($input) {
      $valid_keys = array(
         'categories' => esc_html__('Related Posts By Categories', 'buziness'),
         'tags' => esc_html__('Related Posts By Tags', 'buziness')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   //radio box sanitization function
      function buziness_sanitize_radio( $input, $setting ){
       
          //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
          $input = sanitize_key($input);

          //get the list of possible radio box options 
          $choices = $setting->manager->get_control( $setting->id )->choices;
                           
          //return input if valid or return default option
          return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
           
      }