<?php

namespace CodeEcstasy;

use CodeEcstasy\Frontend\Shortcode;

class Frontend {
    /**
     * Operates all the frontend functionalities like adding shortcode
     */
    public function __construct() {
        new Shortcode();
    }
}
