<?php
namespace B2BP\Core;

/**
 * Main plugin bootstrap
 */
class Plugin {
    private static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function init() {
        // init components
        add_action( 'init', [ $this, 'on_init' ] );
        add_action( 'rest_api_init', [ $this, 'register_rest_routes' ] );
        add_action( 'admin_menu', [ $this, 'register_admin' ] );

        // load textdomain
        load_plugin_textdomain( 'b2b-pro', false, dirname( plugin_basename( B2BP_FILE ) ) . '/languages' );
    }

    public function on_init() {
        // placeholder
    }

    public function register_rest_routes() {
        if ( class_exists( '\\B2BP\\Api\\RestRoutes' ) ) {
            \\B2BP\\Api\\RestRoutes::register_routes();
        }
    }

    public function register_admin() {
        if ( class_exists( '\\B2BP\\Admin\\AdminPage' ) ) {
            \\B2BP\\Admin\\AdminPage::register();
        }
    }

    public function activate() {
        // run migrations
        if ( class_exists( '\\B2BP\\Core\\Migrations' ) ) {
            \\B2BP\\Core\\Migrations::install();
        }
    }

    public function deactivate() {
        // scheduled jobs cleanup etc (placeholder)
    }
}
