<?php

namespace App\Models\lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LookupGroupModel extends Model
{
    use HasFactory;
    protected $table='sa_lookup_grp';
    protected $primaryKey='LOOKUP_GRP_ID '; 
    protected $protected='sa_lookup_grp';
    protected $fillable=['LOOKUP_GRP_NAME', 'LOOKUP_GRP_ID','USE_CHAR_NUMB '];
}
