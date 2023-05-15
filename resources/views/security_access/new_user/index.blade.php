@extends('layouts.master') @section('content') @section('title') @endsection
<style>
    ul li.active,
    a.active {
        color: #3fbbc0;
    }

</style>
<div class="" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{$header['pageTitle']}}</h3>
            </div>
            <div class="title_right">
                <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                        <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Create New User"
                            pageLink="{{url('/createUser')}}" data-modal-size="modal-xl" data-toggle="tooltip"
                            data-placement="top" title="Create User">
                            Create User
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="x_panel">
                    <div class="x_title">
                        {{-- <h2>{{$header['tableTitle']}} </h2> --}}

                        {{-- filtering start --}}

                       <!-- <div class="row" style="padding-top:15px">
                            <div class="col-sm-12">
                                <div class="col-md-3">
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Course*</label>
                                        <div class="col-md-9 col-sm-9">
                                            <select  class="form-control searchCourseType required" id="searchCourseType">
                                                <option value="">---Select---</option>
                                                @foreach($courseTypes as $c)
                                                    <option value="{{$c->LOOKUP_DATA_ID}}">{{$c->LOOKUP_DATA_NAME}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Faculty</label>
                                        <div class="col-md-9 col-sm-9">
                                            <select  class="form-control searchDept required" id="searchDept">
                                                <option value="">---Select---</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align">Dept</label>
                                        <div class="col-md-9 col-sm-9">
                                            <select  class="form-control searchCourse required" id="searchCourse">
                                            <option value="">---Select---</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="field item form-group">
                                        <div style="display: block; color:#FFF">
                                            <a id="btnSearch" class="form-control btn btn-info">Search</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        {{-- filtering end --}}


                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="searchResultUser">
                        {{-- <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable"
                                        class="table table-striped table-bordered custom-table-border dataTable no-footer"
                                        role="grid" aria-describedby="datatable_info">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th class="center">Name</th>
                                                <th class="center">User name</th>
                                                <th class="center">Course</th>
                                                <th class="center">Faculty</th>
                                                <th class="center">Department</th>
                                                <th class="center">Email</th>
                                                <th class="center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sl=1@endphp @foreach($users as $user)
                                            <tr>
                                                <td>{{$sl}}</td>
                                                <td>{{$user->name}}</td>
                                                <td style="color:blue">{{$user->email}}</td>
                                                <td>{{$user->course_type}}</td>
                                                <td>{{$user->department}}</td>
                                                <td>{{$user->course_name}}</td>
                                                <td>{{$user->email_address}}</td>
                                                <td>
                                                    @if($user->active_status == 1)
                                                    <label>
                                                        <span type="" class="btn btn-primary btn-sm">Active</span>
                                                    </label>
                                                    @else
                                                    <label>
                                                        <span type="" class="btn btn-primary btn-sm">Inactive</span>
                                                    </label>

                                                    @endif
                                                </td>
                                            </tr>
                                            @php $sl++;@endphp @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).on('click', '#multiselect_rightSelected', function () {
        if (confirm("Are You Sure?")) {
            var module_ids = $('#multiselectModule').val();
            // alertify.alert(module_ids)
            $.ajax({
                type: "POST",
                url: "/addModules",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "module_ids": module_ids
                },
                success: function (data) {
                    //    $("#multi-select-add-single-ids").html("");
                    //  $("#selectable-target").html(data);

                }

            });
        } else {
            return false;
        }
    });


    $(document).on('click', '#multiselect_leftSelected', function () {
        if (confirm("Are You Sure?")) {
            var module_ids_delete = $('#multiselecSelectedtModule').val();
            // alertify.alert(module_ids)
            $.ajax({
                type: "POST",
                url: "/deleteModules",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "module_ids_delete": module_ids_delete
                },
                success: function (data) {
                    //    $("#multi-select-add-single-ids").html("");
                    //  $("#selectable-target").html(data);

                }

            });
        } else {
            return false;
        }
    });

    // user searching clone from block list page

    // $(document).on('change', '#searchCourse444', function () {
    //     var type = $('#searchCourseType').val();
    //     var dept = $('#searchDept').val();
    //     var course = $('#searchCourse').val();

    //     if(type=='' || dept=='' || course==''){
    //         alertify.alert('Please, select all the fields.');
    //         return false;
    //     }else{
    //         getUser(type,dept,course);
    //     }
    // });
    // getUser(type='',dept='',course='');

    // search on user list
    $('#btnSearch').click(function(){
        var type = $('#searchCourseType').val();    // as course
        var dept = $('#searchDept').val();          // as faculty
        var course = $('#searchCourse').val();      // as dept

        if(type==''){
            alertify.alert('Please select course');
            return false;
        }else{
            getUser(type,dept,course);
        }
    });

    getUser(type='',dept='',course='');

    // get user list, with search or without search
    function getUser(type='',dept='',course=''){

        if(type=='') type=0;
        if(dept=='') dept=0;
        if(course=='') course=0;

        $('.ajaxLoaderFormLoad').show();
        $.ajax({
            type: 'GET',
            url: '{{url("/searchUser")}}/'+type+'/'+dept+'/'+course,
            success: function (data) {
                $('.ajaxLoaderFormLoad').hide();
                $('#searchResultUser').html(data);
                $('#datatable').dataTable();
            }
        });
    }


    // get faculty, department by course
    var CT = $('#searchCourseType');
    var D = $('#searchDept');
    var CN = $('#searchCourse');
    D.html('<option value="">--select--</option>');
    CN.html('<option value="">--select--</option>');
    CT.change(function(){
        //$('#searchResultUser').html('');
        D.html('<option value="">--select--</option>');
        CN.html('<option value="">--select--</option>');
        var CTV = CT.val();
        if(CTV!=''){
            $.ajax({type: 'GET', url: '{{url("/block/getDept")}}/'+CTV, success: function (data) {D.html(data);}});
        }
    });

    // get department by faculty
    var D = $('#searchDept');
    var CN = $('#searchCourse');
    CN.html('<option value="">--select--</option>')
    D.change(function(){
        //$('#searchResultUser').html('');
        CN.html('<option value="">--select--</option>');
        var DV = D.val();
        if(DV!=''){
            $.ajax({type: 'GET', url: '{{url("/block/getCourse")}}/'+DV, success: function (data) {CN.html(data);}});
        }
    });

</script>



@endsection
