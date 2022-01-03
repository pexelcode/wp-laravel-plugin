<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e( "New Address", "codecstasy" )?></h1>
    <form method="POST" action="">
        <table class="form-table">

            <tr>
                <th>
                    <label for="name">Name</label>
                </th>
                <td>
                    <input type="text" name="name" class="regular-text" id="name">
                    <?php if ( $this->has_error("name") ) : ?>
                            <p style="color:red"><?php echo $this->get_error("name") ?></p>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <th>
                    <label for="address">Address</label>
                </th>
                <td>
                    <textarea type="textarea" name="address" class="regular-text" id="address"></textarea>
                </td>
            </tr>

            <tr>
                <th>
                    <label for="phone">Phone Number</label>
                </th>
                <td>
                    <input type="text" name="phone" class="regular-text" id="phone">
                    <?php if ( $this->has_error("phone") ) : ?>
                            <p style="color:red"><?php echo $this->get_error("phone") ?></p>
                    <?php endif; ?>
                </td>
            </tr>

        </table>

        <input type="hidden" name="action" value="create_new_address">
        <?php
            wp_nonce_field( "new-address" );
            submit_button( "Add Address", "primary", "submit_address" )
        ?>
    </form>

</div>