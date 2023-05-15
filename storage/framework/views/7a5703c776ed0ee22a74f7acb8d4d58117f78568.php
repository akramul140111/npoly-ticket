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
                        <button type="button" class="btn btn-primary dynamicModal" pageTitle="Add Ticket"
                            pageLink="<?php echo e(URL::route('createTicket')); ?>" data-toggle="tooltip" data-placement="left"
                            title="Add Ticket" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add
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
                                                <th>Ticket No</th>


                                                <th>Title</th>
                                                <th>Module</th>
                                                <th>Priority</th>
                                                <th>Assign To</th>
                                                <th>Ticket Status</th>
                                                <th>Task %</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e($result->ticket_no); ?></td>


                                                <td><?php echo e($result->ticket_title); ?></td>
                                                <td><?php echo e($result->module_name); ?></td>
                                                <td><?php echo e($result->priorityName); ?></td>
                                                <td>
                                                    <?php if(!empty($result->employee_id)): ?>
                                                       <?php
                                                           $empName = DB::selectOne("select employee_name from npoly_employees where employee_id = $result->employee_id");
                                                           echo $empName->employee_name;
                                                       ?>
                                                    <?php else: ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($result->ticketStatus); ?></td>
                                                <td><?php echo e($result->task_complete); ?></td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-sm dynamicModal"
                                                            pageTitle="Update Ticket Assign"
                                                            pageLink="<?php echo e(url('/updateTicketAssign/'.$result->id)); ?>"
                                                            data-modal-size="modal-xl" data-toggle="tooltip"
                                                            data-placement="top" title="Update Ticket Assign">
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/support/index.blade.php ENDPATH**/ ?>