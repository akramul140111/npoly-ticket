@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/storeAcademicCalendarSetup'); @endphp
<script>
    $('form').parsley();

</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="academicCalendarSetupForm" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}"
        class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="col-md-6 col-sm-6 col-lg-6">
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Courses*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control js-example-basic-single" onchange="checkDuplicate($(this))"
                            id="course_type" name="course_type" required>
                            <option value="">--select--</option>
                            @foreach($courseTypes as $key=>$value)
                            <option value="{{$value->LOOKUP_DATA_ID}}">{{$value->LOOKUP_DATA_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Faculty*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="department" onchange="checkDuplicate($(this))"
                            id="department" required>
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
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Department*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="course_name"  onchange="checkDuplicate($(this))"
                            id="course_name" required>
                            <option value="">--select--</option>
                            @if($courseNames)
                            @foreach($courseNames as $c)
                            <option value="{{$c->LOOKUP_DATA_ID}}">{{$c->LOOKUP_DATA_NAME}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Event/Activity Type*</label>
                    <div class="col-md-8 col-sm-8 col-lg-8">
                        <select class="form-control" onchange="checkDuplicate($(this))" id="event_type"
                            name="event_type" required>
                            <option value="">--select--</option>
                            @foreach($activitys as $key=>$value)
                            <option value="{{$value->activity_id}}">{{$value->activity_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Topic*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control js-example-basic-single" onchange="checkDuplicate($(this))"
                            id="event_topic" name="topic" required>
                            <option value="">--select--</option>
                            @foreach($topics as $key=>$value)
                            <option value="{{$value->id}}">{{$value->topic}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Description</label>
                    <div class="col-md-8 col-sm-8">
                        <input type="text" class="form-control" name="title"
                            placeholder="Example: Description here (if needed)">
                    </div>
                </div>


            </div>
            <div class="col-md-6 col-sm-6 col-lg-6">
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Batch*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="batch" onchange="checkDuplicate($(this))" id="batch"
                            required>
                            <option value="">--select--</option>
                            @if($batches)
                            @foreach($batches as $b)
                            <option value="{{$b->LOOKUP_DATA_ID}}">{{$b->LOOKUP_DATA_NAME}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Event Start Date*</label>
                    <div class="col-md-8 col-sm-8">
                        <input type="text" class="datepickerMonthYear form-control" name="start" required>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Event End Date*</label>
                    <div class="col-md-8 col-sm-8">
                        <input type="text" class="datepickerMonthYear form-control" name="end" required>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Color*</label>
                    <div class="col-md-8 col-sm-8">
                        <div class="input-group demo2" style="margin-bottom: 0px">
                            <input type="text" class="form-control" name="color" value="#e01ab5" required>
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Active Status*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="active_status" required>
                            <option value="1">Active</optin>
                            <option value="0">Inactive</optin>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 text-align-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type='reset' class="btn btn-success">Reset</button>
            </div>
        </div>

    </form>
</div>
<script src="{{ URL::asset('assets/custom_js/custom_calendar.js') }}"></script>
<script>
    init_ColorPicker();

</script>

<script>
    // Check Duplicate Block
    function checkDuplicate(a) {
        var event_type = $('#event_type').val();
        var event_topic = $('#event_topic').val();
        var name = $('#course_name').val();
        var dept = $('#department').val();
        var batch = $('#batch').val();
        var course_type = $('#course_type').val();


        if (event_type != '' && event_topic != '' && name != '' && dept != '' && batch != '' && course_type != '') {

            $.ajax({
                type: 'GET',
                url: '{{url("/academic/checkDuplicate")}}/' + event_type + '/' + event_topic + '/' + name +
                    '/' + dept + '/' + batch + '/' + course_type,
                success: function (data) {
                    if (data > 0) {
                        alertify.alert(
                            'Already in used. \nPlease select another event type, event topic, department, course, faculty & batch.'
                        );
                        a.selectedIndex = 0;
                        a.val('');
                    }
                }
            });
        }

    }

    // get faculty, department by course
    var CT = $('#course_type');
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

</script>
