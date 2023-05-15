@section('content') @include('layouts.modalFormSubmit') @php $actionUrl=url('/storeGroup'); @endphp
<script>
    $('form').parsley();

</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left"
        enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />

        <!-- <span class="section">Create Top Menu</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Group Name
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="group_name" id="group_name" placeholder=""
                    required />
            </div>
        </div>

        <div class="field item form-group form-check-inline">
            <label class="col-form-label col-md-3 col-sm-3  label-align"> Active ?
                <span class="required  input-field-required-sign"></span>
            </label>
            <div class="col-md-6 col-sm-6">
                <label class="form-check-label">
                    <input type="checkbox" name="status" class="form-check-input" value="1">
                </label>
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
