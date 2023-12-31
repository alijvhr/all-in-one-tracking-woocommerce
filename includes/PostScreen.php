<?php

namespace AllInOneTrackingWoocommerce\includes;

class PostScreen extends Singleton {

	/** @var $tracker Tracker */
	protected $tracker;

	public function init() {
		add_action( 'load-post.php', [ $this, 'load' ] );
		add_action( 'load-post-new.php', [ $this, 'load' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'meta_box_style' ] );
		add_action( 'save_post', [ $this, 'save' ] );
		$this->tracker = new Tracker();
	}

	public function load() {
		add_action( 'add_meta_boxes_shop_order', [ $this, 'add_meta_box' ] );
	}

	public function add_meta_box( \WP_Post $post ) {
		add_meta_box(
			'wootaio-order-tracking',
			__( 'Order Tracking', 'all-in-one-tracking-woocommerce' ),
			[ $this, 'render_meta_box' ],
			'shop_order',
			'side',
			'high'
		);
	}

	public function save( $post_id ) {

		if ( ! wp_verify_nonce( $_POST['wootaio_nonce'] ?? '', 'wootaio' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$data = [
			'title'    => sanitize_text_field( $_POST['wootaio_tracking_title'] ),
			'code'     => sanitize_text_field( $_POST['wootaio_tracking_code'] ),
			'raw_link'     => sanitize_text_field( $_POST['wootaio_tracking_raw_link'] ),
			'duration' => sanitize_text_field( $_POST['wootaio_tracking_duration'] )
		];

		$this->tracker->set_order(get_the_ID());
		$this->tracker->set_data( $data );

	}

	public function render_meta_box() {
		wp_nonce_field( 'wootaio', 'wootaio_nonce' );
		$this->tracker->set_order(get_the_ID());
		$meta = $this->tracker->get_data();
		include WOOTAIO_PLUGIN_PATH . "/views/meta_box.php";
	}


	public function meta_box_style() {
		wp_register_style( 'wootaio_css_script', plugin_dir_url( __FILE__ ) . '../assets/css/admin.css', false, '1.2' );
		wp_enqueue_style( 'wootaio_css_script' );
	}

}