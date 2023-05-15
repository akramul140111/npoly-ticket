

<style>
    ul li.active,
    a.active {
        color: #3fbbc0;
    }

</style>
<div class="" role="main">
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
                                        <th>Project Name</th>
                                        <th>Task Title</th>
                                        <th>Task Description</th>
                                        <th class="text-center">Task Time</th>
                                        <th>W.Status</th>
                                        <th>Task %</th>
                                        <th>Task Type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $key=> $result)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$result->project_name}}</td>
                                            <td>{{$result->task_title}}</td>
                                            <td>{{$result->task_desc}}</td>
                                            <td>
                                                <style>
                                                    .tblTaskCalc td, .tblTaskCalc th{
                                                        border: 1px solid #ccc !important;
                                                        background-color: #f7ffe9 !important;
                                                    }
                                                </style>
                                                @php
                                                    $taskTime = DB::table('npoly_task_report_log')
                                                                ->select('start_time','end_time')
                                                                ->where('task_id',$result->task_id)
                                                                //->where('prof_task_perfome_dt',date('Y-m-d'))
                                                                ->whereBetween('task_create_date', [ $lastSevendDays,$today])
                                                                ->get();
                                                    $timeCount = count($taskTime);
                                                @endphp

                                                @if($timeCount > 0)
                                                    <table class="tblTaskCalc" width="100%">
                                                        <tbody><tr>
                                                            <th colspan="3" class="text-center" style="background-color:#e3e3cd !important"><b>Task Timing</b></th>
                                                        </tr>
                                                        <tr>
                                                            <th title="Start Time"><b>Start</b></th>
                                                            <th title="End Time"><b>End</b></th>
                                                            <th title="Total Time"><b>Total</b></th>
                                                        </tr>

                                                        @foreach($taskTime as $ttm)
                                                            <tr>
                                                                <td>{{gmdate('h:i A',$ttm->start_time)}}</td>
                                                                <td>
                                                                    @if($ttm->end_time > $ttm->start_time){{gmdate('h:i A',$ttm->end_time)}} @endif
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        if($ttm->end_time > $ttm->start_time){
                                                                          $datetime1 = new DateTime(gmdate('h:i A',$ttm->start_time));
                                                                         $datetime2 = new DateTime(gmdate('h:i A',$ttm->end_time));
                                                                         $interval = $datetime1->diff($datetime2);
                                                                         echo $interval->format('%h')." H ".$interval->format('%i')." M";
                                                                        }

                                                                    @endphp
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody></table>
                                                @else

                                                @endif

                                            </td>
                                            {{--                                                <td>{{date('d-M-Y',strtotime($result->forecast_date))}}</td>--}}
                                            <td>
                                                <button class=" @if($result->task_running=='1') btn btn-warning @else btn btn-success @endif taskStatus" value="{{$result->task_running}}">@if($result->task_running =='1') Stop @else Start @endif </button>
                                                <input type="hidden" class="taskId" value="{{$result->task_id }}" id="taskId">
                                            </td>
                                            <td>{{$result->task_complete}}</td>
                                            <td>
                                                @if($result->assign_date== $result->task_create_date)
                                                    {{'New'}}
                                                @else
                                                    {{'Old'}}
                                                @endif
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

<?php
