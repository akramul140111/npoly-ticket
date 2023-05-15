<?php $actionUrl=url('/storeStudentInfo'); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>
<style>
	#addAcademicRow:hover{
		background-color: white;
	}
	#addAcademicRow{
		background-color: white;
	}
	#removeAcadRow{
		background-color: white;
	}
	#removeAcadRow:hover{
		background-color: white;
	}
	#addSubPubRow{
		background-color: white;
	}
	#addSubPubRow:hover{
		background-color: white;
	}
	#addSkillRow{
		background-color: white;
	}
	#addSkillRow:hover{
		background-color: white;
	}
	#addTrainRow{
		background-color: white;
	}
	#addTrainRow:hover{
		background-color: white;
	}
	#removeRowTrini{
		background-color: white;
	}
	#removeRowTrini:hover{
		background-color: white;
	}
	#removeRowPub{
		background-color: white;
	}
	#removeRowPub:hover{
		background-color: white;
	}
	#removeRowSkil{
		background-color: white;
	}
	#removeRowSkil:hover{
		background-color: white;
	}
	.remove-row{
		background-color: white;
	}
	.remove-row:hover{
		background-color: white;
	}
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

	.wrapper {
		display: flex;
		flex-direction: row;
		align-items: center
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
											<div class="form-wizard-steps form-wizard-tolal-steps-4" style="padding-left:8px;text-align: center">
												<div class="form-wizard-progress">
													<div class="form-wizard-progress-line" data-now-value="16.25" data-number-of-steps="5" style="width: 12.25%;"></div>
												</div>
												<!-- Step 1 -->
												<div class="form-wizard-step active">
													<div class="form-wizard-step-icon"><i class="fa fa-clipboard" aria-hidden="true"></i></div>
													<p>Problem/Severity</p>
												</div>
												<!-- Step 1 -->
												<!-- Step 2 -->
												<div class="form-wizard-step">
													<div class="form-wizard-step-icon"><i class="fa fa-check" aria-hidden="true"></i></div>
													<p>Solution</p>
												</div>
												<!-- Step 2 -->

												<!-- Step 2.1 -->
												<!-- Step 2.1 -->


												<!-- Step 3 -->





												<div class="form-wizard-step">
													<div class="form-wizard-step-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
													<p>Contact</p>
												</div>
												<!-- Step 7 -->

												<!-- Step 8 -->
												<div class="form-wizard-step">
													<div class="form-wizard-step-icon"><i class="fa fa-upload" aria-hidden="true"></i></div>
													<p>Attachment</p>
												</div>
												<!-- Step 8 -->

											</div>
											<!-- Form progress -->

											<!-- Form Step 1 -->
											<fieldset>
												<div class="row">
													<div class="col-md-12 col-sm-12 col-lg-12">
														<div class="x_panel">
															<div class="x_title">
																<div class="stepButton">
																	<div class="form-wizard-buttons">
																		<span><b class="stepText">Step 1 - 4</b></span>
																		<button type="button" id="NextButton" class="btn btn-next btn-sm next-step-validation" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i>	</button>
																		
																	</div>
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
																					<select name="issue_type" id="" class="form-control required">
																						<option value="">--Select--</option>
                                                                                        <?php $__currentLoopData = $issueType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <option value="<?php echo e($issue->LOOKUP_DATA_ID); ?>"><?php echo e($issue->LOOKUP_DATA_NAME); ?></option>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-6 col-sm-6 col-lg-6">
                                                                                <div class="form-group">
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
                                                                                </div>


																			</div>
																		</div>
																		<div class="form-wizard-buttons">
																			

																			<button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i>	</button>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</fieldset>
											<fieldset>
												<div class="row">
													<div class="col-md-12 col-sm-12 col-lg-12">
														<div class="x_panel">
															
															
															
															
															<div class="x_title">
																<div class="stepButton">
																	<div class="form-wizard-buttons">
																		<span><b class="stepText">Step 2 - 4</b></span>
																		
																		
																		<button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
																		<button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>

																	</div>
																	<div class="clearfix"></div>
																</div>
																<div class="text-right stepTitle"><h4>Solution Information : </h4></div>
															</div>
															<div class="x_content">
																<div class="row">
																	<div class="card-box table-responsive">
																		<div class="col-md-12 col-sm-12 col-lg-12">
																			<div class="col-md-6 col-sm-6 col-lg-6">
                                                                                <!--<div class="form-group">
                                                                                    <label>Problem List: <span>*</span></label>
                                                                                    <select class="form-control required" name="module_id">
                                                                                        <option value="">--Select--</option>
                                                                                        <?php $__currentLoopData = $problemList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <option value="<?php echo e($prob->LOOKUP_DATA_ID); ?>"><?php echo e($prob->LOOKUP_DATA_NAME); ?></option>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    </select>
                                                                                </div> -->
                                                                                <div class="form-group">
                                                                                    <label>Module: <span>*</span></label>
                                                                                    <select class="form-control required" name="module_id">
                                                                                        <option value="">--Select--</option>
                                                                                        <?php if($supportModule): ?>
                                                                                            <?php $__currentLoopData = $supportModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                <option value="<?php echo e($module->module_id); ?>"><?php echo e($module->module_name); ?></option>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php endif; ?>
                                                                                    </select>
                                                                                </div>
																			</div>
																			<div class="col-md-6 col-sm-6 col-lg-6">
																			</div>
																		</div>


																		<div class="form-wizard-buttons">
																			
																			
																			<button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
																			<button type="button" class="btn btn-next"  data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
																		</div>

																	</div>
																</div>
															</div>

														</div></div></div>
											</fieldset>
											<fieldset>
												<div class="row">
													<div class="col-md-12 col-sm-12 col-lg-12">
														<div class="x_panel">
															
															
															
															
															<div class="x_title">
																<div class="stepButton">
																	<div class="form-wizard-buttons">
																		<span><b class="stepText">Step 3 - 4</b></span>
																		
																		
																		<button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
																		<button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>

																	</div>
																	<div class="clearfix"></div>
																</div>
																<div class="text-right stepTitle"><h4>Contact  Information : </h4></div>
															</div>
															<div class="x_content">
																<div class="row">
																	<div class="card-box table-responsive">
																		<div class="col-md-12 col-sm-12 col-lg-12">
																			<div class="col-md-6 col-sm-6 col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label>Contact Person: <span>*</span></label>
                                                                                    <select class="form-control required" name="module_id">
                                                                                        <option value="">--Select--</option>
                                                                                        <?php if($employees): ?>
                                                                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                <option value="<?php echo e($emp->employee_id); ?>"><?php echo e($emp->employee_name); ?></option>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php endif; ?>
                                                                                    </select>
                                                                                </div>
																			</div>
																			<br>

																			<div class="form-wizard-buttons">
																				
																				
																				<button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
																				<button type="button" class="btn btn-next"  data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
																			</div>

																		</div>
																	</div>
																</div>

															</div></div></div>
                                                </div>
											</fieldset>
											<!-- <fieldset>

												<div class="row">
													<div class="col-md-12 col-sm-12 col-lg-12">
														<div class="x_panel">
															
															
															
															
															<div class="x_title">
																<div class="stepButton">
																	<div class="form-wizard-buttons">
																		<span><b class="stepText">Step 8 - 9</b></span>
																		
																		
																		<button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
																		<button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
																	</div>
																	<div class="clearfix"></div>
																</div>
																<div class="text-right stepTitle"><h4>Skill Information : </h4></div>
															</div>
															<div class="x_content">
																<div class="row">
																	<div class="card-box table-responsive">

																		<div style="clear:both;"></div>
																		<div class="col-md-12 col-sm-12 col-lg-12">
																			<div class="text-align-center red" style="margin: -5px 0 5px 0; display:none" id="msg4"></div>
																			<table class="table table-borderd skill-tbl  custom-table-border" id="tableID4">
																				<thead>
																				<tr>
																					<th>Name*</th>
																					<th class="text-center">
																						<button class="btn btn-default btn-sm add-row" style="color:black" title="Add Row" id="addSkillRow" type="button"><i  class="glyphicon glyphicon-plus"></i></button>
																					</th>
																				</tr>
																				</thead>
																				<tbody>

																					<tr>
																						<td>
																							<input type="text" class="form-control skillStatus " value="" name="skill_name[]" />
																						</td>
																						<td class="text-center">
																							<button class="btn btn-default remove-row" style="color:red" id="removeRowSkil" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>

																		<br/>
																		<div class="form-wizard-buttons">
																			
																			
																			<button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
																			<button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div></div>
											</fieldset>-->
											<fieldset>

												<div class="row">
													<div class="col-md-12 col-sm-12 col-lg-12">
														<div class="x_panel">
															
															
															
															
															<div class="x_title">
																<div class="stepButton">
																	<div class="form-wizard-buttons">
																		<span><b class="stepText">Step 4 - 4</b></span>
																		
																		
																		<button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
																		
																	</div>
																	<div class="clearfix"></div>
																</div>
																<div class="text-right stepTitle"><h4>Attachment Information : </h4></div>
															</div>
															<div class="x_content">
																<div class="row">
																	<div class="card-box table-responsive">

																		<div style="clear:both;"></div>
																		<div class="col-md-12 col-sm-12 col-lg-12">
																			<div class="col-md-6 col-sm-6 col-lg-6">
																				<div class="form-group">
																					<label>Image: <span>*</span></label>
																					



																					<input style="color: red;border: 1px solid black" type="file" name="students_image" class=""
																						   onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
																				</div>
																			</div>
																			<!--<div class="col-md-6 col-sm-6 col-lg-6">
																				<div class="form-group">
																					<label>Student Signature: <span>*</span></label>
																					



																					<input style="color: red;border: 1px solid black"  type="file" name="students_signature"  class=""
																						   onchange="document.getElementById('signiture').src = window.URL.createObjectURL(this.files[0])">
																				</div>
																			</div> -->
																		</div>

																		<br/>
																		<div class="form-wizard-buttons">
																			
																			
																			<button type="submit" class="btn btn-primary" id="buttonStyle">Submit</button>
																			<button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
																			
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div></div>
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

            var counter = 0;
            $("#addSubPubRow").on("click", function () {
                // publicatonStatus

				var noAddStatusaddSubPubRow = false;
                $('.publicatonStatus').map(function () {
                    if(this.value==''){
                        showMessage(6,'Please fill up the field first.');
                        noAddStatusaddSubPubRow = true;
                    }
                }).get();

                if(noAddStatusaddSubPubRow){
                    return false;
                }

                var newRow = $("<tr>");
                var cols = "";
                //cols += '<td><input type="hidden" value="" name="sub_block_id[]" class="actualDel">';
                cols += '<td><input type="hidden" name="orgName[]" value="1"><input type="text" value="" name="publication_name[]" class="form-control publicatonStatus" >';

                cols += '<td><input type="text" class="form-control datepickerMonthYearAppend" name="publication_start_date[]" required/></td>';
                cols += '<td><input type="text" class="form-control datepickerMonthYearAppend" name="publication_end_date[]" required/></td>';
                cols += '<td><input type="hidden" class="form-control addrow" name="image_alternative[]"/><input type="file" multiple="multiple" class="form-control " name="imageFile[]"/></td>';
                cols += '<td class="text-center"><button class="btn btn-default ibtnDel" id="removeRowPub" style="color:red" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button></td>';
                cols += '</tr>';
                newRow.append(cols);
                $("table.pub-tbl").append(newRow);
                counter++;
            });

            $(document).on('click','#removeRowPub',function () {
                var rowCount = $('#tableID3 >tbody >tr').length;
                if(rowCount == 1){
                    showMessage(6,'You can\'t delete this row.');
                }else{
                    $(this).closest("tr").remove();
                }
            });


            var counterc = 0;
            $("#addAcademicRow").on("click", function () {

                var noAddStatus = false;
                $('.educLevel').map(function () {
                    if(this.value==''){
                        showMessage(3,'Please fill up the field first.');
                        noAddStatus = true;
                    }
                }).get();

                if(noAddStatus){
                    return false;
                }

                var newRow = $("<tr>");
                var cols = "";
                cols += '<td>';
                cols += '<select class="form-control educLevel required" onchange="levelofEducChecking($(this))" name="label_of_education[]">';
                cols += '<option value="">--select--</option>';


                    cols += '</select></td>';
                cols += '<td>';
                cols += '<select class="form-control degree required" onchange="levelofDegreeChecking($(this))" name="degree[]">';
                cols += '<option value="">--select--</option>';

                    cols += '</select></td>';
                cols += '<td><input type="text" class="form-control required" name="academic_institute_board[]" required/></td>';
                cols += '<td><input type="number" class="form-control required" name="academic_passing_year[]" required/></td>';
                cols += '<td><input type="text" id="" class="form-control required" name="academic_result[]"/></td>';
                cols += '<td class="text-center"><button class="btn btn-default ibtnDe" id="removeAcadRow" style="color:red" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button></td>';
                cols += '</tr>';
                newRow.append(cols);
                $("table.sub-block-tbl").append(newRow);
                counterc++;
            });

            
                
                    
                    
                    
                        
                            
                            
                            
                                
                                    
                                    
                                
                            
                        
                    
                        
                        
                    
                
            
            
                
            

$(document).on('click','#removeAcadRow',function () {
                var rowCount = $('#tableID >tbody >tr').length;
                if(rowCount == 1){
                    showMessage(3,'You can\'t delete this row.');
                }else{
                    $(this).closest("tr").remove();
                }
            });

            // Check academic duplicate or not
            function levelofEducChecking(e){

                var allLevelList = $('.educLevel').map(function () {
                    return this.value;
                }).get();

                if(e.val()!=''){
                    var cnt = 0;
                    $.each(allLevelList, function(index, value){
                        if(e.val()==value){
                            cnt = cnt + 1;
                        }
                    });
                    if(cnt > 1){
                        alertify.alert('Please select another level');
                        e.selectedIndex = 0;
                        e.val('');
                    }
                }

            }
            function levelofDegreeChecking(e){

                var allDegList = $('.degree').map(function () {
                    return this.value;
                }).get();

                if(e.val()!=''){
                    var cnt = 0;
                    $.each(allDegList, function(index, value){
                        if(e.val()==value){
                            cnt = cnt + 1;
                        }
                    });
                    if(cnt > 1){
                        alertify.alert('Please select another degree');
                        e.selectedIndex = 0;
                        e.val('');
                    }
                }

            }

            // training info


            var countert = 0;
            $("#addTrainRow").on("click", function () {

                var noAddStatus = false;
                $('.trainingStatus').map(function () {
                    if(this.value==''){
                        showMessage(2,'Please fill up the field first.');
                        noAddStatus = true;
                    }
                }).get();

                if(noAddStatus){
                    return false;
                }

                var newRow = $("<tr>");
                var cols = "";

                cols += '<td><input type="text" class="form-control trainingStatus " name="trining_name[]" /></td>';
                cols += '<td><input type="text" class="form-control" name="institute_board[]"/></td>';
                cols += '<td><input type="text" class="form-control datepickerMonthYearAppend" name="training_exp_start_date[]"/></td>';
                cols += '<td><input type="text" class="form-control datepickerMonthYearAppend" name="training_exp_end_date[]"/></td>';
                cols += '<td class="text-center"><button class="btn btn-default ibtnDe" id="removeRowTrini" style="color:red" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button></td>';
                cols += '</tr>';
                newRow.append(cols);
                $("table.train-tbl").append(newRow);
                countert++;
            });

            
                
                    
                    
                    
                        
                            
                            
                            
                                
                                    
                                    
                                
                            
                        
                    
                        
                        
                    
                
            

$(document).on('click','#removeRowTrini',function () {
                var rowCount = $('#tableID2 >tbody >tr').length;
                if(rowCount == 1){
                    showMessage(2,'You can\'t delete this row.');
                }else{
                    $(this).closest("tr").remove();
                }
            });

            // skill inof

            var counterskl = 0;
            $("#addSkillRow").on("click", function () {

                var noAddStatus = false;
                $('.skillStatus').map(function () {
                    if(this.value==''){
                        showMessage(4,'Please fill up the field first.');
                        noAddStatus = true;
                    }
                }).get();

                if(noAddStatus){
                    return false;
                }

                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><input type="text" class="form-control skillStatus " name="skill_name[]" /></td>';
                cols += '<td class="text-center"><button class="btn btn-default ibtnDel" style="color:red" title="Delete" id="removeRowSkil" type="button"><i  class="glyphicon glyphicon-remove"></i></button></td>';
                cols += '</tr>';
                newRow.append(cols);
                $("table.skill-tbl").append(newRow);
                counterskl++;
            });

            //        $("table.skill-tbl").on("click", ".ibtnDel", function (event) {
            //            if (confirm("Are you sure to delete?")) {
            //
            //
            //            }
            //        });




            $(document).on('click','#removeRowSkil',function () {
                var rowCount = $('#tableID4 >tbody >tr').length;
                if(rowCount == 1){
                    showMessage(4,'You can\'t delete this row.');
                }else{
                    $(this).closest("tr").remove();
                }
            });
            //
            function showMessage(type,msg){
                $('#msg'+type).show();
                $('#msg'+type).html(msg);
                setTimeout(function() {
                    $('#msg'+type).fadeOut();
                }, 5000);
            }



            function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : evt.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }

            //            function setInputFilter(textbox, inputFilter) {
            //                ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            //                    textbox.addEventListener(event, function() {
            //                        if (inputFilter(this.value)) {
            //                            this.oldValue = this.value;
            //                            this.oldSelectionStart = this.selectionStart;
            //                            this.oldSelectionEnd = this.selectionEnd;
            //                        } else if (this.hasOwnProperty("oldValue")) {
            //                            this.value = this.oldValue;
            //                            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            //                        } else {
            //                            this.value = "";
            //                        }
            //                    });
            //                });
            //            }


            // Install input filters.

            //            setInputFilter(document.getElementById("floatTextBox"), function(value) {
            //                return /^-?\d*[.,]?\d*$/.test(value); });
            //
            //            setInputFilter(document.getElementById("floatTextBox2"), function(value) {
            //                return /^-?\d*[.,]?\d*$/.test(value); });
            //
            //            setInputFilter(document.getElementById("floatTextBox6"), function(value) {
            //                return /^-?\d*[.,]?\d*$/.test(value); });
            //
            //            setInputFilter(document.getElementById("floatTextBox4"), function(value) {
            //                return /^-?\d*[.,]?\d*$/.test(value); });

		</script>





<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.support_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/student_portal/student_info/index.blade.php ENDPATH**/ ?>