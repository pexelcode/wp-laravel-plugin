<?php

namespace CodeEcstasy;

use CodeEcstasy\Admin\Addressbook;
use CodeEcstasy\Admin\Menu;

class Admin {
    /**
     * Operates all the admin functionalities
     */
    public function __construct() {
        new Menu();
    }
}
