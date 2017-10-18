<?php 

 add_action( 'add_meta_boxes', 'buziness_add_custom_box' );
/**
 * Add Meta Boxes.
 */
function buziness_add_custom_box() {
    // Adding layout meta box for page
    add_meta_box( 
        'page-layout',
         esc_html__( 'Select Layout', 'buziness' ),
        'buziness_page_layout',
        'page',
        'normal',
        'default' );

     add_meta_box(
        'offer-post-excerpt',
        esc_html__( 'Excerpt', 'buziness'),
        'buziness_post_excerpt',
        'post',
        'normal',
        'default'
     );

     add_meta_box(
        'offerposticondiv',
        esc_html__('Services Image Icon', 'buziness'),
        'buziness_post_image_icon',
        'post',
        'side',
        'low'
     );
   }



/****************************************************************************************/

global $buziness_page_layout;
$allowed_html = buziness_expanded_alowed_tags();
$buziness_page_layout = array(
                           
            'left-sidebar'          => array(
                                            'id'            => 'buziness_page_layout',
                                            'value'         => 'right-content',
                                            'label'         => esc_html__( 'Left Sidebar', 'buziness' ),
                                            'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'
                                            ),
    
            'right-sidebar'        => array(
                                            'id'            => 'buziness_page_layout',
                                            'value'         => 'left-content',
                                            'label'         => buziness_textarea_sanitize( 'Right sidebar<br>(default)', array('br') ),
                                            'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'
                                            ),
            'no-sidebar-content-centered' => array(
                                            'id'            => 'buziness_page_layout',
                                            'value'         => 'content-middle-area',
                                            'label'         => esc_html__( 'Both Sidebar', 'buziness' ),
                                            'thumbnail' => get_template_directory_uri() . '/images/both-sidebar.png'
                                            ),
            'no-sidebar-full-width' => array(
                                            'id'            => 'buziness_page_layout',
                                            'value'         => 'content-full-area',
                                            'label'         => esc_html__( 'Full Width', 'buziness' ),
                                            'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png'
                                            )
            
        );

/************************************************************************************************************************************/

/**
 * Displays metabox to for select layout option
 */
function buziness_page_layout() {
    global $buziness_page_layout, $post;

    // Use nonce for verification
    wp_nonce_field( basename( __FILE__ ), 'buziness_page_layout_nonce' );
    ?>

    <table class="form-table">
    <tr>
    <td colspan="4"><em class="f13"><?php esc_html_e('Choose Sidebar Template', 'buziness' )?></em></td>
    </tr>

    <tr>
    <td>
<?php 
    foreach ($buziness_page_layout as $field) { 
        $layout_meta = get_post_meta( $post->ID, $field['id'], true );
        
        if( empty( $layout_meta ) ) { $layout_meta = 'left-content'; }
        ?>
            <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                <label class="description">
                <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr($field['label']); ?>" /></span></br>
                <input class="" type="radio" name="<?php echo esc_attr($field['id']); ?>" value="<?php echo esc_attr($field['value']); ?>" <?php checked( $field['value'], $layout_meta ); if(empty($layout_meta) && $field['value'] == 'left-content'){ checked('left-content','left-content'); } ?>&nbsp;<?php echo esc_attr($field['label']); ?>
                
                </label>
            </div>
        <?php
    }
    ?>
    </td></tr>
    </table>
    <?php 
}

/******************************************************************************************************************************/

// add_action('pre_post_update', 'buziness_save_custom_meta');
/**
 * save the custom metabox data
 * @hooked to pre_post_update hook
 */
// function buziness_save_custom_meta( $post_id ) {

//     global $buziness_page_layout, $post;
//     // Verify the nonce before proceeding.
//     // if ( !isset( $_POST[ 'buziness_page_layout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'buziness_page_layout_nonce' ], basename( __FILE__ ) ) )
//     // return;

//         // Stop WP from clearing custom fields on autosave
//         if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) 
//           return;

//         if ('page' == $_POST['post_type']) { 
//           if (!current_user_can( 'edit_page', $post_id ) ) 
//              return $post_id; 
//        }
//        elseif (!current_user_can( 'edit_post', $post_id ) ) { 
//           return $post_id;
//        }
//        if( isset( $_POST[ 'buziness_page_layout_nonce' ] ) && wp_verify_nonce( $_POST[ 'buziness_page_layout_nonce' ], basename( __FILE__ ) )  ? 'true' : 'false'){
//         foreach ($buziness_page_layout as $field) {
//             //Execute this saving function
//             $old = get_post_meta( $post_id, $field['id'], true);
//             $new = $_POST[$field['id']];
//             if ($new && $new != $old) {
//                 update_post_meta($post_id, $field['id'], $new);
//             } elseif ('' == $new && $old) {
//                 delete_post_meta($post_id, $field['id'], $old);
//             }
//         } // end foreach
//     }

    
// }

add_action('pre_post_update', 'buziness_theme_meta_save');
function buziness_theme_meta_save( $post_id ) {

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) 
        return;

    if ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) ){ 
        return $post_id; 
    }
    else if ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) ) { 
        return $post_id;
    }

    if( isset( $_POST[ 'buziness_custom_excerpt_nonce' ] ) && wp_verify_nonce( $_POST[ 'buziness_custom_excerpt_nonce' ], basename( __FILE__ ) )  ? 'true' : 'false' ){
        // Checks for input and sanitizes/saves if needed
        if( isset( $_POST[ 'custom_post_excerpt' ] ) ) {
            update_post_meta( $post_id, '_excerpt', sanitize_text_field( $_POST[ 'custom_post_excerpt' ] ) );
        }
    }

    if( isset( $_POST[ 'buziness_custom_image_icon_nonce' ] ) && wp_verify_nonce( $_POST[ 'buziness_custom_image_icon_nonce' ], basename( __FILE__ ) )  ? 'true' : 'false'){

        if( isset( $_POST['_post_icon_image'] ) ) {
            $image_id = (int) $_POST['_post_icon_image'];
            update_post_meta( $post_id, '_post_image_icon_id', $image_id );
        }

        // Checks for input and saves if needed
        if( isset( $_POST[ 'buziness_offer_icon_color' ] ) ) {
            update_post_meta( $post_id, '_post_icon_color_hex', sanitize_hex_color($_POST[ 'buziness_offer_icon_color' ] ) );
        }

    }

    global $buziness_page_layout;
    if( isset( $_POST[ 'buziness_page_layout_nonce' ] ) && wp_verify_nonce( $_POST[ 'buziness_page_layout_nonce' ], basename( __FILE__ ) )  ? 'true' : 'false'){

        foreach ( $buziness_page_layout as $field ) {
            //Execute this saving function
            $old = get_post_meta( $post_id, $field['id'], true);
            $new = $_POST[$field['id']];
            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        } // end foreach
    }
}
// add_action('save_post', 'buziness_save_post_excerpt');
/**
 * save the custom excerpt metabox data
 * @hooked to save_post hook
 */
// function buziness_save_post_excerpt($post_id) {
//     // Checks save status

//     $is_autosave = wp_is_post_autosave( $post_id );
//     // $is_revision = wp_is_post_revision( $post_id );
//     $is_valid_nonce = ( isset( $_POST[ 'buziness_custom_excerpt_nonce' ] ) && wp_verify_nonce( $_POST[ 'buziness_custom_excerpt_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
//     // Exits script depending on save status
//     if ( $is_autosave /*|| $is_revision */|| !$is_valid_nonce ) {
//         return;
//     }

//      // Check the user's permissions.
//     if ( isset( $_POST['post_type'] ) && 'post' == $_POST['post_type'] ) {

//         if ( ! current_user_can( 'edit_page', $post_id ) ) {
//             return;
//         }

//     }
//     else {

//         if ( ! current_user_can( 'edit_post', $post_id ) ) {
//             return;
//         }
//     }
//     // wp_die($_GET);
//     // Checks for input and sanitizes/saves if needed
//     if( isset( $_POST[ 'custom_post_excerpt' ] ) ) {
//         update_post_meta( $post_id, '_excerpt', sanitize_text_field( $_POST[ 'custom_post_excerpt' ] ) );
//     }
// }

/****************************************************************************************************************************************/

function buziness_post_excerpt($post){
    // Add a nonce field so we can check for it later
    // Use nonce for verification
    wp_nonce_field( basename( __FILE__ ) , 'buziness_custom_excerpt_nonce' );

    $value = get_post_meta($post->ID, '_excerpt', true );

    echo '<textarea style="width:100%" id="custom_post_excerpt" name="custom_post_excerpt">' . esc_attr( $value ) . '</textarea>';
    echo "<p>Excerpts are optional hand-crafted summaries of your content that can be used in your theme</p>";
}

/******************************************************************************************************************************************/

function buziness_post_image_icon($post){
    global $content_width, $_wp_additional_image_sizes;


    wp_nonce_field( basename( __FILE__ ) , 'buziness_custom_image_icon_nonce' );
    $image_id = get_post_meta( $post->ID, '_post_image_icon_id', true);
    $color_id = get_post_meta( $post->ID, '_post_icon_color_hex', true);

    $old_content_width = $content_width;
    $content_width = 200;


    if($image_id && get_post($image_id)) {

        if( !isset( $_wp_additional_image_sizes['buziness_offer_image_size'])) {
            $thumbnail_html = wp_get_attachment_image ($image_id, array( $content_width, $content_width) );
        } else {
            $thumbnail_html = wp_get_attachment_image( $image_id, 'buziness_offer_image_size' );
        }

        if( ! empty($thumbnail_html)) {
            $content = $thumbnail_html;
            $content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_icon_image_button" >' . esc_html__( 'Remove Icon image', 'buziness' ) . '</a></p>';
            $content .= '<input type="hidden" id="upload_icon_image" name="_post_icon_image" value="' . esc_attr( $image_id ) . '" />';

        }

        $content_width = $old_content_width;

    } else {

        $content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
        $content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set post icon image', 'buziness' ) . '" href="javascript:;" id="upload_icon_image_button" id="set-icon-image" data-uploader_title="' . esc_attr__( 'Choose an Icon image', 'buziness' ) . '" data-uploader_button_text="' . esc_attr__( 'Set post icon image', 'buziness' ) . '">' . esc_html__( 'Set post icon image', 'buziness' ) . '</a></p>';
        $content .= '<input type="hidden" id="upload_icon_image" name="_post_icon_image" value="" />';
    }

    // Add Color Picker
    $content .= '<table class="form-table">';
    $content .= '<tr> 
                    <td><label for="buziness_offer_icon_color" class="buziness_icon_color_label"><strong>'. __( 'Icon color', 'buziness' ). '</strong></label></td>
                    <td> <input name="buziness_offer_icon_color" id="buziness_offer_icon_color" type="text" value="'.( isset ( $color_id )? $color_id : '').'"';
    $content .= 'class="buziness_offer_icon_color" /> <p class="description">'. __("Select Front Page icon colors","buziness"). '</p></td> </tr>';
    $content .= '</table>';

    do_action('buziness_hide_meta_for_categories', array("Services","Setup"), 'offerposticondiv');
    
    echo $content;
}


// add_action('save_post', 'buziness_save_post_icon_image');
/**
 * save the custom excerpt metabox data
 * @hooked to save_post hook
 */
// function buziness_save_post_icon_image($post_id){

//     $is_autosave = wp_is_post_autosave( $post_id );
//     // $is_revision = wp_is_post_revision( $post_id );
//     $is_valid_nonce = ( isset( $_POST[ 'buziness_custom_image_icon_nonce' ] ) && wp_verify_nonce( $_POST[ 'buziness_custom_image_icon_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
//     // Exits script depending on save status
//     if ( $is_autosave|| !$is_valid_nonce ) {
//         return;
//     }

//      // Check the user's permissions.
//     if ( isset( $_POST['post_type'] ) && 'post' == $_POST['post_type'] ) {

//         if ( ! current_user_can( 'edit_page', $post_id ) ) {
//             return;
//         }

//     }
//     else {

//         if ( ! current_user_can( 'edit_post', $post_id ) ) {
//             return;
//         }
//     }
//     if( isset( $_POST['_post_icon_image'] ) ) {
//         $image_id = (int) $_POST['_post_icon_image'];
//         update_post_meta( $post_id, '_post_image_icon_id', $image_id );
//     }
// }


?>