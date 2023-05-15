

    <style>
        ul li.active,
        a.active {
            color: #3fbbc0;
        }

    </style>
    <div class="" role="main">
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
                                                <th class="text-center">Task Time</th>
                                                <th>W.Status</th>
                                                <th>Task %</th>
                                                <th>Task Type</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($key+1); ?></td>
                                                    <td><?php echo e($result->project_name); ?></td>
                                                    <td><?php echo e($result->task_title); ?></td>
                                                    <td><?php echo e($result->task_desc); ?></td>
                                                    <td>
                                                        <style>
                                                            .tblTaskCalc td, .tblTaskCalc th{
                                                                border: 1px solid #ccc !important;
                                                                background-color: #f7ffe9 !important;
                                                            }
                                                        </style>
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
                                                    
                                                    <td>
                                                        <button class=" <?php if($result->task_running=='1'): ?> btn btn-warning <?php else: ?> btn btn-success <?php endif; ?> taskStatus" value="<?php echo e($result->task_running); ?>"><?php if($result->task_running =='1'): ?> Stop <?php else: ?> Start <?php endif; ?> </button>
                                                        <input type="hidden" class="taskId" value="<?php echo e($result->task_id); ?>" id="taskId">
                                                    </td>
                                                    <td><?php echo e($result->task_complete); ?></td>
                                                    <td>
                                                        <?php if($result->assign_date== $result->task_create_date): ?>
                                                            <?php echo e('New'); ?>

                                                        <?php else: ?>
                                                            <?php echo e('Old'); ?>

                                                        <?php endif; ?>
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

<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/dashboard/specficEmpTaskDetails.blade.php ENDPATH**/ ?>