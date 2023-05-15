<?php

namespace App\Models\security_access;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupsModel extends Model
{
    use HasFactory;
    protected $table='sa_user_group';
    protected $primaryKey='USERGRP_ID'; 
    protected $protected='sa_user_group';
    protected $fillable=['USERGRP_NAME', 'USERGRP_ID','ACTIVE_STATUS '];
}
