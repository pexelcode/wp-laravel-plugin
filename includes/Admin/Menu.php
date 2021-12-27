<?php

namespace CodeEcstasy\Admin;

class Menu {
    public function __construct() {
        add_action( 'admin_menu', [$this, 'admin_menu'] );
    }

    public function admin_menu() {
        add_menu_page( "Code Ecstasy", "Code Ecstasy", "manage_options", "codecstasy", [$this, "plugin_page"], "dashicons-welcome-learn-more" );
    }

    public function plugin_page() {
        echo "Nibir Ahmed";
    }
}
