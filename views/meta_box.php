<ul class="wootaio-order-tracking">
    <li>
        <label class="wootaio-full-width">
            <span><?= __( 'Shipment Title', 'all-in-one-tracking-woocommerce' ) ?>:</span>
            <input type="text" name="wootaio_tracking_title"
                   value="<?= $meta['tracking.title'] ?? __( 'post', 'all-in-one-tracking-woocommerce' ) ?>">
        </label>
    </li>
    <li>
        <label class="wootaio-full-width">
            <span><?= __( 'Tracking Number', 'all-in-one-tracking-woocommerce' ) ?>:</span>
            <input type="text" name="wootaio_tracking_code" value="<?= $meta['tracking.code'] ?? '' ?>">
        </label>
    </li>
    <li>
        <label class="wootaio-full-width">
            <span><?= __( 'Tracking Link', 'all-in-one-tracking-woocommerce' ) ?>:</span>
            <input type="text" name="wootaio_tracking_raw_link" value="<?= $meta['tracking.raw_link'] ?? '' ?>">
        </label>
    </li>
    <li>
        <label class="wootaio-full-width">
            <span><?= __( 'Shipment Duration', 'all-in-one-tracking-woocommerce' ) ?>:</span>
            <input type="text" name="wootaio_tracking_duration" value="<?= $meta['tracking.duration'] ?? '' ?>">
        </label>
    </li>
</ul>