<?php

namespace CodeEcstasy;

/**
 * Asset loading
 */
class Assets {

    /**
     * Calling the hook to enqueue
     */
    public function __construct() {
        add_action("wp_enqueue_scripts",[$this,"enqueue"]);
    }

    /**
     * Calling the script and style enqueuer
     */
    public function enqueue() {
        $this->enqueue_styles();
        $this->enqueue_scripts();
    }

    /**
     * Enqueueing styles
     *
     * @return void
     */
    public function enqueue_styles() {
        // wp_enqueue_style();
    }

    /**
     * Enqueueing scripts
     *
     * @return void
     */
    public function enqueue_scripts() {
        // wp_enqueue_script();
    }
}