<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\StdAcademicController;
use App\Http\Controllers\API\StdInfoController;
use App\Http\Controllers\API\BlockController;
use App\Http\Controllers\API\AcaBlockTopicsController;
use App\Http\Controllers\API\SubBlockController;
use App\Http\Controllers\API\AcaStudentRegisController;
use App\Http\Controllers\API\StuActivityAttendanceController;
use App\Http\Controllers\API\StuClassAttendanceController;
use App\Http\Controllers\API\StuClassRoutineController;
use App\Http\Controllers\API\StuDissProtoSubmissionController;
use App\Http\Controllers\API\StuInstituteAttendanceController;
use App\Http\Controllers\API\StuLeaveController;
use App\Http\Controllers\API\StuMoneyReceiptController;
use App\Http\Controllers\API\StuPublicationInfoController;
use App\Http\Controllers\API\StuSkillInfoController;
use App\Http\Controllers\API\StuTraningExperianceController;
use App\Http\Controllers\API\StuTraineeFeedbackController;
use App\Http\Controllers\API\StuTrainingPublicationController;

use App\Http\Controllers\API\TeaBlockClearanceController;
use App\Http\Controllers\API\TeaBlockPlacementController;
use App\Http\Controllers\API\TeaClassRoutineController;
use App\Http\Controllers\API\TeaFormativeAssessmentController;
use App\Http\Controllers\API\TeaSummativeAssessmentController;
use App\Http\Controllers\API\TeaLeaveController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('login', [LoginController::class, 'signin']);
Route::post('register', [LoginController::class, 'signup']);

Route::middleware('auth:sanctum')->group( function () {
    // azam@atilimited.net
    Route::resource('stdAcademicInfo', StdAcademicController::class);
    Route::resource('aca_student_regis', AcaStudentRegisController::class);
    Route::resource('stu_activity_attendance', StuActivityAttendanceController::class);
    Route::resource('stu_class_attendance', StuClassAttendanceController::class);
    Route::resource('stu_class_routine', StuClassRoutineController::class);
    Route::resource('stu_diss_prot_sub', StuDissProtoSubmissionController::class);
    Route::resource('stu_institute_attendance', StuInstituteAttendanceController::class);
    Route::resource('stu_leave', StuLeaveController::class);
    Route::resource('stu_money_receipt_attachment', StuMoneyReceiptController::class);
    Route::resource('stu_publication_info', StuPublicationInfoController::class);
    Route::resource('stu_skill_info', StuSkillInfoController::class);
    Route::resource('stu_training_exp_info', StuTraningExperianceController::class);
    Route::resource('stu_trainee_feedback_info', StuTraineeFeedbackController::class);
    Route::resource('stu_training_publication_info', StuTrainingPublicationController::class);
    // salaquzzaman
    Route::resource('tea_block_clearance', TeaBlockClearanceController::class);
    Route::resource('tea_block_placement', TeaBlockPlacementController::class);
    Route::resource('tea_class_routine', TeaClassRoutineController::class);
    Route::resource('tea_formative_assessment', TeaFormativeAssessmentController::class);
    Route::resource('tea_summative_assessment', TeaSummativeAssessmentController::class);
    Route::resource('tea_leave', TeaLeaveController::class);

});
Route::post('std_info', [StdInfoController::class, 'std_info']);
Route::post('block_create', [BlockController::class, 'block_create']);
Route::post('block_topics_create', [AcaBlockTopicsController::class, 'block_topics_create']);
Route::post('sub_block_create', [SubBlockController::class, 'sub_block_create']);