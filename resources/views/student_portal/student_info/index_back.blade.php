@extends('layouts.master')

@section('content')
@section('title')
@endsection
<style>
    ul li.active,
    a.active {
        color: #3fbbc0;
    }

</style>
<link rel="stylesheet" href="{{URL::asset('assets/custom_css/admission_index_academic_officer.css')}}">
<div class="" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{$header['pageTitle']}} </h3>
            </div>
            <div class="title_right">
                <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                        <button type="button" class="btn btn-primary dynamicModal"
                            pageTitle="Admission Management Setup" pageLink="{{URL::route('createAdmission')}}"
                            data-toggle="tooltip" data-placement="left" title="Add New Student"
                            data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add New</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Student Information form</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <!-- Smart Wizard -->
                        <div id="wizard" class="form_wizard wizard_horizontal">
                            <ul class="wizard_steps">
                                <li>
                                    <a href="#step-1">
                                        <span class="step_no" title="Student Information">1</span>
                                        <span class="step_descr">
                                            Student <br />
                                            {{--<small>Student Info</small>--}}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-2">
                                        <span class="step_no">2</span>
                                        <span class="step_descr">
                                            Personal <br />
                                            {{--<small>Personal Info</small>--}}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-3">
                                        <span class="step_no">3</span>
                                        <span class="step_descr">
                                            Parents <br />
                                            {{--<small>Gardian Info</small>--}}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-4">
                                        <span class="step_no">4</span>
                                        <span class="step_descr">
                                            Guardians' <br />
                                            {{--<small>Academic Info</small>--}}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-5">
                                        <span class="step_no">5</span>
                                        <span class="step_descr">
                                            Academic <br />
                                            {{--<small>Academic Info</small>--}}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-6">
                                        <span class="step_no">6</span>
                                        <span class="step_descr">
                                            Training<br />
                                            {{--<small>Academic Info</small>--}}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-7">
                                        <span class="step_no">7</span>
                                        <span class="step_descr">
                                            Publications<br />
                                            {{--<small>Academic Info</small>--}}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-8">
                                        <span class="step_no">8</span>
                                        <span class="step_descr">
                                            Skills<br />
                                            {{--<small>Academic Info</small>--}}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-9">
                                        <span class="step_no">9</span>
                                        <span class="step_descr">
                                            Attachment<br />
                                            {{--<small>Academic Info</small>--}}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <div id="step-1">
                                <h5 class="row justify-content-center">Student Information</h5>
                                <form id="informationForm" data-toggle="validator" role="form" method="post"
                                    class="form-label-left" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Full
                                                        Name<span
                                                            class="required input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <input data-dj-validator="atext,3,12"
                                                            class="form-control input-field-required-sign"
                                                            data-validate-length-range="6" data-validate-words="2"
                                                            name="students_name" id="students_name" placeholder=""
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Id
                                                        <span
                                                            class="required input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <input type="text"
                                                            class="form-control input-field-required-sign"
                                                            data-validate-length-range="6" data-validate-words="2"
                                                            name="stu_id" id="stu_id" placeholder="" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Session
                                                        <span
                                                            class="required input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <select class="form-control" name="session_years"
                                                            id="session_years" required>
                                                            <option value="">--select--</option>
                                                            @if($sessions)
                                                            @foreach($sessions as $s)
                                                            <option value="{{$s->LOOKUP_DATA_ID}}">
                                                                {{$s->LOOKUP_DATA_NAME}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Batch
                                                        <span
                                                            class="required input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <select class="form-control" name="batch_no" id="batch_no"
                                                            required>
                                                            <option value="">--select--</option>
                                                            @if($batches)
                                                            @foreach($batches as $b)
                                                            <option value="{{$b->LOOKUP_DATA_ID}}">
                                                                {{$b->LOOKUP_DATA_NAME}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Course
                                                        Type <span
                                                            class="required input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <select class="form-control" name="course_type" id="course_type"
                                                            required>
                                                            <option value="">--select--</option>
                                                            @if($courseTypes)
                                                            @foreach($courseTypes as $c)
                                                            <option value="{{$c->LOOKUP_DATA_ID}}">
                                                                {{$c->LOOKUP_DATA_NAME}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="field item form-group">
                                                    <label
                                                        class="col-form-label col-md-3 col-sm-3  label-align">Faculty
                                                        <span
                                                            class="required input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <select class="form-control" name="department" id="department"
                                                            required>
                                                            <option value="">--select--</option>
                                                            @if($departments)
                                                            @foreach($departments as $d)
                                                            <option value="{{$d->LOOKUP_DATA_ID}}">
                                                                {{$d->LOOKUP_DATA_NAME}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Course
                                                        Name <span
                                                            class="required input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <select class="form-control" name="course_name" id="course_name"
                                                            required>
                                                            <option value="">--select--</option>
                                                            @if($courseNames)
                                                            @foreach($courseNames as $cc)
                                                            <option value="{{$cc->LOOKUP_DATA_ID}}">
                                                                {{$cc->LOOKUP_DATA_NAME}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Dath of
                                                        Birth<span
                                                            class="required input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <input data-dj-validator="atext,3,12" type="date"
                                                            class="form-control input-field-required-sign"
                                                            data-validate-length-range="6" data-validate-words="2"
                                                            name="birth_date" id="birth_date" placeholder="" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Gender
                                                        <span
                                                            class="required input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <select class="form-control" name="gender" id="gender" required>
                                                            <option value="">--select--</option>
                                                            @if($genders)
                                                            @foreach($genders as $g)
                                                            <option value="{{$g->LOOKUP_DATA_ID}}">
                                                                {{$g->LOOKUP_DATA_NAME}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Active
                                                        Status <span
                                                            class="required  input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <select class="form-control" name="active_status">
                                                            <option value="1">Active</option>
                                                            <option value="0">In Active</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <span class="section">Create Top Menu</span> -->

                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type="submit" id='saveBtnStudentInfo'
                                                class="btn btn-primary">Submit</button>
                                            <button type='reset' class="btn btn-success">Reset</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <div id="step-2">
                                <h5 class="row justify-content-center">Personal Information</h5>
                                <form class="form-horizontal form-label-left">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="field item form-group">
                                                    <label
                                                        class="col-form-label col-md-3 col-sm-3 col-lg-3  label-align">Blood
                                                        Group <span
                                                            class="required  input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <select class="form-control" name="blood_group">
                                                            <option value="">Select One</option>
                                                            <option value="1">A+</option>
                                                            <option value="0">B+ </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="field item form-group">
                                                    <label
                                                        class="col-form-label col-md-3 col-sm-3  label-align">Religion
                                                        <span
                                                            class="required  input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <select class="form-control" name="religion">
                                                            <option value="">Select One</option>
                                                            <option value="1">Islam</option>
                                                            <option value="0">Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="field item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Marital
                                                        Status <span
                                                            class="required  input-field-required-sign">*</span></label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <select class="form-control" name="blood_group">
                                                            <option value="">Select One</option>
                                                            <option value="1">Single</option>
                                                            <option value="0">Mar </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                        for="nationality">Nationality <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9 ">
                                                        <input type="text" id="nationality" required="required"
                                                            class="form-control  ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                        for="national id">National ID <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <input type="text" id="national id" required="required"
                                                            class="form-control  ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                        for="passport">Passport (If any) <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <input type="text" id="passport" required="required"
                                                            class="form-control  ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                        for="mobile">Mobile No <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <input type="number" id="mobile" required="required"
                                                            class="form-control  ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                        for="email">Email <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9 col-lg-9">
                                                        <input type="email" id="email" required="required"
                                                            class="form-control  ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                    for="present_address">Present Address <span
                                                        class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-lg-9">
                                                    {{--<input type="text" id="present_address" required="required" class="form-control  ">--}}
                                                    <textarea class="form-control" name="present_address"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                    for="permanent_address">Permanent Address <span
                                                        class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-lg-9">
                                                    {{--<input type="text" id="present_address" required="required" class="form-control  ">--}}
                                                    <textarea class="form-control" name="permanent_address"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="step-3">
                                <h5 class="row justify-content-center">Parents Information</h5>
                                <form class="form-horizontal form-label-left">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2 col-sm-2 col-lg-2 label-align"
                                            for="father-name">Father's Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-10 col-sm-10 col-lg-10">
                                            <input type="text" id="father-name" required="required"
                                                class="form-control  ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2 col-sm-2 col-lg-2 label-align"
                                            for="occupation">Occupation <span class="required">*</span>
                                        </label>
                                        <div class="col-md-10 col-sm-10 col-lg-10">
                                            {{--<input type="text" id="last-name" name="occupation" required="required" class="form-control ">--}}
                                            <select class="form-control" name="occupation">
                                                <option value="">Select One</option>
                                                <option value="1">Govt Job</option>
                                                <option value="0">Service </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mother-name"
                                            class="col-form-label col-md-2 col-sm-2 col-lg-2 label-align">Mother's Name
                                        </label>
                                        <div class="col-md-10 col-sm-10 col-lg-10">
                                            <input id="mother-name" class="form-control col" type="text"
                                                name="mother-name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2 col-sm-2 col-lg-2 label-align"
                                            for="occupation">Occupation <span class="required">*</span>
                                        </label>
                                        <div class="col-md-10 col-sm-10 col-lg-10">
                                            {{--<input type="text" id="last-name" name="occupation" required="required" class="form-control ">--}}
                                            <select class="form-control" name="occupation">
                                                <option value="">Select One</option>
                                                <option value="1">Govt Job</option>
                                                <option value="0">Service </option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="step-4">
                                <h5 class="row justify-content-center">Guardians Information</h5>
                                <form class="form-horizontal form-label-left">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2 col-sm-2 col-lg-2 label-align"
                                            for="local_guardian">Local Guardians' Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-10 col-sm-10 col-lg-10">
                                            <input type="text" id="local_guardian" required="required"
                                                class="form-control  ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2 col-sm-2 col-lg-2 label-align"
                                            for="guardian_occupation"> Guardians Occupation <span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-10 col-sm-10 col-lg-10col-md-10 col-sm-10 col-lg-10">
                                            {{--<input type="text" id="last-name" name="occupation" required="required" class="form-control ">--}}
                                            <select class="form-control" name="guardian_occupation">
                                                <option value="">Select One</option>
                                                <option value="1">Govt Job</option>
                                                <option value="0">Service </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2 col-sm-2 col-lg-2 label-align"
                                            for="guardian_phone">Guardians' Phone No. <span class="required">*</span>
                                        </label>
                                        <div class="col-md-10 col-sm-10 col-lg-10">
                                            <input type="text" id="guardian_phone" required="required"
                                                class="form-control  ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2 col-sm-2 col-lg-2 label-align"
                                            for="guardian_religion">Religion <span class="required">*</span>
                                        </label>
                                        <div class="col-md-10 col-sm-10 col-lg-10">
                                            {{--<input type="text" id="last-name" name="occupation" required="required" class="form-control ">--}}
                                            <select class="form-control" name="guardian_religion">
                                                <option value="">Select One</option>
                                                <option value="1">Islam</option>
                                                <option value="0">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2 col-sm-2 col-lg-2 label-align"
                                            for="present_address">Present Address <span class="required">*</span>
                                        </label>
                                        <div class="col-md-10 col-sm-10 col-lg-10">
                                            {{--<input type="text" id="present_address" required="required" class="form-control  ">--}}
                                            <textarea class="form-control" name="present_address"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="step-5">
                                <h5 class="row justify-content-center">Academic Information</h5>
                                <form class="form-horizontal form-label-left">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Level of Education</th>
                                                        <th>Name of Degree</th>
                                                        <th>Institute/Board</th>
                                                        <th>Passing Year</th>
                                                        <th>Result*</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group row">
                                                                <div class=" ">
                                                                    {{--<input type="text" id="last-name" name="occupation" required="required" class="form-control ">--}}
                                                                    <select class="form-control" name="level_education">
                                                                        <option value="">Select One</option>
                                                                        <option value="1">SSC</option>
                                                                        <option value="0">HSC</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group row">
                                                                <div class=" ">
                                                                    {{--<input type="text" id="last-name" name="occupation" required="required" class="form-control ">--}}
                                                                    <select class="form-control" name="name_degree">
                                                                        <option value="">Select One</option>
                                                                        <option value="1">BBA</option>
                                                                        <option value="0">MBA</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="">
                                                                <div class="form-group row">
                                                                    <div class=" ">
                                                                        <input type="text" id="institute"
                                                                            required="required" class="form-control  ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="">
                                                                <div class="form-group row">
                                                                    <div class="">
                                                                        <input type="text" id="board"
                                                                            required="required" class="form-control  ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="">
                                                                <div class="form-group row">
                                                                    <div class=" ">
                                                                        <input type="text" id="result"
                                                                            required="required" class="form-control  ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="step-6">
                                <h5 class="row justify-content-center">Training/Work Experiences</h5>
                                <form class="form-horizontal form-label-left">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Name of Training</th>
                                                        <th>Institute/Board</th>
                                                        <th>Duration</th>
                                                        <th>Passing Year</th>
                                                        <th>Result*</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="">
                                                                <div class="form-group row">
                                                                    <div class="">
                                                                        <input type="text" id="name_of_training"
                                                                            name="name_of_training" required="required"
                                                                            class="form-control  ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="">
                                                                <div class="form-group row">
                                                                    <div class="">
                                                                        <input type="text" id="institute_board"
                                                                            name="institute_board" required="required"
                                                                            class="form-control  ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="">
                                                                <input type="date" name="duration_from"
                                                                    class="form-control">To<span><input type="date"
                                                                        name="duration_to" class="form-control"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="">
                                                                <div class="form-group row">
                                                                    <div class="">
                                                                        <input type="text" id="passing_year"
                                                                            name="passing_year" required="required"
                                                                            class="form-control  ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="">
                                                                <div class="form-group row">
                                                                    <div class=" ">
                                                                        <input type="text" id="result" name="result"
                                                                            required="required" class="form-control  ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="step-7">
                                <h5 class="row justify-content-center"> Publications/Workshops/Seminars/Achievements
                                </h5>
                                <form class="form-horizontal form-label-left">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Duration</th>
                                                        <th>Attachmetn</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="">
                                                                <div class="form-group row">
                                                                    <div class="">
                                                                        <input type="text" id="name_of_training"
                                                                            name="name_of_training" required="required"
                                                                            class="form-control  ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="">
                                                                <input type="date" name="duration_from"
                                                                    class="form-control">To<span><input type="date"
                                                                        name="duration_to" class="form-control"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="">
                                                                <div class="form-group row">
                                                                    <div class=" ">
                                                                        <input type="file" id="result" name="image"
                                                                            required="required" class="form-control  ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="step-8">
                                <h5 class="row justify-content-center">Skills Information</h5>
                                <form class="form-horizontal form-label-left">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Entity Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="">
                                                                <div class="form-group row">
                                                                    <div class="">
                                                                        <input type="text" id="name_of_training"
                                                                            name="name_of_training" required="required"
                                                                            class="form-control  ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="step-8">
                                {{--<h5 class="row justify-content-center">Attachments Information</h5>--}}
                                <form class="form-horizontal form-label-left">
                                </form>
                            </div>

                        </div>
                        <!-- End SmartWizard Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var url = window.location;
        const allLinks = document.querySelectorAll('.nav-item a');
        const currentLink = [...allLinks].filter(e => {
            return e.href == url;
        });
        currentLink[0].classList.add("active")
        currentLink[0].closest(".nav-treeview").style.display = "block";

    </script>
    @endsection
