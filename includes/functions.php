<?php


/**
 * Insert a new row of addressbook`
 *
 * @param array $args
 * @return int|WP_Error
 */
function codecstasy_insert_address( $args = [] ) {
    global $wpdb;

    $defaults = [
        "name"       => "",
        "address"    => "",
        "phone"      => "",
        "created_at" => current_time("mysql"),
        "created_by" => get_current_user_id(),
    ];

    $data = wp_parse_args( $args, $defaults );

    if( empty($data['name']) ){
        return new WP_Error('no-name','You must provide a name');
    }

    $inserted = $wpdb->insert(

        "{$wpdb->prefix}ce_addressess",
        $data,
        [
            "%s",
            "%s",
            "%s",
            "%d",
            "%s",
        ]

    );

    if ( ! $inserted ) {
        return new WP_Error( 'failed-to-insert', "Failed to insert data" );
    }
    
    return $wpdb->insert_id;

}
