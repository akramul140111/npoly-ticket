<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $actionUrl=url('/storeTask'); ?>
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form id="" data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>" class="form-label-left"
                  enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Client :: Project*</label>
                        <div class="col-md-9 col-sm-9">
                            <select class="form-control" name="project_id">
                                <option value="">Select One</option>
                                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $clint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($clint->project_id); ?>"> <?php echo e($clint->pro_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <!--  <span class="section">Add Module</span> -->
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Task Title*</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" class="  form-control" name="task_title" required />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Task Description*</label>
                        <div class="col-md-9 col-sm-9">
                            <textarea class="form-control" name="task_desc" cols="5" rows="5"></textarea>
                        </div>
                    </div>


                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Assign By*</label>
                        <div class="col-md-9 col-sm-9">
                            <select class="form-control" name="assign_by">
                                <option value="">Select One</option>
                                <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->employee_id); ?>"> <?php echo e($value->employee_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Assign Date
                            <span class="required input-field-required-sign">*</span>
                        </label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="text" name="assign_date" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff;"  />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Forecast Date
                            <span class="required input-field-required-sign">*</span>
                        </label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="text" name="forecast_date" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff;"  />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Work Station*</label>
                        <div class="col-md-9 col-sm-9">
                            <select class="form-control" name="work_station">
                                <option value="">Select One</option>
                                <option value="1"> In House</option>
                                <option value="2"> Out Side Office</option>
                            </select>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <span style="padding-left: 30px !important;">Do You Want To Start This Task</span>

                            <input style="margin-left: 20px !important;" type="checkbox" value="0" id="startStatus" name="start_status">

                    </div>
                </div>

                <!--<div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="field item form-group">
                            <label class="col-form-label col-md-2 col-sm-2 label-align">Task Description*</label>
                            <div class="col-md-10 col-sm-10">
                               <textarea class="form-control" name="task_desc"></textarea>
                            </div>
                        </div>
                    </div> -->




                    <div class="clearfix"></div>

                    <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                            <button type='reset' class="btn btn-success">Reset</button>
                            <button type="submit" id='saveBtnStudentInfo' class="btn btn-primary">Submit</button>
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

    // check task start status

    $('#startStatus').click(function (){
        if($(this).prop('checked')){
           let checkConfirm = confirm('Do You Want To Start This Task');
           if(checkConfirm ==true){
            $('#startStatus').val(1)
           }else{
               return false
           }
        }else{
            $('#startStatus').val(0)
        }
    });



</script>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/task_report/create.blade.php ENDPATH**/ ?>