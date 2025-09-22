<?php
/**
 * Plugin Name: B2B Pro
 * Plugin URI:  https://example.com
 * Description: Zaawansowane reguły cenowe B2B dla WooCommerce (szkielet).
 * Version:     0.1.0
 * Author:      Your Name
 * Text Domain: b2b-pro
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'B2BP_PATH', plugin_dir_path( __FILE__ ) );
define( 'B2BP_FILE', __FILE__ );
define( 'B2BP_VERSION', '0.1.0' );

// Prefer composer autoload, otherwise use builtin PSR-4 loader for src/
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    // Simple PSR-4-ish autoloader for the B2BP\ namespace -> src/
    spl_autoload_register( function( $class ) {
        $prefix = 'B2BP\\';
        $base_dir = __DIR__ . '/src/';
        $len = strlen( $prefix );
        if ( strncmp( $prefix, $class, $len ) !== 0 ) {
            return;
        }
        $relative_class = substr( $class, $len );
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        if ( file_exists( $file ) ) {
            require_once $file;
        }
    } );
}

// Bootstrap plugin
add_action( 'plugins_loaded', function() {
    if ( class_exists( '\B2BP\Core\Plugin' ) ) {
        \B2BP\Core\Plugin::instance()->init();
    }
} );

register_activation_hook( __FILE__, function() {
    if ( class_exists( '\B2BP\Core\Plugin' ) ) {
        \B2BP\Core\Plugin::instance()->activate();
    }
} );

register_deactivation_hook( __FILE__, function() {
    if ( class_exists( '\B2BP\Core\Plugin' ) ) {
        \B2BP\Core\Plugin::instance()->deactivate();
    }
} );
