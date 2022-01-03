<div class="wrap">

    <h1 class="wp-heading-inline"><?php _e( "Addressbook", "codecstasy" )?></h1>
    <a class="page-title-action"
        href="<?php echo admin_url( "admin.php?page=codecstasy&action=new" ) ?>">
        Add New
    </a>

    <hr class="wp-header-end">

        <?php if ( isset( $_GET['inserted'] ) ): ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e( 'Created Successfully!', 'codecstasy' );?></p>
            </div>
        <?php endif; ?>

        <?php if ( isset( $_GET['deleted-record'] ) ): ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e( 'Deleted Successfully!', 'codecstasy' );?></p>
            </div>
        <?php endif;?>

        <form action="" method="POST">
            <?php
                $table = new CodeEcstasy\Admin\AddressList();
                $table->prepare_items();
                $table->display();
            ?>
        </form>

</div>