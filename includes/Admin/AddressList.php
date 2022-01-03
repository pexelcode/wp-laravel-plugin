<?php

namespace CodeEcstasy\Admin;

// if ( ! class_exists("WP_List_Table") ) {

//    require_once ABSPATH . "/wp-admin/includes/class-wp-list-table.php";
// }

use CodeEcstasy\Models\Addressbook;
use WP_List_Table;

/**
 * List table of our addressbook
 */
class AddressList extends WP_List_Table {
    public function __construct() {
        parent::__construct( [
            'singular' => "contant",
            'plural'   => "contacts",
            'ajax'     => false,
        ] );
    }

    public function get_columns() {
        return [
            'cb'         => '<input type="checkbox" />',
            'name'       => "Name",
            'address'    => "Address",
            'phone'      => "Phone",
            'created_at' => "Date",
        ];
    }

    protected function column_default( $item, $column_name ) {
        return $item->$column_name;
    }

    public function column_name( $item ) {

        $actions = [];

        $actions['edit']   = '<a href="' . admin_url( "admin.php?page=codecstasy&action=edit&id=" . $item->id ) . '">Edit</a>';
        $actions['delete'] = '<a onclick="return confirm(\'Are you sure you want to delete this post?\')" href="' . wp_nonce_url( admin_url( "admin-post.php?page=codecstasy&action=addressbook-delete&id=" . $item->id ) , "delete-address-book" ) . '">Delete</a>';

        return "<b><a href='" . admin_url( "admin.php?page=codecstasy&action=edit&id=" . $item->id ) . "'>{$item->name}</a></b>" . $this->row_actions( $actions );
    }

    public function column_cb( $item ) {
        return "<input type='checkbox' name='address_id[]' value='" . $item->id . "'>";
    }

    public function get_sortable_columns() {
        return [
            'name'       => ["name", true],
            'created_at' => ["created_at", true],
        ];
    }

    public function prepare_items() {
        $column   = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [$column, $hidden, $sortable];

        $perpage      = 20;
        $current_page = $this->get_pagenum();
        $offset       = ( $current_page - 1 ) * $perpage;

        if ( isset( $_REQUEST['order'] ) && isset( $_REQUEST['orderby'] ) ) {
            $orderby = $_REQUEST['orderby'];
            $order   = $_REQUEST['order'];
        } else {
            $orderby = "id";
            $order   = "ASC";
        }

        $this->items = Addressbook::offset( $offset )
            ->take( $perpage )
            ->orderby( $orderby, $order )
            ->get();

        $this->set_pagination_args( [
            "total_items" => Addressbook::count(),
            "per_page"    => $perpage,
        ] );
    }

}
