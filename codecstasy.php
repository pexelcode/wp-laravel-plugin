<?php

/**
 * Plugin Name:       Code Ecstasy
 * Plugin URI:        https://codecstasy.com
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Code Ecstasy
 * Author URI:        https://codecstasy.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://codecstasy.com
 * Text Domain:       codecstasy
 * Domain Path:       /languages
 */

use CodeEcstasy\Admin;
use CodeEcstasy\Admin\Installer;
use CodeEcstasy\Frontend;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . "/vendor/autoload.php";

/**
 * 
 * Main Plugin Class
 * 
 */
final class CodeEcstasy {

    const version = '1.0.0';

    /**
     * Constructor
     * 
     * @return void
     */
    private function __construct() {
        $this->define_constants();

        register_activation_hook( __FILE__, [$this, 'activate'] );

        add_action( 'plugins_loaded', [$this, 'init_plugin'] );
    }

    /**
     * Initializes the plugin
     *
     * @return void
     */     
    public function init_plugin() {

        if ( is_admin() ) {
            new Admin();
        }else{
            new Frontend();
        }

        
    }

    /**
     * Initializing the plugin singleton instance
     *
     * @return \CodeEcstasy
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Defining Constants
     * 
     * @return void
     */
    public function define_constants() {
        define( 'CODE_ECSTASY_VERSION', self::version );
        define( 'CODE_ECSTASY_FILE', __FILE__ );
        define( 'CODE_ECSTASY_PATH', __DIR__ );
        define( 'CODE_ECSTASY_URL', plugins_url( '', CODE_ECSTASY_FILE ) );
        define( 'CODE_ECSTASY_ASSETS', CODE_ECSTASY_URL . '/assets' );
    }

    /**
     * Do things while activating the plugin
     *
     * @return void
     */
    public function activate() {
        $installer = new Installer();
        
        $installer->add_version();
        $installer->create_tables();

    }

}

/**
 * Run the plugin
 *
 * @return void
 */
function code_ecstasy() {
    return CodeEcstasy::init();
}

// Kick start the plugin
code_ecstasy();
