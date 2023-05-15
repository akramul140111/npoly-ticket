<?php

namespace App\Models\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveTypeSetupModel extends Model
{
    use HasFactory;
    protected $table='set_leave';

    protected $primaryKey='id';
    protected $protected='id';
    protected $fillable=['leave_type_id','id','number_of_days','description','active_status'];
}
