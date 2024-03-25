<?php
/**
 * WP Theme Header
 *
 * Displays all of the <head> section
 *
 * @package FlatMarket
 */
global $theme_options;

?><!DOCTYPE html>
<html <?php schema_org_markup(); ?> <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<title><?php wp_title(''); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>

<?php global $template; 
if( basename($template) == 'thankyou.php' ) {} else { ?>
<!-- Global site tag (gtag.js) - Google AdWords: 965564625 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-965564625"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-965564625');
</script>

<?php } ?>

<!-- Google Analytics Tracking Code for Events -->
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
    ga('send', 'event', 'Contact Form', 'submit');
}, false );
</script>


<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '197518970612922');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=197518970612922&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


</head>

<body <?php echo body_class(); ?>>

<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-T4GPDC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T4GPDC');</script>
<!-- End Google Tag Manager -->

<?php do_action( 'before' ); ?>
<?php if((isset($theme_options['sideblock_show_facebook'])) && ($theme_options['sideblock_show_facebook'])): ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="widget_facebook_right">
  <div id="facebook_icon"></div>
  <div class="facebook_box">
   <div class="fb-like-box" data-href="https://www.facebook.com/<?php if(isset($theme_options['facebook_gid'])) { echo $theme_options['facebook_gid']; } ?>" data-width="237" data-height="389" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
 
  </div>
</div>
<?php endif; ?>

<?php if((isset($theme_options['sideblock_show_twitter'])) && ($theme_options['sideblock_show_twitter'])): ?>
<div class="widget_twitter_right">
  <div id="twitter_icon"></div>
  <div class="twitter_box">
    <?php if(isset($theme_options['sideblock_twitter_content'])) { echo $theme_options['sideblock_twitter_content']; } ?>
  </div>
</div>
<?php endif; ?>

<?php if(isset($theme_options['sideblock_show_custom']) && $theme_options['sideblock_show_custom']): ?>
<div class="widget_custom_box_right">
<div id="custom_box_icon"></div>
<div class="custom_box">
  <?php if(isset($theme_options['sideblock_custom_content'])) { echo $theme_options['sideblock_custom_content']; } ?>
</div>
</div>
<?php endif; ?>
<div class="header-menu-bg">
  <div class="header-menu">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
         <script>
         jQuery( document ).ready(function() {
          jQuery('#mobile-menu-button').click(function() {
            jQuery('.header-menu .col-md-6.show-toggle').toggleClass("active");
          });
         }); 
         </script> 
         <a id="mobile-menu-button">
          <span class="mobile-menu-button-word"><?php _e( 'Menu', 'flatmarket' ); ?></span>
          <div><span class="mobile-menu-button-line"></span></div>
         </a>
            <?php if($theme_options['header_info_editor'] <> ''): ?>
            <div class="header-info-text"><?php echo $theme_options['header_info_editor']; ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6 show-toggle">
          <?php if(isset($theme_options['header_show_currency_switcher']) && $theme_options['header_show_currency_switcher']): ?>
          <div class="wpml-currency">
          <?php do_action('currency_switcher', array('format' => '%symbol%')); ?>
          </div>
          <?php endif; ?>
          <?php if(isset($theme_options['header_show_language_switcher']) && $theme_options['header_show_language_switcher']): ?>
          <div class="wpml-lang">
          <?php do_action('icl_language_selector'); ?>
          </div>
          <?php endif; ?>
          <?php
          wp_nav_menu(array(
            'theme_location'  => 'top',
            'menu_class'      => 'links'
            ));
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<header>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="logo"><a class="logo-link" href="<?php echo site_url(); ?>"><img src="<?php echo get_header_image(); ?>" alt=""></a></div>
      <?php if($theme_options['header_info_editor'] <> ''): ?>
      <div class="logo-info-text"><?php //echo $theme_options['header_info2_editor']; ?></div>
      <?php endif; ?>
    </div>
    <div class=""></div>
    <div class="col-md-8 cart-and-search">
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
    <div class="search-bar"> 
      <?php
      
          if((isset($theme_options['woocommerce_show_search'])) && ($theme_options['woocommerce_show_search'])):
            if (class_exists('Woocommerce')) {

             if(is_plugin_active('yith-woocommerce-ajax-search/init.php')) {
                echo do_shortcode('[yith_woocommerce_ajax_search]');
              }
              else {
                echo get_product_search_form();
              }

            }
          endif;
      ?>
    </div>

    </div>
  </div>
    
</div>
</header>

 <?php $menu = wp_nav_menu(
    array (
        'theme_location'  => 'primary',
        'echo' => FALSE,
        'fallback_cb' => '__return_false'
    )
 ); 
 if ( ! empty ( $menu ) ):
 ?> 

 <?php if((isset($theme_options['megamenu_hideon_homepage'])) && ($theme_options['megamenu_hideon_homepage']) && is_front_page()):
       else: 
  ?>

  <div id="navbar" class="navbar navbar-default clearfix">
    <div class="navbar-inner">
      <div class="container">
        <?php if(!is_plugin_active('mega_main_menu/mega_main_menu.php')): ?> 
          <div class="navbar-toggle" data-toggle="collapse" data-target=".collapse"><?php _e( 'Menu', 'flatmarket' ); ?></div>       
        <?php endif; ?>      
        <?php wp_nav_menu(array(
            'theme_location'  => 'primary',
            'container_class' => 'navbar-collapse collapse',
            'menu_class'      => 'nav',
            'walker'          => new description_walker
            ));  
        ?>
      </div>
    </div>
  </div>
 <?php endif; ?>

<?php endif; ?>

<?php if(is_front_page()) { ?>
  <div id="navbar" class="navbar navbar-default clearfix">
    <div class="navbar-inner">
      <div class="container">
        <?php if(!is_plugin_active('mega_main_menu/mega_main_menu.php')): ?> 
          <div class="navbar-toggle" data-toggle="collapse" data-target=".collapse"><?php _e( 'Menu', 'flatmarket' ); ?></div>       
        <?php endif; ?>      
        <?php wp_nav_menu(array(
            'theme_location'  => 'primary',
            'container_class' => 'navbar-collapse collapse',
            'menu_class'      => 'nav',
            'walker'          => new description_walker
            ));  
        ?>
      </div>
    </div>
  </div>
<?php } ?>

<div class="main-left-menu">
  <?php echo wp_nav_menu( array( "theme_location" => "left" ) ); ?>
</div>