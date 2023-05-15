
<?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $actionUrl=url('/updateTicketReAssignInfo'); ?>
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="ClassRoutineForm" data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>"
          class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        <?php echo csrf_field(); ?>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Department *</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="department_id" required id="departmentId">
                    <option value="">--select--</option>
                    <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dept->LOOKUP_DATA_ID); ?>" <?php if($result->department_id ==$dept->LOOKUP_DATA_ID): ?> selected <?php endif; ?>><?php echo e($dept->LOOKUP_DATA_NAME); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Employee*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control"  name="employee_id" id="employeeId">
                    <option value="">--select--</option>
                    <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->employee_id); ?>" <?php if($result->employee_id ==$value->employee_id): ?> selected <?php endif; ?>><?php echo e($value->employee_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Assign Date</label>
            <div class="col-md-3 col-sm-3">
                <input type="text" name="assign_date" value="<?php if(!empty($result->forecast_date)): ?><?php echo e(date('d-m-Y',strtotime($result->assign_date))); ?><?php endif; ?>" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff; width: 170px !important;"  />
            </div>
            Forecast Date
            <div class="col-md-3 col-sm-3">
                <input type="text" name="forecast_date" value="<?php if(!empty($result->forecast_date)): ?><?php echo e(date('d-m-Y',strtotime($result->forecast_date))); ?><?php endif; ?>" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff;width: 170px !important;"  />
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Re Assign Reason*</label>
            <div class="col-md-6 col-sm-6">
               <input type="text" class="form-control" name="reassign_reason" value="" required>
            </div>
        </div>
       <!-- <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Work Station*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control"  name="work_station" id="employeeId" required>
                    <option value="">--select--</option>
                    <option value="1" <?php if($result->work_station=='1'): ?> selected <?php endif; ?>>In House</option>
                    <option value="2" <?php if($result->work_station=='2'): ?> selected <?php endif; ?>>Out Side Office</option>
                </select>
            </div>
        </div> -->

        <div class="clearfix"></div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <input type="hidden" name="ticket_id" value="<?php echo e($result->id); ?>">
                <input type="hidden" name="previoue_task_id" value="<?php echo e($result->task_id); ?>">
                <input type="hidden" name="previoue_emp_id" value="<?php echo e($result->employee_id); ?>">

                <button type='reset' class="btn btn-success">Reset</button>
                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
            </div>
        </div>

    </form>

</div>

<script src="<?php echo e(URL::asset('assets/custom_js/custom_calendar.js')); ?>"></script>

<script>
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
</script>


<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/support/edit_ticket_re_assign_info.blade.php ENDPATH**/ ?>