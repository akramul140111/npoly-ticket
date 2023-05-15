@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/storeTaskReportMail'); @endphp
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<style>

</style>
<div class="x_content">
        <div class="col-lg-12 col-md-12 col-sm-12">
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
                                    <option value="{{$emp->employee_id}}" @if(Auth::user()->employee_id == $emp->employee_id) selected @endif> {{$emp->employee_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--  <span class="section">Add Module</span> -->
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Report To*</label>
                        <div class="col-md-9 col-sm-9">
                            <select class="form-control select2" name="report_to">
                                <option value="">Select One</option>
                                @foreach($employees as $key => $value)
                                    <option value="{{$value->employee_id}}"> {{$value->employee_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--<div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Assign Date
                            <span class="required input-field-required-sign">*</span>
                        </label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="text" name="assign_date" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff;"  />
                        </div>
                    </div> -->
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">CC Person*</label>
                        <div class="col-md-9 col-sm-9">
                            <select class="form-control select2" name="cc_person[]" multiple>
                                <option value="">Select One</option>
                                @foreach($employees as $key => $value)
                                    <option value="{{$value->employee_id}}"> {{$value->employee_name}}</option>
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
                                    <option value="{{$value->employee_id}}"> {{$value->employee_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Employee Name</label>
                        <div class="col-md-9 col-sm-9">
                           <input type="text" class="form-control" value="@if(Auth::user()->employee_id) {{$employee[0]->employee_name}} @endif" id="employeeName" readonly>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Department</label>
                        <div class="col-md-9 col-sm-9">
                           <input type="text" class="form-control" value="@if(Auth::user()->employee_id) {{$employee[0]->department_name}} @endif" id="departmentId" readonly>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Designation</label>
                        <div class="col-md-9 col-sm-9">
                           <input type="text" class="form-control" value="@if(Auth::user()->employee_id) {{$employee[0]->designation_name}} @endif" id="designationId" readonly>
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

                </div>

                    <div class="clearfix"></div>

                    <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                            <button type='reset' class="btn btn-success">Reset</button>
                            <button type="submit" id='saveBtnStudentInfo' class="btn btn-primary">Submit</button>
                        </div>
                    </div>
            </form>
        </div>
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
