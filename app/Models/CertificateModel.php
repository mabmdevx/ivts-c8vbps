<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateModel extends Model{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'certificates';
	
	public $primaryKey = 'certificate_id';

}
