<?php

namespace AllInOneTrackingWoocommerce\includes;

class PostScreen {

	public function init(){
		add_action( 'load-post.php', [ $this, 'load' ] );
		add_action( 'load-post-new.php', [ $this, 'load' ] );
		add_action('admin_enqueue_scripts', [$this, 'meta_box_style' ]);
	}
	public function load() {
		add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
	}

	public function add_meta_box() {
		add_meta_box(
			'wootaio-order-tracking',
			esc_html__( 'Order Tracking', 'example' ),
			[ $this, 'render_meta_box' ],
			'shop_order',
			'side',
			'high'
		);
	}

	public function render_meta_box() {
		include WOOTAIO_PLUGIN_PATH."/views/meta_box.php";
	}


	public function meta_box_style()
	{
		wp_register_style('wootaio_css_script', plugin_dir_url(__FILE__) . '../assets/css/admin.css', false, '1.2');
		wp_enqueue_style('wootaio_css_script');
	}

}