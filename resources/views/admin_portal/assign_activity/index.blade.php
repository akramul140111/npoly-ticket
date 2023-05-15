@extends('layouts.master')
@section('content')
@section('title')
@endsection
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/storeAssignActivity'); @endphp
<style>
    ul li.active, a.active {
        color: #3fbbc0;
    }
    .checkbox-group{
        margin-top: 20px;
        background-color: #cdedfc;
    }
    .checkbox-style{
        margin-bottom: 10px;
    }
    .button-style{
        margin-top: 10px;
    }
</style>
<link rel="stylesheet" href="{{URL::asset('assets/custom_css/block_index_academic_officer.css')}}">
<div class="" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{$header['pageTitle']}}</h3>
            </div>
            <div class="title_right">
                <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                        <button type="button" class="btn btn-sm btn-primary dynamicModal" pageTitle="Create New Activity/Event" pageLink="{{URL::route('createActivityEvent')}}" data-toggle="tooltip" data-placement="left" title="Add New Activity/Event" data-target=".bs-example-modal-lg" data-modal-size="modal-lg">Add New</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$header['tableTitle']}} </h2>

                        <div class="clearfix"></div>
                    </div>
                    <style>
                        .dt-buttons{

                        }
                    </style>
                    <div class="x_content">
                        <form id="" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-md-4">
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Course* </label>
                                            <div class="col-md-9 col-sm-9">
                                                <select  class="form-control courseType required" id="courseType">
                                                    <option value="">---Select---</option>
                                                    @foreach($courseTypes as $c)
                                                        <option value="{{$c->LOOKUP_DATA_ID}}">{{$c->LOOKUP_DATA_NAME}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-4 col-sm-4  label-align">Faculty* </label>
                                            <div class="col-md-8 col-sm-8">
                                                <select  class="form-control dept required" id="department">
                                                    <option value="">---Select---</option>
                                                    @foreach($departments as $dept)
                                                        <option value="{{$dept->LOOKUP_DATA_ID}}">{{$dept->LOOKUP_DATA_NAME}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Department* </label>
                                            <div class="col-md-9 col-sm-9">
                                                <select  class="form-control course required" id="courseName">
                                                <option value="">---Select---</option>
                                                    @foreach($courseNames as $crsName)
                                                        <option value="{{$crsName->LOOKUP_DATA_ID}}">{{$crsName->LOOKUP_DATA_NAME}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-12 checkbox-group">
                                        @foreach($activityInof as $activity)
                                        <div class="form-check checkbox-style get-assign-info">
                                            <input class="form-check-input" type="checkbox" value="{{$activity->activity_id}}">
                                            <label class="form-check-label">
                                               {{$activity->activity_name}}
                                            </label>
                                        </div>
                                        @endforeach
                               </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-md-12 text-align-center button-info button-style">
                                <button type="submit" id='saveBtn' class="btn btn-primary">Submit</button>
                                <button type='reset' class="btn btn-success">Reset</button>
                            </div>
                        </form>
                    </div>
                    <div class="get-assign-info">
                    </div>
            </div>
        </div>
    </div>
</div>



<script>
    var url = window.location;
    const allLinks = document.querySelectorAll('.nav-item a');
    const currentLink = [...allLinks].filter(e => {
        return e.href == url;
    });

    currentLink[0].classList.add("active")
    currentLink[0].closest(".nav-treeview").style.display="block";
</script>

<script type="text/javascript">

    $(document).on('change', '.course', function () {
        var type = $('.courseType').val();
        var dept = $('.dept').val();
        var course = $('.course').val();
        var _token = "{{ csrf_token() }}";

        var postUrl = '{{url("/get-assign-activity")}}';

        $('.ajaxLoaderFormLoad').show();
        $.ajax({
            type: "POST",
            url: postUrl,
            data: {_token: _token, type:type,dept:dept,course:course},
            //data: {data : jsonString},
            beforeSend: function () {
            },
            success: function (data) {
                $('.ajaxLoaderFormLoad').hide();
                $('.checkbox-group').hide();
                $('.button-info').hide();
                $('.get-assign-info').html(data);
            }
        });
    });

    // get faculty, department by course
    var CT = $('#courseType');
    var D = $('#department');
    var CN = $('#courseName');
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

    // get department by faculty
    var D = $('#department');
    var CN = $('#courseName');
    CN.html('<option value="">--select--</option>');
    D.change(function(){
        CN.html('<option value="">--select--</option>');
        var DV = D.val();
        if(DV!=''){
            $.ajax({type: 'GET', url: '{{url("/block/getCourse")}}/'+DV, success: function (data) {CN.html(data);}});
        }
    });
</script>

@endsection




