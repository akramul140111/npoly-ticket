@extends('layouts.master')
@section('content')
    <style>
        .p-5 {
             padding: 2rem!important;
        }
        .font-strong{
            font-weight: 600 !important;
            font-size: 2rem;
            color: white;
        }
        .m-b-5 {
            margin-bottom: 5px!important;
            padding-left: 10px;
        }
        small {
            font-size: 85%;
            padding-left: 10px;
        }
        .bg-success {
            background-color: #2ecc71!important;
        }
        .bg-info{background-color:#23b7e5!important}
        .bg-warning{background-color:#f39c12!important}
        .bg-danger{background-color:#e74c3c!important}
        .widget-stat-icon {
            position: absolute;
            top: 9px !important;
            right: 9px !important;
            width: 60px;
            height: 100%;
            line-height: 100px;
            text-align: center;
            font-size: 30px;
            background-color: rgba(0,0,0,.1);
        }
        .widget-stat-icon{position:absolute;top:0;right:0;width:60px;height:100%;line-height:100px;text-align:center;font-size:30px;background-color:rgba(0,0,0,.1)}
        .color-white {
            color: #fff!important;
        }

    </style>
    @php
        $openTicket = DB::table('npoly_tickets')->where('ticket_status',225)->count();
        $closeTicket = DB::table('npoly_tickets')->where('ticket_status',230)->count();
        $pendingTicket = DB::table('npoly_tickets')->where('ticket_status',234)->count();
        $wProgressTicket = DB::table('npoly_tickets')->where('ticket_status',227)->count();
        $notResolvedTicket = DB::table('npoly_tickets')->where('ticket_status',229)->count();
        $ResolvedTicket = DB::table('npoly_tickets')->where('ticket_status',228)->count();
        $ReassignTicket = DB::table('npoly_tickets')->where('reassign_fg',1)->count();
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <a href="{{url('get_ticket_info/225')}}">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$openTicket}}</h2>
                        <div class="m-b-5">Open Ticket</div><i class="fa fa-list widget-stat-icon"></i>
                        <div><i class="fa fa-leve-up m-r-5"></i></div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{url('get_ticket_info/234')}}">
                    <div class="ibox bg-warning color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{$pendingTicket}}</h2>
                            <div class="m-b-5">Pending</div><i class="fa fa-circle-o-notch widget-stat-icon"></i>
                            <div><i class="fa fa-leve-up m-r-5"></i></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{url('get_ticket_info/227')}}">
                    <div class="ibox bg-success color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{$wProgressTicket}}</h2>
                            <div class="m-b-5">Work In Progress </div><i class="fa fa-check-circle widget-stat-icon"></i>
                            <div><i class="fa fa-leve-up m-r-5"></i></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{url('get_ticket_info/229')}}"><div class="ibox bg-danger color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{$notResolvedTicket}}</h2>
                            <div class="m-b-5">Not Resolved</div><i class="fa fa-thumbs-up widget-stat-icon"></i>
                            <div><i class="fa fa-leve-down m-r-5"></i><small></small></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="{{url('get_ticket_info/228')}}">
                        <div class="ibox bg-success color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">{{$ResolvedTicket}}</h2>
                                <div class="m-b-5">Resolved </div><i class="fa fa-check-circle widget-stat-icon"></i>
                                <div><i class="fa fa-leve-up m-r-5"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="{{url('get_ticket_info/225')}}">
                        <div class="ibox bg-info color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">{{$openTicket}}</h2>
                                <div class="m-b-5">User Working</div><i class="fa fa-list widget-stat-icon"></i>
                                <div><i class="fa fa-leve-up m-r-5"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="{{url('get_ticket_info/1')}}">
                        <div class="ibox bg-warning color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">{{$ReassignTicket}}</h2>
                                <div class="m-b-5">Reassign Ticket</div><i class="fa fa-circle-o-notch widget-stat-icon"></i>
                                <div><i class="fa fa-leve-up m-r-5"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="{{url('get_ticket_info/230')}}"><div class="ibox bg-danger color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">{{$closeTicket}}</h2>
                                <div class="m-b-5">Closed</div><i class="fa fa-thumbs-up widget-stat-icon"></i>
                                <div><i class="fa fa-leve-down m-r-5"></i><small></small></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        @if(Auth::user()->is_admin==1)
            @php
                $today = date('Y-m-d');
                $lastSevendDays = date('Y-m-d', strtotime('-7 days'));
                $totalPresent = DB::table('hr_attendance')->select('employee_id')->where('present_status',1)->where('attendance_date',date('Y-m-d'))->count();
                $totalAbsent = DB::table('hr_attendance')->select('employee_id')->where('present_status',0)->where('attendance_date',date('Y-m-d'))->count();

                $totalWokingHours = DB::table('npoly_task_report_log')
                                ->select('start_time','end_time')
                                ->where('task_create_date',date('Y-m-d'))
                                ->get();
                $totaHourlast7days = DB::selectOne("SELECT sum(end_time - start_time) as total_hours FROM npoly_task_report_log WHERE end_time > start_time and task_create_date BETWEEN '$lastSevendDays' AND '$today';");
                $totalHour = 0;
                foreach ($totalWokingHours as $hour){
                    if(!empty($hour->end_time)){
                        $totalHour += $hour->end_time -$hour->start_time;
                    }
                }
               $totalHours = floor($totalHour / 3600);
                @endphp
        <div class="row">
            <div class="col-md-4 col-sm-4 ">
                <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>Ticket Info</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="mybarChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 ">
                <div class="x_panel tile fixed_height_320 overflow_hidden">
                    <div class="x_title">
                        <h2>Employee Info</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="" style="width:100%">
                           <!-- <tr>
                                <th style="width:37%;">
                                    <p>Top 5</p>
                                </th>
                                <th>
                                    <div class="col-lg-7 col-md-7 col-sm-7 ">
                                        <p class="">Device</p>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                        <p class="">Progress</p>
                                    </div>
                                </th>
                            </tr> -->
                            <tr>
                                <td>
                                    <canvas class="canvasDoughnut1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                                </td>
                                <td>
                                    <table class="tile_info">
                                        <tr>
                                            <td>
                                               <a href="{{url('/allEmployeeIndex')}}"> <p title="Total Employee"><i class="fa fa-square blue"></i>Total Emp </p></a>
                                            </td>
                                            <td> <a href="{{url('/allEmployeeIndex')}}"><span id="">9
                                                    <input type="hidden" id="totalEmp" value="9">
                                                    </span></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{url('/total_present_employee')}}"> <p title="Total Present"><i class="fa fa-square green"></i>Present</p></a>
                                            </td>
                                            <td> <a href="{{url('/total_present_employee')}}">
                                                  <span id="totalPresent">{{$totalPresent}}</span>
                                                </a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{url('/total_absent_employee')}}"><p title="Total Absent"><i class="fa fa-square purple"></i>Absent</p></a>
                                            </td>
                                            <td><a href="{{url('/total_absent_employee')}}"><span id="totalAbsent">{{$totalAbsent}}</span></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{url('/total_working_hour')}}"><p title="Total Working Hours"><i class="fa fa-square aero"></i>T.W.H </p></a>
                                            </td>
                                            <td><a href="{{url('/total_working_hour')}}"><span id="totalHour">{{$totalHours}}</span></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{url('/get_last_seven_days_task')}}"> <p title="Last 7 Days Work"><i class="fa fa-square red"></i>Last 7 Days</p></a>
                                            </td>
                                            <td><a href="{{url('/get_last_seven_days_task')}}"><span id="last7Days">{{floor($totaHourlast7days->total_hours / 3600)}}</span></a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 ">
                <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>Quick Settings</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                            <div id="echart_pie" style="height:278px;margin-top: -20px !important;"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert").slideUp(500);
            });
        });

        $(document).on('click','.news',function (){
            $('.newsInfo').css('display','block')
            $('.dashboardInfo').css('display','none')
        })
    </script>
    <script>
        $(document).ready(function(){
            if ($('.canvasDoughnut1').length) {
                var totalWork = $('#totalHour').text();
                var absent = $('#totalAbsent').text();
                var last7Days = $('#last7Days').text();
                var present = $('#totalPresent').text();
                var totalEmp = $('#totalEmp').val();

                var chart_doughnut_settings = {
                    type: 'doughnut',
                    tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                    data: {
                        labels: [
                            "Tot.Work Hour",
                            "Absent",
                            "Last 7 Days Work",
                            "Present",
                            "Tot.Employee"
                        ],
                        datasets: [{
                            data: [totalWork, absent, last7Days, present, totalEmp],
                            backgroundColor: [
                                "#BDC3C7",
                                "#9B59B6",
                                "#E74C3C",
                                "#26B99A",
                                "#3498DB"
                            ],
                            hoverBackgroundColor: [
                                "#CFD4D8",
                                "#B370CF",
                                "#E95E4F",
                                "#36CAAB",
                                "#49A9EA"
                            ]
                        }]
                    },
                    options: {
                        legend: false,
                        responsive: false
                    }
                }

                $('.canvasDoughnut1').each(function () {

                    var chart_element = $(this);
                    var chart_doughnut = new Chart(chart_element, chart_doughnut_settings);

                });

            }



        })
    </script>

@endsection
