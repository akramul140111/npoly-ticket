<?php

namespace App\Models\lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookupGroupDataModel extends Model
{
    use HasFactory;
    protected $table='sa_lookup_data';
    protected $primaryKey='LOOKUP_DATA_ID'; 
    protected $protected='sa_lookup_data';
    protected $fillable=['LOOKUP_DATA_ID', 'LOOKUP_GRP_ID','LOOKUP_DATA_NAME','CHAR_LOOKUP','CHAR_LOOKUP'];
}
