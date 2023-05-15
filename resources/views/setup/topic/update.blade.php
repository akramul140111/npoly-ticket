@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateTopicSetup'); @endphp
<script>
    $('form').parsley();

</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<form id="TopicSetupForm" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}"
    class="form-label-left" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="col-md-12 col-sm-12 col-lg-5">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="width-100p text-align-center">Update Topic Setup</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">


                <!-- TOPIC SETUP DATA -->
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4  label-align">Course*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="course_type" id="course_type"
                            onchange="checkDuplicate($(this))" required>
                            <option value="">--select--</option>
                            @if($courseTypes)
                            @foreach($courseTypes as $c)
                            <option value="{{$c->LOOKUP_DATA_ID}}"
                                {{ ($result->course_type==$c->LOOKUP_DATA_ID)? 'selected':'' }}>{{$c->LOOKUP_DATA_NAME}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4  label-align">Faculty*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="department" id="department" required>
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
                                {{ ($result->department==$d->LOOKUP_DATA_ID)? 'selected':'' }}>{{$d->LOOKUP_DATA_NAME}}
                            </option>
                            @endforeach
                            @endif -->
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4  label-align">Department*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="course_name" id="course_name"
                            onchange="checkDuplicate($(this))" required>
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
                                {{ ($result->course_name==$cc->LOOKUP_DATA_ID)? 'selected':'' }}>
                                {{$cc->LOOKUP_DATA_NAME}}</option>
                            @endforeach
                            @endif -->
                        </select>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4  label-align">Phase*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="phase" id="phase" onchange="checkDuplicate($(this))"
                            required>
                            <option value="">--select--</option>
                            @if($phases)
                            @foreach($phases as $p)
                            <option value="{{$p->LOOKUP_DATA_ID}}"
                                {{ ($result->phase==$p->LOOKUP_DATA_ID)? 'selected':'' }}>{{$p->LOOKUP_DATA_NAME}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4  label-align">Select Year*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="year" id="year" onchange="checkDuplicate($(this))" required>
                            <option value="">--select--</option>
                            @if($years)
                            @foreach($years as $y)
                            <option value="{{$y->LOOKUP_DATA_ID}}"
                                {{ ($result->year==$y->LOOKUP_DATA_ID)? 'selected':'' }}>{{$y->LOOKUP_DATA_NAME}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4  label-align">Topic Type*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="topic_type" id="topic_type"
                            onchange="checkDuplicate($(this))" required>
                            <option value="">--select--</option>
                            @if($topicTypes)
                            @foreach($topicTypes as $ttp)
                            <option value="{{$ttp->LOOKUP_DATA_ID}}"
                                {{ ($result->topic_type==$ttp->LOOKUP_DATA_ID)? 'selected':'' }}>
                                {{$ttp->LOOKUP_DATA_NAME}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4  label-align">Active Status <span
                            class="required  input-field-required-sign">*</span></label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="active_status">
                            <option value="1" {{ ($result->active_status==1)? 'selected':'' }}>Active</optin>
                            <option value="0" {{ ($result->active_status<1)? 'selected':'' }}>Inactive</optin>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-lg-7">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="width-100p text-align-center">Topics</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <!-- TOPICS DATA -->
                <div class="text-align-center red" style="margin: -10px 0 5px 0; display:none" id="msg2"></div>
                <table class="table  table-borderd topics-tbl custom-table-border">
                    <thead>
                        <tr>
                            <th style=width:90%>Topic Name</th>
                            <th class="text-center">
                                <button class="btn btn-default btn-sm" style="color:black" title="Delete"
                                    id="addTopicsRow" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $pk = true; @endphp
                        @php $topicsInfo = DB::table('set_topic_chd')->where('topic_id', $result->id)->get() @endphp
                        @if($topicsInfo)
                        @foreach($topicsInfo as $topicInfo)
                        <tr>
                            <td>
                                <input type="hidden" value="{{$topicInfo->id}}" name="topic_chd_id[]" class="actualDel">
                                <input type="text" class="form-control deptTopics" name="topics[]" id="department_tp"
                                    value="{{$topicInfo->topic}}" required>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-default ibtnDel{{($pk)? 'Non':''}}" style="color:red"
                                    title="Delete" id="" type="button">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </button>
                            </td>
                        </tr>
                        @php $pk = false; @endphp
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- Submit Button -->
    <div class="col-md-12 text-align-center">
        <input type="hidden" name="topic_id" value="{{$result->id}}">
        <button type="submit" id='saveBtn' class="btn btn-primary">Submit</button>
        <button type='reset' class="btn btn-success">Reset</button>
    </div>
</form>
<input type="hidden" id="oType" value="{{$result->course_type}}" />
<input type="hidden" id="oName" value="{{$result->course_name}}" />
<input type="hidden" id="oPhase" value="{{$result->phase}}" />
<input type="hidden" id="oYear" value="{{$result->year}}" />
<input type="hidden" id="oTopicType" value="{{$result->topic_type}}" />
<script>
    // Topics Tbl
    var counterc = 0;
    $("#addTopicsRow").on("click", function () {

        var noAddStatus = false;
        $('.deptTopics').map(function () {
            if (this.value == '') {
                showMessage(2, 'Please enter topic name.');
                noAddStatus = true;
            }
        }).get();

        if (noAddStatus) {
            return false;
        }

        var newRow = $("<tr>");
        var cols = "";
        cols += '<td><input type="hidden" name="topic_chd_id[]" class="actualDel">';
        cols +=
            '<input type="text" class="form-control deptTopics" name="topics[]" id="department_tp" required></td>';
        cols +=
            '<td class="text-center"><button class="btn btn-default ibtnDel" style="color:red" title="Delete" id="" type="button"><i  class="glyphicon glyphicon-remove"></i></button></td>';
        cols += '</tr>';
        newRow.append(cols);
        $("table.topics-tbl").append(newRow);
        counterc++;
    });

    $("table.topics-tbl").on("click", ".ibtnDel", function (event) {
        if (confirm("Are you sure to delete?")) {
            var Gbl = $(this);
            var sbID = parseInt(Gbl.parents('tr').find('.actualDel').val());
            if (sbID > 0) {
                $.ajax({
                    type: 'GET',
                    url: '{{url("/topicSetup/deleteTopics")}}/' + sbID,
                    success: function (data) {
                        if (data == 1) {
                            Gbl.closest("tr").remove();
                            counterc -= 1;
                        }
                    }
                });
            } else {
                Gbl.closest("tr").remove();
                counterc -= 1;
            }
        }
    });
    $("table.topics-tbl").on("click", ".ibtnDelNon", function (event) {
        showMessage(2, 'You can\'t delete this item.');
    });

    // Check sub block duplicate or not
    // function subBlockChecking(e){

    //     var allDeptList = $('.deptSubBlock').map(function () {
    //         return this.value;
    //     }).get();

    //     if(e.val()!=''){
    //         var cnt = 0;
    //         $.each(allDeptList, function(index, value){
    //             if(e.val()==value){
    //                 cnt = cnt + 1;
    //             }
    //         });
    //         if(cnt > 1){
    //             alertify.alert('Please select another department');
    //             e.selectedIndex = 0;
    //             e.val('');
    //         }
    //     }

    // }

    // Check topics duplicate or not
    // function topicsChecking(e){

    //     var allTopicsList = $('.deptTopics').map(function () {
    //         return this.value;
    //     }).get();

    //     if(e.val()!=''){
    //         var cnt = 0;
    //         $.each(allTopicsList, function(index, value){
    //             if(e.val()==value){
    //                 cnt = cnt + 1;
    //             }
    //         });
    //         if(cnt > 1){
    //             alertify.alert('Please select another topics');
    //             e.selectedIndex = 0;
    //             e.val('');
    //         }
    //     }

    // }

    // fade message
    function showMessage(type, msg) {
        $('#msg' + type).show();
        $('#msg' + type).html(msg);
        setTimeout(function () {
            $('#msg' + type).fadeOut();
        }, 5000);
    }

    // Check Duplicate Topic
    function checkDuplicate(a) {
        var type = $('#course_type').val();
        var name = $('#course_name').val();
        var phase = $('#phase').val();
        var year = $('#year').val();
        var topic_type = $('#topic_type').val();

        var oType = $('#oType').val();
        var oName = $('#oName').val();
        var oPhase = $('#oPhase').val();
        var oYear = $('#oYear').val();
        var oTopicType = $('#oTopicType').val();


        if (type != '' && name != '' && phase != '' && year != '' && topic_type != '') {

            if (type == oType && name == oName && phase == oPhase && year == oYear && topic_type == oTopicType) {

            } else {
                $.ajax({
                    type: 'GET',
                    url: '{{url("/topicSetup/checkDuplicateTopic")}}/' + type + '/' + name + '/' + phase + '/' +
                        year + '/' + topic_type,
                    success: function (data) {
                        if (data > 0) {
                            alertify.alert(
                                'Already in used. \nPlease select another course, department, phase, year and topic type.'
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
