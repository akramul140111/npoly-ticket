<?php $actionUrl=url('/storeSupportTicketInfo'); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startSection('title'); ?>
    <?php $__env->stopSection(); ?>
    <style>
        .stepButton{
            display: inline-block;
            float: right
        }
        .stepText{
            font-weight: bold;
            font-size: 17px;color:#f07184;
        }
        .stepTitle{
            display: inline-block;
        }
        html.touch *:hover {
            all:unset!important;
        }
        #buttonStyle:hover{
            background-color: #007bff;
        }


    </style>
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/student_assets/css/style.css')); ?>">
    <!-- Main css -->
    <div class="main" role="">
        <div class="container">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <section class="" >
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-lg-12 form-wizard">
                                            <!-- Form Wizard -->
                                            <form id="formValidate"  data-parsley-validate="" role="form" method="post" action="<?php echo e($actionUrl); ?>" class="form-label-left" enctype="multipart/form-data" autocomplete="off">
                                                <?php echo csrf_field(); ?>
                                                <!-- Form progress -->
                                               <!-- <div class="form-wizard-steps form-wizard-tolal-steps-4" style="padding-left:8px;text-align: center">
                                                    <div class="form-wizard-progress">
                                                        <div class="form-wizard-progress-line" data-now-value="16.25" data-number-of-steps="5" style="width: 12.25%;"></div>
                                                    </div>
                                                    <div class="form-wizard-step active">
                                                        <div class="form-wizard-step-icon"><i class="fa fa-clipboard" aria-hidden="true"></i></div>
                                                        <p>Problem/Severity</p>
                                                    </div>
                                                    <div class="form-wizard-step">
                                                        <div class="form-wizard-step-icon"><i class="fa fa-check" aria-hidden="true"></i></div>
                                                        <p>Solution</p>
                                                    </div>
                                                    <div class="form-wizard-step">
                                                        <div class="form-wizard-step-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                                        <p>Contact</p>
                                                    </div>
                                                    <div class="form-wizard-step">
                                                        <div class="form-wizard-step-icon"><i class="fa fa-upload" aria-hidden="true"></i></div>
                                                        <p>Attachment</p>
                                                    </div>
                                                </div> -->
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                            <div class="x_panel">
                                                                <div class="x_title">
                                                                    <div class="stepButton">
                                                                       <!-- <div class="form-wizard-buttons">
                                                                            <span><b class="stepText">Step 1 - 4</b></span>
                                                                            <button type="button" id="NextButton" class="btn btn-next btn-sm next-step-validation" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i>	</button>
                                                                            
                                                                        </div> -->
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="text-right stepTitle"><h4>Ticket Information : </h4></div>
                                                                </div>
                                                                <div class="x_content">
                                                                    <div class="row">
                                                                        <div class="card-box table-responsive">
                                                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Problem Summery: <span>*</span></label>
                                                                                        <input type="text" id="" name="ticket_title" placeholder="" value="" class="form-control required">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Problem Description: <span>*</span></label>
                                                                                        <textarea name="ticket_desc" class="form-control required"></textarea>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Issue Type: <span>*</span></label>
                                                                                        <select name="issue_type" id="" class="form-control required select2">
                                                                                            <option value="">--Select--</option>
                                                                                            <?php $__currentLoopData = $issueType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                <option value="<?php echo e($issue->LOOKUP_DATA_ID); ?>"><?php echo e($issue->LOOKUP_DATA_NAME); ?></option>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Module: <span>*</span></label>
                                                                                        <select class="form-control required select2" name="module_id">
                                                                                            <option value="">--Select--</option>
                                                                                            <?php if($supportModule): ?>
                                                                                                <?php $__currentLoopData = $supportModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <option value="<?php echo e($module->module_id); ?>"><?php echo e($module->module_name); ?></option>
                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                            <?php endif; ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Contact Person: <span>*</span></label>
                                                                                        <select class="form-control required select2" name="contact_person">
                                                                                            <option value="">--Select--</option>
                                                                                            <?php if($employees): ?>
                                                                                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <option value="<?php echo e($emp->employee_id); ?>"><?php echo e($emp->employee_name); ?></option>
                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                            <?php endif; ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Image:</label>
                                                                                        



                                                                                        <input style="color: red;border: 1px solid black" type="file" name="ticket_attachment[]" class="" multiple
                                                                                               onchange="document.getElementById('ticket_attachment').src = window.URL.createObjectURL(this.files[0])">
                                                                                    </div>




                                                                                   <!-- <div class="form-group">
                                                                                        <label>Business Impact: <span>*</span></label>
                                                                                        <select class="form-control required" name="business_impact">
                                                                                            <option value="">--Select--</option>
                                                                                            <?php $__currentLoopData = $businessImpact; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bussimp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                <option value="<?php echo e($bussimp->LOOKUP_DATA_ID); ?>"><?php echo e($bussimp->LOOKUP_DATA_NAME); ?></option>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>System Lifecycle: <span>*</span></label>
                                                                                        <select class="form-control required" name="system_lifecycle">
                                                                                            <option value="">--Select--</option>
                                                                                            <?php $__currentLoopData = $issueType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                <option value="<?php echo e($issue->LOOKUP_DATA_ID); ?>"><?php echo e($issue->LOOKUP_DATA_NAME); ?></option>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label>Severity: <span>*</span></label>
                                                                                        <select class="form-control required" name="priority_id">
                                                                                            <option value="">--Select--</option>
                                                                                            <?php if($priority): ?>
                                                                                                <?php $__currentLoopData = $priority; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <option value="<?php echo e($p->LOOKUP_DATA_ID); ?>" <?php if($p->LOOKUP_DATA_ID =='218'): ?> selected <?php endif; ?>><?php echo e($p->LOOKUP_DATA_NAME); ?></option>
                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                            <?php endif; ?>
                                                                                        </select>
                                                                                    </div> -->


                                                                                </div>
                                                                            </div>
                                                                            <div class="form-wizard-buttons">
                                                                                <button type="submit" class="btn btn-primary" id="buttonStyle">Submit</button>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                            <!-- Form Wizard -->
                                        </div>
                                    </div>

                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <script src="<?php echo e(URL::asset('assets/student_assets/js/student_info.js')); ?>"></script>

            <script>
                $(document).ready(function() {
                    $('.select2').select2();
                });
            </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.support_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/support_user/support_ticket_info.blade.php ENDPATH**/ ?>