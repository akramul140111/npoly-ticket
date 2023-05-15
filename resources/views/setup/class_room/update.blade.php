@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateClassRoomSetup'); @endphp
<script>
    $('form').parsley();

</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
    <form id="ClassRoomSetupForm" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}"
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
                    <option value="{{$c->LOOKUP_DATA_ID}}"
                        {{($result->course_type==$c->LOOKUP_DATA_ID)? 'selected':''}}>{{$c->LOOKUP_DATA_NAME}}</option>
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
                    <option value="{{$d->LOOKUP_DATA_ID}}" {{($result->department==$d->LOOKUP_DATA_ID)? 'selected':''}}>
                        {{$d->LOOKUP_DATA_NAME}}</option>
                    @endforeach
                    @endif -->
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Department*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="course_name" id="course_name" onchange="checkDuplicate($(this))"
                    required>
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
                    @foreach($courseNames as $cc)
                    <option value="{{$cc->LOOKUP_DATA_ID}}"
                        {{($result->course_name==$cc->LOOKUP_DATA_ID)? 'selected':''}}>{{$cc->LOOKUP_DATA_NAME}}
                    </option>
                    @endforeach
                    @endif -->
                </select>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Room No*</label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="room_no" value="{{$result->room_no}}"
                    required />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Description</label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control input-field-required-sign" name="description"
                    value="{{$result->description}}" placeholder="Example: Description here (if needed)" />
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status <span
                    class="required  input-field-required-sign">*</span></label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="active_status" required>
                    <option value="1" {{ ($result->active_status==1)? 'selected':'' }}>Active</optin>
                    <option value="0" {{ ($result->active_status<1)? 'selected':'' }}>Inactive</optin>
                </select>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <input type="hidden" name="class_room_id" value="{{$result->id}}">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type='reset' class="btn btn-success">Reset</button>
            </div>
        </div>

    </form>
</div>
<input type="hidden" id="oType" value="{{$result->course_type}}" />
<input type="hidden" id="oName" value="{{$result->course_name}}" />
<input type="hidden" id="oDept" value="{{$result->department}}" />
<script>
    // Check Duplicate Topic
    function checkDuplicate(a) {
        /*var type = $('#course_type').val();
        var name = $('#course_name').val();
        var dept = $('#department').val();

        var oType = $('#oType').val();
        var oName = $('#oName').val();
        var oDept = $('#oDept').val();        

        if(type!='' && name!='' && dept!=''){

            if(type==oType && name==oName && dept==oDept){
                
            }else{
                $.ajax({
                    type: 'GET',
                    url: '{{url("/classRoomSetup/checkDuplicateClassRoom")}}/'+type+'/'+name+'/'+dept,
                    success: function (data) {
                        if(data>0){
                            alertify.alert('Already in used. \nPlease select another course, department, faculty.');
                            a.selectedIndex = 0;
                            a.val('');
                        }
                    }
                });
            }
        }*/

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
