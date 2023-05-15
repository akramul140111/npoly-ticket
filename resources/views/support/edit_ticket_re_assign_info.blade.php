{{--@section('content')--}}
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateTicketReAssignInfo'); @endphp
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="ClassRoutineForm" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}"
          class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Department *</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="department_id" required id="departmentId">
                    <option value="">--select--</option>
                    @foreach($department as $dept)
                        <option value="{{$dept->LOOKUP_DATA_ID}}" @if($result->department_id ==$dept->LOOKUP_DATA_ID) selected @endif>{{$dept->LOOKUP_DATA_NAME}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Employee*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control"  name="employee_id" id="employeeId">
                    <option value="">--select--</option>
                    @foreach($employee as $key => $value)
                        <option value="{{$value->employee_id}}" @if($result->employee_id ==$value->employee_id) selected @endif>{{$value->employee_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Assign Date</label>
            <div class="col-md-3 col-sm-3">
                <input type="text" name="assign_date" value="@if(!empty($result->forecast_date)){{date('d-m-Y',strtotime($result->assign_date))}}@endif" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff; width: 170px !important;"  />
            </div>
            Forecast Date
            <div class="col-md-3 col-sm-3">
                <input type="text" name="forecast_date" value="@if(!empty($result->forecast_date)){{date('d-m-Y',strtotime($result->forecast_date))}}@endif" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff;width: 170px !important;"  />
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Re Assign Reason*</label>
            <div class="col-md-6 col-sm-6">
               <input type="text" class="form-control" name="reassign_reason" value="" required>
            </div>
        </div>
       <!-- <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Work Station*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control"  name="work_station" id="employeeId" required>
                    <option value="">--select--</option>
                    <option value="1" @if($result->work_station=='1') selected @endif>In House</option>
                    <option value="2" @if($result->work_station=='2') selected @endif>Out Side Office</option>
                </select>
            </div>
        </div> -->

        <div class="clearfix"></div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <input type="hidden" name="ticket_id" value="{{$result->id}}">
                <input type="hidden" name="previoue_task_id" value="{{$result->task_id}}">
                <input type="hidden" name="previoue_emp_id" value="{{$result->employee_id}}">

                <button type='reset' class="btn btn-success">Reset</button>
                <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
            </div>
        </div>

    </form>

</div>

<script src="{{ URL::asset('assets/custom_js/custom_calendar.js') }}"></script>

<script>
    $('#departmentId').change(function(){
        var deptId = $(this).val();
        $('#employeeId').html('<option value="">--select--</option>');
        if(deptId!=''){
            $.ajax({
                type: 'GET',
                url: '{{url("/getEmployee")}}/'+deptId,
                success: function (data) {
                    $('#employeeId').html(data);
                }
            });
        }
    });
</script>


