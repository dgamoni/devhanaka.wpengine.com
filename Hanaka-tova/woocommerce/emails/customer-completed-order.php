<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<div dir="rtl">

<p style="text-align:right;">אנו שמחים לעדכן אותך שהמוצרים הבאים נשלחו אליך דרך דואר רשום:</p>

<?php

/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @since 2.5.0
 **/
 
 /*Removing Email Order Details Table -- August 10, 2016 */

do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );
/*

/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

?>

<p style="text-align:right;">אנו מקווים שנהנית מחוויית הקניה. וכן שתתאהבי במוצרים עם קבלתם. במידה ויש לך שאלות או בירורים בנוגע לרכישתך, אנא צרי איתנו קשר, ונשמח לעמוד לשירותך. <br /><br />בברכה<br />
	
	אריאלה וצוות 'הנקה טובה׳
</p>

</div>

<?php

/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
