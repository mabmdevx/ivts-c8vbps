<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';
	
	public $primaryKey = 'customer_id';

}
