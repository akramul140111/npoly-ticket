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
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="exampleInputFormDate">Form</label>
                                        <input type="text" class="form-control datepickerMonthYearAppend" id="fromDate" aria-describedby="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="exampleInputFormDate">To</label>
                                        <input type="text" class="form-control datepickerMonthYearAppend" id="toDate" aria-describedby="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelectDepartment">Department</label>
                                        <select class="form-control select2" id="departmentId">
                                            <option value="">Select</option>
                                            <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($dept->LOOKUP_DATA_ID); ?>"><?php echo e($dept->LOOKUP_DATA_NAME); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelectEmployee">Employee</label>
                                        <select class="form-control select2" id="employeeId">
                                            <option value="">Select</option>
                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($emp->employee_id); ?>"><?php echo e($emp->employee_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlStatus">Status</label>
                                        <select class="form-control select2" id="taskStatusId">
                                            <option value=""></option>
                                            <option value="1">Running</option>
                                            <option value="2">Pending</option>
                                            <option value="3">Complete</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2" style="margin-top: 3%">
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align"></label>
                                        <div class="col-md-9 col-sm-9">
                                            <button type="button" id="searchID" class="btn btn-info">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                <th>Assign Date</th>
                                                <th>Forecast Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key+1); ?></td>
                                                <td><?php echo e($result->project_name); ?></td>
                                                <td><?php echo e($result->task_title); ?></td>
                                                <td><?php echo e($result->task_desc); ?></td>
                                                <td><?php echo e(date('d-M-Y',strtotime($result->assign_date))); ?></td>
                                                <td><?php echo e(date('d-M-Y',strtotime($result->forecast_date))); ?></td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-sm dynamicModal"
                                                            pageTitle="Update Task"
                                                            pageLink="<?php echo e(url('/updateTask/'.$result->task_id)); ?>"
                                                            data-modal-size="modal-xl" data-toggle="tooltip"
                                                            data-placement="top" title="Update Task">
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
    $(document).ready(function() {
        $('.select2').select2();
    });

    $('#departmentId').change(function(){
        var deptId = $(this).val();
        $('#employeeId').html('<option value="">--select--</option>');
        if(deptId!=''){
            $.ajax({
                type: 'GET',
                url: '<?php echo e(url("/getEmployee")); ?>/'+deptId,
                success: function (data) {
                    $('#employeeId').html(data);
                }
            });
        }
    });

    $('#searchID').click(function (){
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();
        var deptId = $('#departmentId').val();
        var empId = $('#employeeId').val();
        var statusId = $('#taskStatusId').val();

        if(fromDate ==""){
            alert('Please Select Form Date');
        }else if(toDate ==""){
            alert('Please Select To Date');
        }else{
            var _token = '<?php echo e(csrf_token()); ?>'
            $.ajax({
                type: 'GET',
                url: '<?php echo e(url("/department_wise_task_report")); ?>',
                data: { fromDate: fromDate,toDate:toDate,deptId:deptId,empId:empId,statusId:statusId },
                success: function (data) {
                    $('#employeeId').html(data);
                }
            });
        }
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/dept_wise_task_report/index.blade.php ENDPATH**/ ?>