<?php
namespace B2BP\Admin;

class AdminPage {
    public static function register() {
        add_menu_page( 'B2B Pro', 'B2B Pro', 'manage_options', 'b2bp-dashboard', [ __CLASS__, 'render' ], 'dashicons-businessman', 56 );
    }

    public static function render() {
        echo '<div id="b2bp-admin-app">';
        echo '<h1>B2B Pro</h1>';
        echo '<div x-data="{msg:\'Witaj w B2B Pro!\'}">';
        echo '<h2 x-text="msg"></h2>';
        echo '</div>';
        echo '</div>';
    }
}
