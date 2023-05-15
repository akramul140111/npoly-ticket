@extends('layouts.master')
@section('content')
@section('title')
@endsection
<style>
    ul li.active, a.active {
        color: #3fbbc0;
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered custom-table-border">
                                        <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th style="min-width:60px">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $sl=1@endphp
                                        @foreach($results as $result)
                                            <tr>
                                                <td>{{$sl}}</td>
                                                <td>{{$result->activity_name}}</td>
                                                <td>{{$result->descripton}}</td>
                                                <td>
                                                    @if($result->active_status ==1)
                                                        <button type="button" class="btn btn-info btn-sm "  data-placement="top" title="Active" >
                                                          Active
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-info btn-sm "  data-placement="top" title="Inactive" >
                                                            Inactive
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Update Activity Event" pageLink="{{url('/updateActivityEvent/'.$result->activity_id)}}" data-modal-size="modal-lg" data-toggle="tooltip" data-placement="top" title="Update Activity/Event" >
                                                        <i class="glyphicon glyphicon-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm dynamicModal" pageTitle="View Activity Event" pageLink="{{url('/viewActivity/'.$result->activity_id)}}" data-modal-size="modal-lg" data-toggle="tooltip" data-placement="top" title="View Activity/Event" >
                                                        <i class="glyphicon glyphicon-zoom-in"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @php $sl++;@endphp
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

