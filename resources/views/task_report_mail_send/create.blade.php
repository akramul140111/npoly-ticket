@section('content')
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/createTaskMailSend'); @endphp
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form id="" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left"
                  enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />

                    <!--  <span class="section">Add Module</span> -->

                <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dataTable"
                           role="grid" aria-describedby="data-table-info" width="100%">
                        <thead style="background-color: #0b58a2; color: white">
                        <tr>
                            <th>Sl</th>
                            <th>Project Name</th>
                            <th>Task Title</th>
                            <th>Assign By</th>
                            <th>Assign Date</th>
                            <th class="text-center">Task Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $key=> $result)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$result->project_name}}</td>
                                <td>{{$result->task_title}}</td>
                                <td>
                                    @if(!empty($result->assign_by))
                                    @php
                                    $assignByName = DB::table('npoly_employees')->select('employee_name as assign_by')->where('employee_id',$result->assign_by)->first();
                                    @endphp
                                    {{$assignByName->assign_by}}
                                    @endif
                                </td>
                                <td>{{date('d-M-Y',strtotime($result->assign_date))}}</td>
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
                                                    ->where('task_create_date',date('Y-m-d'))
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
                                                       @if(!empty($ttm->end_time)) {{gmdate('h:i A',$ttm->end_time)}} @endif
                                                    </td>
                                                    <td>
                                                        @if(!empty($ttm->end_time && $ttm->end_time > $ttm->start_time))
                                                        @php
                                                            $datetime1 = new DateTime(gmdate('h:i A',$ttm->start_time));
                                                            $datetime2 = new DateTime(gmdate('h:i A',$ttm->end_time));
                                                            $interval = $datetime1->diff($datetime2);
                                                            echo $interval->format('%h')." H ".$interval->format('%i')." M";
                                                        @endphp
                                                            @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody></table>
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br><br>
                <h5>Daily Work Report Email Info</h5><br>

                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <th>To*</th>
                            <td>{{$mailInfo->report_to_name}}</td>

                        </tr>
                        <tr>
                            <th>CC *</th>
                           <td>
                               @php
                               $ccEmployee = DB::select("select employee_name from npoly_employees where employee_id in($mailInfo->cc_to)");
                               $employeeName = [];

                               foreach ($ccEmployee as $empNam){
                                  $employeeName  [] = $empNam->employee_name;
                               }
                               $employeeNameIn = implode(',',$employeeName);
                               echo $employeeNameIn;
                               @endphp


                           </td>
                        </tr>
                        <tr>
                            <th>BCC * </th>
                            <td>
                                @php
                                    $ccEmployee = DB::select("select employee_name from npoly_employees where employee_id in($mailInfo->bcc_to)");
                                    $employeeName = [];

                                    foreach ($ccEmployee as $empNam){
                                       $employeeName  [] = $empNam->employee_name;
                                    }
                                    $employeeNameIn = implode(',',$employeeName);
                                    echo $employeeNameIn;
                                @endphp
                            </td>
                            <input type="hidden" name="cc_to" value="{{$mailInfo->cc_to_name}}"/>
                            <input type="hidden" name="bcc_to" value="{{$mailInfo->bcc_to}}"/>
                        </tr>

                        <tr>
                            <th></th>
                            <td>
                                <button type="submit" id='saveBtnStudentInfo' class="btn btn-primary">Send</button>
                            </td>
                        </tr>
                    </table>
                    <br><br>
                </div>
            </form>
        </div>

<script type="text/javascript">
    $(document).on('focus', '.datepickerMonthYearAppend', function(e){
        $(e.target).daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_1",
            showDropdowns: true,
            minDate: $('#block_from_date').val(),
            maxDate: $('#block_to_date').val(),
            locale: {
                format: "DD-MM-YYYY"
            }
        })
    }).on('show.daterangepicker', function () {
        $('.table-condensed tbody tr:nth-child(2) td').click();
    });

    $('.time-picker').datetimepicker({
        format: 'hh:mm A'
    });

    // check task start status

    $('#startStatus').click(function (){
        if($(this).prop('checked')){
           let checkConfirm = confirm('Do You Want To Start This Task');
           if(checkConfirm ==true){
            $('#startStatus').val(1)
           }else{
               return false
           }
        }else{
            $('#startStatus').val(0)
        }
    });



</script>
