<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>
<style>
    ul li.active,
    a.active {
        color: #3fbbc0;
    }

    tr:nth-child(even) tr {background: #ffffff !important;}

</style>
<div class="" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo e($header['pageTitle']); ?> </h3>
            </div>
            <!-- USER LEVEL SUPERVISOR=10 WILL LOGIN -->
            
            <div class="title_right">
                <div class="item form-group">

                    <div class="col-md-3 col-sm-3 offset-md-6" style="padding-left: 25px !important;">
                            <button type="button" class="btn btn-success dynamicModal" pageTitle="Task Mail Send"
                                    pageLink="<?php echo e(URL::route('createTaskMailSend')); ?>" data-toggle="tooltip" data-placement="left"
                                    title="Task Mail Send" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Send Email
                            </button>
                    </div>
                    <div class="col-md-3 col-sm-3 offset-md-1">
                        <button type="button" class="btn btn-primary dynamicModal" pageTitle="Add Task"
                                pageLink="<?php echo e(URL::route('createTask')); ?>" data-toggle="tooltip" data-placement="left"
                                title="Add Task" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add New
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="x_panel">
                    <div class="x_title" style="border:none;">
                        <h2><?php echo e($header['tableTitle']); ?> </h2>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered dataTable"
                                        role="grid" aria-describedby="data-table-info" width="100%">
                                        <thead style="background-color: #0b58a2; color: white">
                                            <tr>
                                                <th>Sl</th>
                                                <th>Project Name</th>
                                                <th>Task Title</th>
                                                <th>Task Description</th>
                                                <th class="text-center">Task Info</th>
                                                <th>W.Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr <?php if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d')): ?>style="background-color: #e4f0e9" <?php endif; ?>>
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e($result->project_name); ?></td>
                                                <td><?php echo e($result->task_title); ?></td>
                                                <td><?php echo e($result->task_desc); ?></td>
                                                <style>
                                                    .tblTimeCalc td{
                                                        border: none !important;
                                                        border-top: none !important;
                                                        border-bottom: none !important;
                                                    }

                                                    .tblTaskCalc td, .tblTaskCalc th{
                                                        border: 1px solid #ccc !important;
                                                        background-color: #f7ffe9 !important;
                                                        padding:2px 4px !important;
                                                    }

                                                    .tblTaskCalc{

                                                        font-size:12px !important;
                                                    }
                                                </style>
                                                <td style="width: 27%!important;">
                                                    <table class="table table-striped tblTimeCalc" width="100%">
                                                        <?php if(!empty($result->priority_name)): ?>
                                                            <tr class="" <?php if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d')): ?>style="background-color: #e4f0e9 !important;" <?php else: ?> style="background-color: #f2f2f2" <?php endif; ?>>
                                                                <td><strong>Priority</strong></td>
                                                                <td><strong>:</strong></td>
                                                                <td><?php echo e($result->priority_name); ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                            <tr class="" <?php if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d')): ?>style="background-color: #e4f0e9 !important;" <?php else: ?> style="background-color: #f2f2f2" <?php endif; ?>>
                                                                <td><strong>Assign By</strong></td>
                                                                <td><strong>:</strong></td>
                                                                <td>
                                                                    <?php if(!empty($result->assign_by_name)): ?>
                                                                        <?php echo e($result->assign_by_name); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                            <tr class="" <?php if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d')): ?>style="background-color: #e4f0e9 !important;" <?php else: ?> style="background-color: #f2f2f2" <?php endif; ?>>
                                                                <td><strong>Assign Date</strong></td>
                                                                <td><strong>:</strong></td>
                                                                <td>
                                                                    <?php
                                                                        $today = date('Y-m-d');
                                                                        $foCheDate = date('Y-m-d');
                                                                    ?>
                                                                    <?php if(!empty($result->assign_date)): ?>
                                                                        <?php echo e(date('d-M-Y',strtotime($result->assign_date))); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                            <tr  class="" <?php if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d')): ?>style="background-color: #e4f0e9 !important;" <?php else: ?> style="background-color: #f2f2f2" <?php endif; ?>>
                                                                <td <?php if(date('Y-m-d',strtotime($result->forecast_date)) < $foCheDate): ?>style="color: red; <?php endif; ?>"><strong>Forecast Date</strong></td>
                                                                <td <?php if(date('Y-m-d',strtotime($result->forecast_date)) < $foCheDate): ?>style="color: red; <?php endif; ?>"><strong>:</strong></td>
                                                                <td <?php if(date('Y-m-d',strtotime($result->forecast_date)) < $foCheDate): ?>style="color: red; <?php endif; ?>"><?php echo e(!empty($result->forecast_date)?date('d-M-Y',strtotime($result->forecast_date)):''); ?></td>
                                                            </tr>
                                                            <tr  class="" <?php if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d')): ?>style="background-color: #e4f0e9 !important;" <?php else: ?> style="background-color: #f2f2f2" <?php endif; ?>>
                                                            <td colspan="3">
                                                                <?php
                                                                    $taskTime = DB::table('npoly_task_report_log')
                                                                                ->select('start_time','end_time')
                                                                                ->where('task_id',$result->task_id)
                                                                                ->where('prof_task_perfome_dt',date('Y-m-d'))
                                                                                ->get();
                                                                    $timeCount = count($taskTime);
                                                                ?>

                                                                <?php if($timeCount > 0 && $result->task_create_date==date('Y-m-d')): ?>
                                                                    <table class="tblTaskCalc" width="100%">
                                                                        <tbody><tr>
                                                                            <th colspan="3" class="text-center" style="background-color:#e3e3cd !important"><b>Task Timing</b></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th title="Start Time"><b>Start</b></th>
                                                                            <th title="End Time"><b>End</b></th>
                                                                            <th title="Total Time"><b>Total</b></th>
                                                                        </tr>

                                                                        <?php $__currentLoopData = $taskTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ttm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <tr>
                                                                                <td><?php echo e(gmdate('h:i A',$ttm->start_time)); ?></td>
                                                                                <td>
                                                                                    <?php if($ttm->end_time > $ttm->start_time): ?><?php echo e(gmdate('h:i A',$ttm->end_time)); ?> <?php endif; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php
                                                                                        if($ttm->end_time > $ttm->start_time){
                                                                                          $datetime1 = new DateTime(gmdate('h:i A',$ttm->start_time));
                                                                                         $datetime2 = new DateTime(gmdate('h:i A',$ttm->end_time));
                                                                                         $interval = $datetime1->diff($datetime2);
                                                                                         echo $interval->format('%h')." H ".$interval->format('%i')." M";
                                                                                        }

                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </tbody></table>
                                                                <?php else: ?>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                            <tr class="" <?php if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d')): ?>style="background-color: #e4f0e9 !important;" <?php else: ?> style="background-color: #f2f2f2" <?php endif; ?>>
                                                                <td><strong>Task Type</strong></td>
                                                                <td><strong>:</strong></td>
                                                                <td>
                                                                    <?php if($result->assign_date == $today): ?>
                                                                        <?php echo e('New'); ?>

                                                                    <?php else: ?>
                                                                        <?php echo e('Old'); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                            <?php if($result->task_complete > 0): ?>
                                                                <tr class="" <?php if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d')): ?>style="background-color: #e4f0e9 !important;"<?php else: ?> style="background-color: #f2f2f2"  <?php endif; ?>>
                                                                    <td <?php if($result->task_complete==100): ?> style="color: green; <?php endif; ?>"><strong>Task Done</strong></td>
                                                                    <td  <?php if($result->task_complete==100): ?> style="color: green; <?php endif; ?>"><strong>:</strong></td>
                                                                    <td  <?php if($result->task_complete==100): ?> style="color: green; <?php endif; ?>"><?php echo e($result->task_complete); ?>% </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                    </table>

                                                </td>

                                                <td>
                                                    <button <?php if($result->task_complete=='100'): ?> disabled <?php endif; ?> class=" <?php if($result->task_running=='1'): ?> btn btn-warning <?php else: ?> btn btn-success <?php endif; ?> taskStatus" value="<?php echo e($result->task_running); ?>"><?php if($result->task_running =='1'): ?> Stop <?php else: ?> Start <?php endif; ?> </button>
                                                    <input type="hidden" class="taskId" value="<?php echo e($result->task_id); ?>" id="taskId">
                                                </td>
                                                    <td class="text-center">
                                                        <button type="button" <?php if($result->task_running=='1' || $result->task_complete=='100'): ?> disabled  <?php endif; ?> class="btn btn-info btn-sm dynamicModal"
                                                            pageTitle="Update Task"
                                                            pageLink="<?php echo e(url('/updateTask/'.$result->task_id)); ?>"
                                                            data-modal-size="modal-xl" data-toggle="tooltip"
                                                            data-placement="top" title="<?php if($result->task_running=='1'): ?> Stop The Task Then Update <?php else: ?> Update Task <?php endif; ?>">
                                                            <i class="glyphicon glyphicon-edit"></i>
                                                        </button>
                                                    </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).off('click','.taskStatus').on('click','.taskStatus',function (){
        //$('.taskStatus').click(function (){
           var taskId = $(this).closest('tr').find('#taskId').val();
           var taskStatus = $(this).val();

           if(taskStatus == '1'){
               let stopMsg = confirm('Do You Want To Stop This Task');
               if(stopMsg ==true){
                   var _token = '<?php echo e(csrf_token()); ?>'
                   $.ajax({
                       type: 'get',
                       url: '<?php echo e(url("/update_task_status")); ?>',
                       data: {_token: _token, taskId: taskId,taskStatus:taskStatus},
                       success: function (data) {
                           window.location.replace("<?php echo e(url("/taskReportIndex")); ?>");
                       }
                   });
               }else{
                   return false;
               }
           }else if(taskStatus == '0'){
              if(taskId !=='') {
                  var _token = '<?php echo e(csrf_token()); ?>'
                  $.ajax({
                      type: 'GET',
                      url: '<?php echo e(url("/check_task_start_or_stop_status")); ?>',
                      data: { _token: _token,taskId:taskId },
                      success: function (data) {
                          if(data =='1'){
                              var anotherTask = confirm('Another Task Is Running Do You Want To Stop This Task');

                              if(anotherTask ==true){
                                  $.ajax({
                                      type: 'get',
                                      url: '<?php echo e(url("/update_task_status")); ?>',
                                      data: {_token: _token, taskId: taskId,taskStatus:taskStatus},
                                      success: function (data) {
                                          console.log(data)
                                          window.location.replace("<?php echo e(url("/taskReportIndex")); ?>");
                                      }
                                  });
                              }else{
                                  return false;
                              }
                          }else{
                              let taskStartMst = confirm('Do You Want To Start The Task');
                              if(taskStartMst ==true){
                                  $.ajax({
                                      type: 'get',
                                      url: '<?php echo e(url("/update_task_status")); ?>',
                                      data: {_token: _token, taskId: taskId,taskStatus:taskStatus},
                                      success: function (data) {
                                          console.log(data)
                                          window.location.replace("<?php echo e(url("/taskReportIndex")); ?>");
                                      }
                                  });
                              }else{
                                  return  false;
                              }

                          }
                      }
                  });
              }
           }




           // check another task start or stop info
           
           
           
           
           
           
           
           
           

           
           
           
           
           
           
           
           
           
           
           
           
           
           

           
           
           
           

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/task_report/index.blade.php ENDPATH**/ ?>