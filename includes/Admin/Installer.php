<?php

namespace CodeEcstasy\Admin;

/**
 * Admin Installer Class
 */
class Installer {

    /**
     * Add versioning
     *
     * @return void
     */
    public function add_version() {
        update_option( 'code_ecstasy_version', CODE_ECSTASY_VERSION );

        $installed = get_option( 'code_ecstasy_installed' );

        if ( ! $installed ) {
            update_option( 'code_ecstasy_installed', time() );
        }

    }

    /**
     * Create Database tables when activating the plugin
     *
     * @return void
     */
    public function create_tables() {
        global $wpdb;

        $collate = $wpdb->get_charset_collate();

        $schema = "Your create sql";

        if ( ! function_exists( "dbDelta" ) ) {
            require_once ABSPATH . "/wp-admin/includes/upgrade.php";
        }

        // dbDelta( $schema );
    }

}
