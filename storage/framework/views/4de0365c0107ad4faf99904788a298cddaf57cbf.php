<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $actionUrl=url('/updateTaskInfo'); ?>
    <script>$('form').parsley();</script>
    <style>
        .reasonDiv{
            display:none; }
    </style>
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
                    <input type="text" value="<?php echo e(date('d-m-Y',strtotime($result->assign_date))); ?>" name="assign_date_dis" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff; width: 170px !important;" disabled />
                    <input type="hidden" value="<?php echo e(date('d-m-Y',strtotime($result->assign_date))); ?>" name="assign_date">
                </div>
                Forecast Date
                <div class="col-md-3 col-sm-3">
                    <input type="text" value="<?php echo e(date('d-m-Y',strtotime($result->forecast_date))); ?>" name="forecast_date" class="form-control assignDate datepickerMonthYearAppend" id="changeForecastDate" style="background-color:#fff;width: 170px !important;"  />
                    <input type="hidden" class="oldForecastDate" value="<?php echo e(date('Y-m-d',strtotime($result->forecast_date))); ?>">
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
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align reasonDiv">Reason *</label>
                <div class="col-md-6 col-sm-6 reasonDiv">
                    <input type="text" value="" class=" form-control change_reason" name="fdate_change_reason" />
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
                minDate: new Date(),
                locale: {
                    format: "DD-MM-YYYY"
                }
            })
        }).on('show.daterangepicker', function () {
            $('.table-condensed tbody tr:nth-child(2) td').click();
        });

        $(document).off('change','#changeForecastDate').on('change','#changeForecastDate',function(){
            var fDate = $(this).val();
            var oldDate = $('.oldForecastDate').val();
            //var changeFormatDate = moment(changeForeCastDate).format('YYYY-MM-DD');



            var year = fDate.substr(-4);
            var day = fDate.substring(0,2);
            var month = fDate.slice(3, -5);

            //var newDate = month+'-'+ day +'-'+year;
            var changeDate = year+'-'+ month +'-'+day;

            if(changeDate > oldDate){
                $('.reasonDiv').css('display','block')
                $('.change_reason').prop('required',true)
            }else{
                $('.reasonDiv').css('display','none')
                $('.change_reason').prop('required',false)
            }

        });

    </script>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/task_report/update.blade.php ENDPATH**/ ?>