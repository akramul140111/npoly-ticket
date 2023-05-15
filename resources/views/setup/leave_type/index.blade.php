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
                        <button type="button" class="btn btn-primary dynamicModal" pageTitle="Add Leave Type Setup"
                            pageLink="{{URL::route('createLeaveTypeSetup')}}" data-toggle="tooltip"
                            data-placement="left" title="Add New Leave Type Setup" data-target=".bs-example-modal-lg"
                            data-modal-size="modal-xl">Add
                            New</button>

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
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable"
                                        class="table table-striped table-bordered custom-table-border">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Leave Type</th>
                                                <th>Number Of Days</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($leaveTypes as $key => $leaveType)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$leaveType->leaveTypeName}}</td>
                                                <td>{{$leaveType->number_of_days}}</td>
                                                <td>{{$leaveType->description}}</td>
                                                <td>
                                                    @if($leaveType->active_status==1)
                                                    <label>
                                                        <span type="" class="btn btn-primary btn-sm">Active</span>
                                                    </label>
                                                    @else
                                                    <label>
                                                        <span type="" class="btn btn-danger btn-sm">Inactive</span>
                                                    </label>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-info btn-sm dynamicModal"
                                                        pageTitle="Edit Leave Type"
                                                        pageLink="{{url('/editLeaveTypeSetup/'.$leaveType->id)}}"
                                                        data-modal-size="modal-xl" data-toggle="tooltip"
                                                        data-placement="top" title="Edit  Leave Type">
                                                        <i class="glyphicon glyphicon-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach


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

@endsection
