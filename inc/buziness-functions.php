<?php 

function buziness_counter_json_content($json_content)
{
	return '{' . $json_content . '}';
}

function buziness_counter_row_html($counter)
{
	?><div class="counter-row">

<?php 
	$json_obj = json_decode($counter, true);
	
	if($json_obj !== null  && json_last_error() === JSON_ERROR_NONE) :
		$i = 0;
		foreach($json_obj as $key => $val) : ?>
		    <div id="buziness_counter" class="counter col-3">
				<span class="counter-number"><?php echo $val ?> </span>
				<span class="counter-description"><?php echo $key ?> </span>
			</div>
<?php   	if(++$i == 3) break;
	    endforeach;

	endif;
	?> </div> <?php
}

add_action('buziness_counter_row', 'buziness_counter_row_html', 10, 1);

function buziness_banner()
{
	?>
	<div class="main-banner">
		<div class="banner" style="background-image: url(<?php echo( get_header_image()); ?>" >
			<div class="parallax-overlay"></div>
 			<div style="
			    /*background-image: url(http://localhost/sbdc/wp-content/uploads/2017/09/pexels-photo-331990-1920x1287-1.jpeg);*/
			    /*background-image: url(<?php echo( get_header_image()); ?>);*/
/*			    background-attachment: fixed;
			    background-position: top;
			    background-repeat: no-repeat;
			    background-size: cover;
			    width: 100vw;*/
			    /*top: 20px;*/
			    /*height: 120vh;*/
			    ">
			    	
			 </div> 
			<!-- <figure> -->
				<!-- <img src="<?php echo(get_header_image() ); ?>" alt="<?php echo( get_bloginfo( 'title' ) );?>" > -->
				 <!-- <img src="https://images.unsplash.com/photo-1494707924465-e1426acb48cb" max-height: 400px; width:100% > -->
				 <!-- <img src="http://localhost/sbdc/wp-content/uploads/2017/09/pexels-photo-331990-1920x1287-1.jpeg"> -->
				 <!-- <img src="http://localhost/sbdc/wp-content/uploads/2017/09/business-model-woman-message-1920x1287-1.jpg"> -->
				 <!-- <img src="http://localhost/sbdc/wp-content/uploads/2017/09/Photo-by-Mike-Petrucci-on-Unsplash-1.jpg">  -->
				 <!-- <img src="http://localhost/sbdc/wp-content/uploads/2017/09/dark_open1920-1.jpg"> -->
			<!-- </figure>  -->
			<div class="banner-caption-wrapper clearfix">
				<div class="container">
					<h1 class="caption-title">YOU HAVE A <span style="color: #ffce58;">VISION.</span> WE HAVE THE TOOLS YOU NEED.</h1>
					<div class="caption-desc">
						<h3>Our team will help you on every cycle of your Businessess life.</h3>		
					</div>
					<div class="caption-button">
						<a href="#">JOIN TODAY FOR FREE COUNCELING!</a>
					</div>
				</div>
			</div> <!-- banner-caption-wrappre -->
		</div> <!-- banner -->
		<div class="dropdown"><a class="dropdown-icon" href="#main-content-section"><i class="fa fa-angle-down"></i></a></div>
	</div><!-- main-banner -->

	<?php
}
add_action('buziness_main_banner', 'buziness_banner');

function buziness_header_image()
{ ?>
			<div class="header-base">
			<div class="background-text">
				<h1>YOU HAVE A <span style="color: #ffce58;">VISION.</span> WE HAVE THE TOOLS YOU NEED.</h1>
				<h3>Our team will help you on every cycle of your Businessess life.</h3>
				<div class="background-button wow zoomIn">
					<a href="#">JOIN TODAY FOR FREE COUNCELING!</a>
				</div>
				<!-- <h2>Alabama State Unversity Small Business Development Center</h2>
				<h3>Commited to Helping small business grow!</h3> -->
			</div>
			<!-- <img src="http://localhost/sbdc/wp-content/uploads/2017/09/coba_sl_030311_025.jpg" width=100%> -->
			<div class="header-image">
				<!-- <img src="https://images.unsplash.com/photo-1494707924465-e1426acb48cb" max-height: 400px; width:100% > -->
				<!-- <img src="http://localhost/sbdc/wp-content/uploads/2017/09/dark_open1920-1.jpg"> -->
				<!-- <img src="http://localhost/sbdc/wp-content/uploads/2017/09/Photo-by-Mike-Petrucci-on-Unsplash-1.jpg"> -->
				<!-- <img src="http://localhost/sbdc/wp-content/uploads/2017/09/business-model-woman-message-1920x1287-1.jpg"> -->
				<img src="http://localhost/sbdc/wp-content/uploads/2017/09/pexels-photo-331990-1920x1287-1.jpeg">
				
				<!-- dpr=1&auto=format&fit=crop&w=1500&h=1001&q=80&cs=tinysrgb&crop= -->
					
			</div>
		</div>
		<?php
}

add_action('buziness_main_header_image', 'buziness_header_image');

/**
 * Get first paragraph from a WordPress post. Use inside the Loop.
 *
 * @return string
 */
function get_first_paragraph(){
	global $post;
	
	$str = wpautop( the_content() );
	$str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
	$str = strip_tags($str, '<a><strong><em>');
	return '<p>' . $str . '</p>';
}



/*************************************************************************************************************************/
/*Sidebar layout function start */
/*************************************************************************************************************************/

//main content area                          

/****************************************************************************************/

//add_filter( 'body_class', 'buziness_sidebar_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function buziness_sidebar_layout_class() {
  
  global $post;

  if( $post ) { $layout_meta = get_post_meta( $post->ID, 'buziness_page_layout', true ); }
 

  if( is_home() ) {
    $queried_id = get_option( 'page_for_posts' );
    $layout_meta = get_post_meta( $queried_id, 'buziness_page_layout', true );
    $classes = 'left-content';
    
  }
  else{
    $layout_meta = 'left_content';
  }


  if( empty( $layout_meta ) || is_archive() || is_search() || is_single() || is_page() ) { $layout_meta = 'default_layout'; }

  if(  $layout_meta == 'default_layout' ) {
    if( is_page() ) {
      $page_layout = get_post_meta($post->ID, 'buziness_page_layout', true);
      
//var_dump($page_layout);
      if( $page_layout == 'left-content' ) { $classes = 'left-content'; }
      elseif( $page_layout == 'right-content' ) { $classes = 'right-content'; }
      elseif( $page_layout == 'content-full-area' ) { $classes = 'content-full-area'; }
      elseif( $page_layout == 'content-middle-area' ) { $classes = 'content-middle-area'; }
      elseif( $page_layout == '' ){
        $classes = 'left-content';
      }
      else
      {
        $classes = 'left-content';
      }
    }

    elseif( class_exists( 'WooCommerce' )  && ( is_product() || is_shop() || is_product_tag() || is_product_category() || is_product_taxonomy() ) ) { 
    $buziness_woo_layout = get_theme_mod( 'buziness_woocommerce_layout', 'right_content' );
    
    if( $buziness_woo_layout == 'left_content' ) { $classes = 'left-content'; }
    elseif( $buziness_woo_layout == 'right_content' ) { $classes = 'right-content'; }
    elseif( $buziness_woo_layout == 'content_full_area' ) { $classes = 'content-full-area'; }
    elseif( $buziness_woo_layout == 'content_middle_area' ) { $classes = 'content-middle-area'; }
    else
    {
        $classes = 'left-content';
    }

    }

    elseif( is_archive() ) {
      $buziness_archive_page_layout = get_theme_mod( 'buziness_archive_page_layout', 'right_content');

      if( $buziness_archive_page_layout == 'left_content' ) { $classes = 'left-content'; }
      elseif( $buziness_archive_page_layout == 'right_content' ) { $classes = 'right-content'; }
      elseif( $buziness_archive_page_layout == 'content_full_area' ) { $classes = 'content-full-area'; }
      elseif( $buziness_archive_page_layout == 'content_middle_area' ) { $classes = 'content-middle-area'; }
      else{  $classes = 'left-content'; }
    }
    elseif( is_single() ) {
     $buziness_single_post_layout = get_theme_mod( 'buziness_single_post_layout', 'right_content' );

      if( $buziness_single_post_layout == 'left_content' ) { $classes = 'left-content'; }
      elseif( $buziness_single_post_layout == 'right_content' ) { $classes = 'right-content'; }
      elseif( $buziness_single_post_layout == 'content_full_area' ) { $classes = 'content-full-area'; }
      elseif( $buziness_single_post_layout == 'content_middle_area' ) { $classes = 'content-middle-area'; }
      else{ $classes = 'left-content'; }
    }

    elseif( is_search() ) { 
    $buziness_search_page_layout = get_theme_mod( 'buziness_search_page_layout', 'right_content' );

    if( $buziness_search_page_layout == 'left_content' ) { $classes = 'left-content'; }
    elseif( $buziness_search_page_layout == 'right_content' ) { $classes = 'right-content'; }
    elseif( $buziness_search_page_layout == 'content_full_area' ) { $classes = 'content-full-area'; }
    elseif( $buziness_search_page_layout == 'content_middle_area' ) { $classes = 'content-middle-area'; }
    else{ $classes = 'left-content'; }

    }
    
  }

  elseif( $layout_meta == 'left-content' ) { $classes = 'left-content'; }
  elseif( $layout_meta == 'right-content' ) { $classes = 'right-content'; }
  elseif( $layout_meta == 'content-full-area' ) { $classes = 'content-full-area'; }
  elseif( $layout_meta == 'content-middle-area' ) { $classes = 'content-middle-area'; }
  else
  {
    $classes = '';
  }


  return $classes;
  
}

/****************************************************************************************/

if ( ! function_exists( 'buziness_sidebar_select' ) ) :
/**
 * Function to select the sidebar
 */
function buziness_sidebar_select() {
  global $post;

  if( $buziness_post ) { $layout_meta = get_post_meta( $post->ID, 'buziness_page_layout', true ); }

  if( is_home() ) {
    $queried_id = get_option( 'page_for_posts' );
    $layout_meta = get_post_meta( $queried_id, 'buziness_page_layout', true );
  }


  elseif( $layout_meta == 'right_sidebar' ) { get_sidebar(); }
  elseif( $layout_meta == 'left_sidebar' ) { get_sidebar( 'left' ); }
}
endif;

/****************************************************************************************/
/****************************************************************************************/


/****************************************************************************************/
//layout sidebar function
/****************************************************************************************/

function buziness_sidebar_class( $layout_class ) {

  if( $layout_class == 'right-content' ) {
            $sidebar = 'left-sb';
        } 
        elseif( $layout_class == 'content-full-area' ) {
            $sidebar = 'full-con';
          }
          elseif(is_search()){
              
              $sidebar = 'search-sb';
            
          }
        else{
            $sidebar = '';
          }

         return  $sidebar;
}

/**
 * Get Category Id by name function
 *
 * @return string
 */
function buziness_get_category_id_by_name($cat_name){
    $term = get_term_by('name', $cat_name, 'category');
    return $term->term_id;
}


add_action('buziness_hide_meta_for_categories', 'buziness_hide_metabox', 10, 2 );
/**
 * Add custom action hook 
 *
 * Do the custom hide_metabox action hook with parameters.
 * 
 * @method custom_function function() use($content) contains the echo of the content(javascript)
 *
 * @param $cat_name     array       array of category names
 * @param $div_id       string      id of the div element.
 */
function buziness_hide_metabox($cat_names, $div_id){
    global $post;

    // check if the metabox is for the correct post_type
    if('post' != $post->post_type)
        return;

    //array to store category ids
    $args = array();

    // loop through each category names and get the id.
    foreach ($cat_names as $cat_name) {
        $args[] = buziness_get_category_id_by_name($cat_name);
    }

    // call the function that contains the JQuery for hiding elements
    $custom_function= buziness_hide_metabox_on_categories($div_id,$args);

    //Add the javascript from the function to the footer of the admin menu.
    add_action('admin_footer', $custom_function);
}

/**
 * Show/Hide Metabox (or any other div ) for only Specific Categories.  
 *
 * hide_metabox action with arguments.
 * 
 * Version 1.1 : added dynamic div_id and category parameteres and break from each() loop
 * after the first category is found. 
 * 
 * @param $cat_name     array       array of category names
 * @param $div_id       string      id of the div element.
 * @author Dimas Begunoff
 * @link https://www.youtube.com/watch?v=hv1o6NrINu8&t=2s to Original
 * 
 * @since Version 1.1
 * 
 */
function buziness_hide_metabox_on_categories($div_id,$args){

    $content = '<script type="text/javascript">';
    $content .='    jQuery(document).ready(function($) {';
    $content .='        function buziness_hide_metabox_js(){';
    $content .='            $("#'.$div_id.'").hide();';
    $content .="            $('#categorychecklist input[type=".'"checkbox"]'."'".').each(function(i,e){';
    $content .='                var id = $(this).attr("id").match(/-([0-9]*)$/i);';
    $content .='                id = (id && id[1]) ? parseInt(id[1]) : null ;';
    $content .='                if ($.inArray(id, '. json_encode($args) .') > -1 && $(this).is(":checked") ){';
    $content .='                    $("#'.$div_id.'").show();';
    $content .='                    return false;';
    $content .='                }';
    $content .='            });';
    $content .='        }';
    $content .="        $('#categorychecklist input[type=".'"checkbox"]'."'".').live("click", buziness_hide_metabox_js);';
    $content .="        buziness_hide_metabox_js();";
    $content .="    });";
    $content .="</script>";
    
    $return_echoed_content = function() use($content) {echo $content;};

    return $return_echoed_content;
}