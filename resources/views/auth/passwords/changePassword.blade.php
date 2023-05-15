@section('content') @include('layouts.modalFormSubmit') @php $actionUrl=url('/saveChangePassword'); @endphp
<script>
    $('form').parsley();
</script>
<?php ini_set('memory_limit', -1); ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="" data-parsley-validate="" role="form" method="post" action="{{ $actionUrl }}" class="form-label-left"
        enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Current Password
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" type="password" name="currentPassword" id="currentPassword" placeholder="" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">New Password
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" type="password" name="password" id="password" placeholder="" required />
            </div>
        </div>
        {{-- <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Confirm Password
                <span class="required input-field-required-sign">*</span>
            </label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" type="password" name="password_confirm" id="password_confirm" placeholder="" required />
            </div>
        </div> --}}
        <div class="clearfix"></div>
        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <button type="submit" id='saveBtnStudentInfo' class="btn btn-primary">Submit</button>
                <button type='reset' class="btn btn-success">Reset</button>
            </div>
        </div>
    </form>
</div>
<!-- input field only  text -->
<script>
    $('.cha_text_validation').on('input', function() {
        if (!/[a-z]$/.test(this.value)) {
            this.value = this.value.slice(0, -1);
        }
    });
</script>
