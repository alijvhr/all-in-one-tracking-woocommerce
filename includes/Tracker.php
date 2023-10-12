<?php

namespace AllInOneTrackingWoocommerce\includes;

class Tracker {
	/** @var $order \WC_Order */
	protected $order;
	protected $order_id;

	protected $data;

	protected $pattern = '/\{([\w.]++)}/m';

	public function set_order( $order_id ) {
		try {
			$this->order = new \WC_Order( $order_id );
		} catch ( \Exception $e ) {
			return false;
		}
		$this->order_id = $order_id;
		$this->data     = null;

		return true;
	}

	public function interpolate( $message ) {
		$this->get_data();
		$undefined = __( 'Undefined', 'all-in-one-tracking-woocommerce' );
		while ( preg_match( '#{([\w.]++)}(.+){/\1}#ism', $message , $match) ) {
			$message = str_replace( $match[0], isset( $this->data[ $match[1] ] ) ? $match[2] : '', $message );
		}
		foreach ( $this->data as $key => $val ) {
			$message = str_replace( '{' . $key . '}', $val ?: $undefined, $message );
		}

		return preg_replace( $this->pattern, $undefined, nl2br( $message ) );
	}

	public function get_data() {
		if ( isset( $this->data ) ) {
			return $this->data;
		}
		$meta         = get_post_meta( $this->order_id );
		$wootaio_meta = [];
		foreach ( $meta as $key => $value ) {
			if ( substr( $key, 0, 17 ) == "wootaio_tracking_" ) {
				$wootaio_meta[ 'tracking.' . substr( $key, 17 ) ] = $value[0] ?? null;
			}
		}
		if ( isset( $wootaio_meta['tracking.code'] ) ) {
			$wootaio_meta['tracking.link'] = str_replace( '{code}', $wootaio_meta['tracking.code'], $wootaio_meta['tracking.raw_link'] );
		}
		$wootaio_meta['order.id']     = $this->order_id;
		$wootaio_meta['order.status'] = wc_get_order_status_name( $this->order->get_status() );
		$wootaio_meta['order.phone']  = $this->order->get_billing_phone();
		$wootaio_meta['order.email']  = $this->order->get_billing_email();
		$wootaio_meta['order.icon']   = [
			'processing' => '🕙',
			'completed'  => '✅',
			'cancelled'  => '❌',
			'refunded'   => '💸'
		][ $this->order->get_status() ];

		$this->data = $wootaio_meta;

		return $wootaio_meta;
	}

	public function set_data( $data ) {
		foreach ( $data as $key => $value ) {
			update_post_meta( $this->order_id, "wootaio_tracking_$key", $value );
		}
	}

}