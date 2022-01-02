<?php 

namespace CodeEcstasy\Models;

use WeDevs\ORM\Eloquent\Model;


class Addressbook extends Model {

    /**
     * Name for table without prefix
     *
     * @var string
     */
    protected $table = 'ce_addressess';

    /**
     * Columns that can be edited - IE not primary key or timestamps if being used
     */
    protected $fillable = [
        'name',
        'phone',
        'address'
    ];

    /**
     * Disable created_at and update_at columns, unless you have those.
     */
    public $timestamps = false;

    /** Everything below this is best done in an abstract class that custom tables extend */

    /**
     * Set primary key as ID, because WordPress
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * Make ID guarded -- without this ID doesn't save.
     *
     * @var string
     */
    protected $guarded = [ 'ID' ];

    /**
     * Overide parent method to make sure prefixing is correct.
     *
     * @return string
     */
    public function getTable()
    {
        // In this example, it's set, but this is better in an abstract class
        if ( isset( $this->table ) ){
            $prefix =  $this->getConnection()->db->prefix;
            
            return $prefix . $this->table;
        }

        return parent::getTable();
    }

}