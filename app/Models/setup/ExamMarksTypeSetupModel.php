<?php

namespace App\Models\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamMarksTypeSetupModel extends Model
{
    use HasFactory;
    protected $table='set_exam_marks_type';
    protected $primaryKey='id';
    protected $protected='id';
    protected $fillable=['exam','id','description','type','active_status'];
}
