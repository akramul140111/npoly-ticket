@section('content') @include('layouts.modalFormSubmit') @php $actionUrl=url('/storeUser'); @endphp
<script>
    $('form').parsley();

</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <form id="" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left"
            enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Course
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select class="form-control" name="cousetype" required>
                            <option value="">--select--</option>

                            @foreach($courseTypes as $courseType)
                            <option value="{{$courseType->LOOKUP_DATA_ID}}">{{$courseType->LOOKUP_DATA_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Faculty
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select class="form-control" name="department" required>
                            <option value="">--select--</option>

                            @foreach($departments as $department)
                            <option value="{{$department->LOOKUP_DATA_ID}}">{{$department->LOOKUP_DATA_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Department
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <select class="form-control" name="coursename" required>
                            <option value="">--select--</option>
                            @foreach($courseNames as $courseName)
                            <option value="{{$courseName->LOOKUP_DATA_ID}}">{{$courseName->LOOKUP_DATA_NAME}}</option>
                            @endforeach
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

                            @foreach($user_groups as $user_group)
                            <option value="{{$user_group->USERGRP_ID}}">{{$user_group->USERGRP_NAME}}</option>
                            @endforeach

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
                            @foreach($designations as $designation)
                            <option value="{{$designation->id}}">{{$designation->designation}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- <span class="section">Create Top Menu</span> -->



                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Contact Number
                        <span class="required input-field-required-sign">*</span>
                    </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input class="form-control input-field-required-sign" name="contact_no" id="user_name"
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
                        <button type="submit" id='saveBtnStudentInfo' class="btn btn-primary">Submit</button>
                        <button type='reset' class="btn btn-success">Reset</button>
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
                url: "{{route('userGroupLevel')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
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
