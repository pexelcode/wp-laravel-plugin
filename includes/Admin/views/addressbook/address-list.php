<div class="wrap">

    <h1 class="wp-heading-inline"><?php _e( "Addressbook", CE_TD )?></h1>
    <a class="page-title-action"
        href="<?php echo admin_url( "admin.php?page=codecstasy&action=new" ) ?>">
        Add New
    </a>

    <hr class="wp-header-end">

        <?php if ( isset( $_GET['inserted'] ) ): ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e( 'Created Successfully!', CE_TD );?></p>
            </div>
        <?php endif; ?>

        <?php if ( isset( $_GET['deleted-record'] ) ): ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e( 'Deleted Successfully!', CE_TD );?></p>
            </div>
        <?php endif;?>

        <form action="" method="POST">
            <?php
                $table = new CodeEcstasy\Admin\Controllers\ListTables\AddressList();
                $table->prepare_items();
                // $table->search_box("Search","search_id");
                $table->display();
            ?>
        </form>

</div>