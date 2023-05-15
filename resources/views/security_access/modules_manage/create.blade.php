@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/storeBlock'); @endphp
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<style>
  .custom-head{background-color: #F2F2F2}
</style>
<link rel="stylesheet" href="{{URL::asset('assets/custom_css/block_create.css')}}">
<div class="flash-message"></div>
<form id="BlockForm" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left" enctype="multipart/form-data" autocomplete="off">
@csrf
<div class="col-md-12 col-sm-12 col-lg-5">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="width-100p text-align-center">Create Block</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <!-- BLOCK DATA -->
            <div class="field item form-group">
                <label class="col-form-label col-md-4 col-sm-4  label-align">Course*</label>
                <div class="col-md-8 col-sm-8">
                    <select class="form-control" name="course_type" id="sesDropdown" required>
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
                <label class="col-form-label col-md-4 col-sm-4  label-align">Department*</label>
                <div class="col-md-8 col-sm-8">
                    <select class="form-control" name="course_name" required>
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
                <label class="col-form-label col-md-4 col-sm-4  label-align">Faculty*</label>
                <div class="col-md-8 col-sm-8">
                    <select class="form-control" name="department" required>
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
                <label class="col-form-label col-md-4 col-sm-4  label-align">Phase*</label>
                <div class="col-md-8 col-sm-8">
                    <select class="form-control" name="phase" required>
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
                <label class="col-form-label col-md-4 col-sm-4  label-align">Block Name*</label>
                <div class="col-md-8 col-sm-8">
                    <select class="form-control" name="block_name" required>
                        <option value="">--select--</option>
                        <option value="1">Block 1</option>
                        <option value="2">Block 2</option>
                        <option value="3">Block 3</option>
                        <option value="4">Block 4</option>
                        <option value="5">Block 5</option>
                        <option value="6">Block 6</option>
                    </select>
                </div>
            </div>                    
            <div class="field item form-group">
                <label class="col-form-label col-md-4 col-sm-4  label-align">Placement*</label>
                <div class="col-md-8 col-sm-8">
                    <select class="form-control" name="placement" required>
                        <option value="">--select--</option> 
                        
                        @if($placements)
                            @foreach($placements as $pl)
                                <option value="{{$pl->LOOKUP_DATA_ID}}">{{$pl->LOOKUP_DATA_NAME}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-4 col-sm-4  label-align">Duration*</label>
                <div class="col-md-4 col-sm-4">                
                    <input type="text" class="date-picker form-control" name="duration_from" id="duration_from" placeholder="dd/mm/yyyy" onclick="this.type='date'" required/>
                </div>
                <div class="col-md-4 col-sm-4">
                    <input type="text" class="date-picker form-control" name="duration_to" id="duration_to" placeholder="dd/mm/yyyy" onclick="this.type='date'" required/>
                </div>
            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-4 col-sm-4  label-align">Active Status <span class="required  input-field-required-sign">*</span></label>
                <div class="col-md-8 col-sm-8">
                <select  class="form-control" name="active_status">
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
            <h2 class="width-100p text-align-center">Sub Block</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <!-- SUB BLOCK DATA -->
            
            <table class="table  table-borderd sub-block-tbl custom-table-border">
            <thead>
                <tr>
                    <th>Faculty</th>
                    <th>From</th>
                    <th>To</th>
                    <th class="text-center">
                        <button class="btn btn-default btn-sm" style="color:black" title="Delete" id="addSubBlockRow" type="button"><i  class="glyphicon glyphicon-plus"></i></button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select class="form-control deptSubBlock" onchange="subBlockChecking($(this))" name="department_sub_block[]" required>
                            <option value="">--select--</option>
                            @if($departments)
                                @foreach($departments as $dp)
                                    <option value="{{$dp->LOOKUP_DATA_ID}}">{{$dp->LOOKUP_DATA_NAME}}</option>
                                @endforeach
                            @endif
                        </select>
                    </td>
                    <td>
                        <input type="text" class="date-picker form-control" name="duration_from_sub_block[]" placeholder="dd/mm/yyyy" onclick="this.type='date'" required/>
                    </td>
                    <td>
                        <input type="text" class="date-picker form-control" name="duration_to_sub_block[]" placeholder="dd/mm/yyyy"  onclick="this.type='date'" required/>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-default ibtnDel90" style="color:red" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button>
                    </td>
                </tr>
            </tbody>
            </table>
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
            
            <table class="table  table-borderd topics-tbl custom-table-border">
                <thead>
                <tr>
                    <th style=width:90%>Topics</th>
                    <th class="text-center">
                        <button class="btn btn-default btn-sm" style="color:black" title="Delete" id="addTopicsRow" type="button"><i  class="glyphicon glyphicon-plus"></i></button>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <select  class="form-control deptTopics" onchange="topicsChecking($(this))" name="topics[]" id="department_tp" required>
                            <option value="">--select--</option>
                            <option value="1">Topics-1</option>
                            <option value="2">Topics-2</option>
                        </select>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-default ibtnDel91" style="color:red" title="Delete" id="" type="button">
                            <i  class="glyphicon glyphicon-remove"></i> 
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
        <button action="{{$actionUrl}}"  type="submit" id='saveBtn' class="btn btn-primary">Submit</button>
        <button type='reset' class="btn btn-success">Reset</button>
</div>
</form>
<script>

    // Sub Block Tbl
    var counter = 0;
    $("#addSubBlockRow").on("click", function () {

        /*var department_sb_text = $("#department_sub_block option:selected").text();
        var department_sb = $("#department_sub_block").val();
        var from_date_sb = $("#duration_from_sub_block").val();
        var to_date_sb = $("#duration_to_sub_block").val();*/

        /*if(department_sb=='' || from_date_sb=='' || to_date_sb==''){
            return false;
        }*/

        var newRow = $("<tr>");
        var cols = "";
        cols += '<td><select class="form-control deptSubBlock" onchange="subBlockChecking($(this))" name="department_sub_block[]" required>';
        cols += '<option value="">--select--</option>';
        @if($departments)
            @foreach($departments as $dp)
            cols += '<option value="{{$dp->LOOKUP_DATA_ID}}">{{$dp->LOOKUP_DATA_NAME}}</option>';
            @endforeach
        @endif
        cols += '</select></td>';
        cols += '<td><input type="text" class="date-picker form-control" name="duration_from_sub_block[]" placeholder="dd/mm/yyyy" onclick="this.type=\'date\'" required/></td>';
        cols += '<td><input type="text" class="date-picker form-control" name="duration_to_sub_block[]" placeholder="dd/mm/yyyy"  onclick="this.type=\'date\'" required/></td>';
        cols += '<td class="text-center"><button class="btn btn-default ibtnDel" style="color:red" title="Delete" type="button"><i  class="glyphicon glyphicon-remove"></i></button></td>';
        cols += '</tr>';        
        newRow.append(cols);
        $("table.sub-block-tbl").append(newRow);

        /*$("#department_sub_block").selectedIndex = 0;
        $("#department_sub_block").val('');
        $("#duration_from_sub_block").val('');
        $("#duration_to_sub_block").val('');*/
        counter++;
    });

    $("table.sub-block-tbl").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        counter -= 1
    });
    
    // Topics Tbl
    var counterc = 0;
    $("#addTopicsRow").on("click", function () {

        var department_tp_text = $("#department_tp option:selected").text();
        var department_tp = $("#department_tp").val();

        /*if(department_tp==''){
            return false;
        }*/

        var newRow = $("<tr>");
        var cols = "";
        cols += '<td><select  class="form-control deptTopics" onchange="topicsChecking($(this))" name="topics[]" id="department_tp" required>';
        cols += '<option value="">--select--</option>';
        cols += '<option value="1">Topics-1</option>';
        cols += '<option value="2">Topics-2</option>';
        cols += '</select></td>';
        cols += '<td class="text-center"><button class="btn btn-default ibtnDel" style="color:red" title="Delete" id="" type="button"><i  class="glyphicon glyphicon-remove"></i></button></td>';
        cols += '</tr>';
        newRow.append(cols);
        $("table.topics-tbl").append(newRow);

        /*$("#department_tp").selectedIndex = 0;
        $("#department_tp").val('');*/
        counterc++;
    });

    $("table.topics-tbl").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        counterc -= 1
    });

    
    // Check sub block duplicate or not
    function subBlockChecking(e){

        var allDeptList = $('.deptSubBlock').map(function () {
            return this.value;
        }).get();

        if(e.val()!=''){
            var cnt = 0;
            $.each(allDeptList, function(index, value){
                if(e.val()==value){
                    cnt = cnt + 1;
                }
            });
            if(cnt > 1){
                alertify.alert('Please select another department');
                e.selectedIndex = 0;
                e.val('');
            }
        }

    }

    
    // Check topics duplicate or not
    function topicsChecking(e){

        var allTopicsList = $('.deptTopics').map(function () {
            return this.value;
        }).get();

        if(e.val()!=''){
            var cnt = 0;
            $.each(allTopicsList, function(index, value){
                if(e.val()==value){
                    cnt = cnt + 1;
                }
            });
            if(cnt > 1){
                alertify.alert('Please select another topics');
                e.selectedIndex = 0;
                e.val('');
            }
        }

    }
</script>