<?php
/**
 * Plugin Name: Ultimate Blocks
 * Plugin URI: http://ultimateblocks.io
 * Description: Ultimate Blocks for Gutenberg.
 * Author: Imtiaz Rayhan
 * Author URI: http://imtiazrayhan.com/
 * Version: 1.0.3
 * License: GPL3+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: ultimate-blocks
 * Domain Path: /languages
 *
 * @package UB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once 'includes/class-ultimate-blocks-constants.php';

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'ULTIMATE_BLOCKS_VERSION', Ultimate_Blocks_Constants::plugin_version() );
/**
 * Plugin Name
 */
define( 'ULTIMATE_BLOCKS_NAME', Ultimate_Blocks_Constants::plugin_name() );
/**
 * Plugin Path
 */
define( 'ULTIMATE_BLOCKS_PATH', Ultimate_Blocks_Constants::plugin_path() );
/**
 * Plugin URL
 */
define( 'ULTIMATE_BLOCKS_URL', Ultimate_Blocks_Constants::plugin_url() );
/**
 * Plugin TextDomain
 */
define( 'ULTIMATE_BLOCKS_TEXT_DOMAIN', Ultimate_Blocks_Constants::text_domain() );


/**
 * Create a helper function for easy SDK access.
 *
 * @return Freemius
 */
function ub_fs() {
	global $ub_fs;

	if ( ! isset( $ub_fs ) ) {
		// Include Freemius SDK.
		require_once dirname( __FILE__ ) . '/freemius/start.php';

		$ub_fs = fs_dynamic_init( array(
			'id'             => '1798',
			'slug'           => 'ultimate-blocks',
			'type'           => 'plugin',
			'public_key'     => 'pk_bd3d3c8e255543256632fd4bb9842',
			'is_premium'     => false,
			'has_addons'     => false,
			'has_paid_plans' => false,
			'menu'           => array(
				'first-path' => 'plugins.php',
				'account'    => false,
				'contact'    => false,
			),
		) );
	}

	return $ub_fs;
}

// Init Freemius.
ub_fs();
// Signal that SDK was initiated.
do_action( 'ub_fs_loaded' );

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ultimate-blocks-activator.php
 */
function activate_ultimate_blocks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-blocks-activator.php';
	Ultimate_Blocks_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ultimate-blocks-deactivator.php
 */
function deactivate_ultimate_blocks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-blocks-deactivator.php';
	Ultimate_Blocks_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ultimate_blocks' );
register_deactivation_hook( __FILE__, 'deactivate_ultimate_blocks' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-blocks.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.2
 */
function run_ultimate_blocks() {

	$plugin = new Ultimate_Blocks();
	$plugin->run();

}
run_ultimate_blocks();
