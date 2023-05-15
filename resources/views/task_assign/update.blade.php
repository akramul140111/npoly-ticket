@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateTaskAssignInfo'); @endphp
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #495057;
        padding-top: 5px;
        font-weight: normal;
    }
</style>
<div class="x_content">
    <form id="ProjectForm" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}"
        class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Project*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control select2" name="project_id">
                    <option value="">Select One</option>
                    @foreach($projects as $key => $pro)
                        <option value="{{$pro->project_id}}" @if($result->project_id == $pro->project_id) selected @endif> {{$pro->pro_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Assign By*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control select2" name="assign_by">
                    <option value="">Select One</option>
                    @foreach($employee as $key => $value)
                        <option value="{{$value->employee_id}}" @if($result->assign_by == $value->employee_id) selected @endif> {{$value->employee_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Assign To*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control select2" name="assign_to">
                    <option value="">Select One</option>
                    @foreach($employee as $key => $value)
                        <option value="{{$value->employee_id}}" @if($result->employee_id == $value->employee_id) selected @endif> {{$value->employee_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Task Title*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" value="{{$result->task_title}}" class="  form-control" name="task_title" required />
            </div>

        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Task Description*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" value="{{$result->task_desc}}" class=" form-control" name="task_desc" required />
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Assign Date</label>
            <div class="col-md-3 col-sm-3">
                <input type="text" value="{{date('d-m-Y',strtotime($result->assign_date))}}" name="assign_date" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff; width: 170px !important;"  />
            </div>
            Forecast Date
            <div class="col-md-3 col-sm-3">
                <input type="text" value="{{date('d-m-Y',strtotime($result->forecast_date))}}" name="forecast_date" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff;width: 170px !important;"  />
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Project Priority*</label>
            <div class="col-md-6 col-sm-6">

                <select class="form-control select2" name="task_priority">
                    <option value="">Select Priority</option>
                    @foreach($priority as $prio)
                        <option value="{{$prio->LOOKUP_DATA_ID}}" @if($result->task_priority_id == $prio->LOOKUP_DATA_ID) selected @endif>{{$prio->LOOKUP_DATA_NAME}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Duration*</label>
            <div class="col-md-6 col-sm-6">
                <input type="number" value="{{$result->task_duration}}" class=" form-control" name="task_duration"  />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status <span
                    class="required  input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="active_status">
                    <option value="1" {{ ($result->active_status==1)? 'selected':'' }}>Active</option>
                    <option value="0" {{ ($result->active_status<1)? 'selected':'' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <input type="hidden" name="task_id" value="{{$result->task_id}}">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                    <button type='reset' class="btn btn-success">Reset</button>
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


    $('.select2').select2({
        dropdownParent: $('.modal .modal-content')
    });

</script>
