<?php
namespace B2BP\Api;

class RestRoutes {
    public static function register_routes() {
        register_rest_route( 'b2bp/v1', '/ping', [
            'methods' => 'GET',
            'callback' => [ __CLASS__, 'ping' ],
            'permission_callback' => '__return_true'
        ] );
    }

    public static function ping( $request ) {
        return rest_ensure_response( [
            'ok' => true,
            'version' => B2BP_VERSION,
            'time' => current_time( 'mysql' )
        ] );
    }
}
