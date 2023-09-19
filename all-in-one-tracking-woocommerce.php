<?php


/**
 * All-In-One Tracking WooCommerce
 *
 * @package AllInOneTrackingWoocommerce
 * @version 1.0.0
 * @license GPL-2.0-or-later
 * @author  Ali Javaheri
 *
 * @wordpress-plugin
 * Plugin Name: All-In-One Tracking WooCommerce
 * Description: A simple order tracking plugin for woocommerce
 * Author: Ali Javaheri
 * Version: 1.0.0
 * Author URI: https://alijvhr.com
 * Requires at least: 5.2
 * Requires PHP: 7.3
 * WC requires at least: 3.2
 * WC tested up to: 7.9
 * Text Domain: all-in-one-tracking-woocommerce
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace AllInOneTrackingWoocommerce;

use AllInOneTrackingWoocommerce\includes\Initializer;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WOOTAIO_PLUGIN_VERSION', '1.0.0' );

function wootaio_auto_loader( $class ) {
	if ( substr( $class, 0, 27 ) == 'AllInOneTrackingWoocommerce' ) {
		require __DIR__ . str_replace( '\\', DIRECTORY_SEPARATOR, substr( $class, 27 ) ) . '.php';
	}
}

spl_autoload_register( 'AllInOneTrackingWoocommerce\\wootaio_auto_loader', true, true );

define( 'WOOTAIO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WOOTAIO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WOOTAIO_PLUGIN_DIR', __DIR__ );
define( 'WOOTAIO_PLUGIN_ICON', plugins_url( "images/ic.png", __FILE__ ) );

/**@var Initializer $wootaio */

$wootaio   = Initializer::getInstance();

register_deactivation_hook( __FILE__, [ $wootaio, 'deactivate' ] );
