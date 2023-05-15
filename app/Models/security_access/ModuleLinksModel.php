<?php

namespace App\Models\security_access;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleLinksModel extends Model
{
    use HasFactory;
    protected $protected='SA_MLINKS_ID';
	protected $fillable = ['SA_MLINKS_ID','MODULE_ID','SA_MLINK_NAME','SA_MLINK_PAGES','URL_URI','CREATE','READ','UPDATE','DELETE'];
	protected $primaryKey = 'SA_MLINKS_ID';	
	protected $table='sa_org_mlinks';
}
