<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<div>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search for products', 'woocommerce' ); ?>" /><?php
        
            $args = array(
                 'parent'    =>  0
            );
            $product_categories = get_terms( 'product_cat', $args );

        ?><select name="product_cat" >
        <option value='' selected><?php _e( 'כל הקטגוריות', 'flatmarket' ) ?></option>
        <?php foreach( $product_categories as $cat ) {
        echo '<option value="'. $cat->slug .'">' . $cat->name . '</option>';
        }
        ?>
        </select><input type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Search' ); ?>" /><input type="hidden" name="post_type" value="product" />
	</div>
</form>