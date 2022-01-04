<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e( "Edit Address", CE_TD )?></h1>

    <hr class="wp-header-end">

    <?php if( isset($_GET['updated-record']) ) : ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( 'Updated Successfully!', CE_TD ); ?></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <table class="form-table">

            <tr>
                <th>
                    <label for="name">Name</label>
                </th>
                <td>
                    <input type="text" name="name" class="regular-text" id="name" value="<?php echo esc_attr( $address->name ) ?>">
                    <?php if ( $this->has_error( "name" ) ): ?>
                            <p style="color:red"><?php echo $this->get_error( "name" ) ?></p>
                    <?php endif;?>
                </td>
            </tr>

            <tr>
                <th>
                    <label for="address">Address</label>
                </th>
                <td>
                    <textarea type="textarea" name="address" class="regular-text"
                        id="address"><?php echo isset( $address['address'] ) ? esc_attr( $address->address ) : ""; ?>
                    </textarea>
                </td>
            </tr>

            <tr>
                <th>
                    <label for="phone">Phone Number</label>
                </th>
                <td>
                    <input type="text" name="phone" class="regular-text" id="phone" value="<?php echo esc_attr( $address->phone ) ?>">
                        <?php if ( $this->has_error( "phone" ) ): ?>
                            <p style="color:red"><?php _e( $this->get_error( "phone" ), CE_TD ) ?></p>
                        <?php endif; ?>
                </td>
            </tr>

        </table>

        <input type="hidden" name="action" value="create_new_address">
        <input type="hidden" name="id" value="<?php esc_attr( _e( $address->id, CE_TD ) )?>">
        <?php
            wp_nonce_field( "new-address" );
            submit_button( "Update Address", "primary", "submit_address" )
        ?>
    </form>

</div>