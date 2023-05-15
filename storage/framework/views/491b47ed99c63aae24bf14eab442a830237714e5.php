<?php $__env->startSection('content'); ?> <?php echo $__env->make('layouts.modalFormSubmit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $actionUrl=url('/storeUser'); ?>
<script>
    $('form').parsley();

</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <form id="" data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>" class="form-label-left"
            enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />
            <div class="col-lg-6 col-md-6 col-sm-6">




























                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Department
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select class="form-control" name="department" required id="departmentId">
                            <option value="">--select--</option>
                            <?php $__currentLoopData = $courseNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $courseName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($courseName->LOOKUP_DATA_ID); ?>"><?php echo e($courseName->LOOKUP_DATA_NAME); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Employee
                        <span class="required input-field-required-sign"></span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select class="form-control select2" name="employee_id" id="employeeId">
                            <option value="">--select--</option>

                        </select>
                    </div>
                </div>
                <!--  <span class="section">Add Module</span> -->
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Group
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select class="form-control" name="group_name" id="groupName" required>
                            <option value="">--select--</option>

                            <?php $__currentLoopData = $user_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user_group->USERGRP_ID); ?>"><?php echo e($user_group->USERGRP_NAME); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Role
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select class="form-control" name="user_level" id="userLevel" required>

                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Designation
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select name="designation" id="" class="form-control" required>
                            <option value="">--select--</option>
                            <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($designation->LOOKUP_DATA_ID); ?>"><?php echo e($designation->LOOKUP_DATA_NAME); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <!-- <span class="section">Create Top Menu</span> -->



                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Contact No.
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control input-field-required-sign" name="contact_no" id="contact_no"
                            placeholder="" required />
                    </div>
                </div>
                <!-- <span class="section">Create Top Menu</span> -->

            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Full Name
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input class="form-control input-field-required-sign" name="user_name" id="user_name"
                            placeholder="" required />
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Email
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="email_address" class="form-control input-field-required-sign" name="email_address"
                            id="email" placeholder="" required />
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">User Name
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input class="form-control input-field-required-sign" name="email" id="login_name"
                            placeholder="" required />
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Password
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="password" class="form-control input-field-required-sign" name="password"
                            id="password" placeholder="" required />
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status
                        <span class="required  input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select class="form-control" name="status">
                            <option value="1"> Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- <div class="field item form-group form-check-inline">
            <label class="col-form-label col-md-3 col-sm-3  label-align"> Is Admin
                <span class="required  input-field-required-sign"></span>
            </label>
            <div class="col-lg-9 col-md-9 col-sm-9">
                <label class="form-check-label">
                    <input type="checkbox" name="is_admin" class="form-check-input" value="1">
                </label>
            </div>
        </div> -->
                <div class="clearfix"></div>

                <div class="form-group">
                    <div class="col-md-6 offset-md-3">
                        <button type='reset' class="btn btn-success">Reset</button>
                        <button type="submit" id='saveBtnStudentInfo' class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#groupName').on('change', function (e) {
            var group_name = e.target.value;

            $.ajax({
                url: "<?php echo e(route('userGroupLevel')); ?>",
                type: "POST",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    group_name: group_name
                },

                success: function (data) {


                    $('#userLevel').empty();
                    $.each(data.groupLevels, function (index, userLevel) {
                        $('#userLevel').append('<option value="' + userLevel
                            .UG_LEVEL_ID + '">' + userLevel.UGLEVE_NAME +
                            '</option>');
                    })

                }

            })
        });
    });

</script>
<script>
    $('#departmentId').change(function(){
        var deptId = $(this).val();
        $('#employeeId').html('<option value="">--select--</option>');
        if(deptId!=''){
            $.ajax({
                type: 'GET',
                url: '<?php echo e(url("/getEmployee")); ?>/'+deptId,
                success: function (data) {
                    $('#employeeId').html(data);
                }
            });
        }
    });
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('.modal .modal-content')
        });
    });
</script>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/security_access/new_user/create.blade.php ENDPATH**/ ?>