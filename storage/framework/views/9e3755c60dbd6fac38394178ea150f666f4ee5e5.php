<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $actionUrl=url('/updateTicketAttachment/'); ?>
    <script>$('form').parsley();</script>
    <?php ini_set('memory_limit', -1) ?>
    <div class="flash-message"></div>
    <div class="x_content">
        <form id="projectSetupForm" data-parsley-validate="" role="form" method="post" action="<?php echo e(url('/updateTicketAttachment/'.$id)); ?>"
              class="form-label-left" enctype="multipart/form-data" autocomplete="off">
            <?php echo csrf_field(); ?>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Attachment*</label>
                <div class="col-md-6 col-sm-6">
                    <input type="file" class=" form-control" name="ticket_attachment[]" multiple style="width: 500px" />
                </div>
            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Note*</label>
                <div class="col-md-6 col-sm-6">
                    <textarea class="form-control" name="attachment_note" cols="5" rows="3" style="width: 500px !important;"><?php echo e($closeTicketInfo->attachment_note); ?></textarea>
                    <div>
                        <div style="width: 500px !important;"> <span>Check the box below if your file may contain either (i) personal information (ii) protected health information (PHI) subject to HIPAA. Do not provide any other sensitive personal information (such as payment card data) or U.S. federal government covered defense information (CDI) or controlled unclassified information (CUI) that requires protections greater than those specified in the Oracle GCS Security Practices link below.
                        </span><br>
                        <span><b>Please Note:</b> The information you provide will be transferred and accessed on a global basis by Oracle resources.</span>
                        </div>
                    </div>
                </div>
            </div>

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
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/support_user/updateTicketAttachment.blade.php ENDPATH**/ ?>