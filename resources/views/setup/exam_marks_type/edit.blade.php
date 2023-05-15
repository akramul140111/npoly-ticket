@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateMarksTypeSetup/'.$examMarksType->id); @endphp
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
            <label class="col-form-label col-md-3 col-sm-3 label-align">Exam Marks Type

                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control" name="exam" id="Exam" value="{{$examMarksType->exam}}">
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Criteria Type
                <span class="required  input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="criteria_type">
                    <option value="1" {{$examMarksType->type == 1 ? 'selected' : ''}}>Marks </option>
                    <option value="2" {{$examMarksType->type == 2 ? 'selected' : ''}}>Selection </option>
                </select>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Description*</label>
            <div class="col-md-6 col-sm-6">
                <textarea class="form-control" rows="3" name="description">{{$examMarksType->description}}</textarea>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status
                <span class="required  input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="active_status">
                    <option value="1" {{$examMarksType->active_status == 1 ? 'selected' : ''}}>Active</option>
                    <option value="0" {{$examMarksType->active_status == 0 ? 'selected' : ''}}>Inactive</option>
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
