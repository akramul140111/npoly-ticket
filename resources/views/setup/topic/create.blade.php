@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/storeTopicSetup'); @endphp
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
                <h2 class="width-100p text-align-center">Create Topic Setup</h2>
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
                            <option value="{{$c->LOOKUP_DATA_ID}}">{{$c->LOOKUP_DATA_NAME}}</option>
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
                            @if($departments)
                            @foreach($departments as $d)
                            <option value="{{$d->LOOKUP_DATA_ID}}">{{$d->LOOKUP_DATA_NAME}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-4  label-align">Department*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="course_name" id="course_name"
                            onchange="checkDuplicate($(this))" required>
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
                    <label class="col-form-label col-md-4 col-sm-4  label-align">Phase*</label>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" name="phase" id="phase" onchange="checkDuplicate($(this))"
                            required>
                            <option value="">--select--</option>
                            @if($phases)
                            @foreach($phases as $p)
                            <option value="{{$p->LOOKUP_DATA_ID}}">{{$p->LOOKUP_DATA_NAME}}</option>
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
                            <option value="{{$y->LOOKUP_DATA_ID}}">{{$y->LOOKUP_DATA_NAME}}</option>
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
                            <option value="{{$ttp->LOOKUP_DATA_ID}}">{{$ttp->LOOKUP_DATA_NAME}}</option>
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
                            <option value="1">Active</optin>
                            <option value="0">Inactive</optin>
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
                <div class="col-md-12">
                    <div class="field item form-group">
                        <label class="col-form-label col-md-2 col-sm-2  label-align" style="text-align: left;padding-left: 0;">Block*</label>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-control" name="block_id" id="block_id" required>
                                <option value="">--select--</option>
                            </select>
                        </div>
                    </div>
                </div>
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
                        <tr>
                            <td>
                                <input type="text" class="form-control deptTopics" name="topics[]" id="department_tp"
                                    required>
                                <!-- <select  class="form-control deptTopics" onchange="topicsChecking($(this))" name="topics[]" id="department_tp" required>
                            <option value="">--select--</option>
                            <option value="1">Topics-1</option>
                            <option value="2">Topics-2</option>
                            <option value="3">Topics-3</option>
                            <option value="4">Topics-4</option>
                        </select> -->
                            </td>
                            <td class="text-center">
                                <button class="btn btn-default ibtnDel91" style="color:red" title="Delete" id=""
                                    type="button">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- Submit Button -->
    <div class="col-md-12 text-align-center">
        <button action="{{$actionUrl}}" type="submit" id='saveBtn' class="btn btn-primary">Submit</button>
        <button type='reset' class="btn btn-success">Reset</button>
    </div>
</form>
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
        cols +=
            '<td><input type="text" class="form-control deptTopics" name="topics[]" id="department_tp" required></td>';
        cols +=
            '<td class="text-center"><button class="btn btn-default ibtnDel" style="color:red" title="Delete" id="" type="button"><i  class="glyphicon glyphicon-remove"></i></button></td>';
        cols += '</tr>';
        newRow.append(cols);
        $("table.topics-tbl").append(newRow);
        counterc++;
    });

    $("table.topics-tbl").on("click", ".ibtnDel", function (event) {
        if (confirm("Are you sure to delete?")) {
            $(this).closest("tr").remove();
            counterc -= 1
        }
    });

    $("table.topics-tbl").on("click", ".ibtnDel91", function (event) {
        showMessage(2, 'You can\'t delete this item.');
    });

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

        if (type != '' && name != '' && phase != '' && year != '' && topic_type != '') {
            $.ajax({
                type: 'GET',
                url: '{{url("/topicSetup/checkDuplicateTopic")}}/' + type + '/' + name + '/' + phase + '/' +
                    year + '/' + topic_type,
                success: function (data) {
                    if (data > 0) {
                        alertify.alert(
                            'Already in used. \nPlease select another course, department, phase, year and topic type.');
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
        $('#block_id').html('<option value="">--select--</option>');
        var CTV = CT.val();
        if(CTV!=''){
            $.ajax({type: 'GET', url: '{{url("/block/getDept")}}/'+CTV, success: function (data) {D.html(data);}});
        }
    });

    D.change(function(){
        CN.html('<option value="">--select--</option>');
        $('#block_id').html('<option value="">--select--</option>');
        var DV = D.val();
        if(DV!=''){
            $.ajax({type: 'GET', url: '{{url("/block/getCourse")}}/'+DV, success: function (data) {CN.html(data);}});
        }
    });

    // Get block list
    $('#course_name').change(function(){
        var c_type = $('#course_type').val();
        var dept = $('#department').val();
        var c_name = $('#course_name').val();
        $('#block_id').html('<option value="">--select--</option>');
        if(c_type!='' && dept!='' && c_name!=''){
            // get block list
            $.ajax({
                type: 'GET',
                url: '{{url("/block/getBlockList")}}/'+c_type+'/'+dept+'/'+c_name,
                success: function (data) {
                    $('#block_id').html(data);
                }
            });
        }
    });

    $('#block_id').change(function(){
        var course_type = $('#course_type').val();
        var department = $('#department').val();
        var course_name = $('#course_name').val();
        if(course_type=='' || department=='' || course_name==''){
            alertify.alert('Please select course, faculty & department.');
            $('#block_id').val('');
            return false;
        }
    });

</script>
