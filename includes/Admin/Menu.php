<?php

namespace CodeEcstasy\Admin;

use CodeEcstasy\Admin\Controllers\Addressbook;

class Menu {

    public $addessbook;

    /**
     * Initializin the menu
     */
    public function __construct() {

        add_action( 'admin_menu', [$this, 'admin_menu'] );

        $this->dispatch_form_handlers();
    }

    /**
     * Add menu and submenu pages
     *
     * @return void
     */
    public function admin_menu() {

        global $submenu;

        add_menu_page( "Code Ecstasy", "Code Ecstasy", "manage_options", "codecstasy", [$this, "address_book_page"], "dashicons-welcome-learn-more" );
        add_submenu_page( "codecstasy", "Address Book", "Address Book", "manage_options", "codecstasy", [$this, "address_book_page"] );
        add_submenu_page( "codecstasy", "Settings", "Settings", "manage_options", "codecstasy_settings", [$this, "settings_page"] );

    }

    /**
     * Connect the form to it's handlers
     * 
     * First initialize the class and connect it to the form handler
     *
     * @return void
     */
    public function dispatch_form_handlers() {

        // Addressbook from handler

        $this->addressbook = new Addressbook();
        add_action( 'admin_init', [$this->addressbook, 'form_handler'] );

    }

    /**
     * Addressbook Page
     *
     * @return void
     */
    public function address_book_page() {
        $this->addressbook->plugin_page();
    }

    /**
     * Settings page
     *
     * @return void
     */
    public function settings_page() {
        echo "<div class='wrap'><h1>Settings</h1></div>";
    }
}
