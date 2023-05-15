<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>
<style>
    ul li.active,
    a.active {
        color: #3fbbc0;
    }

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
                    <div class="col-md-3 col-sm-3 offset-md-9">
                        <button type="button" class="btn btn-primary dynamicModal" pageTitle="Add Task Mail"
                            pageLink="<?php echo e(URL::route('createTaskMail')); ?>" data-toggle="tooltip" data-placement="left"
                            title="Add Task Mail" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add
                            New</button>
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
                                                <th>Employee Name</th>
                                                <th>Report To</th>
                                                <th>CC Person</th>
                                                <th>BCC Person</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e($result->employee_name); ?></td>
                                                <td><?php echo e($result->report_to); ?></td>
                                                <td>
                                                    <?php
                                                    if(!empty($result->cc_to)){
                                                      $employeeName = DB::select("select employee_name from npoly_employees where employee_id in($result->cc_to)");
                                                     if(!empty($employeeName)){
                                                         $empsName = [];
                                                         foreach ($employeeName as $emp){
                                                             $empsName [] = $emp->employee_name;
                                                         }
                                                         $empName = implode(',',$empsName);
                                                         echo $empName;
                                                     }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if(!empty($result->bcc_to)){
                                                          $employeeName = DB::select("select employee_name from npoly_employees where employee_id in($result->bcc_to)");
                                                         if(!empty($employeeName)){
                                                             $empsName = [];
                                                             foreach ($employeeName as $emp){
                                                                 $empsName [] = $emp->employee_name;
                                                             }
                                                             $empName = implode(',',$empsName);
                                                             echo $empName;
                                                         }
                                                        }
                                                    ?>
                                                </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-sm dynamicModal"
                                                            pageTitle="Update Task Mail"
                                                            pageLink="<?php echo e(url('/updateTaskMail/'.$result->task_mail_id)); ?>"
                                                            data-modal-size="modal-xl" data-toggle="tooltip"
                                                            data-placement="top" title="Update Task Mail">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/task_report_mail/index.blade.php ENDPATH**/ ?>