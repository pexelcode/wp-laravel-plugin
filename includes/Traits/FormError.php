<?php 

namespace CodeEcstasy\Traits;


/**
 * The Form Error Trait
 */
trait FormError{

    /**
     * Holds all the errors
     *
     * @var array
     */
    public $errors = [];

    /**
     * Check if has error
     *
     * @param string $name
     * @return boolean
     */
    public function has_error( $name ) {
        return isset( $this->errors[$name] ) ? true : false;
    }

    /**
     * Get the error
     *
     * @param string $name
     * @return Error|false
     */
    public function get_error( $name ) {
        return isset( $this->errors[$name] ) ? $this->errors[$name] : false;
    }
}

