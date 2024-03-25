<?php

if ( $tracking_items ) : ?>

    <?php
    foreach ( $tracking_items as $tracking_item ) : ?>

        <p dir="rtl" style="text-align:right;">הזמנתך נשלח ב <?php echo date( 'Y-m-d', $tracking_item[ 'date_shipped' ] ); ?> דרך דואר ישראל. דואר רשום מספר: <?php echo esc_html( $tracking_item[ 'tracking_number' ] ); ?>.<br/>
            <?php
            if ( $tracking_item[ 'formatted_tracking_link' ] ) : ?>
                <a href="<?php echo esc_url( $tracking_item[ 'formatted_tracking_link' ] ); ?>" target="_blank">הקליקי כאן כדי לעקוב אחרי המשלוח.</a>
            <?php endif; ?>
        </p>

    <?php endforeach; ?>

<?php endif;