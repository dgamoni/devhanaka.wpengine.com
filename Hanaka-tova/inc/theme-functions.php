<?php
/** 
 * Plugin recomendations
 **/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

require_once ('class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'flatmarket_register_required_plugins' );

function flatmarket_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        
        array(
            'name'                  => 'FlatMarket Visual Page Builder', // The plugin name
            'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/js_composer.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '4.4.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Revolution Slider', // The plugin name
            'slug'                  => 'revslider', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/revslider.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '4.6.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Mega Main Menu', // The plugin name
            'slug'                  => 'mega_main_menu', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/mega_main_menu.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.0.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce', // The plugin name
            'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/woocommerce.2.3.3.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.3.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce Brands', // The plugin name
            'slug'                  => 'mgwoocommercebrands', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/mgwoocommercebrands.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce WishList', // The plugin name
            'slug'                  => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/yith-woocommerce-wishlist.1.1.1.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce Compare', // The plugin name
            'slug'                  => 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/yith-woocommerce-compare.1.2.1.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce QuickView', // The plugin name
            'slug'                  => 'woo_quickview', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/woo_quickview.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '3.0.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce Sales Countdown', // The plugin name
            'slug'                  => 'woosalescountdown', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/woosalescountdown.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.8.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce Ajax Search', // The plugin name
            'slug'                  => 'yith-woocommerce-ajax-search', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/yith-woocommerce-ajax-search.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '100.1.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'WooCommerce CloudZoom', // The plugin name
            'slug'                  => 'cloud-zoom-for-woocommerce', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/cloud-zoom-for-woocommerce.0.1.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        
        array(
            'name'                  => 'FlatMarket Translation Manager', // The plugin name
            'slug'                  => 'loco-translate', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/loco-translate.1.4.6.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.4.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'                  => 'PrettyPhoto Lightbox', // The plugin name
            'slug'                  => 'prettyphoto', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/prettyphoto.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),


        array(
            'name'                  => 'Contact Form 7', // The plugin name
            'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/contact-form-7.3.9.3.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '3.9.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        
        array(
            'name'                  => 'Regenerate Thumbnails', // The plugin name
            'slug'                  => 'regenerate-thumbnails', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/regenerate-thumbnails.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.2.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        
        array(
            'name'                  => 'Simple WP Retina', // The plugin name
            'slug'                  => 'simple-wp-retina', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/simple-wp-retina.1.1.1.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'                  => 'Lazy Load (Faster your website with optimized image loading)', // The plugin name
            'slug'                  => 'lazy-load', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/lazy-load.0.5.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '0.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        )

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => 'flatmarket',           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                          // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',                // Default parent menu slug
        'parent_url_slug'   => 'themes.php',                // Default parent URL slug
        'menu'              => 'install-required-plugins',  // Menu slug
        'has_notices'       => true,                        // Show admin notices or not
        'is_automatic'      => false,                       // Automatically activate plugins after installation or not
        'message'           => '',                          // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', 'flatmarket' ),
            'menu_title'                                => __( 'Install Plugins', 'flatmarket' ),
            'installing'                                => __( 'Installing Plugin: %s', 'flatmarket' ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', 'flatmarket' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', 'flatmarket' ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', 'flatmarket' ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'flatmarket' ), // %1$s = dashboard link
            'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );

}

/* Widgets */

function flatmarket_widgets_init() {
    register_sidebar(
      array(
        'name' => __( 'Left/Right sidebar', 'flatmarket' ),
        'id' => 'main-sidebar',
        'description' => __( 'Widgets in this area will be shown in the left or right site column.', 'flatmarket' )
      )
    );

    register_sidebar(
      array(
        'name' => __( 'Woocommerce sidebar', 'flatmarket' ),
        'id' => 'shop-sidebar',
        'description' => __( 'Widgets in this area will be shown in the left or right column on shop pages.', 'flatmarket' )
      )
    );

    register_sidebar(
      array(
        'name' => __( 'Footer 4 column sidebar #1', 'flatmarket' ),
        'id' => 'footer-sidebar',
        'description' => __( 'Widgets in this area will be shown in site footer in 4 column.', 'flatmarket' )
      )
    );

    register_sidebar(
      array(
        'name' => __( 'Footer 4 column sidebar #2', 'flatmarket' ),
        'id' => 'footer-sidebar-2',
        'description' => __( 'Widgets in this area will be shown in site footer in 4 column after Footer sidebar #1.', 'flatmarket' )
      )
    );
}

add_action( 'widgets_init', 'flatmarket_widgets_init' );

add_filter('widget_text', 'do_shortcode');

/* WooCommerce settings */

if(!isset($theme_options['shop_woocommerce_products_per_page'])) {
    $theme_options['shop_woocommerce_products_per_page'] = 10;
}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$theme_options['shop_woocommerce_products_per_page'].';' ), 20 );

/*
* WooCommerce ajax add to cart
*/
// Ensure cart contents update when products are added to the cart via AJAX
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
  <div class="shopping-cart">
      
      <div class="shopping-cart-title">
        <?php if($woocommerce->cart->cart_contents_count > 0): ?>
        <div class="shopping-cart-count"><?php echo $woocommerce->cart->cart_contents_count; ?></div>
        <?php endif; ?>
        <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'flatmarket'); ?>"><?php echo $woocommerce->cart->get_cart_total(); ?></a>
      </div>
      <a class="shopping-cart-icon" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="fa fa-shopping-cart"></i></a>
      <div class="shopping-cart-content">
      <?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
      <?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) : $_product = $cart_item['data'];
      if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 ) continue;
      $product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();
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
      <a class="view-cart" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'flatmarket'); ?>"><?php _e('View Cart', 'flatmarket'); ?></a> <a class="view-cart" href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" title="<?php _e('לקופה', 'flatmarket'); ?>"><?php _e('Checkout', 'flatmarket'); ?></a>
      <?php else : ?><div class="empty"><?php _e('No products in the cart.', 'flatmarket'); ?></div>
      <?php endif; ?>
      </div>
    </div>
  <?php
  $fragments['.shopping-cart'] = ob_get_clean();
  return $fragments;
}

// Customisation Menu Links
class description_walker extends Walker_Nav_Menu{
      function start_el(&$output, $item, $depth = 0, $args = Array(), $current_object_id = 0 ){
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
           $class_names = $value = '';
           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
          
           $add_class = '';
           
           $post = get_post($item->object_id);          

               $class_names = ' class="'.$add_class.' '. esc_attr( $class_names ) . '"';
               $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
               $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
               $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
               $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

                    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

                if (is_object($args)) {
                    $item_output = $args->before;
                    $item_output .= '<a'. $attributes .'>';
                    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
                    $item_output .= $args->link_after;
                    $item_output .= '</a>';
                    $item_output .= $args->after;
                    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

                }
     }
}

function flatmarket_custom_favicon() {
    global $theme_options;

    if(isset($theme_options['favicon_image']) && $theme_options['favicon_image']['url'] <> '') {
      echo '<link rel="icon" type="image/png" href="'.$theme_options['favicon_image']['url'].'" />';
    }
}
add_action( 'wp_head' , 'flatmarket_custom_favicon' );

// include the WPML installer in the theme
include get_template_directory() . '/inc/wpml-installer/loader.php';

WP_Installer_Setup($wp_installer_instance, array(
    'plugins_install_tab' => 1, // optional, default value: 0
    'affiliate_id' => '90915', // optional, default value: empty
    'affiliate_key' => '2BMypRRSJR46', // optional, default value: empty
    'src_name' => 'FlatMarket', // optional, default value: empty, needed for coupons 
    'src_author' => 'Magnium themes',// optional, default value: empty, needed for coupons 
    'repositories_include' => array('wpml') // optional, default to empty (show all)
) );
