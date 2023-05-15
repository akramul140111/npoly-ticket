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
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                                <th>Date</th>
                                                <th>Login Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $key=> $result)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$result->employee_name}}</td>
                                                    <td>{{$result->card_no}}</td>
                                                    <td>{{$result->email}}</td>
                                                    <td>{{$result->mobile_no}}</td>
                                                    <td>{{$result->department_name}}</td>
                                                    <td>{{$result->designation_name}}</td>
                                                    <td>{{date('d-M-Y',strtotime($result->attendance_date))}}</td>
                                                    <td><span @if($result->login_time >33399) style="color: red;" @endif>{{gmdate('H:i A',$result->login_time)}}</span></td>
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
