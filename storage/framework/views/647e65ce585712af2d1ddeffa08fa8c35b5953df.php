<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $actionUrl=url('/updateCloseTicket/'); ?>
    <script>$('form').parsley();</script>
    <?php ini_set('memory_limit', -1) ?>
    <div class="flash-message"></div>









    <div class="x_content">
        <form id="closeReasonForm" data-parsley-validate="" role="form" method="post" action="<?php echo e(url('/updateCloseTicket/'.$id)); ?>"
              class="form-label-left" enctype="multipart/form-data" autocomplete="off">
            <?php echo csrf_field(); ?>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Reason For Close *</label>
                <div class="col-md-6 col-sm-6">
                   <select class=" form-control close-reason" name="close_reason" id="" style="width: 500px !important;" required>
                       <option value="">--Select--</option>
                       <?php $__currentLoopData = $closeReason; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($reason->LOOKUP_DATA_ID); ?>" <?php if($reason->LOOKUP_DATA_ID == $closeTicketInfo->close_reason): ?> selected <?php endif; ?>><?php echo e($reason->LOOKUP_DATA_NAME); ?></option>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
                </div>
            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Update Details*</label>
                <div class="col-md-6 col-sm-6">
                    <textarea class="form-control" name="close_update_details" required="required" cols="5" rows="3" style="width: 500px !important;"><?php echo e($closeTicketInfo->close_update_details); ?></textarea>
                    <div>
                        <div style="width: 500px !important;"><span><b>Note:</b></span> <span>Do not submit any personal information, protected health information subject to HIPAA, any other sensitive personal information (such as payment card data), or U.S. federal government covered defense information (CDI) or controlled unclassified information (CUI) that requires protections greater than those specified in the Oracle GCS Security Practices link below.</span></div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="ticket_id" value="<?php echo e($id); ?>">
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <button type='reset' class="btn btn-success">Reset</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.close-reason').select2({
                dropdownParent: $('.modal .modal-content')
            });
        });

        $(document).on('click','#btnSubmit',function (){
            var reasonId = $('.close-reason').val();
            if(reasonId==''){
                $('.select2-container').css('border','1px solid #E85445');
            }
        });

        $(document).on('change','.close-reason',function (){
            var reasonId = $('.close-reason').val();
            if(reasonId!=''){
                $('.select2-container').css('border','1px solid #ffff');
            }
        })

    </script>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/support_user/updateCloseTicket.blade.php ENDPATH**/ ?>