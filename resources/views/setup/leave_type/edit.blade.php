@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateLeaveTypeSetup/'.$leaveTypeSetup->id); @endphp
<script>
    $('form').parsley();

</script>

<div class="flash-message"></div>
<div class="x_content">
    <form id="" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left"
        enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />

        <!--  <span class="section">Add Module</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Leave Type
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="leaveType" id="LeaveType" required>

                    @foreach($leaveTypes as $leaveType)
                    <option value="{{$leaveType->LOOKUP_DATA_ID}}"
                        {{$leaveType->LOOKUP_DATA_ID == old('leave_type_id', $leaveTypeSetup->leave_type_id) ? 'selected' : '' }}>
                        {{$leaveType->LOOKUP_DATA_NAME}}
                    </option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Number Of Days
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input type="number" class="form-control input-field-required-sign"
                    value="{{$leaveTypeSetup->number_of_days}}" name="number_of_days" id="number_of_days" placeholder=""
                    required />
            </div>
        </div>


        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Description*</label>
            <div class="col-md-6 col-sm-6">
                <textarea class="form-control" rows="3" name="description"
                    required>{{$leaveTypeSetup->description}}</textarea>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status
                <span class="required  input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="active_status">
                    <option value="1" {{$leaveTypeSetup->active_status == 1 ? 'selected' : ''}}> Active </option>
                    <option value="0" {{$leaveTypeSetup->active_status == 0 ? 'selected' : ''}}> Inactive</option>
                </select>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <button type="submit" id='saveBtnStudentInfo' class="btn btn-primary">Submit</button>
                <button type='reset' class="btn btn-success">Reset</button>
            </div>
        </div>

    </form>
</div>
