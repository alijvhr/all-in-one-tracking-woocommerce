<?php

namespace AllInOneTrackingWoocommerce\includes;

class Initializer extends Singleton {


	/** @var $tracker Tracker */
	protected $tracker;

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
		$this->tracker = new Tracker();
		PostScreen::getInstance();
	}


	public function woocommerceNotice() {
		$message = __( 'Please activate woocommerce on your wp installation in order to use All-In-One Tracking WooCommerce plugin', 'all-in-one-tracking-woocommerce' );
		echo "<div class=\"notice notice-error\"><p>$message</p></div>";
	}

	public function loadHooks() {
		add_shortcode( 'woo_aio_track', [ $this, 'tracker_view' ] );
		add_filter( 'woocommerce_get_settings_pages', [ $this, 'addWooSettingSection' ] );
		if ( version_compare( get_option( 'wootaio_version', '0.0.0' ), WOOTAIO_PLUGIN_VERSION, '<' ) ) {
			$this->update();
		}
	}

	public function update() {
		$old_version = get_option( 'wootaio_version', '0.0.0' );
		update_option( 'wootaio_version', WOOTAIO_PLUGIN_VERSION );
	}

	public function tracker_view() {
		if ( isset( $_GET['order'] ) ) {
			$wootaio_order_status = $this->render_status( $_GET['order'] );
		}
		include WOOTAIO_PLUGIN_PATH . "/views/tracker_view.php";
	}

	public function render_status( $order_id ) {
		$this->tracker->set_order( $order_id );
		$template     = get_option( 'wootaio_setting_template' );

		return $this->tracker->interpolate( $template );
	}

	public function addWooSettingSection( $settings ) {
		$settings[] = new OptionPanel();

		return $settings;
	}

	public function deactivate() {

	}
}