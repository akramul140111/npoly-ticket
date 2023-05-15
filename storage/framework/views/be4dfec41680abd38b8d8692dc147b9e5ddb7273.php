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
                    <div style="display: inline-block;float: left;">
                        <h3><?php echo e($header['pageTitle']); ?> </h3>
                    </div>
                    <div style="display: inline-block;float: left;padding-left: 10px !important;">
                        <h3><a href="<?php echo e(url('/home')); ?>">Dashboard</a> </h3>
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
                                                <th>Card No</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($key+1); ?></td>
                                                    <td><?php echo e($result->employee_name); ?></td>
                                                    <td><?php echo e($result->card_no); ?></td>
                                                    <td><?php echo e($result->email); ?></td>
                                                    <td><?php echo e($result->mobile_no); ?></td>
                                                    <td><?php echo e($result->department_name); ?></td>
                                                    <td><?php echo e($result->designation_name); ?></td>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/dashboard/total_absent.blade.php ENDPATH**/ ?>