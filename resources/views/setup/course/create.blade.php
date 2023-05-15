@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/storeCourseSetup'); @endphp
<script>
    $('form').parsley();

</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="CourseSetupForm" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}"
        class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        @csrf

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Course*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="course_type" id="course_type" onchange="checkDuplicate($(this))"
                    required>
                    <option value="">--select--</option>
                    @if($courseTypes)
                    @foreach($courseTypes as $c)
                    <option value="{{$c->LOOKUP_DATA_ID}}">{{$c->LOOKUP_DATA_NAME}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Faculty*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="department" id="department" onchange="checkDuplicate($(this))"
                    required>
                    <option value="">--select--</option>
                    @if($departments)
                    @foreach($departments as $d)
                    <option value="{{$d->LOOKUP_DATA_ID}}">{{$d->LOOKUP_DATA_NAME}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Department*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="course_name" id="course_name" onchange="checkDuplicate($(this))"
                    required>
                    <option value="">--select--</option>
                    @if($courseNames)
                    @foreach($courseNames as $cc)
                    <option value="{{$cc->LOOKUP_DATA_ID}}">{{$cc->LOOKUP_DATA_NAME}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Total Seat Number*</label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="total_seat_number" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Course Duration (Years)*</label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="course_duration" required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Number of Phase*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="number_of_phase" required>
                    <option value="">--select--</optin>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">Not Applicable</option>
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Description</label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="descripton" />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status <span
                    class="required  input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="active_status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type='reset' class="btn btn-success">Reset</button>
            </div>
        </div>

    </form>
</div>
<script>
    // Check Duplicate Course
    function checkDuplicate(a) {
        var type = $('#course_type').val();
        var name = $('#course_name').val();
        var dept = $('#department').val();

        if (type != '' && name != '' && dept != '') {
            $.ajax({
                type: 'GET',
                url: '{{url("/courseSetup/checkDuplicateCourse")}}/' + type + '/' + name + '/' + dept,
                success: function (data) {
                    if (data > 0) {
                        alertify.alert(
                            'Already in used. \nPlease select another course, faculty, department.');
                        a.selectedIndex = 0;
                        a.val('');
                    }
                }
            });
        }

    }

    // get faculty, department by course
   /* var CT = $('#course_type');
    var D = $('#department');
    var CN = $('#course_name');
    D.html('<option value="">--select--</option>');
    CN.html('<option value="">--select--</option>');
    CT.change(function(){
        D.html('<option value="">--select--</option>');
        CN.html('<option value="">--select--</option>');
        var CTV = CT.val();
        if(CTV!=''){
            $.ajax({type: 'GET', url: '{{url("/block/getDept")}}/'+CTV, success: function (data) {D.html(data);}});
        }
    });

    D.change(function(){
        CN.html('<option value="">--select--</option>');
        var DV = D.val();
        if(DV!=''){
            $.ajax({type: 'GET', url: '{{url("/block/getCourse")}}/'+DV, success: function (data) {CN.html(data);}});
        }
    });
*/
</script>
