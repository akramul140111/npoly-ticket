<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $actionUrl=url('/updateSupportModuleInfo'); ?>
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="ProjectForm" data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>"
        class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        <?php echo csrf_field(); ?>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Department *</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="client_id">
                    <option value="">Select Department</option>
                    <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dept->LOOKUP_DATA_ID); ?>" <?php if(isset($result)): ?> <?php if($result->department_id == $dept->LOOKUP_DATA_ID): ?> selected <?php endif; ?>  <?php endif; ?>> <?php echo e($dept->LOOKUP_DATA_NAME); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Module Name*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" value="<?php if(isset($result)): ?> <?php echo e($result->module_name); ?> <?php endif; ?>" class=" form-control" name="module_name" required />
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
                <input type="hidden" name="module_id" value="<?php echo e($result->module_id); ?>">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                    <button type='reset' class="btn btn-success">Reset</button>
            </div>
        </div>

    </form>
</div>

<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/setup/support_module/update.blade.php ENDPATH**/ ?>