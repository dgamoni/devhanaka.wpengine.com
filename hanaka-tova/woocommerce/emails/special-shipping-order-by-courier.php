<?php
/**
 * Customer processing order email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php do_action('woocommerce_email_header', $email_heading); ?>

<div dir="rtl">
	<p><?php _e( "אנו שמחים לעדכן אותך שהמוצרים הבאים נשלחו אליך.", 'woocommerce' ); ?></p>
	<p><?php printf ( __( "ההזמנה נשלח ב-<time datetime='%s'>%s</time> עם שליח עד הבית.777", 'woocommerce' ), date_i18n( 'c', strtotime( $order->get_date_created()  ) ), date_i18n( wc_date_format(), strtotime( $order->get_date_created() ) ) ); ?></p>

	<?php// do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text ); ?>

	<h2><?php printf( __( '&#1492;&#1494;&#1502;&#1504;&#1492; #%s', 'woocommerce' ), $order->get_order_number() ); ?></h2>

	<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
		<thead>
			<tr>
				<th scope="col" style="text-align:right; border: 1px solid #eee;"><?php _e( '&#1502;&#1493;&#1510;&#1512;', 'woocommerce' ); ?></th>
				<th scope="col" style="text-align:right; border: 1px solid #eee;"><?php _e( '&#1499;&#1502;&#1493;&#1514;', 'woocommerce' ); ?></th>
				<th scope="col" style="text-align:right; border: 1px solid #eee;"><?php _e( '&#1502;&#1495;&#1497;&#1512;', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php echo $order->email_order_items_table( $order->is_download_permitted(), true, $order->has_status( 'processing' ) ); ?>
		</tbody>
		<tfoot>
			<?php
				if ( $totals = $order->get_order_item_totals() ) {
					$i = 0;
					foreach ( $totals as $total ) {
						$i++;
						?><tr>
							<th scope="row" colspan="2" style="text-align:right; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
							<td style="text-align:right; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['value']; ?></td>
						</tr><?php
					}
				}
			?>
		</tfoot>
	</table>

	<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text ); ?>

	<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text ); ?>

	<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text ); ?>

	<p><?php _e( 'אנו מקווים שנהנית מחוויית הקניה. וכן שתתאהבי במוצרים עם קבלתם. במידה ויש לך שאלות או בירורים בנוגע לרכישתך, אנא צרי איתנו קשר, ונשמח לעמוד לשירותך.', 'woocommerce' ); ?></p>

	<p>,בברכה
	<br />
	אריאלה דובראוין וצוות ׳הנקה טובה׳</p>

</div>

<?php do_action( 'woocommerce_email_footer' ); ?>
