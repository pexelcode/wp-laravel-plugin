<?php

namespace CodeEcstasy\Admin;

use CodeEcstasy\Models\Addressbook as ModelsAddressbook;

/**
 * Addressbook Handler Class
 */
class Addressbook {

    public $errors = [];

    public function plugin_page() {

        $page = isset( $_GET['action'] ) ? $_GET['action'] : 'list';

        switch ( $page ) {
        case 'new':
            $template = __DIR__ . "/views/addressbook/address-new.php";
            break;

        case 'edit':
            $template = __DIR__ . "/views/addressbook/address-edit.php";
            break;

        case 'view':
            $template = __DIR__ . "/views/addressbook/address-view.php";
            break;

        default:
            $template = __DIR__ . "/views/addressbook/address-list.php";
            break;
        }

        if ( file_exists( $template ) ) {
            include $template;
        }

    }

    public function form_handler() {

        if ( ! isset( $_POST['submit_address'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'new-address' ) ) {
            wp_die( "Are you cheating" );
        }

        if ( ! current_user_can( "manage_options" ) ) {
            wp_die( "Are you cheating" );
        }

        $name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : "";
        $address = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : "";
        $phone   = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : "";

        if ( empty( $name ) ) {
            $this->errors['name'] = "Name is required";
        }

        if ( empty( $phone ) ) {
            $this->errors['phone'] = "Phone no is required";
        }

        if ( ! empty( $this->errors ) ) {
            return;
        }

        $inserted = ModelsAddressbook::create( [
            "name"    => $name,
            "phone"   => $phone,
            "address" => $address,
        ] );

        if ( $inserted->ID == 0 ) {
            wp_die( "Something went wrong!" );
        }

        wp_redirect( admin_url( "admin.php?page=codecstasy&inserted=true" ) );

        exit;

    }

}
