<?php $__env->startSection('content'); ?> <?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $actionUrl=url('/updateLookupGroupItem/'.$lookup_group_item->LOOKUP_DATA_ID); ?>
<script>
    $('form').parsley();

</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="" data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>" class="form-label-left"
        enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />
        <input type="hidden" value="<?php echo e($USE_CHAR_NUMB); ?>" name="lookup_group_name">
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Item Name
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" value="<?php echo e($lookup_group_item->LOOKUP_DATA_NAME); ?>"
                    name="item_name" id="item_name" placeholder="" required />
            </div>
        </div>
        <!-- <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Short Name Char
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <?php if($USE_CHAR_NUMB== 'C'): ?>
                <input class="form-control input-field-required-sign cha_text_validation"
                    value="<?php echo e($lookup_group_item->CHAR_LOOKUP); ?>" name="short_name_cha" id="short_name_cha" placeholder=""
                    required />
                <?php else: ?>
                <input type="hidden" class="form-control input-field-required-sign"
                    value="<?php echo e($lookup_group_item->NUMB_LOOKUP); ?>" name="short_name_num" id="short_name_num" placeholder=""
                    required />
                <?php endif; ?>
            </div>
        </div> -->
        <?php if($lookup_group->SHORT_NAME_STATUS==1): ?>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Short Name
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">               
                    <input type="text" class="form-control input-field-required-sign"
                        value="<?php echo e($lookup_group_item->SHORT_NAME); ?>" name="SHORT_NAME" id="SHORT_NAME" placeholder=""
                        required />
            </div>
        </div>
        <?php endif; ?>
        <div class="field item form-group form-check-inline">
            <label class="col-form-label col-md-3 col-sm-3  label-align"> Active
                <span class="required  input-field-required-sign"></span>
            </label>
            <div class="col-md-6 col-sm-6">
                <select name="status" id="" class="form-control">
                    <option value="1" <?php echo e(($lookup_group_item->ACTIVE_FLAG==1)? 'selected':''); ?>>Active</option>
                    <option value="0"   <?php echo e(($lookup_group_item->ACTIVE_FLAG==0)? 'selected':''); ?>>Inactive</option>
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
<!-- input field only  text -->
<script>
    $('.cha_text_validation').on('input', function () {
        if (!/[a-z]$/.test(this.value)) {
            this.value = this.value.slice(0, -1);
        }
    });

</script>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/lookup/edit_group_item.blade.php ENDPATH**/ ?>