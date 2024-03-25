<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package FlatMarket
 */
?>
<?php 
global $theme_options;
?>
<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
<div class="footer-sidebar sidebar container">
  <ul id="footer-sidebar">
    <?php dynamic_sidebar( 'footer-sidebar' ); ?>
  </ul>
</div>
<?php endif; ?>

<div class="container-fluid">
<div class="row">
<div class="footer-sidebar-2-wrapper">
<div class="footer-sidebar-2 sidebar container footer-container">
<?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
  <div id="footer-shopping-cart" class="col-xs-12">
    <?php if((isset($theme_options['shop_disable_cartbox']) && !$theme_options['shop_disable_cartbox']) && (isset($theme_options['shop_catalog_mode_enable']) && !$theme_options['shop_catalog_mode_enable']) ): ?>
    <?php if (class_exists('Woocommerce')): ?>
    <?php global $woocommerce; ?>
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
      <a class="view-cart none1" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php //_e('View your shopping cart', 'hanakatova'); ?>"><?php _e('View Cart', 'hanakatova'); ?></a> <a class="view-cart" href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" title="<? // php _e('Checkout', 'hanakatova'); ?>"><?php _e('Checkout', 'hanakatova'); ?></a>
      <?php else : ?><div class="empty"><?php _e('No products in the cart.', 'hanakatova'); ?></div>
      <?php endif; ?>
      
      </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>

  </div>
  
    
<!-- Change to Footer Link on Mobile -->   
   <div class="link-to-wishlist-button">    
  <div class="link-to-wishlist mob-show"> 
      <a href="<? /* php echo esc_url( home_url( '/wishlist/' ) ); */?>" >רשימת המשאלות</a>         
    <!-- <a href="<?php echo esc_url( home_url( '/nationwide-sales/' ) ); ?>" >מכירות ברחבי הארץ</a> -->    
    </div> 
   </div>
  <ul id="footer-sidebar-2" class="clearfix">
    <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
  </ul>
<?php endif; ?>
      
      <div class="line"></div>
      <div class="footer-social">
               <span>
            <?php

            $social_services_arr = Array("facebook", "vk","twitter", "google-plus", "linkedin", "dribbble", "instagram", "tumblr", "pinterest", "vimeo-square", "youtube", "skype");

            foreach( $social_services_arr as $ss_data ){
              if(isset($theme_options[$ss_data]) && (trim($theme_options[$ss_data])) <> '') {
                $social_service_url = $theme_options[$ss_data];
                $social_service = $ss_data;
                echo '<a href="'.$social_service_url.'" target="_blank" class="a-'.$social_service.'"><i class="fa fa-'.$social_service.'"></i></a>';
              }
            }

            ?>
              </span>
      </div>
    
</div>
      
</div>

<? 
//RIGHT POPUP
//$post_id = get_queried_object_id();
if( !isset($_COOKIE['fx_expire_cookie']) AND !isset($_COOKIE['fx_expire_cookie_2']) AND is_user_logged_in() !== true ){
	get_template_part( '/popup/popup_file' ); 
}
?>

<footer>
<div class="container">
<div class="row">
    <div class="col-md-6 copyright">
    <?php echo $theme_options['footer_copyright_editor']; ?>
    </div>
    <div class="col-md-6">
         <div class="payment-icons">
          <?php
          if(isset($theme_options['footer_payment_icons'])) {
            foreach( $theme_options['footer_payment_icons'] as $footer_payment_icon ){

              echo '<img src="'.get_stylesheet_directory_uri().'/img/payment/'.$footer_payment_icon.'.png" alt="'.$footer_payment_icon.'"/>';
            }
          }

          ?>
          </div>
    </div>
</div>
</div>
<a id="top-link" href="#top"></a>
</footer>
</div>
</div>
<?php wp_footer(); ?>

</body>
</html>