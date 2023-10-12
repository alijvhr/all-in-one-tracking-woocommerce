<style>
    .wootaio-title {
        border-bottom: 1px solid;
    }

    .wootaio-title, .wootaio-content {
        padding: 10px;
    }

    form.wootaio-tracking-form {
        display: block;
        max-width: 700px;
        margin: auto;
        width: 100%;
    }

    .wootaio-input-wrapper span {
        width: 27%;
    }

    .wootaio-input-wrapper, .wootaio-buttons-wrapper {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 10px 5px;
    }

    .wootaio-buttons-wrapper {
        justify-content: center;
    }

    .wootaio-buttons-wrapper > button {
        flex: 1 150px;
        max-width: 200px;
    }

    .wootaio-order-status {
        border: 1px solid #ccc;
        border-radius: 7px;
        padding: 10px;
        background: #EFEFEF;
        box-shadow: 3px 3px 5px #ccc;
        max-width: 700px;
        margin: 10px auto;
        width: 100%;
    }

    .wootaio-input-wrapper .wootaio-input {
        width: 100%;
        max-width: 300px;
        box-shadow: 1px 1px 3px #aaa;
        border-radius: 5px;
        overflow: hidden;
        border: 1px solid;
        direction: ltr;
    }

</style>

<div class="wootaio-view-wrapper">
    <div class="wootaio-box">
        <h4 class="wootaio-title">
			<?= __( 'Order Tracking', 'all-in-one-tracking-woocommerce' ) ?>
        </h4>
        <div class="wootaio-content">
			<?php if ( isset( $wootaio_order_status ) ) { ?>
                <div class="wootaio-order-status">
					<?= $wootaio_order_status ?>
                </div>
			<?php } ?>
            <form class="wootaio-tracking-form" action="" method="get">
                <label class="wootaio-input-wrapper">
                    <span class="wootaio-input-title">
                        <?= __( 'Order ID', 'all-in-one-tracking-woocommerce' ) ?>
                    </span>
                    <input type="text" class="wootaio-input" name="order" value="<?= $_GET['order'] ?? "" ?>" placeholder="<?= __( 'Order ID', 'all-in-one-tracking-woocommerce' ) ?>">
                </label>
                <label class="wootaio-input-wrapper">
                    <span class="wootaio-input-title">
                        <?= __( 'Phone or Email', 'all-in-one-tracking-woocommerce' ) ?>
                    </span>
                    <input type="text" class="wootaio-input" name="phone" value="<?= $_GET['phone'] ?? "" ?>" placeholder="<?= __( 'Phone or Email', 'all-in-one-tracking-woocommerce' ) ?>">
                </label>
                <label class="wootaio-buttons-wrapper">
                    <button class="btn btn-color-primary">بررسی</button>
                </label>
            </form>
        </div>
    </div>
</div>