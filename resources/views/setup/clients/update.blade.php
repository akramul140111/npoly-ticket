@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateClientInfo'); @endphp
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="ClientForm" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}"
        class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Client Name*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" value="@if(isset($result)) {{$result->client_name}} @endif" class=" form-control" name="client_name" required />
            </div>

        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Client Abr*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" value="@if(isset($result)) {{$result->client_abbr}} @endif" class=" form-control" name="client_abbr" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Client Address*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" value="@if(isset($result)) {{$result->client_addr}} @endif" class=" form-control" name="client_addr" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Phone*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" value="@if(isset($result)) {{$result->client_phone}} @endif" class=" form-control" name="client_phone" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Email*</label>
            <div class="col-md-6 col-sm-6">
                <input type="text" value="@if(isset($result)) {{$result->client_email}} @endif" class=" form-control" name="client_email" required />
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
                <input type="hidden" name="client_id" value="{{$result->client_id}}">
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

    function getDay() {
        var cDate = $('#class_start_date').val();
        if (cDate != '') {
            $.ajax({
                type: 'GET',
                url: '{{url("/getDay")}}/' + cDate,
                success: function (data) {
                    $("#dayval").val(data);
                }
            });
        }
    }

    // block date validation for class routine add
    // $('#block_id').change(function(){
    //     $('#btnSubmit').prop("disabled",true);
    //     var blockID = $('#block_id').val();
    //     if (blockID != '') {
    //         $.ajax({
    //             type: 'GET',
    //             url: '{{url("/classRoutine/getBlockDate/")}}/' + blockID,
    //             success: function (data) {
    //                 if(data==1){
    //                     $('#btnSubmit').prop("disabled",false);
    //                 }
    //             }
    //         });
    //     }
    // });

    // block date validation for class routine add
    $('#block_id').change(function(){
        $('#btnSubmit').prop("disabled",true);
        var blockID = $('#block_id').val();
        if (blockID != '') {
            $.ajax({
                type: 'GET',
                url: '{{url("/classRoutine/getBlockDate/")}}/' + blockID,
                success: function (data) {
                    $('#block_from_date').val(data.dateForm);
                    $('#block_to_date').val(data.dateTo);
                    $('#class_start_date').focus();
                    // drp-calendar left single dspla none
                    if(data.status==1){
                        $('#btnSubmit').prop("disabled",false);
                    }
                }
            });
        }
    });

</script>
