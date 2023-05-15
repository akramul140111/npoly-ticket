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
                                                <th>Employee Name</th>
                                                <th>Card No</th>
                                                <th>Mobile</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                                <th>Total Hours</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $key=> $result)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$result->employee_name}}</td>
                                                    <td>@if(!empty($result->card_no)){{$result->card_no}}@endif</td>
                                                    <td>@if(!empty($result->mobile_no)){{$result->mobile_no}}@endif</td>
                                                    <td>@if(!empty($result->department_name)){{$result->department_name}}@endif</td>
                                                    <td>@if(!empty($result->designation_name)){{$result->designation_name}}@endif</td>
                                                    <td>
                                                        @php
                                                            $totalWokingHours = DB::table('npoly_task_report_log')
                                                                                    ->select('start_time','end_time')
                                                                                    ->where('employee_id',$result->employee_id)
                                                                                    ->whereBetween('task_create_date', [ $lastSevendDays,$today])
                                                                                    ->get();

                                                                    $totalHour = 0;
                                                                    foreach ($totalWokingHours as $hour){
                                                                        if(!empty($hour->end_time)){
                                                                            $totalHour += $hour->end_time -$hour->start_time;
                                                                        }
                                                                    }
                                                                   $totalHours = floor($totalHour / 3600);
                                                                   //$minutes = ceil($totalHour / 60) % 60;
                                                                   $minutes = floor($totalHour / 60) % 60;
                                                                    echo $totalHours .'H : ' .$minutes .'M';

                                                        @endphp
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-success btn-sm dynamicModal"
                                                                pageTitle="{{$result->employee_name}} Task Details"
                                                                pageLink="{{url('/task_details_last_seven_days/'.$result->employee_id)}}"
                                                                data-modal-size="modal-xl" data-toggle="tooltip"
                                                                data-placement="top" title="Task Details">
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
