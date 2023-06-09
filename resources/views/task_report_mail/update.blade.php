@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateTaskMailInfo'); @endphp
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left"
          enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Employee*</label>
                <div class="col-md-9 col-sm-9">
                    <select class="form-control select2" name="employee_id" id="employee_id">
                        <option value="">Select One</option>
                        @foreach($employee as $key => $emp)
                            <option value="{{$emp->employee_id}}" @if($result->employee_id == $emp->employee_id) selected @endif> {{$emp->employee_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Report To*</label>
                <div class="col-md-9 col-sm-9">
                    <select class="form-control select2" name="report_to">
                        <option value="">Select One</option>
                        @foreach($employees as $key => $value)
                            <option value="{{$value->employee_id}}" @if($result->report_to == $value->employee_id) selected @endif> {{$value->employee_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">CC Person*</label>
                <div class="col-md-9 col-sm-9">
                    @php
                    $empIds = DB::select("select employee_id from npoly_employees where employee_id in($result->cc_to)");
                    $BccempIds = DB::select("select employee_id from npoly_employees where employee_id in($result->bcc_to)");
                    @endphp

                    <select class="form-control select2" name="cc_person[]" multiple>
                        <option value="">Select One</option>
                        @foreach($employees as $key => $value)
                                <option value="{{$value->employee_id}}"
                                        @foreach($empIds as $id)
                                            @if($value->employee_id == $id->employee_id)
                                                selected
                                    @endif
                                    @endforeach
                                > {{$value->employee_name}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">BCC Person*</label>
                <div class="col-md-9 col-sm-9">
                    <select class="form-control select2" name="bcc_person[]" multiple>
                        <option value="">Select One</option>
                        @foreach($employees as $key => $value)
                                <option value="{{$value->employee_id}}"
                                @foreach($BccempIds as $bccId)
                                   @if($value->employee_id == $bccId->employee_id)
                                       selected
                                    @endif
                                @endforeach
                                > {{$value->employee_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Employee Name</label>
                <div class="col-md-9 col-sm-9">
                    <input type="text" class="form-control" value="{{$result->employee_name}}" id="employeeName" readonly>
                </div>
            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Department</label>
                <div class="col-md-9 col-sm-9">
                    <input type="text" class="form-control" value="{{$result->department_name}}" id="departmentId" readonly>
                </div>
            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Designation</label>
                <div class="col-md-9 col-sm-9">
                    <input type="text" class="form-control" value="{{$result->designation_name}}" id="designationId" readonly>
                </div>
            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3  label-align">Assign Date
                    <span class="required input-field-required-sign">*</span>
                </label>
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <input type="text" name="assign_date" value="{{date('d-m-Y',strtotime($result->assign_date))}}" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff;"  />
                </div>
            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status <span
                        class="required  input-field-required-sign">*</span></label>
                <div class="col-md-9 col-sm-9">
                    <select class="form-control" name="active_status">
                        <option value="1" {{ ($result->active_status==1)? 'selected':'' }}>Active</option>
                        <option value="0" {{ ($result->active_status<1)? 'selected':'' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="task_mail_id" value="{{$result->task_mail_id}}">

        <div class="clearfix"></div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <button type='reset' class="btn btn-success">Reset</button>
                <button type="submit" id='saveBtnStudentInfo' class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<script src="{{ URL::asset('assets/custom_js/custom_calendar.js') }}"></script>

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

    $('#employee_id').change(function (){
        let empId = $(this).val();
        if(empId !==''){
            var _token = '{{csrf_token()}}'
            $.ajax({
                type: 'GET',
                url: '{{url("/get_employee_info")}}',
                data: { _token: _token,empId:empId },
                success: function (data) {
                    $('#employeeName').val(data.employee_name);
                    $('#departmentId').val(data.department_name);
                    $('#designationId').val(data.designation_name);
                }
            });
        }
    })




</script>
