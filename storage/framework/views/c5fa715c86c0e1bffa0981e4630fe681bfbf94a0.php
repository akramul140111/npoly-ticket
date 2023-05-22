<?php $__env->startSection('content'); ?> <?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php $actionUrl=url('/updatemoduleSetup/'.$modules->MODULE_ID);?>
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>" class="form-label-left" enctype="multipart/form-data"
        autocomplete="off">
        <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />
        <input type="hidden" name="id" id="id">

        <!-- <span class="section">Create Top Menu</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Module Name
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="module_name" id="module_name" placeholder="" value="<?php echo e($modules->MODULE_NAME); ?>"
                    required/>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Short Name
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="short_name" id="short_name" placeholder="" value="<?php echo e($modules->SHORT_NAME); ?>"
                    required/>
            </div>
        </div>
        <!-- <span class="section">Create Top Menu</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Module Name Bangla
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="module_name_bangla" id="module_name_bangla" value="<?php echo e($modules->MODULE_NAME_BN); ?>"
                    placeholder="" required/>
            </div>
        </div>
        <!-- <span class="section">Create Top Menu</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Serial No
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input type="number" class="form-control input-field-required-sign" name="serial_no" id="serial_no" value="<?php echo e($modules->SL_NO); ?>"
                    placeholder="" required/>
            </div>
        </div>


        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status
                <span class="required  input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="active_status">
                    <option value="1" <?php echo e($modules->ACTIVE_STATUS == 1 ? 'selected' : ''); ?> > Active </option>
                    <option value="0" <?php echo e($modules->ACTIVE_STATUS == 0 ? 'selected' : ''); ?> > Inactive</option>
                </select>
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
</div><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/security_access/modules/edit.blade.php ENDPATH**/ ?>