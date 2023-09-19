<?php

namespace AllInOneTrackingWoocommerce\includes;

class Initializer extends Singleton {

	function init() {
		$path = dirname( plugin_basename( __FILE__ ), 2 );
		load_plugin_textdomain( 'all-in-one-tracking-woocommerce', false, "$path/languages/" );
		$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );

		if ( in_array( 'woocommerce/woocommerce.php', $active_plugins ) ) {
			$this->run();
		} else {
			add_action( 'admin_notices', [ $this, 'woocommerceNotice' ] );
		}
	}

	private function run() {
		add_action( 'plugins_loaded', [ $this, 'loadHooks' ], 26 );
		$post_screen = new PostScreen();
		$post_screen->init();
	}


	public function woocommerceNotice() {
		$message = __( 'Please activate woocommerce on your wp installation in order to use All-In-One Tracking WooCommerce plugin', 'all-in-one-tracking-woocommerce' );
		echo "<div class=\"notice notice-error\"><p>$message</p></div>";
	}

	public function loadHooks() {
		if ( version_compare( get_option( 'wootaio_version', '0.0.0' ), WOOTAIO_PLUGIN_VERSION, '<' ) ) {
			$this->update();
		}
	}

	public function update() {
		$old_version = get_option( 'wootaio_version', '0.0.0' );
		update_option( 'wootaio_version', WOOTAIO_PLUGIN_VERSION );
	}

	public function deactivate() {

	}
}