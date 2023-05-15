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
                                <option value="">--select level--</option>

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
                        <!-- start accordion -->
                        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel-body">
                                <table class="table table-bordered" id="showPreviousLink">
                                    
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
    $(document).off("change", "#DELETE").on("change", "#DELETE", function () {
        //alertify.alert('dd')
        var thisRowU = $(this).closest('tr');
        var SA_MLINKS_ID = thisRowU.find('.SA_MLINKS').val()
        var setDelete = thisRowU.find('#DELETE').val();
        $.ajax({
            type: "POST",
            url: "changePageLinkDelete",
            data: {
                "_token": "{{ csrf_token()}}",
                "setDelete": setDelete,
                "SA_MLINKS_ID": SA_MLINKS_ID
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

    $(document).off("change", "#CREATE").on("change", "#CREATE", function () {
        //alertify.alert('dd')
        var thisRowU = $(this).closest('tr');
        var SA_MLINKS_ID = thisRowU.find('.SA_MLINKS').val()
        var setCreate = thisRowU.find('#CREATE').val();
        $.ajax({
            type: "POST",
            url: "changePageLinkCreate",
            data: {
                "_token": "{{ csrf_token()}}",
                "setCreate": setCreate,
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
                   
                    html = "";
                   // $('#userLevel').empty();
            html += '<select><option>--select--</option>';
            html += '</select>';
           // $('#userLevel').empty();
            $.each(data.groupLevels, function (index, userLevel) {
                html += '<option  value="' + userLevel
                            .UG_LEVEL_ID + '">' + userLevel.UGLEVE_NAME +
                            '</option>';
            });           
           // $('#userLevel').empty();
           $('#userLevel').trigger("change");         
            $('#userLevel').append(html);         

            // $('#userLevel').empty();
            //         $.each(data.groupLevels, function (index, userLevel) {
            //             $('#userLevel').append('<option  value="' + userLevel
            //                 .UG_LEVEL_ID + '">' + userLevel.UGLEVE_NAME +
            //                 '</option>');
            //         })





                }

            })
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#userLevel').on('change', function (e) {
            var user_level = e.target.value;
            var userLevel = $('#userLevel').val();
            var groupName = $('#groupName').val();
           // alertify.alert(groupName)
           // alertify.alert(userLevel)
            

            $.ajax({
                url: "{{route('assingLinkUserLevel')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "userLevel":userLevel,
                    "groupName":groupName
                },

                success: function (data) {


                    // $('#userName').empty();
                    // $.each(data.userLevels, function (index, userName) {
                    //     $('#userName').append(
                    //         '<li class="list-group-item" value="' + userName
                    //         .id + '">' + userName.name +
                    //         '</li>');
                    // })

                    $('#showPreviousLink').html(data);

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
