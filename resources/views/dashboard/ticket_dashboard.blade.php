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
    <div class="" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <div style="display: inline-block;float: left;">
                        <h3>{{$header['pageTitle']}} </h3>
                    </div>
                    <div style="display: inline-block;float: left;padding-left: 10px !important;">
                        <h3><a href="{{url('/home')}}">Dashboard</a> </h3>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="x_panel">
                        <div class="x_title" style="border:none;">
                            <h2>{{$header['tableTitle']}} </h2>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered dataTable"
                                               role="grid" aria-describedby="data-table-info" width="100%">
                                            <thead style="background-color: #0b58a2; color: white">
                                            <tr>
                                                <th>Sl</th>
                                                <th>Ticket No</th>
                                                {{--                                                <th>Client</th>--}}
                                                {{--                                                <th>Project</th>--}}
                                                <th>Title</th>
                                                <th>Module</th>
                                                <th>Priority</th>
                                                <th>Assign To</th>
                                                <th>Ticket Status</th>
                                                <th>Task %</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $key=> $result)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$result->ticket_no}}</td>
                                                    {{--                                                <td>{{$result->client_name}}</td>--}}
                                                    {{--                                                <td>{{$result->project_name}}</td>--}}
                                                    <td>{{$result->ticket_title}}</td>
                                                    <td>{{$result->module_name}}</td>
                                                    <td>{{$result->priorityName}}</td>
                                                    <td>
                                                        @if(!empty($result->employee_id))
                                                            @php
                                                                $empName = DB::selectOne("select employee_name from npoly_employees where employee_id = $result->employee_id");
                                                                echo $empName->employee_name;
                                                            @endphp
                                                        @else
                                                        @endif
                                                    </td>
                                                    <td>{{$result->ticketStatus}}</td>
                                                    <td>{{$result->task_complete}}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-primary btn-sm dynamicModal"
                                                                pageTitle="Update Ticket Assign"
                                                                pageLink="{{url('/updateTicketAssign/'.$result->id)}}"
                                                                data-modal-size="modal-xl" data-toggle="tooltip"
                                                                data-placement="top" title="Update Ticket Assign">
                                                            <i class="glyphicon glyphicon-eye-open"></i>
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
