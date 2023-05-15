<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $actionUrl=url('/storeProject'); ?>
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="projectSetupForm" data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>"
        class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        <?php echo csrf_field(); ?>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Client*</label>
            <div class="col-md-6 col-sm-6">

                <select class="form-control" name="client_id">
                    <option value="">Select Client</option>
                    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $clint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($clint->client_id); ?>"> <?php echo e($clint->client_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Project Name*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" class=" form-control" name="project_name" required />
            </div>

        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Project Abr*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" class=" form-control" name="project_abbr" required />
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Project Status*</label>
            <div class="col-md-6 col-sm-6">

                <select class="form-control" name="client_id">
                    <option value="">Select Status</option>
                    <option value="1">Open</option>
                    <option value="2">Work In Porgress</option>
                    <option value="3">Close</option>
                </select>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                <button type='reset' class="btn btn-success">Reset</button>
            </div>
        </div>

    </form>
</div>

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

    // get day of a date



</script>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/setup/projects/create.blade.php ENDPATH**/ ?>