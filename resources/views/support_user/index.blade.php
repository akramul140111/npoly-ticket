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
                <h3>{{$header['pageTitle']}} </h3>
            </div>
            <!-- USER LEVEL SUPERVISOR=10 WILL LOGIN -->
            {{-- @if(Auth::user()->USERLVL_ID==10) --}}
            <div class="title_right">
                <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                        <button type="button" class="btn btn-primary dynamicModal" pageTitle="Add Ticket"
                            pageLink="{{URL::route('createTicket')}}" data-toggle="tooltip" data-placement="left"
                            title="Add Ticket" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add
                            New</button>
                    </div>
                </div>
            </div>
            {{-- @endif --}}
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
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Ticket No</th>
                                                <th>Client</th>
                                                <th>Project</th>
                                                <th>Title</th>
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
                                                <td>{{$result->client_name}}</td>
                                                <td>{{$result->project_name}}</td>
                                                <td>{{$result->ticket_title}}</td>
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
                                                        <button type="button" class="btn btn-info btn-sm dynamicModal"
                                                            pageTitle="Update Ticket Assign"
                                                            pageLink="{{url('/updateTicketAssign/'.$result->id)}}"
                                                            data-modal-size="modal-xl" data-toggle="tooltip"
                                                            data-placement="top" title="Update Ticket Assign">
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
