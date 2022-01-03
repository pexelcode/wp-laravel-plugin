<?php

namespace CodeEcstasy\Admin;

use CodeEcstasy\Models\Addressbook as ModelAddressBook;
use CodeEcstasy\Traits\FormError;
use WeDevs\ORM\Eloquent\Facades\DB;

/**
 * Addressbook Handler Class
 */
class Addressbook {

    use FormError;

    /**
     * Shows the plugin template
     *
     * @return void
     */
    public function plugin_page() {

        $page = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id   = isset( $_GET['id'] ) ? $_GET['id'] : 0;

        switch ( $page ) {
        case 'new':
            $template = __DIR__ . "/views/addressbook/address-new.php";
            break;

        case 'edit':
            $address  = ModelAddressBook::findOrFail( $id );
            $template = __DIR__ . "/views/addressbook/address-edit.php";
            break;

        case 'view':
            $template = __DIR__ . "/views/addressbook/address-view.php";
            break;

        case 'relation':
            var_dump( ModelAddressBook::findOrFail( 1 )->ce_relation->first()->name );
            die;
            break;

        default:
            $template = __DIR__ . "/views/addressbook/address-list.php";
            break;
        }

        if ( ! file_exists( $template ) ) {
            wp_die( "File not found" );
        }

        include $template;

    }

    /**
     * Add address form handler
     *
     * @return void
     */
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

        $id      = isset( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
        $name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : null;
        $address = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : null;
        $phone   = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : null;

        if ( empty( $name ) ) {
            $this->errors['name'] = "Name is required";
        }

        if ( empty( $phone ) ) {
            $this->errors['phone'] = "Phone no is required";
        }

        if ( ! empty( $this->errors ) ) {
            return;
        }

        if ( $id ) {

            $data = [
                "name"    => $name,
                "address" => $address,
                "phone"   => $phone,
            ];

            $updated = ModelAddressBook::where( "id", $id )->update( $data );

            if ( ! $updated ) {
                wp_die( "Update failed" );
            }

            wp_redirect( admin_url( "admin.php?page=codecstasy&action=edit&updated-record=true&id=" . $id ) );

        } else {

            $inserted = ModelAddressBook::create( [
                "name"       => $name,
                "phone"      => $phone,
                "address"    => $address,
                "created_by" => get_current_user_id(),
            ] );

            if ( $inserted->ID == 0 ) {
                wp_die( "Something went wrong!" );
            }

            wp_redirect( admin_url( "admin.php?page=codecstasy&inserted=true" ) );

        }

        exit;

    }

    /**
     * Delete Addressbook
     *
     * @return void
     */
    public function delete_addressbook() {

        if ( ! isset( $_REQUEST['action'] ) && $_REQUEST['delete-address-book'] != "addressbook-delete" ) {
            return;
        }

        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'delete-address-book' ) ) {
            wp_die( "Are you cheating" );
        }

        if ( ! current_user_can( "manage_options" ) ) {
            wp_die( "Are you cheating" );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        if ( ! $id ) {
            wp_die( "Something is wrong" );
        }
        
        $deleted = ModelAddressBook::where( "id", $id )->delete();

        if ( ! $deleted ) {
            wp_die( "Something is wrong" );
        }

        wp_redirect( admin_url( "admin.php?page=codecstasy&deleted-record=true" ) );

    }

}
