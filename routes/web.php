<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AcademyOfficerController;
use App\Http\Controllers\BotManController;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# Add this to header
//...
Route::get('/botmanCheck', function () {
    return view('botman');
});
Route::match(['get', 'post'], '/botman', [BotManController::class,'handel']);
        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::get('home', [LoginController::class, 'home']);
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/', 'App\Http\Controllers\FontHomeController@home');

        // change password ...
        Route::get('/changePassword',[App\Http\Controllers\custom_auth\ForgotPasswordController::class,'changePassword'])->name('changePassword');
        Route::post('/saveChangePassword',[App\Http\Controllers\custom_auth\ForgotPasswordController::class,'saveChangePassword'])->name('saveChangePassword');

          //Email
          Route::get('/forgetPassword',[App\Http\Controllers\custom_auth\ForgotPasswordController::class,'getEmail'])->name('forgetPassword');
          Route::post('/forgetPassword',[App\Http\Controllers\custom_auth\ForgotPasswordController::class,'postEmail'])->name('forgetPassword');
          Route::get('/resetPassword/{token}', [App\Http\Controllers\custom_auth\ResetPasswordController::class,'getPassword'])->name('resetPassword');
          Route::post('/resetPassword', [App\Http\Controllers\custom_auth\ResetPasswordController::class,'PostPassword'])->name('resetPassword');

        //start backend route
        Auth::routes();
        Route::group(['middleware' => ['auth'],['prevent-back-history']], function(){

            //start Admission Management route
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/support_home', [App\Http\Controllers\HomeController::class, 'support_index'])->name('support_home');


            //start Modules route
        Route::get('/moduleSetup', [App\Http\Controllers\security_access\ModulesController::class, 'index'])->name('moduleSetup');
        Route::get('/creatModuleSetup', [App\Http\Controllers\security_access\ModulesController::class, 'create'])->name('creatModuleSetup');

        Route::post('/storemoduleSetup', [App\Http\Controllers\security_access\ModulesController::class, 'store'])->name('storeModuleSetup');
        Route::get('/editemoduleSetup/{id}', [App\Http\Controllers\security_access\ModulesController::class, 'edit'])->name('edit');
        Route::post('/updatemoduleSetup/{id}', [App\Http\Controllers\security_access\ModulesController::class, 'update'])->name('update');
              //start Modules links route

        Route::get('/moduleLinkSetup', [App\Http\Controllers\security_access\ModuleLinksController::class, 'index'])->name('moduleLinkSetup');
        Route::get('/createModuleLinkSetup', [App\Http\Controllers\security_access\ModuleLinksController::class, 'create'])->name('createModuleLinkSetup');
        Route::post('/storeModuleLinkSetup', [App\Http\Controllers\security_access\ModuleLinksController::class, 'store'])->name('storeModuleLinkSetup');
        Route::get('/editModuleLinkSetup/{id}', [App\Http\Controllers\security_access\ModuleLinksController::class, 'edit'])->name('edit');
        Route::post('/updateModuleLinkSetup/{id}', [App\Http\Controllers\security_access\ModuleLinksController::class, 'update'])->name('update');
        //end Modules links route
        //start Modules Manage route
        Route::get('/moduleManage', [App\Http\Controllers\security_access\ModuleManageController::class, 'index'])->name('moduleManage');
        Route::get('/createGroup/{id}', [App\Http\Controllers\security_access\ModuleManageController::class, 'createGroup'])->name('createGroup');
        Route::get('/createUser/{id}', [App\Http\Controllers\security_access\ModuleManageController::class, 'createUser'])->name('createUser');
        Route::get('/assignModul', [App\Http\Controllers\security_access\ModuleManageController::class, 'assignModul'])->name('assignModul');
        Route::get('/addPage/{id}', [App\Http\Controllers\security_access\ModuleManageController::class, 'addPage'])->name('addPage');
        Route::post('/addModulesInsert', [App\Http\Controllers\security_access\ModuleManageController::class, 'addModules'])->name('addModules');
        Route::post('/deleteModules', [App\Http\Controllers\security_access\ModuleManageController::class, 'deleteModules'])->name('deleteModules');

        //end Modules Manage route

        // Modules Manage  New User
        Route::get('/userIndex', [App\Http\Controllers\security_access\ModuleManageController::class, 'userIndex'])->name('userIndex');
        Route::get('/searchUser/{type}/{dept}/{course}', [App\Http\Controllers\security_access\ModuleManageController::class, 'searchUser'])->name('searchUser');
        Route::get('/createUser', [App\Http\Controllers\security_access\ModuleManageController::class, 'createUser'])->name('createUser');
        Route::post('/storeUser', [App\Http\Controllers\security_access\ModuleManageController::class, 'store'])->name('store');

        Route::post('/userGroupLevel', [App\Http\Controllers\security_access\ModuleManageController::class, 'userGroupLevel'])->name('userGroupLevel');

        //  Modules Manage group
        Route::get('/groupIndex', [App\Http\Controllers\security_access\ModuleManageController::class, 'groupIndex'])->name('groupIndex');
        Route::get('/createGroup', [App\Http\Controllers\security_access\GroupController::class, 'createGroup'])->name('createGroup');
        Route::post('/storeGroup', [App\Http\Controllers\security_access\ModuleManageController::class, 'storeGroup'])->name('storeGroup');

        //  Modules Manage user group level
        Route::get('/createLevel/{id}', [App\Http\Controllers\security_access\ModuleManageController::class, 'createLevel'])->name('createLevel');
        Route::post('/storeLevel', [App\Http\Controllers\security_access\ModuleManageController::class, 'storeLevel'])->name('storeLevel');
        Route::get('/editLevel/{id}', [App\Http\Controllers\security_access\ModuleManageController::class, 'editLevel'])->name('editLevel');
        Route::post('/updateLevel/{id}', [App\Http\Controllers\security_access\ModuleManageController::class, 'updateLevel'])->name('updateLevel');
        Route::post('/insertPageLinkStatus', [App\Http\Controllers\security_access\ModuleManageController::class, 'insertPageLinkStatus'])->name('insertPageLinkStatus');

              //end Modules Manage route

        //end security and access setup
        // Modules Manage  add page
        Route::get('/addPage', [App\Http\Controllers\security_access\ModuleManageController::class, 'addPage'])->name('addPage');
        Route::get('/createPage', [App\Http\Controllers\security_access\ModuleManageController::class, 'createPage'])->name('createPage');
        Route::post('/addPageLink', [App\Http\Controllers\security_access\ModuleManageController::class, 'addPageLink'])->name('addPageLink');


        Route::post('/changePageLinkStatus', [App\Http\Controllers\security_access\ModuleManageController::class, 'changePageLinkStatus'])->name('changePageLinkStatus');
        Route::post('/changePageLinkRead', [App\Http\Controllers\security_access\ModuleManageController::class, 'changePageLinkRead'])->name('changePageLinkRead');
        Route::post('/changePageLinkDelete', [App\Http\Controllers\security_access\ModuleManageController::class, 'changePageLinkDelete'])->name('changePageLinkDelete');

        Route::post('/addPageLink', [App\Http\Controllers\security_access\ModuleManageController::class, 'addPageLink'])->name('addPageLink');
        Route::post('/changePageLinkCreate', [App\Http\Controllers\security_access\ModuleManageController::class, 'changePageLinkCreate'])->name('changePageLinkCreate');


        Route::post('/updatePageLink', [App\Http\Controllers\security_access\ModuleManageController::class, 'updatePageLink'])->name('updatePageLink');

        // Modules Manage  add page Module
        Route::get('/createPageModule', [App\Http\Controllers\security_access\ModuleManageController::class, 'createPageModule'])->name('createPageModule');

                //Start Topic Setup Route

         //Security Access Assing Link To Group
        Route::post('/assingLinkGroupLevel', [App\Http\Controllers\security_access\ModuleManageController::class, 'assingLinkGroupLevel'])->name('assingLinkGroupLevel');
        Route::post('/assingLinkUserLevel', [App\Http\Controllers\security_access\ModuleManageController::class, 'assingLinkUserLevel'])->name('assingLinkUserLevel');
        Route::post('/assingLinkUsergroup', [App\Http\Controllers\security_access\ModuleManageController::class, 'assingLinkUsergroup'])->name('assingLinkUsergroup');

        //Security Access Assing Link To Group
        Route::post('/assingLinkGroupLevel', [App\Http\Controllers\security_access\ModuleManageController::class, 'assingLinkGroupLevel'])->name('assingLinkGroupLevel');
        Route::post('/assingLinkUserLevel', [App\Http\Controllers\security_access\ModuleManageController::class, 'assingLinkUserLevel'])->name('assingLinkUserLevel');
        Route::post('/assingLinkUsergroup', [App\Http\Controllers\security_access\ModuleManageController::class, 'assingLinkUsergroup'])->name('assingLinkUsergroup');

        //Lookup  group and data
        Route::get('/lookupIndex', [App\Http\Controllers\lookup\LookupController::class, 'index'])->name('lookupIndex');
        Route::get('/createLookupGrpup', [App\Http\Controllers\lookup\LookupController::class, 'create'])->name('createLookupGrpup');
        Route::post('/storeLookupGroup', [App\Http\Controllers\lookup\LookupController::class, 'store'])->name('storeLookupGroup');
        Route::get('/createLookupGroupItem/{GROUP_ID}/{USE_CHAR_NUMB}', [App\Http\Controllers\lookup\LookupController::class, 'createLookupGroupItem'])->name('createLookupGroupItem');
        Route::post('/storeLookupGroupItem', [App\Http\Controllers\lookup\LookupController::class, 'storeLookupGroupItem'])->name('storeLookupGroupItem');
        Route::get('/editLookupGroupItem/{id}/{USE_CHAR_NUMB}', [App\Http\Controllers\lookup\LookupController::class, 'editLookupGroupItem'])->name('editLookupGroupItem');
        Route::post('/updateLookupGroupItem/{id}', [App\Http\Controllers\lookup\LookupController::class, 'updateLookupGroupItem'])->name('updateLookupGroupItem');

        // Start Client Setup Route
        Route::get('/clientSetupIndex', [App\Http\Controllers\support\ClientSetupController::class, 'index'])->name('clientSetupIndex');
        Route::get('/createclientSetup', [App\Http\Controllers\support\ClientSetupController::class, 'create'])->name('createclientSetup');
        Route::post('/storeClient', [App\Http\Controllers\support\ClientSetupController::class, 'store'])->name('storeClient');
        Route::get('/updateClient/{id}', [App\Http\Controllers\support\ClientSetupController::class, 'edit'])->name('updateClient');
        Route::post('/updateClientInfo', [App\Http\Controllers\support\ClientSetupController::class, 'update'])->name('updateClientInfo');

        // Start Project setup Route
        Route::get('/projectSetupIndex', [App\Http\Controllers\support\ProjectSetupController::class, 'index'])->name('projectSetupIndex');
        Route::get('/createProjectSetup', [App\Http\Controllers\support\ProjectSetupController::class, 'create'])->name('createProjectSetup');
        Route::post('/storeProject', [App\Http\Controllers\support\ProjectSetupController::class, 'store'])->name('storeProject');
        Route::get('/updateProject/{id}', [App\Http\Controllers\support\ProjectSetupController::class, 'edit'])->name('updateProject');
        Route::post('/updateProjectInfo', [App\Http\Controllers\support\ProjectSetupController::class, 'update'])->name('updateProjectInfo');

        // Start News Setup Route
        Route::get('/newsSetupIndex', [App\Http\Controllers\support\NewsSetupController::class, 'index'])->name('newsSetupIndex');
        Route::get('/createNewsSetup', [App\Http\Controllers\support\NewsSetupController::class, 'create'])->name('createNewsSetup');
        Route::post('/storeNews', [App\Http\Controllers\support\NewsSetupController::class, 'store'])->name('storeNews');
        Route::get('/updateNews/{id}', [App\Http\Controllers\support\NewsSetupController::class, 'edit'])->name('updateNews');
        Route::post('/updateNewsInfo', [App\Http\Controllers\support\NewsSetupController::class, 'update'])->name('updateNewsInfo');

        // Support Module Setup Route
        Route::get('/supportModuleIndex', [App\Http\Controllers\support\SupportModuleSetupController::class, 'index'])->name('supportModuleIndex');
        Route::get('/createModuleSetup', [App\Http\Controllers\support\SupportModuleSetupController::class, 'create'])->name('createModuleSetup');
        Route::post('/storeSupportModule', [App\Http\Controllers\support\SupportModuleSetupController::class, 'store'])->name('storeSupportModule');
        Route::get('/updateSupportModule/{id}', [App\Http\Controllers\support\SupportModuleSetupController::class, 'edit'])->name('updateSupportModule');
        Route::post('/updateSupportModuleInfo', [App\Http\Controllers\support\SupportModuleSetupController::class, 'update'])->name('updateSupportModuleInfo');

        //Start Ticket Route
        Route::get('/ticketIndex', [App\Http\Controllers\support\TicketController::class, 'index'])->name('ticketIndex');
        Route::get('/createTicket', [App\Http\Controllers\support\TicketController::class, 'create'])->name('createTicket');
        Route::post('/storeTicket', [App\Http\Controllers\support\TicketController::class, 'store'])->name('storeTicket');
        Route::get('/updateTicketAssign/{id}', [App\Http\Controllers\support\TicketController::class, 'edit'])->name('updateTicketAssign');
        Route::post('/updateTaskAssign', [App\Http\Controllers\support\TicketController::class, 'update'])->name('updateTaskAssign');
        Route::post('/getTicketInfo', [App\Http\Controllers\support\TicketController::class, 'ticketInfo'])->name('getTicketInfo');
        Route::post('/getTicketStatus', [App\Http\Controllers\support\TicketController::class, 'getTicketStatus'])->name('getTicketStatus');
        Route::post('/getTicketAssignInfo', [App\Http\Controllers\support\TicketController::class, 'getTicketAssignInfo'])->name('getTicketAssignInfo');
        Route::post('/editTicketInfo', [App\Http\Controllers\support\TicketController::class, 'editTicketInfo'])->name('editTicketInfo');
        Route::post('/editStatusInfo', [App\Http\Controllers\support\TicketController::class, 'editStatusInfo'])->name('editStatusInfo');
        Route::post('/editAssignInfo', [App\Http\Controllers\support\TicketController::class, 'editAssignInfo'])->name('editAssignInfo');
        Route::post('/editReAssignInfo', [App\Http\Controllers\support\TicketController::class, 'editReAssignInfo'])->name('editReAssignInfo');
        Route::post('/updateTicketBasicInfo', [App\Http\Controllers\support\TicketController::class, 'updateBasicInfo'])->name('updateTicketBasicInfo');
        Route::post('/updateTicketStatusInfo', [App\Http\Controllers\support\TicketController::class, 'updateStatusInfo'])->name('updateTicketStatusInfo');
        Route::post('/updateTicketAssignInfo', [App\Http\Controllers\support\TicketController::class, 'updateAssignInfo'])->name('updateTicketAssignInfo');
        Route::post('/updateTicketReAssignInfo', [App\Http\Controllers\support\TicketController::class, 'updateTicketReAssignInfo'])->name('updateTicketReAssignInfo');
        Route::get('/ticket/getProject/{clientId}', [App\Http\Controllers\support\TicketController::class, 'getPorject']);
        Route::get('/getEmployee/{departmentId}', [App\Http\Controllers\support\TicketController::class, 'getEmployee']);

        // Support User Ticket Route
        Route::get('/createSupportTicket', [App\Http\Controllers\support\SupportTicketController::class, 'create'])->name('createSupportTicket');
        Route::post('/storeSupportTicket', [App\Http\Controllers\support\SupportTicketController::class, 'store'])->name('storeSupportTicket');
        Route::get('/supportTicketInfo', [App\Http\Controllers\support\SupportTicketController::class, 'supportTicketInfo'])->name('supportTicketInfo');
        Route::get('/getCloseTicket/{id}', [App\Http\Controllers\support\SupportTicketController::class, 'getCloseTicket'])->name('getCloseTicket');
        Route::get('/getTicketDetailsInfo/{id}', [App\Http\Controllers\support\SupportTicketController::class, 'getTicketDetailsInfo'])->name('getTicketDetailsInfo');
        //Route::get('/updateTicketDetails/{id}', [App\Http\Controllers\support\SupportTicketController::class, 'updateTicketDetails'])->name('updateTicketDetails');
        //Route::get('/updateTicketAttachment/{id}', [App\Http\Controllers\support\SupportTicketController::class, 'updateTicketAttachment'])->name('updateTicketAttachment');
        Route::match(array('get','post'),'/updateTicketDetails/{id}', [App\Http\Controllers\support\SupportTicketController::class, 'updateTicketDetails'])->name('updateTicketDetails');
        Route::match(array('get','post'),'/updateTicketAttachment/{id}', [App\Http\Controllers\support\SupportTicketController::class, 'updateTicketAttachment'])->name('updateTicketAttachment');
        Route::match(array('get','post'),'/updateCloseTicket/{id}', [App\Http\Controllers\support\SupportTicketController::class, 'updateCloseTicket'])->name('updateCloseTicket');

        //Route::get('/updateCloseTicket/{id}', [App\Http\Controllers\support\SupportTicketController::class, 'updateCloseTicket'])->name('updateCloseTicket');
        Route::post('storeSupportTicketInfo', [App\Http\Controllers\support\SupportTicketController::class, 'storeSupportTicketInfo'])->name('storeSupportTicketInfo');


        // Start Task Assign Route
        Route::get('/taskAssignIndex', [App\Http\Controllers\task_report\TaskReportController::class, 'index'])->name('taskAssignIndex');
        Route::get('/createTaskAssign', [App\Http\Controllers\task_report\TaskReportController::class, 'create'])->name('createTaskAssign');
        Route::post('/storeTaskAssign', [App\Http\Controllers\task_report\TaskReportController::class, 'store'])->name('storeTaskAssign');
        Route::get('/updateTaskAssign/{id}', [App\Http\Controllers\task_report\TaskReportController::class, 'edit'])->name('updateTaskAssign');
        Route::post('/updateTaskAssignInfo', [App\Http\Controllers\task_report\TaskReportController::class, 'update'])->name('updateTaskAssignInfo');

        // Task Report Route
        Route::get('/taskReportIndex', [App\Http\Controllers\task_report\TaskReportController::class, 'taskReportIndex'])->name('taskReportIndex');
        Route::get('/createTask', [App\Http\Controllers\task_report\TaskReportController::class, 'createTask'])->name('createTask');
        Route::post('/storeTask', [App\Http\Controllers\task_report\TaskReportController::class, 'storeTask'])->name('storeTask');
        Route::get('/updateTask/{id}', [App\Http\Controllers\task_report\TaskReportController::class, 'editTask'])->name('updateTask');
        Route::post('/updateTaskInfo', [App\Http\Controllers\task_report\TaskReportController::class, 'updateTask'])->name('updateTaskInfo');
        Route::get('/check_task_start_or_stop_status', [App\Http\Controllers\task_report\TaskReportController::class, 'checkStartStopStatus'])->name('check_task_start_or_stop_status');
        //Route::post('/update_task_status', [App\Http\Controllers\task_report\TaskReportController::class, 'updateTaskStatus'])->name('update_task_status');
        Route::get('/update_task_status', [App\Http\Controllers\task_report\TaskReportController::class, 'updateTaskStatus'])->name('update_task_status');

        Route::get('/studentInfo', [App\Http\Controllers\student_portal\StudentInfoController::class, 'index'])->name('studentInfo');
        Route::post('storeStudentInfo', [App\Http\Controllers\student_portal\StudentInfoController::class, 'storeStudentInfo'])->name('storeStudentInfo');

        // Dept wises Task Report Route
        Route::get('/deptWiseTaskReportIndex', [App\Http\Controllers\task_report\TaskReportController::class, 'deptWiseTaskReportIndex'])->name('deptWiseTaskReportIndex');
        Route::get('/department_wise_task_report', [App\Http\Controllers\task_report\TaskReportController::class, 'deptWiseTaskReport'])->name('department_wise_task_report');

        // Task Report Mail Route
        Route::get('/taskReportMailIndex', [App\Http\Controllers\task_report\TaskReportController::class, 'taskReportMailIndex'])->name('taskReportMailIndex');
        Route::get('/createTaskMail', [App\Http\Controllers\task_report\TaskReportController::class, 'createTaskMail'])->name('createTaskMail');
        Route::post('/storeTaskReportMail', [App\Http\Controllers\task_report\TaskReportController::class, 'storeTaskReportMail'])->name('storeTaskReportMail');
        Route::get('/updateTaskMail/{id}', [App\Http\Controllers\task_report\TaskReportController::class, 'editTaskMail'])->name('updateTaskMail');
        Route::post('/updateTaskMailInfo', [App\Http\Controllers\task_report\TaskReportController::class, 'updateTaskMail'])->name('updateTaskMailInfo');

        // Task Report Send Mail
        Route::match(array('get','post'),'/createTaskMailSend', [App\Http\Controllers\task_report\TaskReportController::class, 'createTaskMailSend'])->name('createTaskMailSend');

        // News Route
         Route::get('/newsDetails/{id}', [App\Http\Controllers\HomeController::class, 'newsDetails'])->name('newsDetails');

         // Employee Info Route get_employee_info
         Route::get('/get_employee_info', [App\Http\Controllers\CommonController::class, 'getEmployeeInfo'])->name('get_employee_info');

        // Start Employee Route
        Route::get('/allEmployeeIndex', [App\Http\Controllers\support\EmployeeController::class, 'index'])->name('allEmployeeIndex');
        Route::get('/createEmployee', [App\Http\Controllers\support\EmployeeController::class, 'create'])->name('createEmployee');
        Route::post('/storeEmployee', [App\Http\Controllers\support\EmployeeController::class, 'store'])->name('storeEmployee');
        Route::get('/updateEmployee/{id}', [App\Http\Controllers\support\EmployeeController::class, 'edit'])->name('updateEmployee');
        Route::post('/updateEmployeeInfo', [App\Http\Controllers\support\EmployeeController::class, 'update'])->name('updateEmployeeInfo');

         // Dashboard Route
         Route::get('/get_ticket_info/{ticket_status}', [App\Http\Controllers\DashboardController::class, 'getTicketStatusInfo'])->name('get_ticket_info');
         Route::get('/total_present_employee', [App\Http\Controllers\DashboardController::class, 'totalPresentEmployee'])->name('total_present_employee');
         Route::get('/total_absent_employee', [App\Http\Controllers\DashboardController::class, 'totalAbsentEmployee'])->name('total_absent_employee');
         Route::get('/total_working_hour', [App\Http\Controllers\DashboardController::class, 'totalWorkingHour'])->name('total_working_hour');
         Route::get('/get_last_seven_days_task', [App\Http\Controllers\DashboardController::class, 'getLastSevenDaysTask'])->name('get_last_seven_days_task');
         Route::get('/task_details_specific_emp/{empId}', [App\Http\Controllers\DashboardController::class, 'taskDetailsSpecificEmp'])->name('task_details_specific_emp');
         Route::get('/task_details_last_seven_days/{empId}', [App\Http\Controllers\DashboardController::class, 'taskDetailsLast7Days'])->name('task_details_last_seven_days');

        });


        //end backend route
