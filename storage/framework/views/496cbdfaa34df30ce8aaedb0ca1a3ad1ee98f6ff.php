<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $actionUrl=url('/updateEmployeeInfo'); ?>
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="ProjectForm" data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>"
        class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="employee_id" class="control-label">Name Name * </label>
                        <input type="text" id="employee_id"  class="form-control" placeholder="Please Enter Full Name" value="<?php echo e($result->employee_name); ?>" name="employee_name"  required="required" autocomplete="off" />
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="gender" class="control-label">Gender * </label>
                        <select class="form-control dept_no"  style="width:100%"  name="gender" required>
                            <option value="">--SELECT--</option>
                            <?php $__currentLoopData = $gender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($gen->lookup_data_id); ?>" <?php if($result->gender==$gen->lookup_data_id): ?> selected <?php endif; ?>><?php echo e($gen->lookup_data_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="date_of_birth" class="control-label">Date Of Birth</label>
                        <input type="text" id="date_of_birth"  class="form-control  datepickerMonthYearAppend" placeholder="mm-dd-yy" value="<?php echo e(date('d-m-Y',strtotime($result->date_of_birth))); ?>" name="date_of_birth" autocomplete="off" required/>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="employee_id" class="control-label">Card No* </label>
                        <input type="text" id="card_no"  class="form-control" placeholder="Please Enter Card No" value="<?php echo e($result->card_no); ?>" name="card_no"  required autocomplete="off" />
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="religion" class="control-label">Religion</label>
                        <select class="form-control dept_no "  style="width:100%"  name="religion">
                            <option value="">--SELECT--</option>
                            <?php $__currentLoopData = $religion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($rel->lookup_data_id); ?>" <?php if($result->religion == $rel->lookup_data_id): ?> selected <?php endif; ?>><?php echo e($rel->lookup_data_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="marital_status" class="control-label">Marital Status </label>
                        <select class="form-control dept_no"  style="width:100%"  name="marital_status">
                            <option value="">--SELECT--</option>
                            <?php $__currentLoopData = $maritalStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($mer->lookup_data_id); ?>" <?php if($result->marital_status==$mer->lookup_data_id): ?> selected <?php endif; ?>><?php echo e($mer->lookup_data_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="department" class="control-label">Employee Department * </label>
                        <select class="form-control select2"  style="width:100%"  name="department_id" required>
                            <option value="">--SELECT--</option>
                            <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($dep->lookup_data_id); ?>" <?php if($result->department_id==$dep->lookup_data_id): ?> selected <?php endif; ?>> <?php echo e($dep->lookup_data_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="designation" class="control-label">Employee Designation * </label>
                        <select class="form-control select2"  style="width:100%"  name="designation_id" required>
                            <option value="">--SELECT--</option>
                            <?php $__currentLoopData = $designation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $deg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($deg->lookup_data_id); ?>" <?php if($result->designation_id==$deg->lookup_data_id): ?> selected <?php endif; ?>> <?php echo e($deg->lookup_data_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="hire_date" class="control-label">Employee Hire Date</label>
                        <input type="text" id="hire_date"  class="form-control datepickerMonthYearAppend" placeholder="mm-dd-yy" value="<?php if(!empty($result->hire_date)): ?> <?php echo e(date('d-m-Y',strtotime($result->hire_date))); ?> <?php endif; ?>" name="hire_date" autocomplete="off"  required/>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group has-feedback">
                        <label for="office_email" class="control-label">Official Email Address</label>
                        <input type="email" required="required" id="office_email"  class="form-control check_biometric" placeholder="Please Enter Official Email Address" value="<?php echo e($result->office_email); ?>" name="office_email" autocomplete="off" />
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="mobile_no" class="control-label">Mobile Number</label>
                        <input type="number" id="mobile_no"  class="form-control check_biometric" placeholder="Please Enter Official Mobile Number" value="<?php echo e($result->mobile_no); ?>" name="mobile_no"  />
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="national_id" class="control-label">National ID </label>
                        <input type="number" id="national_id"  class="form-control check_biometric" placeholder="Please Enter National ID" value="<?php echo e($result->national_id); ?>" name="national_id"  />
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                        <input type="hidden" name="employee_id" value="<?php echo e($result->employee_id); ?>">
                    </div>
                </div>
            </div>

            <div class="form-group pull-right">
                <div class="col-md-6 pull-left col-sm-6 col-xs-12 ">
                    <input  type="reset" class="btn btn-primary pull-right">
                </div>
                <div class="col-md-6 pull-right col-sm-6 col-xs-12 ">
                    <button type="submit" class="btn btn-success pull-right" id="btnSubmit">Update</button>
                </div>
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

    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('.modal .modal-content')
        });
    });

</script>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/employee/update.blade.php ENDPATH**/ ?>