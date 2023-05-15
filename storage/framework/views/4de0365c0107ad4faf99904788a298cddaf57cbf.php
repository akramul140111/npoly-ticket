<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $actionUrl=url('/updateTaskInfo'); ?>
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="ProjectForm" data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>"
        class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        <?php echo csrf_field(); ?>
      <!--  <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Client :: Project*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="project_id">
                    <option value="">Select One</option>
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($pro->project_id); ?>" <?php if($result->project_id == $pro->project_id): ?> selected <?php endif; ?>> <?php echo e($pro->pro_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Assign By*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="assign_by">
                    <option value="">Select One</option>
                    <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->employee_id); ?>" <?php if($result->assign_by == $value->employee_id): ?> selected <?php endif; ?>> <?php echo e($value->employee_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Assign To*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="assign_to">
                    <option value="">Select One</option>
                    <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->employee_id); ?>" <?php if($result->employee_id == $value->employee_id): ?> selected <?php endif; ?>> <?php echo e($value->employee_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Task Title*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" value="<?php echo e($result->task_title); ?>" class=" form-control" <?php if($result->task_complete >0 ): ?> readonly  <?php endif; ?> name="task_title" required />
            </div>

        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Task Description*</label>
            <div class="col-md-6 col-sm-6">

                <textarea class="form-control" <?php if($result->task_complete >0 ): ?> readonly  <?php endif; ?> name="task_desc"><?php echo e($result->task_desc); ?></textarea>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Assign Date</label>
            <div class="col-md-3 col-sm-3">
                <input type="text" value="<?php echo e(date('d-m-Y',strtotime($result->assign_date))); ?>" name="assign_date" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff; width: 170px !important;"  />
            </div>
            Forecast Date
            <div class="col-md-3 col-sm-3">
                <input type="text" value="<?php echo e(date('d-m-Y',strtotime($result->forecast_date))); ?>" name="forecast_date" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff;width: 170px !important;"  />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Work Station</label>
            <div class="col-md-3 col-sm-3">
                <select class="form-control" name="work_station" style="width: 170px;">
                    <option value="">Select One</option>
                    <option value="1" <?php if($result->work_station =='1'): ?> selected <?php endif; ?>>In House</option>
                    <option value="2" <?php if($result->work_station =='2'): ?> selected <?php endif; ?>>Out Site Office</option>
                </select>
            </div>
            Task %
            <div class="col-md-3 col-sm-3">
                <input type="number" min="<?php echo e($result->task_complete); ?>" max="100" value="<?php echo e($result->task_complete); ?>" name="task_complete" class="form-control" id="" style="background-color:#fff;width: 170px !important; margin-left: 45px !important;"  />
            </div>
        </div>

      <!--  <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Project Priority*</label>
            <div class="col-md-6 col-sm-6">

                <select class="form-control" name="task_priority">
                    <option value="">Select Priority</option>
                    <?php $__currentLoopData = $priority; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($prio->LOOKUP_DATA_ID); ?>" <?php if($result->task_priority_id == $prio->LOOKUP_DATA_ID): ?> selected <?php endif; ?>><?php echo e($prio->LOOKUP_DATA_NAME); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Duration*</label>
            <div class="col-md-6 col-sm-6">
                <input type="number" value="<?php echo e($result->task_duration); ?>" class=" form-control" name="task_duration"  />
            </div>
        </div> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status <span
                    class="required  input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="active_status">
                    <option value="1" <?php echo e(($result->active_status==1)? 'selected':''); ?>>Active</option>
                    <option value="0" <?php echo e(($result->active_status<1)? 'selected':''); ?>>Inactive</option>
                </select>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <input type="hidden" name="task_id" value="<?php echo e($result->task_id); ?>">
                    <button type='reset' class="btn btn-success">Reset</button>
                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
            </div>
        </div>

    </form>
</div>

<script src="<?php echo e(URL::asset('assets/custom_js/custom_calendar.js')); ?>"></script>

<script type="text/javascript">
    $(document).on('focus', '.datepickerMonthYearAppend', function(e){
        $(e.target).daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_1",
            showDropdowns: true,
            minDate: $('#block_from_date').val(),
            maxDate: $('#block_to_date').val(),
            locale: {
                format: "DD-MM-YYYY"
            }
        })
    }).on('show.daterangepicker', function () {
        $('.table-condensed tbody tr:nth-child(2) td').click();
    });

    $('.time-picker').datetimepicker({
        format: 'hh:mm A'
    });

    function getDay() {
        var cDate = $('#class_start_date').val();
        if (cDate != '') {
            $.ajax({
                type: 'GET',
                url: '<?php echo e(url("/getDay")); ?>/' + cDate,
                success: function (data) {
                    $("#dayval").val(data);
                }
            });
        }
    }

    // block date validation for class routine add
    // $('#block_id').change(function(){
    //     $('#btnSubmit').prop("disabled",true);
    //     var blockID = $('#block_id').val();
    //     if (blockID != '') {
    //         $.ajax({
    //             type: 'GET',
    //             url: '<?php echo e(url("/classRoutine/getBlockDate/")); ?>/' + blockID,
    //             success: function (data) {
    //                 if(data==1){
    //                     $('#btnSubmit').prop("disabled",false);
    //                 }
    //             }
    //         });
    //     }
    // });

    // block date validation for class routine add
    $('#block_id').change(function(){
        $('#btnSubmit').prop("disabled",true);
        var blockID = $('#block_id').val();
        if (blockID != '') {
            $.ajax({
                type: 'GET',
                url: '<?php echo e(url("/classRoutine/getBlockDate/")); ?>/' + blockID,
                success: function (data) {
                    $('#block_from_date').val(data.dateForm);
                    $('#block_to_date').val(data.dateTo);
                    $('#class_start_date').focus();
                    // drp-calendar left single dspla none
                    if(data.status==1){
                        $('#btnSubmit').prop("disabled",false);
                    }
                }
            });
        }
    });

</script>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/task_report/update.blade.php ENDPATH**/ ?>