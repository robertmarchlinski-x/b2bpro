<?php
/**
 * Plugin Name: B2B Pro
 * Plugin URI:  https://your-site.example
 * Description: Zaawansowane reguły cenowe B2B dla WooCommerce.
 * Version:     0.1.0
 * Author:      Twoje Imię
 * Text Domain: b2b-pro
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'B2BP_PATH', plugin_dir_path( __FILE__ ) );
define( 'B2BP_FILE', __FILE__ );
define( 'B2BP_VERSION', '0.1.0' );

/** Autoload (composer) */
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/** Bootstrapping minimalne - rejestracja aktywacji/dezaktywacji */
register_activation_hook( __FILE__, function() {
    // tu migracje DB (dbDelta) w przyszłości
    // przykład: create tables
} );

register_deactivation_hook( __FILE__, function() {
    // cleanup opcjonalny
} );

/** Prosty loader assets (admin) */
add_action( 'admin_enqueue_scripts', function( $hook ) {
    $asset = plugin_dir_url( B2BP_FILE ) . 'dist/admin.js';
    if ( file_exists( B2BP_PATH . 'dist/admin.js' ) ) {
        wp_enqueue_script( 'b2bp-admin', $asset, [], B2BP_VERSION, true );
        wp_localize_script( 'b2bp-admin', 'B2BP', [
            'restNonce' => wp_create_nonce( 'wp_rest' ),
            'restUrl' => esc_url_raw( rest_url( 'b2bp/v1/' ) ),
        ] );
    }
} );

/** Example: add admin menu page */
add_action( 'admin_menu', function() {
    add_menu_page( 'B2B Pro', 'B2B Pro', 'manage_options', 'b2bp-dashboard', function() {
        echo '<div id="b2bp-admin-app">B2B Pro admin (wkrótce UI)</div>';
    }, 'dashicons-businessman', 56 );
} );
