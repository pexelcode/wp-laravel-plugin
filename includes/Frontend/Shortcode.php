<?php

namespace CodeEcstasy\Frontend;

class Shortcode {

    /**
     * Initializes the shortcode class
     */
    public function __construct() {
        add_shortcode( "codecstasy", [$this, "render_codecstasy_shortcode"] );
    }

    /**
     * Shortcode Handler Class
     *
     * @param array $atts
     * @param string $content
     * 
     * @return void
     */
    public function render_codecstasy_shortcode( $atts, $content = "" ) {
        echo "Hello From Shortcode";
    }
}