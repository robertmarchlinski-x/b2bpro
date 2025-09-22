<?php
namespace B2BP\Core;

/**
 * DB migrations using dbDelta
 */
class Migrations {
    public static function install() {
        global $wpdb;
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        $charset_collate = $wpdb->get_charset_collate();

        $tables = [];

        $tables[] = "CREATE TABLE {$wpdb->prefix}b2bp_price_rules (
          id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
          product_id BIGINT UNSIGNED NOT NULL,
          variation_id BIGINT UNSIGNED NULL,
          role VARCHAR(64) NOT NULL,
          currency CHAR(3) NULL,
          updated_at DATETIME NOT NULL,
          updated_by BIGINT UNSIGNED NULL,
          PRIMARY KEY  (id),
          KEY prd_role (product_id, role),
          KEY var_role (variation_id, role)
        ) $charset_collate;";

        $tables[] = "CREATE TABLE {$wpdb->prefix}b2bp_price_tiers (
          id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
          rule_id BIGINT UNSIGNED NOT NULL,
          min_qty DECIMAL(18,3) NOT NULL,
          price DECIMAL(18,6) NOT NULL,
          PRIMARY KEY  (id),
          KEY rule_min (rule_id, min_qty),
          CONSTRAINT fk_tiers_rule FOREIGN KEY (rule_id) REFERENCES {$wpdb->prefix}b2bp_price_rules(id) ON DELETE CASCADE
        ) $charset_collate;";

        $tables[] = "CREATE TABLE {$wpdb->prefix}b2bp_company_addresses (
          id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
          user_id BIGINT UNSIGNED NOT NULL,
          label VARCHAR(191) NOT NULL,
          first_name VARCHAR(100) NULL,
          last_name VARCHAR(100) NULL,
          company VARCHAR(191) NULL,
          address_1 VARCHAR(191) NOT NULL,
          address_2 VARCHAR(191) NULL,
          city VARCHAR(100) NOT NULL,
          postcode VARCHAR(32) NOT NULL,
          country CHAR(2) NOT NULL,
          state VARCHAR(100) NULL,
          phone VARCHAR(50) NULL,
          is_default TINYINT(1) NOT NULL DEFAULT 0,
          created_at DATETIME NOT NULL,
          updated_at DATETIME NOT NULL,
          PRIMARY KEY  (id),
          KEY user_default (user_id, is_default)
        ) $charset_collate;";

        $tables[] = "CREATE TABLE {$wpdb->prefix}b2bp_consents (
          id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
          user_id BIGINT UNSIGNED NOT NULL,
          consent_key VARCHAR(191) NOT NULL,
          given TINYINT(1) NOT NULL DEFAULT 1,
          text_version VARCHAR(191) NULL,
          timestamp DATETIME NOT NULL,
          PRIMARY KEY (id),
          KEY user_consent (user_id, consent_key)
        ) $charset_collate;";

        foreach ( $tables as $sql ) {
            dbDelta( $sql );
        }
    }
}
