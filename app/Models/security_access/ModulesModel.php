<?php

namespace App\Models\security_access;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulesModel extends Model
{
    use HasFactory;
	protected $protected='MODULE_ID';
	protected $fillable = ['MODULE_ID','MODULE_NAME','SHORT_NAME','SL_NO','MODULE_NAME_BN'];
	protected $primaryKey = 'MODULE_ID';	
	protected $table='sa_modules';


}
