<?php $__env->startSection('content'); ?> <?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php $actionUrl=url('/updateLevel/'.$groupLevel->UG_LEVEL_ID);
?>
<script>
    $('form').parsley();

</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="" data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>" class="form-label-left"
        enctype="multipart/form-data" autocomplete="off">

        <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />
        <!-- send group id  -->

        <!-- <span class="section">Create Top Menu</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Level Name
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" value="<?php echo e($groupLevel->UGLEVE_NAME); ?>"
                    name="level_name" id="level_name" placeholder="" required />
            </div>
        </div>

        <div class="field item form-group form-check-inline">
            <label class="col-form-label col-md-3 col-sm-3  label-align"> Active ?
                <span class="required  input-field-required-sign"></span>
            </label>
            <div class="col-md-6 col-sm-6">
                <label class="form-check-label">
                    <input type="checkbox" name="status" class="form-check-input" value="1"
                        <?php echo e($groupLevel->ACTIVE_STATUS == 1 ? 'checked' : ''); ?>>
                </label>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <button type="submit" id='saveBtnStudentInfo' class="btn btn-primary">Submit</button>
                <button type='reset' class="btn btn-success">Reset</button>
            </div>
        </div>

    </form>
</div>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/security_access/user_group_level/edit.blade.php ENDPATH**/ ?>