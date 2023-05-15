<?php

namespace App\Models\security_access;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroupLevelModel extends Model
{
    use HasFactory;
    protected $table='sa_ug_level';
    protected $primaryKey='UG_LEVEL_ID'; 
    protected $protected='sa_ug_level';
    protected $fillable=['UGLEVE_NAME', 'UG_LEVEL_ID','ACTIVE_STATUS','USERGRP_ID'];
}
