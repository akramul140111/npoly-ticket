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
                    <a href="{{url('get_ticket_info/3')}}">
                        <div class="ibox bg-warning color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">0</h2>
                                <div class="m-b-5">On Hold</div><i class="fa fa-circle-o-notch widget-stat-icon"></i>
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
                        <h2>App Versions</h2>
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
                        <h4>App Usage across versions</h4>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>0.1.5.2</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>123k</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>0.1.5.3</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>53k</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>0.1.5.4</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>23k</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>0.1.5.5</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>3k</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_25">
                                <span>0.1.5.6</span>
                            </div>
                            <div class="w_center w_55">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_20">
                                <span>1k</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 ">
                <div class="x_panel tile fixed_height_320 overflow_hidden">
                    <div class="x_title">
                        <h2>Device Usage</h2>
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
                                    <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                                </td>
                                <td>
                                    <table class="tile_info">
                                        <tr>
                                            <td>
                                               <a href="{{url('/allEmployeeIndex')}}"> <p title="Total Employee"><i class="fa fa-square blue"></i>Total Emp </p></a>
                                            </td>
                                            <td> <a href="{{url('/allEmployeeIndex')}}">9</a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{url('/total_present_employee')}}"> <p title="Total Present"><i class="fa fa-square green"></i>Present</p></a>
                                            </td>
                                            <td> <a href="{{url('/total_present_employee')}}">{{$totalPresent}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{url('/total_absent_employee')}}"><p title="Total Absent"><i class="fa fa-square purple"></i>Absent</p></a>
                                            </td>
                                            <td><a href="{{url('/total_absent_employee')}}">{{$totalAbsent}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{url('/total_working_hour')}}"><p title="Total Working Hours"><i class="fa fa-square aero"></i>T.W.H </p></a>
                                            </td>
                                            <td><a href="{{url('/total_working_hour')}}">{{$totalHours}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{url('/get_last_seven_days_task')}}"> <p title="Last 7 Days Work"><i class="fa fa-square red"></i>Last 7 Days</p></a>
                                            </td>
                                            <td><a href="{{url('/get_last_seven_days_task')}}">{{floor($totaHourlast7days->total_hours / 3600)}}</a></td>
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
                        <div class="dashboard-widget-content">
                            <div id="chartContainer" style="width: 100%; height: 200px"></div>
                        </div>
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
    <script type="text/javascript">
        window.onload = function() {
            $("#chartContainer").CanvasJSChart({
                axisY: {
                    title: "Products in %"
                },
                legend :{
                    verticalAlign: "center",
                    horizontalAlign: "right"
                },
                data: [
                    {
                        type: "pie",
                        showInLegend: true,
                        toolTipContent: "{label} <br/> {y} %",
                        indexLabel: "{y} %",
                        dataPoints: [
                            { label: "Samsung",  y: 30.3, legendText: "Samsung"},
                            { label: "Apple",    y: 19.1, legendText: "Apple"  },
                            { label: "Huawei",   y: 4.0,  legendText: "Huawei" },
                            { label: "LG",       y: 3.8,  legendText: "LG Electronics"},
                            { label: "Lenovo",   y: 3.2,  legendText: "Lenovo" },
                            { label: "Others",   y: 39.6, legendText: "Others" }
                        ]
                    }
                ]
            });
        }
    </script>
@endsection
