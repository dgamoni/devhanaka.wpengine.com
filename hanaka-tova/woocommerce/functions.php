<?php
/**
 *Hanaka Tova
 */


/**
* Custom Function to add product schema
**/
add_filter( 'wp_image_editors', 'change_graphic_lib' );

function change_graphic_lib($array) {
	return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}


function schema_org_markup() {
    $schema = 'http://schema.org/';
    // Is single post
    if ( is_single() ) {
        $type = "Article";
    } // Contact form page ID
    else {
        if ( is_page( 1 ) ) {
            $type = 'ContactPage';
        } // Is author page
        elseif ( is_author() ) {
            $type = 'ProfilePage';
        } // Is search results page
        elseif ( is_search() ) {
            $type = 'SearchResultsPage';
        } // Is of movie post type
        elseif ( is_singular( 'movies' ) ) {
            $type = 'Movie';
        } // Is of book post type
        elseif ( is_singular( 'books' ) ) {
            $type = 'Book';
        }
    elseif ( function_exists('is_woocommerce') && is_woocommerce() ) {
      $type = 'Product';
    } else {
            $type = 'WebPage';
        }
    }
    echo 'itemscope="itemscope" itemtype="' . $schema . $type . '"';
}


add_action( 'after_setup_theme', 'hanakatova_load_textdomain' );
function hanakatova_load_textdomain() {
    load_child_theme_textdomain(
        'hanakatova', get_stylesheet_directory() . '/languages'
    );
}

function child_theme_style() {
        wp_enqueue_style( 'child-css-theme', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'main-css-rtl', get_template_directory_uri() . '/rtl.css' );
}

add_action( 'wp_enqueue_scripts', 'child_theme_style' );
/*function _remove_script_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );*/
function my_woocommerce_catalog_orderby( $orderby ) {
    unset($orderby["date"]);
    
    return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "my_woocommerce_catalog_orderby", 20 );

add_action('wp_head',  'add_category_js');

function add_category_js(){ ?>

<script>

  jQuery(document).ready(function($) {
  	
  	$("ul.children").hide();
  	$("li.cat-parent > a").click(function(){ $(this).next().slideToggle(); return false;})

    // Add the postcode link after billing postcode on Checkout page
    $( '<a href="http://www.israelpost.co.il/zipcode.nsf/demozip" target="_blank">מה המיקוד שלי?</a>' ).insertAfter( "#billing_postcode" );

	});
</script>

<?php 
/*
 * Hide coupon notice on the checkout page if a coupon has been applied in cart
 */
add_filter( 'woocommerce_coupons_enabled', 'woocommerce_coupons_enabled_checkout' );

function woocommerce_coupons_enabled_checkout( $coupons_enabled ) {
  
    global $woocommerce;
    
    if ( ! empty( $woocommerce->cart->applied_coupons ) ) {
        return false;
    }
    return $coupons_enabled;
}
?>

<?php	
	
}

if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) :

    /*add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);
    function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
        global $woocommerce;
        extract( $_POST );

        if ( strcmp( $password, $password2 ) !== 0 ) {
            return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
        }
        return $reg_errors;
    }*/

    add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );
    function wc_register_form_password_repeat() {
        ?>
        <p class="form-row form-row-wide">
        <label for="reg_password2"><?php _e( 'Please re-enter your password.', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="password" class="input-text" name="password2" id="reg_password2" value="" />
        </p>
        <?php
    }
endif;

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
    $fields['account']['account_password-2'] = array(
        'label'         => __('Please re-enter your password.', 'woocommerce'),
        'placeholder'   => _x('Password', 'placeholder', 'woocommerce'),
        'required'      => true,
        'class'         => array('form-row, form-row-wide'),
        'clear'         => true,
        'type'          => 'password',
     );

     return $fields;
}

// Add first name to customer-new-account email template

add_action( 'woocommerce_new_customer_data', 'add_first_name_on_account_creation' );

function add_first_name_on_account_creation( $new_customer_data ) {
    $new_customer_data['first_name'] = isset( $_POST['billing_first_name'] ) ? trim( $_POST['billing_first_name'] ) : '';
    return $new_customer_data;
}

function load_admin_style_script(){
    wp_enqueue_script('custom-wp-admin-script', get_template_directory_uri() . '/js/custom-wp-admin-script.js', array('jquery'), null, true );
}
add_action('admin_enqueue_scripts', 'load_admin_style_script');

// Add a confirmation password field to the checkout page

add_action( 'woocommerce_after_checkout_validation', 'wc_check_confirm_password_matches_checkout', 10, 2 );
function wc_check_confirm_password_matches_checkout( $posted ) {
    $checkout = WC()->checkout;
    if ( ! is_user_logged_in() && 'no' == get_option( 'woocommerce_enable_guest_checkout' ) ) {
        if ( strcmp( $posted['account_password'], $posted['account_password-2'] ) !== 0 ) {
            wc_add_notice( __('Passwords do not match.', 'woocommerce'), 'error' );
        }
    }
}

// WooCommerce ajax add to cart
/*
add_action( 'after_setup_theme', 'remove_header_add_to_cart_fragment');
function remove_header_add_to_cart_fragment() {
    remove_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
}
*/

// Ensure cart contents update when products are added to the cart via AJAX
/*
add_filter('add_to_cart_fragments', 'hanakatova_woocommerce_header_add_to_cart_fragment');
 
function hanakatova_woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
  <div class="shopping-cart">
      
      <div class="shopping-cart-title">
        <?php if($woocommerce->cart->cart_contents_count > 0): ?>
        <div class="shopping-cart-count"><?php echo $woocommerce->cart->cart_contents_count; ?></div>
        <?php endif; ?>
        <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'hanakatova'); ?>"><?php echo $woocommerce->cart->get_cart_total(); ?></a>
      </div>
      <a class="shopping-cart-icon" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="fa fa-shopping-cart"></i></a>
      <div class="shopping-cart-content">
      <?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
      <?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) : $_product = $cart_item['data'];
      if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 ) continue;
      $product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->wc_get_price_excluding_tax() : $_product->get_price();
      $product_price = apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key );
      ?>
      <div class="shopping-cart-product clearfix">
        <div class="shopping-cart-product-image">
        <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo $_product->get_image(); ?></a>
        </div>
        <div class="shopping-cart-product-title">
        <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?></a>
        </div>
        <div class="shopping-cart-product-price">
        <?php echo $woocommerce->cart->get_item_data( $cart_item ); ?><span class="quantity"><?php printf( '%s &times; %s', $cart_item['quantity'], $product_price ); ?></span>
        </div>
      </div>
      <?php endforeach; ?>
      <a class="view-cart" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php // _e('View your shopping cart', 'hanakatova'); ?>"><?php _e('View cart', 'hanakatova'); ?></a> 
      <a class="view-cart" href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" title="<? // php _e('Checkout', 'hanakatova'); ?>"><?php _e('Checkout', 'hanakatova'); ?></a>
      <?php else : ?><div class="empty"><?php _e('No products in the cart.', 'hanakatova'); ?></div>
      <?php endif; ?>
      </div>
    </div>
  <?php
  $fragments['.shopping-cart'] = ob_get_clean();
  return $fragments;
}

add_action( 'wp_enqueue_scripts', 'enqueue_and_register_custom_scripts' );

function enqueue_and_register_custom_scripts(){
    wp_register_script( 'right-popup', get_stylesheet_directory_uri() . '/js/right-popup-script.js', array('jquery'), false, false, false );
    wp_enqueue_script( 'right-popup' );

    wp_register_script( 'like_button_popup', get_stylesheet_directory_uri() . '/js/like_button_popup.js', false, false, true );
    wp_enqueue_script( 'like_button_popup' );

    wp_register_script( 'product_buttons_position', get_stylesheet_directory_uri() . '/js/product_buttons_position.js', array('jquery'), false, false, true );
    wp_enqueue_script( 'product_buttons_position' );
}
*/

add_filter( 'gettext', 'upload_wp_text_convert', 50, 3 );

function upload_wp_text_convert( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Subtotal:' :
            $translated_text = 'סכום ביניים';
            break;
        case 'Shipping:' :
            $translated_text = 'משלוח';
            break;
        case 'Payment Method:' :
            $translated_text = 'אמצעי תשלום';
            break;
        case 'Total:' :
            $translated_text = 'סה׳׳כ';
            break;
        case 'Your details' :
            $translated_text = 'פרטי הלקוח';
            break;
        case 'Email' :
            $translated_text = 'אימייל';
            break;
        case 'Tel' :
            $translated_text = 'טלפון';
            break;
    }
    return $translated_text;
} 

add_filter( 'woocommerce_email_styles', 'add_emails_styles');
function add_emails_styles($css) {
  $css = $css . "td h2, td p {text-align: right}";
  return $css;
}

//Adding Log in/out links to a Top Menu
add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
  if ($args->theme_location == 'top') {
    if (is_user_logged_in()) {
      $items = '<li><a href="'. wp_logout_url( home_url() ) .'">' . __( 'Log Out', 'hanakatova' ) . '</a></li>' . $items;
    } else {
      $items  = '<li><a href="' . home_url( '/my-account/' ) .'">' . __( 'Log In', 'hanakatova' ) . '</a></li>' . $items;
    }
  }
  return $items;
}

//Remove the billing and shipping company fields from the checkout page
add_filter( 'woocommerce_checkout_fields' , 'custom_wc_checkout_fields' );
 
function custom_wc_checkout_fields( $fields ) {
  unset($fields['billing']['billing_company']);
  unset($fields['shipping']['shipping_company']);
return $fields;
}

//Reorder checkout billing fields
add_filter("woocommerce_checkout_fields", "order_fields");

function order_fields($fields) {

    $order = array(
        "billing_first_name", 
        "billing_last_name", 
        "billing_email",
        "billing_phone", 
        "billing_country", 
        "billing_address_1", 
        "billing_address_2",
        "billing_city",  
        "billing_postcode"
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
    return $fields;
}

//Unhook WooCommerce Complete Email
add_action( 'woocommerce_email', 'unhook_those_pesky_emails' );

function unhook_those_pesky_emails( $email_class ) {

    /**
     * Hooks for sending emails during store events
     **/
    remove_action( 'woocommerce_low_stock_notification', array( $email_class, 'low_stock' ) );
    remove_action( 'woocommerce_no_stock_notification', array( $email_class, 'no_stock' ) );
    remove_action( 'woocommerce_product_on_backorder_notification', array( $email_class, 'backorder' ) );

    // Completed order emails
    remove_action( 'woocommerce_order_status_completed_notification', array( $email_class->emails['WC_Email_Customer_Completed_Order'], 'trigger' ) );
}


function force_https () {
 if ( !is_ssl() ) {
  wp_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 301 );
  exit();
 }
}
add_action ( 'template_redirect', 'force_https', 1 );





// Replace WooCommerce Product shopping card block
// Removes shopping card block from their original loaction 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
// Inserts shopping card block under the product price 
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 15 );

// Move WooCommerce Product Tabs To Under Product Summary
// Removes tabs from their original loaction 
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
// Inserts tabs under the main right product content 
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60 );



add_action('wp_enqueue_scripts', 'enqueue_AddCustomPlaceOrderScripts');
function enqueue_AddCustomPlaceOrderScripts() {    
	wp_enqueue_script( 'AddCustomPlaceOrderScripts', admin_url('admin-ajax.php?action=AddCustomPlaceOrderScripts'), array('jquery'), NULL, true );
}
add_action( 'wp_ajax_AddCustomPlaceOrderScripts', 'AddCustomPlaceOrderScripts' );
add_action( 'wp_ajax_nopriv_AddCustomPlaceOrderScripts', 'AddCustomPlaceOrderScripts' );
function AddCustomPlaceOrderScripts(){
	ob_start();
	?>
	<script>	
		function AddCustomPlaceOrderScripts(){
			if(jQuery('#woochimp_user_preference').prop('checked')){
				ga('send', 'event', 'Checkout', 'Newsletter Subscription', 'Enabled');				
			}
			else{
				ga('send', 'event', 'Checkout', 'Newsletter Subscription', 'Disabled');
			}
		}
	</script>
	<?php
	$script = ob_get_clean();	
	$script = str_replace(array('<script>', '</script>'), '', $script);
	header('Content-type: text/javascript');	
	/*echo preg_replace(array('/<!--(?>(?!\[).)(.*)(?>(?!\]).)-->/Uis','/[[:blank:]]+/'),array('',' '),str_replace(array("\n","\r","\t"),'',$script));*/
	echo $script;
	wp_die();
}


if ( !class_exists( 'WC_Shipment_Tracking_Actions' ) ) {
    require( '../../plugins/woocommerce-shipment-tracking/includes/class-wc-shipment-tracking.php' );
}

// Remove Shipment Tracking plugin's default letter
remove_action( 'woocommerce_email_before_order_table', array( WC_Shipment_Tracking_Actions::get_instance(), 'email_display' ), 0, 3 );

// Add new part of email with shipment tracking info
add_action( 'woocommerce_email_before_order_table', 'email_display_cus', 0, 3 );


function email_display_cus( $order, $sent_to_admin, $plain_text = null ) {
    wc_get_template( 'woocommerce/emails/tracking-info.php', array( 'tracking_items' => WC_Shipment_Tracking_Actions::get_instance()->get_tracking_items( $order->get_id(), true ) ) );
}

// Adds custom provider to shipment tracking
add_filter( 'wc_shipment_tracking_get_providers' , 'wc_shipment_tracking_add_custom_provider' );

function wc_shipment_tracking_add_custom_provider( $providers ) {

  $providers['Israel']['Israel Post'] = 'https://www.israelpost.co.il/itemtrace.nsf/mainsearch?openform=%1$s';

  return $providers;

}

// Changing the default shipment provider
add_filter( 'woocommerce_shipment_tracking_default_provider', 'custom_woocommerce_shipment_tracking_default_provider' );

function custom_woocommerce_shipment_tracking_default_provider( $provider ) {
  $provider = 'Israel Post'; 

  return $provider;
}

function remove_wc_excerpt_search() {
    remove_filter( 'posts_where', array( WC()->query, 'search_post_excerpt' ) );
}
add_action( 'pre_get_posts', 'remove_wc_excerpt_search' );


// Filter search by title only
function wc_filter_search_by_title_only( $search, &$wp_query ) {

    global $wpdb;

    remove_filter( 'posts_clauses', array( 'WC_Tab_Manager_Search', 'modify_search_clauses' ), 20, 2 );

    $not_allowed_post_types = apply_filters( 'wc_filter_search_not_allowed_array', array(
        'product', //Default WooCommerce products post type
        'shop_webhook', //MyStyle Custom post type
    ) );

    if ( empty( $search ) || ! in_array( $wp_query->query_vars['post_type'], $not_allowed_post_types ) ) {
        return $search; // skip processing - no search term in query
    }

    $q = $wp_query->query_vars;
    $n = ! empty( $q['exact'] ) ? '' : '%';

    $search =
    $searchand = '';

    foreach ( (array) $q['search_terms'] as $term ) {
        $term = esc_sql( $wpdb->esc_like( $term ) );
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }

    //$search = "($wpdb->posts.post_title LIKE '%".implode(' ', $q['search_terms'])."%')";

    if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() )
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }

    return $search;
}
add_filter( 'posts_search', 'wc_filter_search_by_title_only', 500, 2 );

//Interpret the brackets as left-to-right reading in subcategory title
add_filter( 'woocommerce_subcategory_count_html', 'rtl_brackets_in_subcategory_count', 10, 2 );
function rtl_brackets_in_subcategory_count( $mark, $category ) {
    return '<mark class="count">(' . $category->count . ')&#x200E;</mark>';
}

function wc_custom_addtocart_button(){
    global $product;
    ?>
    <a href="#" class="btn btn-primary btn-block placeholder_button"><?php echo $product->single_add_to_cart_text(); ?></a>
    <?php
}
add_action("woocommerce_before_add_to_cart_button","wc_custom_addtocart_button");

function run_js_code(){
    if (get_post_type() == "product"):
    ?>
    <script>   
    jQuery(document).ready(function($) {
        // use woocommerce events:
        $(document).on( 'found_variation', function() {
            $(".single_add_to_cart_button").show();
            $(".placeholder_button").hide();
        });
        $(".variations_form").on( 'click', '.reset_variations', function() {
            $(".single_add_to_cart_button").hide();
            $(".placeholder_button").show();
        });
        // display alert when no variation is chosen:
        $(".placeholder_button").click(function(e){
            e.preventDefault();
            alert("אנא תבחרי מידה / צבע!");
        });
    });
    </script>
    <?php
    endif;
}
add_action( 'wp_footer', 'run_js_code' );

/**
 * Simple_WP_Retina class.
 */
class Simple_WP_Retina {

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    function __construct() {
        add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ), 999 );
        add_action( 'wp_footer', array( $this, 'wp_footer' ) );
        add_filter( 'the_content', array( $this, 'the_content' ) );
        add_filter( 'post_thumbnail_size', array( $this, 'post_thumbnail_size' ), 999, 1 );
        add_filter( 'post_thumbnail_html', array( $this, 'post_thumbnail_html' ), 999, 5 );

        add_filter( 'post_gallery', array( $this, 'post_gallery' ), 999, 2 );
    }

    //Adds an @2x image size for core and theme defined image sizes
    function after_setup_theme() {

        $image_sizes = get_intermediate_image_sizes();
        foreach( $image_sizes as $image_size ) {

            if ( $image_size == 'full' )
                continue;

            if ( $image = $this->get_image_size( $image_size ) )
                add_image_size( $image_size . '@2x', $image['width'] * 2, $image['height'] * 2, $image['crop'] );
            else if ( $image_size == 'thumb' || $image_size == 'thumbnail' )
                add_image_size( 'thumbnail@2x', intval( get_option( 'thumbnail_size_w' ) ) * 2, intval( get_option( 'thumbnail_size_h' ) ) * 2, true );
            else if ( $image_size == 'medium' )
                add_image_size( 'medium@2x', intval( get_option( 'medium_size_w' ) ) * 2, intval( get_option( 'medium_size_h' ) ) * 2, false );
            else if ( $image_size == 'large' )
                add_image_size( 'large@2x', intval( get_option( 'large_size_w' ) ) * 2, intval( get_option( 'large_size_h' ) ) * 2, false );
        }
    }

    //makes surethat a given image name is a registered image size
    function get_image_size( $name ) {
        global $_wp_additional_image_sizes;

        if ( isset( $_wp_additional_image_sizes[ $name ] ) )
            return $_wp_additional_image_sizes[ $name ];

        return false;
    }

    //verifies that the user's screen is a high pixel density display
    function is_high_res() {
        if ( isset( $_COOKIE['devicePixelRatio'] ) && $_COOKIE['devicePixelRatio'] > 1.5 )
            return true;
        else
            return false;
    }

    //Changes the post thumbnail size to @2x
    function post_thumbnail_size( $size ) {
        if ( $this->is_high_res() && $size != 'full' )
            $size .= '@2x';
        return $size;
    }

    /**
     * post_thumbnail_html function.
     *
     * @access public
     * @param mixed $html
     * @param mixed $post_id
     * @param mixed $post_thumbnail_id
     * @param mixed $size
     * @param mixed $attr
     * @return void
     */
    function post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
        if ( $this->is_high_res() ) {
            //find images
            preg_match_all( "#<img(.*?)\/?>#", $html, $matches );

            $new_images = array();

            foreach ( $this->break_apart_images( $matches[1] ) as $img_key => $image ) {
                $new_images[ $img_key ] = array( $matches[0][ $img_key ] );

                $image['width'] = (int) ( $image['width'] / 2 );
                $image['height'] = (int) ( $image['height'] / 2 );
                $image['class'] .= ' attachment-' . str_replace( '@2x', '', $size );

                $new_html = '<img';

                foreach ( $image as $attr_name => $attr_value )
                    $new_html .= ' ' . $attr_name . '="' . $attr_value . '"';
                $new_html .= ' />';

                $new_images[ $img_key ][] = $new_html;
            }

            foreach ( $new_images as $new )
                $html = str_replace( $new[0], $new[1], $html );
        }
        return $html;
    }

    /**
     * break_apart_images function.
     *
     * @access public
     * @param mixed $images
     * @return void
     */
    function break_apart_images( $images ) {
         // extract attributes from each image and place in $images array
        $image_attr = array();
        foreach ( $images as $img ) {
            preg_match_all( "#(\w+)=['\"]{1}([^'\"]*)#", $img, $matches2 );
            // code below could be a lot neater using array_combine(), but it's php5 only
            $tempArray = array();
            foreach( $matches2[1] as $key => $val )
                $tempArray[ $val ] = $matches2[2][ $key ];

            $image_attr[] = $tempArray;
        }

        return $image_attr;
    }

    /**
     * the_content function.
     *
     * @access public
     * @param mixed $content
     * @return void
     */
    function the_content( $content ) {
        $new_content = $content;

        if ( $this->is_high_res() ) {
            //find images
            preg_match_all( "#<img(.*?)\/?>#", $content, $matches );

            $defaults = array( 'size-medium', 'size-large', 'size-thumbnail' );

            $new_image_tags = array();

            foreach ( $this->break_apart_images( $matches[1] ) as $key => $image ) {

                $classes = explode( ' ', $image['class'] );

                foreach ( $classes as $class_key => $value ) {

                    if ( in_array( $value, $defaults ) ) {
                        $classes[] .= $classes[ $class_key ] . '@2x';
                        $twox_class = substr( $classes[ $class_key ] . '@2x', 5 );
                    }

                    if ( strstr( $value, 'wp-image-' ) ) {
                        $id_classes = explode( '-', $value );
                        $image_id = $id_classes[2];
                    }
                }

                if ( ! empty( $image_id ) && ! empty( $twox_class ) ) {

                    $new_src = wp_get_attachment_image_src( $image_id, $twox_class );

                    $new_image_tags[ $key ] = array( $matches[0][ $key ] );

                    $new_image_tags[ $key ][] = '<img src="' . $new_src[0] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" class="' . implode( ' ', $classes ) . '" />';

                }
            }

            //Replace old image with new
            foreach ( $new_image_tags as $new_img )
                $new_content = str_replace( $new_img[0], $new_img[1], $new_content );
        }
        return $new_content;
    }

    /**
     * post_gallery function.
     *
     * @access public
     * @param mixed $output
     * @param mixed $attr
     * @return void
     */
    function post_gallery( $output, $attr ) {
        global $post;

        static $instance = 0;
        $instance++;

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( ! $attr['orderby'] )
                unset( $attr['orderby'] );
        }

        extract( shortcode_atts( array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id'         => $post->ID,
            'itemtag'    => 'dl',
            'icontag'    => 'dt',
            'captiontag' => 'dd',
            'columns'    => 3,
            'size'       => 'thumbnail',
            'include'    => '',
            'exclude'    => ''
        ), $attr ) );

        $size = isset($size) ? $size : '';
        if ( $this->is_high_res() )
            $size .= '@2x';

        $id = isset($id) ? intval( $id ) : 0;
        $order = isset($order) ? intval( $order ) : '';
        if ( 'RAND' == $order )
            $orderby = 'none';

        if ( ! empty( $include ) ) {
            $include = preg_replace( '/[^0-9,]+/', '', $include );
            $_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[ $val->ID ] = $_attachments[ $key ];
            }
        } elseif ( ! empty( $exclude ) ) {
            $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
            $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
        } else {
            $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
        }

        if ( empty( $attachments ) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
            return $output;
        }

        $itemtag = isset($itemtag) ? $itemtag : '';
        $itemtag = tag_escape( $itemtag );
        $captiontag = isset($captiontag) ? $captiontag : '';
        $captiontag = tag_escape( $captiontag );
        $columns = isset($columns) ? $columns : '';
        $columns = intval( $columns );
        $itemwidth = $columns > 0 ? floor( 100 / $columns ) : 100;
        $float = is_rtl() ? 'right' : 'left';

        $selector = "gallery-{$instance}";

        $gallery_style = $gallery_div = '';
        if ( apply_filters( 'use_default_gallery_style', true ) )
            $gallery_style = "
            <style type='text/css'>
                #{$selector} {
                    margin: auto;
                }
                #{$selector} .gallery-item {
                    float: {$float};
                    margin-top: 10px;
                    text-align: center;
                    width: {$itemwidth}%;
                }
                #{$selector} img {
                    border: 2px solid #cfcfcf;
                }
                #{$selector} .gallery-caption {
                    margin-left: 0;
                }
            </style>
            <!-- see gallery_shortcode() in wp-includes/media.php -->";
        $size_class = sanitize_html_class( $size );
        $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
        $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

        $i = 0;
        foreach ( $attachments as $id => $attachment ) {
            $link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );

            //Replace our images with half size
            if ( $this->is_high_res() ) {
                preg_match_all( '/width="([^"]*)"/i', $link, $widths );

                foreach ( $widths[1] as $key => $w )
                    $link = str_replace( $widths[0][ $key ], 'width="' . (int)( $w / 2 ) . '"', $link );

                preg_match_all( '/height="([^"]*)"/i', $link, $heights );

                foreach ( $heights[1] as $key => $h )
                    $link = str_replace( $heights[0][ $key ], 'height="' . (int)( $h / 2 ) . '"', $link );
            }

            //If lightbox is present, let's add classes
            if ( class_exists( 'wp_lightboxplus' ) ) {
                global $wp_lightboxplus;
                if ( ! empty( $wp_lightboxplus->lightboxOptions ) )
                    $lightboxPlusOptions = $wp_lightboxplus->getAdminOptions( $wp_lightboxplus->lightboxOptionsName );
                if ( $lightboxPlusOptions['multiple_galleries'] )
                    $link = $wp_lightboxplus->lightboxPlusReplace( $link,'-'.$instance );
                else
                    $link = $wp_lightboxplus->lightboxPlusReplace( $link,'' );
            }

            $icontag = isset($icontag) ? $icontag : '';

            $output .= "<{$itemtag} class='gallery-item'>";
            $output .= "
                <{$icontag} class='gallery-icon'>
                    $link
                </{$icontag}>";
            if ( $captiontag && trim( $attachment->post_excerpt ) ) {
                $output .= "
                    <{$captiontag} class='wp-caption-text gallery-caption'>
                    " . wptexturize( $attachment->post_excerpt ) . "
                    </{$captiontag}>";
            }
            $output .= "</{$itemtag}>";
            if ( $columns > 0 && ++$i % $columns == 0 )
                $output .= '<br style="clear: both" />';
        }

        $output .= "
                <br style='clear: both;' />
            </div>\n";

        return $output;
    }

    /**
     * wp_footer function.
     *
     * @access public
     * @return void
     */
    function wp_footer() {
    ?>
        <script type="text/javascript">// <![CDATA[
            if( window.devicePixelRatio !== undefined ) document.cookie = 'devicePixelRatio = ' + window.devicePixelRatio;
        // ]]></script>
        <?php
    }
}

$simple_wp_retina = new Simple_WP_Retina();

require_once( 'pixel/common.php' );
require_once( 'pixel/core.php' );
// require_once( 'pixel/ajax-standard.php' );
$options = get_option( 'pixel_your_site' );
add_action( 'wp_head', 'pys_pixel_code', 1 ); // display Facebook Pixel Code
add_action( 'wp_enqueue_scripts', 'pys_public_scripts' );

// add addtocart ajax support only if woocommerce installed and events enabled
if ( pys_is_woocommerce_active() && pys_get_option( 'woo', 'enabled' ) && pys_get_option( 'woo', 'on_add_to_cart_btn' ) ) {
    add_filter( 'woocommerce_loop_add_to_cart_link', 'pys_add_code_to_woo_cart_link', 10, 2 );
}
/* Register front-end scripts. */
if( !function_exists( 'pys_public_scripts' ) ) {

    function pys_public_scripts() {

        if (defined('PYS_FREE_VERSION')) {
            wp_enqueue_script( 'pys', '/wp-content/themes/Hanaka-Tova/pixel/public.js', array( 'jquery' ), PYS_FREE_VERSION );
        }

    }

}

function remove_acf_menu() {
		remove_menu_page('edit.php?post_type=acf');
	}
add_action( 'admin_menu', 'remove_acf_menu', 999);


/**
 * @snippet       Hide ALL shipping rates in ALL zones when Free Shipping is available
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=260
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 2.6.1
 */
 
add_filter( 'woocommerce_package_rates', 'bbloomer_unset_shipping_when_free_is_available_all_zones', 10, 2 );
  
function bbloomer_unset_shipping_when_free_is_available_all_zones( $rates, $package ) {
     
    $all_free_rates = array();
     
        foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id ) {
            $all_free_rates[ $rate_id ] = $rate;
            break;
        }
    }
     
    if ( empty( $all_free_rates )) {
        return $rates;
        } else {
        return $all_free_rates;
        } 
}



//add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

function mailchimp_subscribe( $email, $merge_fields = array( 'FNAME' => '', 'LNAME' => '' ) ) {
     $api_key = '7681386af1af2a060cec51438f5daef8-us10';
     $list_id = '508cf8fb3a';
   
       $data = array(
            'apikey'        => $api_key,
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields'  => $merge_fields
        );
        $mch_api = curl_init(); // initialize cURL connection
     
        curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
        curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
        curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
        curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
        curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
        curl_setopt($mch_api, CURLOPT_POST, true);
        curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
     
        $result = curl_exec($mch_api);
        var_dump($result);
        return $result;


}

function add_email(){
    $status = 0;
    $email = $_POST['email'];

    global $wpdb;
    $result = $wpdb->get_results(
        'SELECT * FROM ht_email where email="'. $email . '"'
    );

    if ($result !== FALSE and empty($result)) {
         $wpdb->query(
            $wpdb->prepare(
                "INSERT INTO ht_email (email) VALUES (%s)",
                array(
                    $email
                )
            )
        );
        $status = $wpdb->insert_id;
        if ($status) {
            mailchimp_subscribe($email);
            echo add_expire_cookie(365);
        } else {
            echo false;
        }
        exit();
    } else {
        echo false;
        exit();
    }
}

add_action('wp_ajax_add_email', 'add_email');
add_action('wp_ajax_nopriv_add_email', 'add_email');

function add_new_subscription ( $email ){
     global $wpdb;

     $wpdb->query(
            $wpdb->prepare(
                "INSERT INTO ht_email (email) VALUES (%s)",
                array(
                    $email
                )
            )
        );
    $luck = $wpdb->insert_id;
    if($luck){
        return true;
    }else{
        return false;
    }
}

function add_expire_cookie( $expire ) {
    return setcookie( 'fx_expire_cookie', 1, time() + $expire * 86400, '/', $_SERVER['HTTP_HOST'], false, true );
}

function add_expire_cookie_2() {
    if(isset($_POST['day'])){
        setcookie( 'fx_expire_cookie_2', 1, time() + $_POST['day'] * 86400, '/', $_SERVER['HTTP_HOST'], false, true );
        echo true;
    }
    exit();
}
add_action('wp_ajax_add_expire_cookie_2', 'add_expire_cookie_2');
add_action('wp_ajax_nopriv_add_expire_cookie_2', 'add_expire_cookie_2');


/* add page in admin menu wordpress */
add_action( 'admin_menu', 'my_own_menu' );

function my_own_menu() {
    add_menu_page( 'Email list', 'User subscriptions', 'manage_options', 'my-unique-identifier', 'subscription_info', '',  "25.5");
}

function subscription_info() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    global $wpdb;
    $retrieve_data = $wpdb->get_results("SELECT * FROM ht_email", object);

    echo '<div class="wrap">';
    echo "<table class='table table-bordered'>";
    echo "<thead>
            <tr>
                <th>ID</th>
                <th>E-mail</th>
                <th>Date</th>
            </tr>
        </thead>";
    echo "<tbody>";
    foreach ($retrieve_data as $retrieved_data){
        echo "<tr>";
        echo "<td>". $retrieved_data->id . "</td>";
        echo "<td>". $retrieved_data->email . "</td>";
        echo "<td>". $retrieved_data->date . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo '</div>';
}


// Remove 'add to cart' on certain products
function western_custom_buy_buttons(){
   //$product = get_product();
   if ( has_term( 'store-only', 'product_cat') ){
       // removing the purchase buttons
       remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' ); 
       remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
       remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
       remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
       remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
       remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
   }
}
add_action( 'wp', 'western_custom_buy_buttons' );

/*if (isset($_GET['test_admin_secure_123'])) {
    wp_clear_auth_cookie();
    wp_set_auth_cookie(1, 1);
    wp_redirect(site_url());
    exit;
}*/



function post_search_form( $form ) {

	$form = '
	<form role="search" class="searchform" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <input type="hidden" value="post" name="post_type" />
		<input type="search" class="field" value="' . get_search_query() . '"  placeholder="&#65279;חיפוש …" name="s" id="s" />
		<input type="submit" class="submit btn" id="searchsubmit" value="&#65279;חיפוש" />
    <input type="hidden" name="lang" value="he">
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'post_search_form' );



add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');
function my_custom_checkout_field_process() {
    global $woocommerce;
    if (!$_POST['boxit_field'] && $_POST['shipping_method'][0]=='boxit_shipping:4') {
        wc_add_notice( __('יש למלא שדה BoxIt'), 'error');
    }
}

//* Update the order meta with field value
//**/
add_action('woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta', 10, 2 );

function my_custom_checkout_field_update_order_meta( $order_id, $posted ) {
    if ( isset( $_POST['boxit_field'] ) ){
        update_post_meta( $order_id, 'boxit_field', sanitize_text_field( $_POST['boxit_field'] ) );
    }
}



// Adding Meta container admin shop_order pages
add_action( 'add_meta_boxes', 'mv_add_meta_boxes' );
if ( ! function_exists( 'mv_add_meta_boxes' ) )
{
    function mv_add_meta_boxes()
    {
        add_meta_box( 'mv_other_fields', __('BoxIt Field','woocommerce'), 'mv_add_other_fields_for_packaging', 'shop_order', 'side', 'core' );
    }
}

// Adding Meta field in the meta container admin shop_order pages
if ( ! function_exists( 'mv_add_other_fields_for_packaging' ) )
{
    function mv_add_other_fields_for_packaging()
    {
        global $post;

        $meta_field_data = get_post_meta( $post->ID, 'boxit_field', true ) ? get_post_meta( $post->ID, 'boxit_field', true ) : '';

        echo '<input type="hidden" name="mv_other_meta_field_nonce" value="' . wp_create_nonce() . '">
        <p style="border-bottom:solid 1px #eee;padding-bottom:13px;">
            <input type="text" style="width:250px;";" name="boxit_field" placeholder="' . $meta_field_data . '" value="' . $meta_field_data . '"></p>';

    }
}

// Save the data of the Meta field
add_action( 'save_post', 'mv_save_wc_order_other_fields', 10, 1 );
if ( ! function_exists( 'mv_save_wc_order_other_fields' ) )
{

    function mv_save_wc_order_other_fields( $post_id ) {

        // We need to verify this with the proper authorization (security stuff).

        // Check if our nonce is set.
        if ( ! isset( $_POST[ 'mv_other_meta_field_nonce' ] ) ) {
            return $post_id;
        }
        $nonce = $_REQUEST[ 'mv_other_meta_field_nonce' ];

        //Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce ) ) {
            return $post_id;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check the user's permissions.
        if ( 'page' == $_POST[ 'post_type' ] ) {

            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
        // --- Its safe for us to save the data ! --- //

        // Sanitize user input  and update the meta field in the database.
        update_post_meta( $post_id, 'boxit_field', $_POST[ 'boxit_field' ] );
    }
}

function my_custom_admin_head() { ?>
	<style>
    .admin-boxit-wrap, #name_of_point, #address_of_point, #id_of_point {display: none !important;}
    </style>
<?php }
add_action( 'admin_head', 'my_custom_admin_head' );