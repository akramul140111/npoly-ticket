@extends('layouts.master')

@section('content')
@section('title')
@endsection
<style>
    ul li.active,
    a.active {
        color: #3fbbc0;
    }

    tr:nth-child(even) tr {background: #ffffff !important;}

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

                    <div class="col-md-3 col-sm-3 offset-md-6" style="padding-left: 25px !important;">
                            <button type="button" class="btn btn-success dynamicModal" pageTitle="Task Mail Send"
                                    pageLink="{{URL::route('createTaskMailSend')}}" data-toggle="tooltip" data-placement="left"
                                    title="Task Mail Send" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Send Email
                            </button>
                    </div>
                    <div class="col-md-3 col-sm-3 offset-md-1">
                        <button type="button" class="btn btn-primary dynamicModal" pageTitle="Add Task"
                                pageLink="{{URL::route('createTask')}}" data-toggle="tooltip" data-placement="left"
                                title="Add Task" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add New
                        </button>
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
                                        <thead style="background-color: #0b58a2; color: white">
                                            <tr>
                                                <th>Sl</th>
                                                <th>Project Name</th>
                                                <th>Task Title</th>
                                                <th>Task Description</th>
                                                <th class="text-center">Task Info</th>
                                                <th>W.Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($results as $key=> $result)
                                            <tr @if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d'))style="background-color: #e4f0e9" @endif>
                                                <td>{{$key+1}}</td>
                                                <td>{{$result->project_name}}</td>
                                                <td>{{$result->task_title}}</td>
                                                <td>{{$result->task_desc}}</td>
                                                <style>
                                                    .tblTimeCalc td{
                                                        border: none !important;
                                                        border-top: none !important;
                                                        border-bottom: none !important;
                                                    }

                                                    .tblTaskCalc td, .tblTaskCalc th{
                                                        border: 1px solid #ccc !important;
                                                        background-color: #f7ffe9 !important;
                                                        padding:2px 4px !important;
                                                    }

                                                    .tblTaskCalc{

                                                        font-size:12px !important;
                                                    }
                                                </style>
                                                <td style="width: 27%!important;">
                                                    <table class="table table-striped tblTimeCalc" width="100%">
                                                        @if(!empty($result->priority_name))
                                                            <tr class="" @if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d'))style="background-color: #e4f0e9 !important;" @else style="background-color: #f2f2f2" @endif>
                                                                <td><strong>Priority</strong></td>
                                                                <td><strong>:</strong></td>
                                                                <td>{{$result->priority_name}}</td>
                                                            </tr>
                                                        @endif
                                                            <tr class="" @if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d'))style="background-color: #e4f0e9 !important;" @else style="background-color: #f2f2f2" @endif>
                                                                <td><strong>Assign By</strong></td>
                                                                <td><strong>:</strong></td>
                                                                <td>
                                                                    @if(!empty($result->assign_by_name))
                                                                        {{ $result->assign_by_name }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr class="" @if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d'))style="background-color: #e4f0e9 !important;" @else style="background-color: #f2f2f2" @endif>
                                                                <td><strong>Assign Date</strong></td>
                                                                <td><strong>:</strong></td>
                                                                <td>
                                                                    @php
                                                                        $today = date('Y-m-d');
                                                                        $foCheDate = date('Y-m-d');
                                                                    @endphp
                                                                    @if(!empty($result->assign_date))
                                                                        {{ date('d-M-Y',strtotime($result->assign_date)) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr  class="" @if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d'))style="background-color: #e4f0e9 !important;" @else style="background-color: #f2f2f2" @endif>
                                                                <td @if(date('Y-m-d',strtotime($result->forecast_date)) < $foCheDate)style="color: red; @endif"><strong>Forecast Date</strong></td>
                                                                <td @if(date('Y-m-d',strtotime($result->forecast_date)) < $foCheDate)style="color: red; @endif"><strong>:</strong></td>
                                                                <td @if(date('Y-m-d',strtotime($result->forecast_date)) < $foCheDate)style="color: red; @endif">{{ !empty($result->forecast_date)?date('d-M-Y',strtotime($result->forecast_date)):'' }}</td>
                                                            </tr>
                                                            <tr  class="" @if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d'))style="background-color: #e4f0e9 !important;" @else style="background-color: #f2f2f2" @endif>
                                                            <td colspan="3">
                                                                @php
                                                                    $taskTime = DB::table('npoly_task_report_log')
                                                                                ->select('start_time','end_time')
                                                                                ->where('task_id',$result->task_id)
                                                                                ->where('prof_task_perfome_dt',date('Y-m-d'))
                                                                                ->get();
                                                                    $timeCount = count($taskTime);
                                                                @endphp

                                                                @if($timeCount > 0 && $result->task_create_date==date('Y-m-d'))
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
                                                        </tr>
                                                            <tr class="" @if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d'))style="background-color: #e4f0e9 !important;" @else style="background-color: #f2f2f2" @endif>
                                                                <td><strong>Task Type</strong></td>
                                                                <td><strong>:</strong></td>
                                                                <td>
                                                                    @if($result->assign_date == $today)
                                                                        {{'New'}}
                                                                    @else
                                                                        {{'Old'}}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @if($result->task_complete > 0)
                                                                <tr class="" @if($result->task_complete > 0 && $result->task_create_date ==date('Y-m-d'))style="background-color: #e4f0e9 !important;"@else style="background-color: #f2f2f2"  @endif>
                                                                    <td @if($result->task_complete==100) style="color: green; @endif"><strong>Task Done</strong></td>
                                                                    <td  @if($result->task_complete==100) style="color: green; @endif"><strong>:</strong></td>
                                                                    <td  @if($result->task_complete==100) style="color: green; @endif">{{$result->task_complete}}% </td>
                                                                </tr>
                                                            @endif
                                                    </table>

                                                </td>
{{--                                                <td>{{date('d-M-Y',strtotime($result->forecast_date))}}</td>--}}
                                                <td>
                                                    <button @if($result->task_complete=='100') disabled @endif class=" @if($result->task_running=='1') btn btn-warning @else btn btn-success @endif taskStatus" value="{{$result->task_running}}">@if($result->task_running =='1') Stop @else Start @endif </button>
                                                    <input type="hidden" class="taskId" value="{{$result->task_id }}" id="taskId">
                                                </td>
                                                    <td class="text-center">
                                                        <button type="button" @if($result->task_running=='1' || $result->task_complete=='100') disabled  @endif class="btn btn-info btn-sm dynamicModal"
                                                            pageTitle="Update Task"
                                                            pageLink="{{url('/updateTask/'.$result->task_id)}}"
                                                            data-modal-size="modal-xl" data-toggle="tooltip"
                                                            data-placement="top" title="@if($result->task_running=='1') Stop The Task Then Update @else Update Task @endif">
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
    <script>
        $(document).off('click','.taskStatus').on('click','.taskStatus',function (){
        //$('.taskStatus').click(function (){
           var taskId = $(this).closest('tr').find('#taskId').val();
           var taskStatus = $(this).val();

           if(taskStatus == '1'){
               let stopMsg = confirm('Do You Want To Stop This Task');
               if(stopMsg ==true){
                   var _token = '{{csrf_token()}}'
                   $.ajax({
                       type: 'get',
                       url: '{{url("/update_task_status")}}',
                       data: {_token: _token, taskId: taskId,taskStatus:taskStatus},
                       success: function (data) {
                           window.location.replace("{{url("/taskReportIndex")}}");
                       }
                   });
               }else{
                   return false;
               }
           }else if(taskStatus == '0'){
              if(taskId !=='') {
                  var _token = '{{csrf_token()}}'
                  $.ajax({
                      type: 'GET',
                      url: '{{url("/check_task_start_or_stop_status")}}',
                      data: { _token: _token,taskId:taskId },
                      success: function (data) {
                          if(data =='1'){
                              var anotherTask = confirm('Another Task Is Running Do You Want To Stop This Task');

                              if(anotherTask ==true){
                                  $.ajax({
                                      type: 'get',
                                      url: '{{url("/update_task_status")}}',
                                      data: {_token: _token, taskId: taskId,taskStatus:taskStatus},
                                      success: function (data) {
                                          console.log(data)
                                          window.location.replace("{{url("/taskReportIndex")}}");
                                      }
                                  });
                              }else{
                                  return false;
                              }
                          }else{
                              let taskStartMst = confirm('Do You Want To Start The Task');
                              if(taskStartMst ==true){
                                  $.ajax({
                                      type: 'get',
                                      url: '{{url("/update_task_status")}}',
                                      data: {_token: _token, taskId: taskId,taskStatus:taskStatus},
                                      success: function (data) {
                                          console.log(data)
                                          window.location.replace("{{url("/taskReportIndex")}}");
                                      }
                                  });
                              }else{
                                  return  false;
                              }

                          }
                      }
                  });
              }
           }




           // check another task start or stop info
           {{-- if(taskId !==''){--}}
           {{--     var _token = '{{csrf_token()}}'--}}
           {{--     $.ajax({--}}
           {{--         type: 'GET',--}}
           {{--         url: '{{url("/check_task_start_or_stop_status")}}',--}}
           {{--         data: { _token: _token,taskId:taskId },--}}
           {{--         success: function (data) {--}}
           {{--         if(data =='1'){--}}
           {{--         var anotherTask = confirm('Another Task Is Running Do You Want To Stop This Task');--}}

           {{--         if(anotherTask ==true){--}}
           {{--             $.ajax({--}}
           {{--                 type: 'get',--}}
           {{--                 url: '{{url("/update_task_status")}}',--}}
           {{--                 data: {_token: _token, taskId: taskId},--}}
           {{--                 success: function (data) {--}}
           {{--                     console.log(data)--}}
           {{--                     window.location.replace("{{url("/taskReportIndex")}}");--}}
           {{--                 }--}}
           {{--             });--}}
           {{--         }else{--}}
           {{--            return false;--}}
           {{--         }--}}
           {{--         }else{--}}

           {{--         }--}}
           {{--         }--}}
           {{--     });--}}
           {{-- }--}}

        });
    </script>
@endsection
