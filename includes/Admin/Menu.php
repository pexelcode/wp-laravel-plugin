<?php

namespace CodeEcstasy\Admin;

class Menu {

    public $addessbook;

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
        $submenu['codecstasy'][] = ['Add new', 'manage_options', admin_url( "admin.php?page=codecstasy&action=new" )];
        add_submenu_page( "codecstasy", "Settings", "Settings", "manage_options", "codecstasy_settings", [$this, "settings_page"] );

    }

    /**
     * Connect the form to it's handlers
     *
     * @return void
     */
    public function dispatch_form_handlers() {
        $this->addressbook = new Addressbook();
        add_action( 'admin_init', [$this->addressbook, 'form_handler'] );
        add_action( 'admin_post_addressbook-delete', [$this->addressbook, 'delete_addressbook'] );
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
