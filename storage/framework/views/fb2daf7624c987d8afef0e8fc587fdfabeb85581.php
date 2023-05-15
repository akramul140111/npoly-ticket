<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $actionUrl=url('/updateModuleLinkSetup/'.$moduleLink->SA_MLINKS_ID); ?>
<script>
    $('form').parsley();

</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="" data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>" class="form-label-left"
        enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />

        <!--  <span class="section">Add Module</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Module Name*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="module_id" required>
                    <option value="">--select--</option>

                    <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($module->MODULE_ID); ?>"
                        <?php echo e($module->MODULE_ID == old('SA_MODULE_ID', $moduleLink->SA_MODULE_ID) ? 'selected' : ''); ?>>
                        <?php echo e($module->MODULE_NAME); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>
            </div>
        </div>
        <!-- <span class="section">Create Top Menu</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Module Link Name <span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" value="<?php echo e($moduleLink->SA_MLINK_NAME); ?>"
                    name="module_link_name" id="module_link_name" value="" placeholder="" required />
            </div>
        </div>
        <!-- <span class="section">Create Top Menu</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Module Link Page<span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="module_link_page" id="module_link_page"
                    value="<?php echo e($moduleLink->SA_MLINK_PAGES); ?>" placeholder="" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Module Link Uri<span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="module_link_uri" id="module_link_uri"
                    value="<?php echo e($moduleLink->URL_URI); ?>" placeholder="" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">SL No
            </label>
            <div class="col-md-6 col-sm-6">
                <input type="number" class="form-control input-field-required-sign" name="SL_NO" id="module_link_uri"
                    value="<?php echo e($moduleLink->SL_NO); ?>" />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Url Function<span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="url_function" id="url_function"
                    value="<?php echo e($moduleLink->url_function); ?>" placeholder="" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Url Class<span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="url_class" id="url_class"
                    value="<?php echo e($moduleLink->url_class); ?>" placeholder="" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Url Name<span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="url_name" id="url_name"
                    value="<?php echo e($moduleLink->url_name); ?>" placeholder="" required />
            </div>
        </div>


        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Url Type<span
                    class="required  input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="url_type">
                    <option value="post" <?php echo e($moduleLink->url_type == "post" ? 'selected' : ''); ?>> Post </option>
                    <option value="get" <?php echo e($moduleLink->url_type == "get" ? 'selected' : ''); ?>> Get</option>
                </select>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status <span
                    class="required  input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="status">
                    <option value="1" <?php echo e($moduleLink->STATUS == 1 ? 'selected' : ''); ?>> Active </option>
                    <option value="0" <?php echo e($moduleLink->STATUS == 0 ? 'selected' : ''); ?>> Inactive</option>
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
</div>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/security_access/modules_links/edit.blade.php ENDPATH**/ ?>