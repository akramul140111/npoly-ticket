@extends('layouts.master')
@php $actionUrl=url('/storeStudentInfo'); @endphp
@section('content')
@section('title')
@endsection
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
<link rel="stylesheet" href="{{URL::asset('assets/student_assets/css/style.css')}}">
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
                                        <form id="formValidate"  data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left" enctype="multipart/form-data" autocomplete="off">
                                            @csrf
                                            <h3>Student Information form</h3>
                                            <p>Fill all form required field to go next step</p>
                                            <!-- Form progress -->
                                            <div class="form-wizard-steps form-wizard-tolal-steps-4" style="padding-left:8px">
                                                <div class="form-wizard-progress">
                                                    <div class="form-wizard-progress-line" data-now-value="16.25" data-number-of-steps="5" style="width: 12.25%;"></div>
                                                </div>
                                                <!-- Step 1 -->
                                                <div class="form-wizard-step active">
                                                    <div class="form-wizard-step-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                                    <p>Student</p>
                                                </div>
                                                <!-- Step 1 -->
                                                <!-- Step 2 -->
                                                <div class="form-wizard-step">
                                                    <div class="form-wizard-step-icon"><i class="fa fa-image" aria-hidden="true"></i></div>
                                                    <p>Personal</p>
                                                </div>
                                                <!-- Step 2 -->

                                                <!-- Step 2.1 -->
                                                <div class="form-wizard-step">
                                                    <div class="form-wizard-step-icon"><i class="fa fa-home" aria-hidden="true"></i></div>
                                                    <p>Parents</p>
                                                </div>
                                                <!-- Step 2.1 -->


                                                <!-- Step 3 -->
                                                <div class="form-wizard-step">
                                                    <div class="form-wizard-step-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
                                                    <p>Guardians</p>
                                                </div>
                                                <!-- Step 3 -->

                                                <!-- Step 4 -->
                                                <div class="form-wizard-step">
                                                    <div class="form-wizard-step-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                                                    <p>Academic</p>
                                                </div>
                                                <!-- Step 4 -->
                                                <!-- Step 5 -->
                                                <div class="form-wizard-step">
                                                    <div class="form-wizard-step-icon"><i class="fa fa-institution" aria-hidden="true"></i></div>
                                                    <p>Training</p>
                                                </div>
                                                <!-- Step 5 -->

                                                <!-- Step 6 -->
                                                <div class="form-wizard-step">
                                                    <div class="form-wizard-step-icon"><i class="fa fa-language" aria-hidden="true"></i></div>
                                                    <p>Publications</p>
                                                </div>
                                                <!-- Step 6 -->

                                                <!-- Step 7 -->
                                                <div class="form-wizard-step">
                                                    <div class="form-wizard-step-icon"><i class="fa fa-adjust" aria-hidden="true"></i></div>
                                                    <p>Skill</p>
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
                                                                        <span><b class="stepText">Step 1 - 9</b></span>
                                                                        <button type="button" id="NextButton" class="btn btn-next btn-sm next-step-validation" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i>	</button>
                                                                        {{--<button type="button" class="btn btn-next btn-sm">Next	</button>--}}
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="text-right stepTitle"><h4>Student Information : </h4></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="row">
                                                                    <div class="card-box table-responsive">
                                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                                            <div class="col-md-4 col-sm-4 col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Full Name: <span>*</span></label>
                                                                                    <input type="text" id="studentName" name="students_name" placeholder="Full Name" value="{{$studentInfo->students_name}}" class="form-control required">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Batch No: <span>*</span></label>
                                                                                    <select class="form-control required"  name="batch_n" disabled  id="batch_no">
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($batches as $btch)
                                                                                            <option value="{{$btch->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->batch_no == $btch->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$btch->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Faculty: <span>*</span></label>
                                                                                    <select name="departmen" id="" class="form-control required" disabled >
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($departments as $dept)
                                                                                            <option value="{{$dept->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->department == $dept->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$dept->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-4 col-sm-4 col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>ID: <span>*</span></label>
                                                                                    <input type="text" name="student_id" placeholder="id" readonly="readonly" value=" {{$studentInfo->stu_id}}" class="form-control required">
                                                                                    <input type="hidden" name="student_id" value="{{$studentID}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Course: <span>*</span></label>
                                                                                    <select class="form-control required" name="course_typ" disabled >
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($courseTypes as $course)
                                                                                            <option value="{{$course->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->course_type == $course->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$course->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Date of Birth <span>*</span></label>
                                                                                    <input type="text" name="date_of_birt"  placeholder=""  value="{{date('d-M-Y',strtotime($studentInfo->date_of_birth))}}" class="form-control required date-picke" disabled>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-4 col-sm-4 col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Session: <span>*</span></label>
                                                                                    <select class="form-control required" name="session_year" id="sessionYears" disabled >
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($sessions as $sesion)
                                                                                            <option value="{{$sesion->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->session_years == $sesion->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$sesion->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach

                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Department: <span>*</span></label>
                                                                                    <select name="course_nam" id="" class="form-control required" disabled >
                                                                                        <option value="">Select Dept</option>
                                                                                        @foreach($courseNames as $crsName)
                                                                                            <option value="{{$crsName->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->course_name == $crsName->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$crsName->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Gender: <span>*</span></label>
                                                                                    <select class="form-control required" name="gende" required disabled >
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($genders as $gen)
                                                                                            <option value="{{$gen->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->gender == $gen->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$gen->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-wizard-buttons">
                                                                            {{--<button type="button" class="btn btn-next btn-sm">Next</button>--}}

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
                                                            {{--<div class="x_title">--}}
                                                            {{--<h4>Personal Information : <span>Step 2 - 8</span></h4>--}}
                                                            {{--<div class="clearfix"></div>--}}
                                                            {{--</div>--}}
                                                            <div class="x_title">
                                                                <div class="stepButton">
                                                                    <div class="form-wizard-buttons">
                                                                        <span><b class="stepText">Step 2 - 9</b></span>
                                                                        {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                        {{--<button type="button" class="btn btn-next btn-sm">Next	</button>--}}
                                                                        <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                        <button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>

                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="text-right stepTitle"><h4>Personal Information : </h4></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="row">
                                                                    <div class="card-box table-responsive">
                                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                                            <div class="col-md-4 col-sm-4 col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Blood Group: <span>*</span></label>
                                                                                    <select class="form-control required" name="blood_group">
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($bloodgroup as $bldgroup)
                                                                                            <option value="{{$bldgroup->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->blood_group == $bldgroup->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$bldgroup->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Nationality: <span>*</span></label>
                                                                                    <select class="form-control required" name="nationality" required>
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($nationality as $nat)
                                                                                            <option value="{{$nat->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->nationality == $nat->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$nat->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    {{--<input type="text" name="nationality" placeholder="Nationality" class="form-control required">--}}
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Mobile NO: <span>*</span></label>
                                                                                    <input type="number" name="mobile_number" placeholder="Mobile No" value="{{$studentInfo->mobile_number}}" class="form-control required">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-4 col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Religion: <span>*</span></label>
                                                                                    <select class="form-control required" name="religion" required>
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($religion as $rgion)
                                                                                            <option value="{{$rgion->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->religion == $rgion->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$rgion->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>National ID: <span>*</span></label>
                                                                                    <input type="number" name="national_id" placeholder="National ID" value="{{$studentInfo->national_id}}" class="form-control required">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Email: <span>*</span></label>
                                                                                    <input type="email" name="email_address" value="{{$studentInfo->email_address}}" placeholder="Email Address" class="form-control required">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-4 col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label>Marital Status: <span>*</span></label>
                                                                                    <select class="form-control required" name="marial_status">
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($maritalStatus as $msts)
                                                                                            <option value="{{$msts->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->marial_status == $msts->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$msts->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Passport: <span></span></label>
                                                                                    <input type="text" name="passport_number" value="{{$studentInfo->passport_number}}" placeholder="(if any)" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label>Present Address: <span>*</span></label>
                                                                                    <textarea name="present_address" class="form-control required">{{$studentInfo->present_address}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label>Permanent Address: <span>*</span></label>
                                                                                    <textarea name="permanent_address" class="form-control required">{{$studentInfo->permanent_address}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>

                                                                        <div class="form-wizard-buttons">
                                                                            {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                            {{--<button type="button" class="btn btn-next btn-sm">Next</button>--}}
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
                                                            {{--<div class="x_title">--}}
                                                            {{--<h4>Personal Information : <span>Step 2 - 8</span></h4>--}}
                                                            {{--<div class="clearfix"></div>--}}
                                                            {{--</div>--}}
                                                            <div class="x_title">
                                                                <div class="stepButton">
                                                                    <div class="form-wizard-buttons">
                                                                        <span><b class="stepText">Step 3 - 9</b></span>
                                                                        {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                        {{--<button type="button" class="btn btn-next btn-sm">Next	</button>--}}
                                                                        <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                        <button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>

                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="text-right stepTitle"><h4>Parents  Information : </h4></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="row">
                                                                    <div class="card-box table-responsive">
                                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                                            <div class="col-md-3 col-sm-3 col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Father's Name: <span>*</span></label>
                                                                                    <input type="text" name="fathers_name" placeholder="Father's Name" class="form-control required" value="{{$studentInfo->fathers_name}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 col-sm-3 col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Occupation: <span>*</span></label>
                                                                                    <select class="form-control required" name="father_occupation">
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($occupation as $ocp)
                                                                                            <option value="{{$ocp->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->father_occupation == $ocp->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$ocp->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 col-sm-3 col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Mothers's Name: <span>*</span></label>
                                                                                    <input type="text" name="mothers_name" value="{{$studentInfo->mothers_name}}" placeholder="Mothers's Name" class="form-control required">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 col-sm-3 col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Occupation: <span>*</span></label>
                                                                                    <select class="form-control required" name="mother_occupation">
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($occupation as $ocp)
                                                                                            <option value="{{$ocp->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->mother_occupation == $ocp->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$ocp->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <br>

                                                                            <div class="form-wizard-buttons">
                                                                                {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                                {{--<button type="button" class="btn btn-next btn-sm">Next</button>--}}
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
                                                            {{--<div class="x_title">--}}
                                                            {{--<h4>Guardians Information: <span>Step 3 - 8</span></h4>--}}
                                                            {{--<div class="clearfix"></div>--}}
                                                            {{--</div>--}}
                                                            <div class="x_title">
                                                                <div class="stepButton">
                                                                    <div class="form-wizard-buttons">
                                                                        <span><b class="stepText">Step 4 - 9</b></span>
                                                                        {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                        {{--<button type="button" class="btn btn-next btn-sm">Next	</button>--}}
                                                                        <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                        <button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="text-right stepTitle"><h4>Guardians Information : </h4></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="row">
                                                                    <div class="card-box table-responsive">
                                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                                            <div class="col-md-3 col-sm-3 col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Local Guardians' Name: <span>*</span></label>
                                                                                    <input type="text" name="local_guardian_name"  value="{{$studentInfo->local_guardian_name}}" placeholder="Local Guardians' Name" class="form-control required">
                                                                                </div>
                                                                                {{--<div class="form-group">--}}
                                                                                {{--<label>Guardians' Phone No.: <span>*</span></label>--}}
                                                                                {{--<input type="text" name="Faculty" placeholder="Faculty" class="form-control required">--}}
                                                                                {{--</div>--}}
                                                                            </div>
                                                                            <div class="col-md-3 col-sm-3 col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Occupation: <span>*</span></label>
                                                                                    <select class="form-control required" name="local_guardian_occupation">
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($occupation as $ocp)
                                                                                            <option value="{{$ocp->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->father_occupation == $ocp->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$ocp->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 col-sm-3 col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label>Guardians' Phone No.: <span>*</span></label>
                                                                                    <input type="number" name="local_guardian_phone_number" value="{{$studentInfo->local_guardian_phone_number}}" placeholder="Guardians' Phone No" class="form-control required">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 col-lg-3 col-sm-3">
                                                                                <div class="form-group">
                                                                                    <label>Relation: <span>*</span></label>
                                                                                    <select class="form-control required" name="local_guardian_relation">
                                                                                        <option value="">--Select--</option>
                                                                                        @foreach($relation as $rlson)
                                                                                            <option value="{{$rlson->LOOKUP_DATA_ID}}"
                                                                                                    @if(!empty($studentInfo))
                                                                                                    @if($studentInfo->local_guardian_relation == $rlson->LOOKUP_DATA_ID)
                                                                                                    selected
                                                                                                    @endif
                                                                                                    @endif
                                                                                            >{{$rlson->LOOKUP_DATA_NAME}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-12 col-lg-12 col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label>Present Address: <span>*</span></label>
                                                                                    <textarea name="local_guardian_present_address" class="form-control required">{{$studentInfo->local_guardian_present_address}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="form-wizard-buttons">
                                                                            {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                            {{--<button type="button" class="btn btn-next btn-sm">Next</button>--}}
                                                                            <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                            <button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div></div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                                        <div class="x_panel">
                                                            {{--<div class="x_title">--}}
                                                            {{--<h4>Academic Information: <span>Step 4 - 8</span></h4>--}}
                                                            {{--<div class="clearfix"></div>--}}
                                                            {{--</div>--}}
                                                            <div class="x_title">
                                                                <div class="stepButton">
                                                                    <div class="form-wizard-buttons">
                                                                        <span><b class="stepText">Step 5 - 9</b></span>
                                                                        {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                        {{--<button type="button" class="btn btn-next btn-sm">Next	</button>--}}
                                                                        <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                        <button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="text-right stepTitle"><h4>Academic Information : </h4></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="row">
                                                                    <div class="card-box table-responsive">
                                                                        <div style="clear:both;"></div>
                                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                                            <div class="text-align-center red" style="margin: -5px 0 5px 0; display:none" id="msg3"></div>
                                                                            {{--<table  class="table table-striped table-bordered  custom-table-border no-footer tableID3" role="grid" aria-describedby="datatable_info" width="100%" style="width: 100%;">--}}
                                                                            <table class="table table-borderd academic-tbl sub-block-tbl block-tbl custom-table-border" id="tableID">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Education Level</th>
                                                                                    <th>Degree</th>
                                                                                    <th>Institute/Board</th>
                                                                                    <th>Passing Year</th>
                                                                                    <th>Result</th>
                                                                                    <th class="text-center">
                                                                                        <button class="btn btn-default btn-sm add-row" style="color:black" title="Add Row" id="addAcademicRow" type="button"><i  class="glyphicon glyphicon-plus"></i></button>
                                                                                    </th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                @if(sizeof($academicInof)>0)
                                                                                    @foreach($academicInof as $value)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <select class="form-control educLevel required" onchange="levelofEducChecking($(this))" name="label_of_education[]">
                                                                                                    <option value="">--select--</option>
                                                                                                    @if($leverOfEducation)
                                                                                                        @foreach($leverOfEducation as $educ)
                                                                                                            <option value="{{$educ->LOOKUP_DATA_ID}}" @if($educ->LOOKUP_DATA_ID == $value->label_of_education) selected @endif>{{$educ->LOOKUP_DATA_NAME}}</option>
                                                                                                        @endforeach
                                                                                                    @endif
                                                                                                </select>
                                                                                            </td>
                                                                                            <td>
                                                                                                <select class="form-control degree required" onchange="levelofDegreeChecking($(this))" name="degree[]">
                                                                                                    <option value="">--select--</option>
                                                                                                    @if($degree)
                                                                                                        @foreach($degree as $deg)
                                                                                                            <option value="{{$deg->LOOKUP_DATA_ID}}" @if($deg->LOOKUP_DATA_ID == $value->degree) selected @endif>{{$deg->LOOKUP_DATA_NAME}}</option>
                                                                                                        @endforeach
                                                                                                    @endif
                                                                                                </select>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control required " value="{{$value->institute_board}}" name="academic_institute_board[]" required/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="number" class="form-control required" value="{{$value->passing_year}}"  name="academic_passing_year[]" required/>
                                                                                            </td>
                                                                                            <td>
                                                                                                {{--<input type="number" class="form-control required" name="academic_result[]" required/>--}}
                                                                                                {{--<input name="academic_result[]" type="number" onkeypress="return isNumberKey(event)"/>--}}
                                                                                                <input id="floatTextBox" name="academic_result[]" value="{{$value->result}}"  class="form-control required">
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                <button class="btn btn-default remove-row" style="color:red" id="removeAcadRow" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach

                                                                                @else
                                                                                    <tr>
                                                                                        <td>
                                                                                            <select class="form-control educLevel required" onchange="levelofEducChecking($(this))" name="label_of_education[]">
                                                                                                <option value="">--select--</option>
                                                                                                @if($leverOfEducation)
                                                                                                    @foreach($leverOfEducation as $educ)
                                                                                                        <option value="{{$educ->LOOKUP_DATA_ID}}">{{$educ->LOOKUP_DATA_NAME}}</option>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select class="form-control degree required" onchange="levelofDegreeChecking($(this))" name="degree[]">
                                                                                                <option value="">--select--</option>
                                                                                                @if($degree)
                                                                                                    @foreach($degree as $deg)
                                                                                                        <option value="{{$deg->LOOKUP_DATA_ID}}">{{$deg->LOOKUP_DATA_NAME}}</option>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="text" class="form-control required " value="" name="academic_institute_board[]" required/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" class="form-control required" value=""  name="academic_passing_year[]" required/>
                                                                                        </td>
                                                                                        <td>
                                                                                            {{--<input type="number" class="form-control required" name="academic_result[]" required/>--}}
                                                                                            {{--<input name="academic_result[]" type="number" onkeypress="return isNumberKey(event)"/>--}}
                                                                                            <input id="floatTextBox2" name="academic_result[]" value=""  class="form-control required">
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            <button class="btn btn-default remove-row" style="color:red" id="removeAcadRow" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="form-wizard-buttons">
                                                                            {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                            {{--<button type="button" class="btn btn-next btn-sm">Next</button>--}}
                                                                            <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                            <button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div></div>
                                            </fieldset>
                                            <fieldset>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                                        <div class="x_panel">
                                                            {{--<div class="x_title">--}}
                                                            {{--<h4>Training Information: <span>Step 5 - 8</span></h4>--}}
                                                            {{--<div class="clearfix"></div>--}}
                                                            {{--</div>--}}
                                                            <div class="x_title">
                                                                <div class="stepButton">
                                                                    <div class="form-wizard-buttons">
                                                                        <span><b class="stepText">Step 6 - 9</b></span>
                                                                        {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                        {{--<button type="button" class="btn btn-next btn-sm">Next	</button>--}}
                                                                        <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                        <button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="text-right stepTitle"><h4>Training Information : </h4></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="row">
                                                                    <div class="card-box table-responsive">
                                                                        <div style="clear:both;"></div>
                                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                                            <div class="text-align-center red" style="margin: -5px 0 5px 0; display:none" id="msg2"></div>
                                                                            {{--<table  class="table table-striped table-bordered  custom-table-border no-footer tableID3" role="grid" aria-describedby="datatable_info" width="100%" style="width: 100%;">--}}
                                                                            <table class="table table-borderd train-tbl  block-tbl custom-table-border" id="tableID2">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Training*</th>
                                                                                    <th>Institute/Board</th>
                                                                                    <th colspan="2" class="text-center">Duration</th>
                                                                                    <th>Passing Year</th>
                                                                                    <th>Result</th>
                                                                                    <th class="text-center">
                                                                                        <button class="btn btn-default btn-sm add-row" style="color:black" title="Add Row" id="addTrainRow" type="button"><i  class="glyphicon glyphicon-plus"></i></button>
                                                                                    </th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                {{--																				@if(!empty($trainingInof))--}}
                                                                                @if(sizeof($trainingInof)>0)
                                                                                    @foreach($trainingInof as $trexp)

                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="text" class="form-control trainingStatus"  value="{{$trexp->trining_name}}" name="trining_name[]"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control" value="{{$trexp->exp_institute_board}}" name="institute_board[]"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control datepickerMonthYearAppend" value="{{date('d-m-Y',strtotime($trexp->training_start_date))}}" name="training_exp_start_date[]"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control datepickerMonthYearAppend" value="{{date('d-m-Y',strtotime($trexp->training_end_date))}}" name="training_exp_end_date[]"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="number" class="form-control" value="{{$trexp->exp_passing_year}}"  name="passing_year[]"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                {{--<input type="number" class="form-control" name="result[]" required/>--}}
                                                                                                <input id="floatTextBox2" value="{{$trexp->exp_result}}"  name="result[]" class="form-control">
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                <button class="btn btn-default remove-row" style="color:red" id="removeRowTrini" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @else
                                                                                    <tr>
                                                                                        <td>
                                                                                            <input type="text" class="form-control trainingStatus"  value="" name="trining_name[]"/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="text" class="form-control" value="" name="institute_board[]"/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="text" class="form-control datepickerMonthYearAppend" value="" name="training_exp_start_date[]"/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="text" class="form-control datepickerMonthYearAppend" value="" name="training_exp_end_date[]"/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number" class="form-control"  name="passing_year[]"/>
                                                                                        </td>
                                                                                        <td>
                                                                                            {{--<input type="number" class="form-control" name="result[]" required/>--}}
                                                                                            <input id="floatTextBox2"  name="result[]" class="form-control">
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            <button class="btn btn-default remove-row" style="color:red" id="removeRowTrini" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <br/>
                                                                        <div class="form-wizard-buttons">
                                                                            {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                            {{--<button type="button" class="btn btn-next btn-sm">Next</button>--}}
                                                                            <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                            <button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div></div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                                        <div class="x_panel">
                                                            {{--<div class="x_title">--}}
                                                            {{--<h4>Publications Information: <span>Step 6 - 8</span></h4>--}}
                                                            {{--<div class="clearfix"></div>--}}
                                                            {{--</div>--}}
                                                            <div class="x_title">
                                                                <div class="stepButton">
                                                                    <div class="form-wizard-buttons">
                                                                        <span><b class="stepText">Step 7 - 9</b></span>
                                                                        {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                        {{--<button type="button" class="btn btn-next btn-sm">Next	</button>--}}
                                                                        <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                        <button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="text-right stepTitle"><h4>Publications Information : </h4></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="row">
                                                                    <div class="card-box table-responsive">
                                                                        <div style="clear:both;"></div>
                                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                                            <div class="text-align-center red" style="margin: -5px 0 5px 0; display:none" id="msg6"></div>
                                                                            {{--<table  class="table table-striped table-bordered  custom-table-border no-footer tableID3" role="grid" aria-describedby="datatable_info" width="100%" style="width: 100%;">--}}
                                                                            <table class="table table-borderd pub-tbl block-tbl custom-table-border" id="tableID3">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Name*</th>
                                                                                    <th colspan="2" class="text-center">Duration</th>
                                                                                    <th>Attachment</th>
                                                                                    <th class="text-center">
                                                                                        <button class="btn btn-default btn-sm add-row" style="color:black" title="Add Row" id="addSubPubRow" type="button"><i  class="glyphicon glyphicon-plus"></i></button>
                                                                                    </th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                @if(sizeof($publicationInof)>0)
                                                                                    @foreach($publicationInof  as $key=> $pub)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="hidden" name="orgName[]" value="1">
                                                                                                <input type="text" class="form-control publicatonStatus" value="{{$pub->publication_name}}" name="publication_name[]"/>
                                                                                            </td>

                                                                                            <td>
                                                                                                <input type="text" class="form-control datepickerMonthYearAppend" value="{{date('d-m-Y',strtotime($pub->pub_start_date))}}" name="publication_start_date[]"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control datepickerMonthYearAppend" value="{{date('d-m-Y',strtotime($pub->pub_end_date))}}" name="publication_end_date[]"/>
                                                                                                <input type="hidden" class="form-control" name="image_alternative[]"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                {{--<img id="signiture" alt="student signiture" src="{{asset('/uploads/student_information/signature/'.$studentInfo->students_signature)}}" width="100" height="100" />--}}


                                                                                                {{--<input type="file" name="students_signature"  class=""--}}
                                                                                                {{--onchange="document.getElementById('signiture').src = window.URL.createObjectURL(this.files[0])">--}}


                                                                                                {{--<input type="file"  multiple="multiple"  class="form-control" value="{{$pub->pub_attach}}" name="imageFile[]"/>--}}
                                                                                                <div class="wrapper">
                                                                                                    <input type="hidden" name="old_image[]" value="{{$pub->pub_attach}}">
                                                                                                    <input type="file"  multiple="multiple"  class="form-control"  name="imageFile[]"

                                                                                                    >


                                                                                                    {{--																									<img src="{{asset('/uploads/student_information/'.$studentInfo->students_image)}}" id="publication" alt="" style='margin-left:-70px;' height="50" width="50" />--}}

                                                                                                    @if(strpos($pub->pub_attach, '.pdf') !== false)
                                                                                                        <iframe src="{{url('/uploads/student_information/publication/'.$pub->pub_attach)}}" width="40%"
                                                                                                                height="40px"></iframe>
                                                                                                    @else<img src="{{url('/uploads/student_information/publication/'.$pub->pub_attach)}}"
                                                                                                              class="img-fluid" alt="" width="15%" height="15px">
                                                                                                    @endif


                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                <button class="btn btn-default remove-row ibtnDel" style="color:red" id="removeRowPub" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @else
                                                                                    <tr>
                                                                                        <td>
                                                                                            <input type="text" class="form-control publicatonStatus" value="" name="publication_name[]"/>
                                                                                            <input type="hidden" name="orgName[]" value="1">
                                                                                        </td>

                                                                                        <td>
                                                                                            <input type="text" class="form-control datepickerMonthYearAppend" value="" name="publication_start_date[]"/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="text" class="form-control datepickerMonthYearAppend" value="" name="publication_end_date[]"/>
                                                                                            <input type="hidden" class="form-control" name="image_alternative[]"/>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="file"  multiple="multiple"  class="form-control" name="imageFile[]"/>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            <button class="btn btn-default remove-row ibtnDel" style="color:red" id="removeRowPub" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                        <br/>
                                                                        <div class="form-wizard-buttons">
                                                                            {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                            {{--<button type="button" class="btn btn-next btn-sm">Next</button>--}}
                                                                            <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                            <button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div></div>
                                            </fieldset>
                                            <fieldset>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                                        <div class="x_panel">
                                                            {{--<div class="x_title">--}}
                                                            {{--<h4>Skill Information: <span>Step 7 - 8</span></h4>--}}
                                                            {{--<div class="clearfix"></div>--}}
                                                            {{--</div>--}}
                                                            <div class="x_title">
                                                                <div class="stepButton">
                                                                    <div class="form-wizard-buttons">
                                                                        <span><b class="stepText">Step 8 - 9</b></span>
                                                                        {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                        {{--<button type="button" class="btn btn-next btn-sm">Next	</button>--}}
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
                                                                                @if(sizeof($skillInof)>0)
                                                                                    @foreach($skillInof as $skl)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="text" class="form-control skillStatus" value="{{$skl->skill_name}}" name="skill_name[]"/>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                <button class="btn btn-default remove-row" style="color:red" id="removeRowSkil" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @else
                                                                                    <tr>
                                                                                        <td>
                                                                                            <input type="text" class="form-control skillStatus" value="" name="skill_name[]"/>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            <button class="btn btn-default remove-row" style="color:red" id="removeRowSkil" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                        <br/>
                                                                        <div class="form-wizard-buttons">
                                                                            {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                            {{--<button type="button" class="btn btn-next btn-sm">Next</button>--}}
                                                                            <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                            <button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div></div>
                                            </fieldset>
                                            <fieldset>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                                        <div class="x_panel">
                                                            {{--<div class="x_title">--}}
                                                            {{--<h4>Attachment Information: <span>Step 8 - 8</span></h4>--}}
                                                            {{--<div class="clearfix"></div>--}}
                                                            {{--</div>--}}
                                                            <div class="x_title">
                                                                <div class="stepButton">
                                                                    <div class="form-wizard-buttons">
                                                                        <span><b class="stepText">Step 9 - 9</b></span>
                                                                        {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                        {{--<button type="button" class="btn btn-next btn-sm">Next	</button>--}}
                                                                        <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                        {{--<button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>--}}
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
                                                                                    <label>Student Image: <span>*</span></label>
                                                                                    {{--<img id="image" alt="your image" width="100" height="100" />--}}
                                                                                    <img id="image" alt="student image" src="{{asset('/uploads/student_information/'.$studentInfo->students_image)}}" width="100" height="100" />

                                                                                    <input type="file" name="students_image" class=""
                                                                                           onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label>Student Signiture: <span>*</span></label>
                                                                                    {{--<img id="signiture" alt="your image" width="100" height="100" />--}}
                                                                                    <img id="signiture" alt="student signiture" src="{{asset('/uploads/student_information/signature/'.$studentInfo->students_signature)}}" width="100" height="100" />


                                                                                    <input type="file" name="students_signature"  class=""
                                                                                           onchange="document.getElementById('signiture').src = window.URL.createObjectURL(this.files[0])">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <br/>
                                                                        <div class="form-wizard-buttons">
                                                                            {{--<button type="button" class="btn btn-previous btn-sm">Previous</button>--}}
                                                                            {{--<button type="button" class="btn btn-next btn-sm">Submit</button>--}}
                                                                            <button type="submit" class="btn btn-primary" id="buttonStyle">Submit</button>
                                                                            <button type="button" class="btn btn-previous" data-toggle="tooltip" data-placement="top" title="Previous"><i class="glyphicon glyphicon-step-backward"></i></button>
                                                                            {{--<button type="button" class="btn btn-next" data-toggle="tooltip" data-placement="top" title="Next"><i class="glyphicon glyphicon-step-forward"></i></button>--}}
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
        <script src="{{ URL::asset('assets/student_assets/js/student_info.js') }}"></script>

        <script>

            var counter = 0;
            $("#addSubPubRow").on("click", function () {
                // publicatonStatus

                var newRow = $("<tr>");
                var cols = "";
                //cols += '<td><input type="hidden" value="" name="sub_block_id[]" class="actualDel">';
                cols += '<td><input type="hidden" name="orgName[]" value="1"><input type="text" value="" name="publication_name[]" class="form-control">';

                cols += '<td><input type="text" class="form-control datepickerMonthYearAppend" name="publication_start_date[]" required/></td>';
                cols += '<td><input type="text" class="form-control datepickerMonthYearAppend" name="publication_end_date[]" required/></td>';
                cols += '<td><input type="hidden" class="form-control" name="image_alternative[]"/><input type="file" class="form-control " name="imageFile[]" required/></td>';
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

            {{--$("table.pub-tbl").on("click", ".ibtnDel", function (event) {--}}
            {{--if (confirm("Are you sure to delete?")) {--}}
            {{--var Gbl = $(this);--}}
            {{--var sbID = parseInt(Gbl.parents('tr').find('.actualDel').val());--}}
            {{--if(sbID>0){--}}
            {{--$.ajax({--}}
            {{--type: 'GET',--}}
            {{--url: '{{url("/block/deleteSubBlock")}}/'+sbID,--}}
            {{--success: function (data) {--}}
            {{--if(data==1){--}}
            {{--Gbl.closest("tr").remove();--}}
            {{--counter -= 1;--}}
            {{--}--}}
            {{--}--}}
            {{--});--}}
            {{--}else{--}}
            {{--Gbl.closest("tr").remove();--}}
            {{--counter -= 1;--}}
            {{--}--}}
            {{--}--}}
            {{--});--}}
            {{--$("table.sub-block-tbl").on("click", ".ibtnDelNon", function (event) {--}}
            {{--showMessage(1,'You can\'t delete this item.');--}}
            {{--});--}}

            // academic information
            var counterc = 0;
            $("#addAcademicRow").on("click", function () {

                var noAddStatus = false;
                $('.educLevel').map(function () {
                    if(this.value==''){
                        showMessage(3,'Please fill Level of education name.');
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
                @if($leverOfEducation)
                        @foreach($leverOfEducation as $ledu)
                    cols += '<option value="{{$ledu->LOOKUP_DATA_ID}}">{{$ledu->LOOKUP_DATA_NAME}}</option>';
                @endforeach
                        @endif
                    cols += '</select></td>';
                cols += '<td>';
                cols += '<select class="form-control degree required" onchange="levelofDegreeChecking($(this))" name="degree[]">';
                cols += '<option value="">--select--</option>';
                @if($degree)
                        @foreach($degree as $deg)
                    cols += '<option value="{{$deg->LOOKUP_DATA_ID}}">{{$deg->LOOKUP_DATA_NAME}}</option>';
                @endforeach
                        @endif
                    cols += '</select></td>';
                cols += '<td><input type="text" class="form-control required" name="academic_institute_board[]" required/></td>';
                cols += '<td><input type="number" class="form-control required" name="academic_passing_year[]" required/></td>';
                cols += '<td><input type="number" id="floatTextBox2" class="form-control required" name="academic_result[]"/></td>';
                cols += '<td class="text-center"><button class="btn btn-default ibtnDe" id="removeAcadRow" style="color:red" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button></td>';
                cols += '</tr>';
                newRow.append(cols);
                $("table.sub-block-tbl").append(newRow);
                counterc++;
            });

            {{--$("table.academic-tbl").on("click", ".ibtnDe", function (event) {--}}
                {{--if (confirm("Are you sure to delete?")) {--}}
                    {{--var Gbl = $(this);--}}
                    {{--var sbID = parseInt(Gbl.parents('tr').find('.actualDel').val());--}}
                    {{--if(sbID>0){--}}
                        {{--$.ajax({--}}
                            {{--type: 'GET',--}}
                            {{--url: '{{url("/block/deleteTopics")}}/'+sbID,--}}
                            {{--success: function (data) {--}}
                                {{--if(data==1){--}}
                                    {{--Gbl.closest("tr").remove();--}}
                                    {{--counterc -= 1;--}}
                                {{--}--}}
                            {{--}--}}
                        {{--});--}}
                    {{--}else{--}}
                        {{--Gbl.closest("tr").remove();--}}
                        {{--counterc -= 1;--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
            {{--$("table.topics-tbl").on("click", ".ibtnDelNon", function (event) {--}}
                {{--showMessage(2,'You can\'t delete this item.');--}}
            {{--});--}}

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
                        showMessage(2,'Please fill training name.');
                        noAddStatus = true;
                    }
                }).get();

                if(noAddStatus){
                    return false;
                }

                var newRow = $("<tr>");
                var cols = "";

                cols += '<td><input type="text" class="form-control " name="trining_name[]" required/></td>';
                cols += '<td><input type="text" class="form-control " name="institute_board[]" required/></td>';
                cols += '<td><input type="text" class="form-control datepickerMonthYearAppend" name="training_exp_start_date[]" required/></td>';
                cols += '<td><input type="text" class="form-control datepickerMonthYearAppend" name="training_exp_end_date[]" required/></td>';
                cols += '<td><input type="number" class="form-control" name="passing_year[]" required/></td>';
                cols += '<td><input type="number" id="floatTextBox4" class="form-control" name="result[]" required/></td>';
                cols += '<td class="text-center"><button class="btn btn-default ibtnDe" id="removeRowTrini" style="color:red" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button></td>';
                cols += '</tr>';
                newRow.append(cols);
                $("table.train-tbl").append(newRow);
                countert++;
            });

            {{--$("table.train-tbl").on("click", ".ibtnDe", function (event) {--}}
                {{--if (confirm("Are you sure to delete?")) {--}}
                    {{--var Gbl = $(this);--}}
                    {{--var sbID = parseInt(Gbl.parents('tr').find('.actualDel').val());--}}
                    {{--if(sbID>0){--}}
                        {{--$.ajax({--}}
                            {{--type: 'GET',--}}
                            {{--url: '{{url("/block/deleteTopics")}}/'+sbID,--}}
                            {{--success: function (data) {--}}
                                {{--if(data==1){--}}
                                    {{--Gbl.closest("tr").remove();--}}
                                    {{--counterc -= 1;--}}
                                {{--}--}}
                            {{--}--}}
                        {{--});--}}
                    {{--}else{--}}
                        {{--Gbl.closest("tr").remove();--}}
                        {{--counterc -= 1;--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}

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
                        showMessage(4,'Please fill slill name.');
                        noAddStatus = true;
                    }
                }).get();

                if(noAddStatus){
                    return false;
                }

                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><input type="text" class="form-control " name="skill_name[]" required/></td>';
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

            function setInputFilter(textbox, inputFilter) {
                ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                    textbox.addEventListener(event, function() {
                        if (inputFilter(this.value)) {
                            this.oldValue = this.value;
                            this.oldSelectionStart = this.selectionStart;
                            this.oldSelectionEnd = this.selectionEnd;
                        } else if (this.hasOwnProperty("oldValue")) {
                            this.value = this.oldValue;
                            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                        } else {
                            this.value = "";
                        }
                    });
                });
            }


            // Install input filters.

            setInputFilter(document.getElementById("floatTextBox"), function(value) {
                return /^-?\d*[.,]?\d*$/.test(value); });

            setInputFilter(document.getElementById("floatTextBox2"), function(value) {
                return /^-?\d*[.,]?\d*$/.test(value); });

            setInputFilter(document.getElementById("floatTextBox6"), function(value) {
                return /^-?\d*[.,]?\d*$/.test(value); });

            setInputFilter(document.getElementById("floatTextBox4"), function(value) {
                return /^-?\d*[.,]?\d*$/.test(value); });

        </script>




@endsection

