<?php

namespace CodeEcstasy\Admin\Controllers;

use CodeEcstasy\Traits\FormError;

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

        // Routing with query variable action
        $page = isset($_GET['action']) ? $_GET['action'] : 'list';

        switch ( $page ) {
            case 'new':
                $template = CODE_ECSTASY_PATH . "/includes/admin/views/my-file.php";
                break;

            case 'edit':
                $template = CODE_ECSTASY_PATH . "/includes/admin/views/my-file.php";
                break;

            case 'view':
                $template = CODE_ECSTASY_PATH . "/includes/admin/views/my-file.php";
                break;

            default:
                $template = CODE_ECSTASY_PATH . "/includes/admin/views/my-file.php";
                break;
        }

        if ( ! file_exists( $template ) ) {
            wp_die( "File not found" );
        }

        include $template;
    }

    /**
     * Form Handler
     *
     * @return void
     */
    public function form_handler() {
        // Handle your form
    }

}
