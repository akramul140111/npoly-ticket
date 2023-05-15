<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $actionUrl=url('/updateProjectInfo'); ?>
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="ProjectForm" data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>"
        class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        <?php echo csrf_field(); ?>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Client*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="client_id">
                    <option value="">Select Client</option>
                    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $clint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($clint->client_id); ?>" <?php if(isset($result)): ?> <?php if($result->client_id == $clint->client_id): ?> selected <?php endif; ?>  <?php endif; ?>> <?php echo e($clint->client_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Project Name*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" value="<?php if(isset($result)): ?> <?php echo e($result->project_name); ?> <?php endif; ?>" class=" form-control" name="project_name" required />
            </div>

        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Project Abr*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" value="<?php if(isset($result)): ?> <?php echo e($result->project_abbr); ?> <?php endif; ?>" class=" form-control" name="project_abbr" required />
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Project Status*</label>
            <div class="col-md-6 col-sm-6">

                <select class="form-control" name="client_id">
                    <option value="">Select Status</option>
                    <option value="1" selected>Open</option>
                    <option value="2">Work In Porgress</option>
                    <option value="3">Close</option>
                </select>
            </div>
        </div>
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
                <input type="hidden" name="project_id" value="<?php echo e($result->project_id); ?>">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                    <button type='reset' class="btn btn-success">Reset</button>
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
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/setup/projects/update.blade.php ENDPATH**/ ?>