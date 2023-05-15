@extends('layouts.master')
@section('content')
@section('title')
@endsection

<style>
    ul li.active,
    a.active {
        color: #3fbbc0;
    }

</style>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 26px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: -10px !important;
        bottom: 1px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>

<div class="" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{$header['pageTitle']}}</h3>
            </div>
            <!-- <div class="title_right">
                <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                        <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Add New Group"
                            pageLink="{{URL::route('createGroup')}}" data-toggle="tooltip" data-placement="left"
                            title="Add New Group" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add
                            New</button>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-9 col-sm-12 col-lg-9">

                <div class="x_panel">
                    <div class="field item form-group">

                        <div class="col-md-4 col-sm-4">
                            <select class="form-control" name="group_name" id="groupName" required>
                                <option>--select group--</option>
                                @foreach($userGroups as $key => $userGroup)
                                <option value="{{$userGroup->USERGRP_ID}}">{{$userGroup->USERGRP_NAME }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" col-md-4 col-sm-4">
                            <select class="form-control" name="user_level" id="userLevel" required>
                                <option active>--select level--</option>

                            </select>
                        </div>
                    </div>
                    <div class="x_title">
                        <h2> </h2>
                        <!-- <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"></a>
                            </li>
                        </ul> -->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id=""></div>
                        <!-- start accordion -->
                        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Modules </th>
                                            <th> Create</th>
                                            <th> Read</th>
                                            <th> Update</th>
                                            <th> Delete</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showPreviousLink">
                                        @foreach($modules as $module)
                                        <div class="panel">
                                            <tr>
                                                <td colspan="6">
                                                   
                                                    <a class="panel-heading" role="tab" id="headingOne"
                                                        data-toggle="collapse" data-parent="#accordion"
                                                        href="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                        {{$module->MODULE_NAME}}
                                                    </a>
                                                </td>
                                            </tr>
                                            @php
                                            $moduleLinks = DB::table('sa_org_mlinks')
                                            ->leftJoin('sa_uglw_mlink','sa_uglw_mlink.SA_MLINKS_ID','=','sa_org_mlinks.SA_MLINKS_ID')
                                            ->where('sa_org_mlinks.SA_MODULE_ID','=', $module->MODULE_ID)
                                            ->where('sa_org_mlinks.ACTIVE_STATUS',1)
                                            ->select('sa_uglw_mlink.SA_UGLWM_LINK','sa_uglw_mlink.CREATE','sa_uglw_mlink.UPDATE','sa_uglw_mlink.READ','sa_uglw_mlink.DELETE','sa_uglw_mlink.STATUS','sa_org_mlinks.SA_MLINK_NAME','sa_org_mlinks.SA_MLINKS_ID','sa_org_mlinks.LINK_ID')
                                            ->get();
                                            @endphp
                                            @foreach($moduleLinks as $moduleLink)

                                            <tr id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                                aria-labelledby="headingOne" data-parent="#accordion">
                                                <td class="text-right"> {{$moduleLink->SA_MLINK_NAME}} </td>
                                                <td>
                                                    <label class="switch">
                                                        <input class="switchCreate" name="status" id="CREATE"
                                                            value="{{$moduleLink->CREATE}}" @if($moduleLink->CREATE==1)
                                                        checked @endif type="checkbox" />
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input class="switchRead" name="status" id="READ"
                                                            value="{{$moduleLink->READ}}" @if($moduleLink->READ==1)
                                                        checked @endif type="checkbox" />
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input class="switchUpdate" id="UPDATE"
                                                            value="{{$moduleLink->UPDATE}}" @if($moduleLink->UPDATE==1)
                                                        checked @endif type="checkbox" />
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input class="switchDelete" id="DELETE"
                                                            value="{{$moduleLink->DELETE}}" @if($moduleLink->DELETE==1)
                                                        checked @endif type="checkbox" />
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                
                                                <input type="hidden" value="{{$moduleLink->SA_UGLWM_LINK}}" class="SA_UGLWM_LINK">
                                                <input type="hidden" value="{{$module->MODULE_ID}}" class="MODULE_ID">
                                                <input type="hidden" class="SA_MLINKS"
                                                        value="{{$moduleLink->SA_MLINKS_ID}}" />
                                                <input type="hidden" value="{{$moduleLink->LINK_ID}}" class="LINK_ID_A">                                                 
                                                  
                                                    <label class="switch">
                                                        <input class="switchStatus" id="STATUS"
                                                            value="{{$moduleLink->STATUS}}" @if($moduleLink->STATUS==1)
                                                        checked @endif type="checkbox" />
                                                        <!-- <input type="checkbox" checked> -->
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4><strong> Users </strong></h4>
                    </div>
                    <ul class="list-group" name="name" Id='userName'>

                    </ul>
                    <ul class="list-group" name="name" Id='userGroupName'>

                    </ul>

                </div>

            </div>
        </div>
    </div>
</div>
<script>    

$(document).off("change", "#CREATE").on("change", "#CREATE", function () {
        //alertify.alert('dd')
        var thisRowU = $(this).closest('tr');
        var SA_MLINKSID = thisRowU.find('.SA_MLINKS').val()        
        var LINK_ID = thisRowU.find('.LINK_ID_A').val()        
        var setCreate = thisRowU.find('#CREATE').val();
        var MODULE_ID = thisRowU.find('.MODULE_ID').val();
        var SA_UGLWM_LINK = thisRowU.find('.SA_UGLWM_LINK').val();
        $.ajax({
            type: "POST",
            url: "modulePageLinkCreate",
            data: {
                "_token": "{{ csrf_token()}}",
                "setCreate": setCreate,
                "LINK_ID": LINK_ID,
                "SA_MLINKSID" : SA_MLINKSID,
                "MODULE_ID" : MODULE_ID,
                "SA_UGLWM_LINK" : SA_UGLWM_LINK
            },
            success: function (result) {
                //alertify.alert(result);
            }
        });
    });

    
$(document).off("change", "#DELETE").on("change", "#DELETE", function () {
        //alertify.alert('dd')
        var thisRowU = $(this).closest('tr');
        var SA_MLINKSID = thisRowU.find('.SA_MLINKS').val()        
        var LINK_ID = thisRowU.find('.LINK_ID_A').val()        
        var setCreate = thisRowU.find('#DELETE').val();
        var MODULE_ID = thisRowU.find('.MODULE_ID').val();
        var SA_UGLWM_LINK = thisRowU.find('.SA_UGLWM_LINK').val();
        $.ajax({
            type: "POST",
            url: "modulePageLinkDelete",
            data: {
                "_token": "{{ csrf_token()}}",
                "setCreate": setCreate,
                "LINK_ID": LINK_ID,
                "SA_MLINKSID" : SA_MLINKSID,
                "MODULE_ID" : MODULE_ID,
                "SA_UGLWM_LINK" : SA_UGLWM_LINK
            },
            success: function (result) {
                //alertify.alert(result);
            }
        });
    });

    $(document).off("change", "#READ").on("change", "#READ", function () {
        //alertify.alert('dd')
        var thisRowU = $(this).closest('tr');
        var SA_MLINKS_ID = thisRowU.find('.SA_MLINKS').val()
        var setRead = thisRowU.find('#READ').val();
        $.ajax({
            type: "POST",
            url: "changePageLinkRead",
            data: {
                "_token": "{{ csrf_token()}}",
                "setRead": setRead,
                "SA_MLINKS_ID": SA_MLINKS_ID
            },
            success: function (result) {
                //alertify.alert(result);
            }
        });

    });

 


    $(document).off("change", "#UPDATE").on("change", "#UPDATE", function () {
        //alertify.alert('dd')
        var thisRowU = $(this).closest('tr');
        var SA_MLINKS_ID = thisRowU.find('.SA_MLINKS').val()
        var setUpdate = thisRowU.find('#UPDATE').val();
        $.ajax({
            type: "POST",
            url: "updatePageLink",
            data: {
                "_token": "{{ csrf_token()}}",
                "setUpdate": setUpdate,
                "SA_MLINKS_ID": SA_MLINKS_ID
            },
            success: function (result) {
                //alertify.alert(result);
            }
        });

    });

    $(document).off("change", ".switchStatus").on("change", ".switchStatus", function () {
        var thisRow = $(this).closest('tr');
        var SA_MLINKS_ID = thisRow.find('.SA_MLINKS').val()
        var setVaue = thisRow.find('.switchStatus').val()
        $.ajax({
            type: "POST",
            url: "changePageLinkStatus",
            data: {
                "_token": "{{ csrf_token()}}",
                "setVaue": setVaue,
                "SA_MLINKS_ID": SA_MLINKS_ID
            },
            success: function (result) {
                if (result == 'Success') {
                    return;
                } else {
                    return;
                }
            }
        });

    });



    //change status switch 1 or 0
    $(document).off("click", ".switchStatus").on("click", ".switchStatus", function () {
        $('input[type=checkbox][class=switchStatus]').change(function () {

            if ($(this).is(':checked')) {
                $('input[type=checkbox][class=switchStatus]').val(1);
            } else {
                $('input[type=checkbox][class=switchStatus]').val(0);

            }
        })
    });

    //change delete switch 1 or 0
    $(document).off("click", ".switchDelete").on("click", ".switchDelete", function () {
        $('input[type=checkbox][class=switchDelete]').change(function () {

            if ($(this).is(':checked')) {
                $('input[type=checkbox][class=switchDelete]').val(1);
            } else {
                $('input[type=checkbox][class=switchDelete]').val(0);

            }
        })
    });

    //change update switch 1 or 0
    $(document).off("click", ".switchUpdate").on("click", ".switchUpdate", function () {
        $('input[type=checkbox][class=switchUpdate]').change(function () {

            if ($(this).is(':checked')) {
                $('input[type=checkbox][class=switchUpdate]').val(1);
            } else {
                $('input[type=checkbox][class=switchUpdate]').val(0);

            }
        })
    });

    //change read switch 1 or 0
    $(document).off("click", ".switchRead").on("click", ".switchRead", function () {
        $('input[type=checkbox][class=switchRead]').change(function () {

            if ($(this).is(':checked')) {
                $('input[type=checkbox][class=switchRead]').val(1);
            } else {
                $('input[type=checkbox][class=switchRead]').val(0);

            }
        })
    });

    //change create switch 1 or 0
    $(document).off("click", ".switchCreate").on("click", ".switchCreate", function () {
        $('input[type=checkbox][class=switchCreate]').change(function () {

            if ($(this).is(':checked')) {
                $('input[type=checkbox][class=switchCreate]').val(1);
            } else {
                $('input[type=checkbox][class=switchCreate]').val(0);

            }
        })
    });
    E

</script>



<script type="text/javascript">
    $(document).ready(function () {
        $('#groupName').on('change', function (e) {
            var group_name = e.target.value;

            $.ajax({
                url: "{{route('userGroupLevel')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    group_name: group_name
                },

                success: function (data) {

                    $('#userLevel').empty();
                    $.each(data.groupLevels, function (index, userLevel) {
                        $('#userLevel').append('<option  value="' + userLevel
                            .UG_LEVEL_ID + '">' + userLevel.UGLEVE_NAME +
                            '</option>');
                    })

                }

            })
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#userLevel').on('change', function (e) {
            var user_level = e.target.value;

            $.ajax({
                url: "{{route('assingLinkUserLevel')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    user_level: user_level
                },

                success: function (data) {


                    $('#userName').empty();
                    $.each(data.userLevels, function (index, userName) {
                        $('#userName').append(
                            '<li class="list-group-item" value="' + userName
                            .id + '">' + userName.name +
                            '</li>');
                    })

                    $('#showPreviousLink').text('dddddddddddddddd');

                }

            })
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#groupName').on('change', function (e) {
            var group_name = e.target.value;

            $.ajax({
                url: "{{route('assingLinkUsergroup')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    group_name: group_name
                },

                success: function (data) {

                    console.log(data);
                    $('#userGroupName').empty();
                    $.each(data.userGroups, function (index, userGroupName) {
                        $('#userGroupName').append(
                            '<li class="list-group-item" value="' +
                            userGroupName
                            .id + '">' + userGroupName.name +
                            '</li>');
                    })

                }

            })
        });
    });

</script>

@endsection
