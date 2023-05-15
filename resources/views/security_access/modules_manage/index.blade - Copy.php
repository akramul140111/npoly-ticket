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
           
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$header['tableTitle']}} </h2>
                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th class="center">Logo</th>
                                                <th class="center">Organization</th>
                                                <th class="center">Status</th>
                                                <th class="center">Group</th>
                                                <th class="center">User</th>
                                                <th class="center">Pages</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sl=1@endphp @foreach($organizations as $organization)
                                            <tr>
                                                <td>{{$sl}}</td>
                                                <td>{{$organization->ORG_NAME}}</td>
                                                <td>{{$organization->ORG_NAME}}</td>
                                                <td>{{$organization->ORG_NAME}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm dynamicModal"
                                                        pageTitle="Crate Group" pageLink="{{url('/createGroup')}}"
                                                        data-modal-size="modal-xl" data-toggle="tooltip"
                                                        data-placement="top" title="Create Group">
                                                        Create Group
                                                        </i>
                                                    </button>

                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm dynamicModal"
                                                        pageTitle="Create New User" pageLink="{{url('/createUser')}}"
                                                        data-modal-size="modal-xl" data-toggle="tooltip"
                                                        data-placement="top" title="Create User">
                                                        Create User
                                                    </button>
                                                </td>
                                                <!-- <td>
                                                    <button type="button" class="btn btn-primary btn-sm dynamicModal"
                                                        pageTitle="Module Manage"
                                                        pageLink="{{url('/assignModul')}}"
                                                        data-toggle="modal" data-modal-size="modal-xl"
                                                        data-placement="top" title="Assign Module">
                                                        Assign Model
                                                    </button>
                                                </td> -->
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm dynamicModal"
                                                        pageTitle="Add Page" pageLink="{{url('/createPage')}}"
                                                        data-modal-size="modal-xl" data-toggle="tooltip"
                                                        data-placement="top" title="Add Page">
                                                        Add Page
                                                    </button>
                                                </td>
                                            </tr>
                                            @php $sl++;@endphp @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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



</script> 



@endsection
