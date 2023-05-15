@section('content') @include('layouts.modalFormSubmit') @php $actionUrl=url('/storeModuleLinkSetup'); @endphp
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left" enctype="multipart/form-data"
        autocomplete="off">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />

        <!--  <span class="section">Add Module</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Module Name*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="module_id" required>
                    <option value="">--select--</option>
                    @if(!empty($modules)) @foreach($modules as $module)
                    <option value="{{$module->MODULE_ID}}">{{$module->MODULE_NAME}}</option>
                    @endforeach @endif
                </select>
            </div>
        </div>
        <!-- <span class="section">Create Top Menu</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Module Link Name
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="module_link_name" id="module_link_name" placeholder="" required/>
            </div>
        </div>
        <!-- <span class="section">Create Top Menu</span> -->
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Module Link Page
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="module_link_page" id="module_link_page" placeholder="" required/>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Module Link Uri
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="module_link_uri" id="module_link_uri" placeholder="" required/>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">SL No
            </label>
            <div class="col-md-6 col-sm-6">
                <input type="number" class="form-control input-field-required-sign" name="SL_NO" id="module_link_uri" placeholder=""/>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status
                <span class="required  input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">
                <span class="required  input-field-required-sign"></span>
            </label>
            <div class="col-md-6 col-sm-6">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" name="create" class="form-check-input" value="1"> Create
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="read" value="1"> Read
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="update" value="1"> Update
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="delete" value="1"> Delete
                    </label>
                </div>
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