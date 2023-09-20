<ul class="wootaio-order-tracking">
    <li>
        <label class="wootaio-full-width">
            <span><?= __( 'Shipment Title', 'all-in-one-tracking-woocommerce' ) ?>:</span>
            <input type="text" name="wootaio_tracking_title"
                   value="<?= $meta['wootaio_tracking_title'][0] ?? __( 'post', 'all-in-one-tracking-woocommerce' ) ?>">
        </label>
    </li>
    <li>
        <label class="wootaio-full-width">
            <span><?= __( 'Tracking Number', 'all-in-one-tracking-woocommerce' ) ?>:</span>
            <input type="text" name="wootaio_tracking_code" value="<?= $meta['wootaio_tracking_code'][0] ?? '' ?>">
        </label>
    </li>
    <li>
        <label class="wootaio-full-width">
            <span><?= __( 'Tracking Link', 'all-in-one-tracking-woocommerce' ) ?>:</span>
            <input type="text" name="wootaio_tracking_link" value="<?= $meta['wootaio_tracking_link'][0] ?? '' ?>">
        </label>
    </li>
    <li>
        <label class="wootaio-full-width">
            <span><?= __( 'Shipment Duration', 'all-in-one-tracking-woocommerce' ) ?>:</span>
            <input type="text" name="wootaio_tracking_duration" value="<?= $meta['wootaio_tracking_duration'][0] ?? '' ?>">
        </label>
    </li>
</ul>