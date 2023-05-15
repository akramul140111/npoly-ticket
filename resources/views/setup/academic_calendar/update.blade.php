@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateAcademicCalendarSetup'); @endphp
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
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Course*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="course_type" onchange="checkDuplicate($(this))"
                            id="course_type" required>
                            <option value="">--select--</option>
                            @foreach($courseTypes as $key=>$value)
                            <option value="{{$value->LOOKUP_DATA_ID}}" @if($value->LOOKUP_DATA_ID==$result->course_type)
                                selected
                                @endif>{{$value->LOOKUP_DATA_NAME}}</option>
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
                            <?php
                            $targetCT = '';
                            if($result->course_type){
                                $dept = DB::table('set_course as dt1')
                                ->where('dt1.course_type', $result->course_type)
                                ->where('dt1.active_status', 1)
                                ->select('dt1.department')
                                ->groupBy('dt1.department')
                                ->get();

                                if($dept){
                                    $deptName = '';
                                    //$dpt = '<option value="">--select--</option>';
                                    foreach($dept as $d){
                                        $deptInfo = DB::table('sa_lookup_data')->where('LOOKUP_DATA_ID', $d->department)->select('LOOKUP_DATA_NAME AS NAME')->first();
                                        if($deptInfo){
                                            $deptName = $deptInfo->NAME; ?>
                                            <option value="{{$d->department}}" {{ ($result->department==$d->department)? 'selected':'' }}>{{$deptName}}</option>
                                            <?php
                                        }
                                    }
                                }
                            }
                            ?>

                            <!-- @if($departments)
                            @foreach($departments as $d)
                            <option value="{{$d->LOOKUP_DATA_ID}}"
                                {{($result->department==$d->LOOKUP_DATA_ID)? 'selected':''}}>{{$d->LOOKUP_DATA_NAME}}
                            </option>
                            @endforeach
                            @endif -->
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Department*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="course_name" onchange="checkDuplicate($(this))"
                            id="course_name" required>
                            <option value="">--select--</option>
                            <?php
                            if($result->department){
                                $course = DB::table('set_course as dt1')
                                ->where('dt1.department', $result->department)
                                ->where('dt1.active_status', 1)
                                ->select('dt1.course_name')
                                ->groupBy('dt1.course_name')
                                ->get();
                    
                                if($course){
                                    $courseName = '';
                                    foreach($course as $c){
                                        $courseInfo = DB::table('sa_lookup_data')->where('LOOKUP_DATA_ID', $c->course_name)->select('LOOKUP_DATA_NAME AS COURSE')->first();
                                        if($courseInfo){
                                            $courseName = $courseInfo->COURSE;
                                            ?>
                                            <option value="{{$c->course_name}}" {{ ($result->course_name==$c->course_name)? 'selected':'' }}>{{$courseName}}</option>
                                            <?php
                                        }
                                    }
                                }
                            }                        
                            ?>

                            <!-- @if($courseNames)
                            @foreach($courseNames as $c)
                            <option value="{{$c->LOOKUP_DATA_ID}}"
                                {{($result->course_name==$c->LOOKUP_DATA_ID)? 'selected':''}}>{{$c->LOOKUP_DATA_NAME}}
                            </option>
                            @endforeach
                            @endif -->
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Event/Activity Type*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" onchange="checkDuplicate($(this))" id="event_type"
                            name="event_type" required>
                            <option value="">--select--</option>
                            @foreach($activitys as $key=>$valuea)
                            <option value="{{$valuea->activity_id}}" @if($valuea->activity_id==$result->event_type)
                                selected @endif>{{$valuea->activity_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Topic*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="topic" onchange="checkDuplicate($(this))" id="event_topic"
                            required>
                            <option value="">--select--</option>
                            @foreach($topics as $key=>$value)
                            <option value="{{$value->id}}" @if($value->id==$result->topic) selected
                                @endif>{{$value->topic}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Description</label>
                    <div class="col-md-8 col-sm-8">
                        <input type="text" class="form-control" name="title"
                            placeholder="Example: Description here (if needed)" value="{{$result->title}}">
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
                            <option value="{{$b->LOOKUP_DATA_ID}}"
                                {{($result->batch==$b->LOOKUP_DATA_ID)? 'selected':''}}>{{$b->LOOKUP_DATA_NAME}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Event Start Date*</label>
                    <div class="col-md-8 col-sm-8">
                        <input type="text" class="datepickerMonthYear form-control" name="start"
                            value="{{($result->start)? date('d-M-Y', strtotime($result->start)):''}}" required>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Event End Date*</label>
                    <div class="col-md-8 col-sm-8">
                        <input type="text" class="datepickerMonthYear form-control" name="end"
                            value="{{($result->end)? date('d-M-Y', strtotime($result->end)):''}}" required>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Color*</label>
                    <div class="col-md-8 col-sm-8">
                        <div class="input-group demo2" style="margin-bottom: 0px">
                            <input type="text" class="form-control" name="color" value="{{$result->color}}" required>
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4 label-align">Active Status*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="active_status" required>
                            <option value="1" {{ ($result->active_status==1)? 'selected':'' }}>Active</optin>
                            <option value="0" {{ ($result->active_status<1)? 'selected':'' }}>Inactive</optin>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 text-align-center">
                <input type="hidden" name="id" value="{{$result->id}}">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type='reset' class="btn btn-success">Reset</button>
            </div>
        </div>

    </form>
</div>
<input type="hidden" id="oevent_type" value="{{$result->event_type}}" />
<input type="hidden" id="oevent_topic" value="{{$result->topic}}" />
<input type="hidden" id="ocourse_name" value="{{$result->course_name}}" />
<input type="hidden" id="odepartment" value="{{$result->department}}" />
<input type="hidden" id="obatch" value="{{$result->batch}}" />
<input type="hidden" id="ocourse_type" value="{{$result->course_type}}" />
<script src="{{ URL::asset('assets/custom_js/custom_calendar.js') }}"></script>
<script>
    init_ColorPicker();

    function checkDuplicate(a) {

        var event_type = $('#event_type').val();
        var event_topic = $('#event_topic').val();
        var name = $('#course_name').val();
        var dept = $('#department').val();
        var batch = $('#batch').val();
        var course_type = $('#course_type').val();


        var oevent_type = $('#oevent_type').val();
        var oevent_topic = $('#oevent_topic').val();
        var ocourse_name = $('#ocourse_name').val();
        var odepartment = $('#odepartment').val();
        var obatch = $('#obatch').val();
        var ocourse_type = $('#ocourse_type').val();

        if (event_type != '' && event_topic != '' && name != '' && dept != '' && batch != '' && course_type != '') {

            if (event_type == oevent_type && name == oevent_topic && dept == ocourse_name && phase == odepartment &&
                batch == obatch && course_type == ocourse_type) {

            } else {
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

    }
    
    // get faculty, department by course
    var CT = $('#course_type');
    var D = $('#department');
    var CN = $('#course_name');
    //D.html('<option value="">--select--</option>');
    //CN.html('<option value="">--select--</option>');
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
