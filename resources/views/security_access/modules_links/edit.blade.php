@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateModuleLinkSetup/'.$moduleLink->SA_MLINKS_ID); @endphp
<script>
    $('form').parsley();

</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left"
        enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />

        <!--  <span class="section">Add Module</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Module Name*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="module_id" required>
                    <option value="">--select--</option>

                    @foreach($modules as $module)
                    <option value="{{$module->MODULE_ID}}"
                        {{$module->MODULE_ID == old('SA_MODULE_ID', $moduleLink->SA_MODULE_ID) ? 'selected' : '' }}>
                        {{ $module->MODULE_NAME  }}
                        @endforeach

                </select>
            </div>
        </div>
        <!-- <span class="section">Create Top Menu</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Module Link Name <span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" value="{{$moduleLink->SA_MLINK_NAME}}"
                    name="module_link_name" id="module_link_name" value="" placeholder="" required />
            </div>
        </div>
        <!-- <span class="section">Create Top Menu</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Module Link Page<span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="module_link_page" id="module_link_page"
                    value="{{$moduleLink->SA_MLINK_PAGES}}" placeholder="" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Module Link Uri<span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="module_link_uri" id="module_link_uri"
                    value="{{$moduleLink->URL_URI}}" placeholder="" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">SL No
            </label>
            <div class="col-md-6 col-sm-6">
                <input type="number" class="form-control input-field-required-sign" name="SL_NO" id="module_link_uri"
                    value="{{$moduleLink->SL_NO}}" />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Url Function<span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="url_function" id="url_function"
                    value="{{$moduleLink->url_function}}" placeholder="" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Url Class<span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="url_class" id="url_class"
                    value="{{$moduleLink->url_class}}" placeholder="" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Url Name<span
                    class="required input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="url_name" id="url_name"
                    value="{{$moduleLink->url_name}}" placeholder="" required />
            </div>
        </div>


        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Url Type<span
                    class="required  input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="url_type">
                    <option value="post" {{$moduleLink->url_type == "post" ? 'selected' : ''}}> Post </option>
                    <option value="get" {{$moduleLink->url_type == "get" ? 'selected' : ''}}> Get</option>
                </select>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status <span
                    class="required  input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="status">
                    <option value="1" {{$moduleLink->STATUS == 1 ? 'selected' : ''}}> Active </option>
                    <option value="0" {{$moduleLink->STATUS == 0 ? 'selected' : ''}}> Inactive</option>
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
