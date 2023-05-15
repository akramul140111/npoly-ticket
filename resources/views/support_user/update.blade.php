{{--@section('content')--}}
@include('layouts.modalFormSubmit')
@php $actionUrl=url('/updateTaskAssign'); @endphp
<script>$('form').parsley();</script>
<?php ini_set('memory_limit', -1) ?>
<div class="flash-message"></div>
<div class="x_content">
   <!-- <form id="ClassRoutineForm" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}"
        class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Department *</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control" name="department_id" required id="departmentId">
                    <option value="">--select--</option>
                    @foreach($department as $dept)
                        <option value="{{$dept->LOOKUP_DATA_ID}}">{{$dept->LOOKUP_DATA_NAME}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Employee*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control"  name="employee_id" id="employeeId">
                    <option value="">--select--</option>
                    @foreach($employee as $key => $value)
                        <option value="{{$value->employee_id}}">{{$value->employee_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Assign Date</label>
            <div class="col-md-3 col-sm-3">
                <input type="text" name="assign_date" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff; width: 170px !important;"  />
            </div>
            Forecast Date
            <div class="col-md-3 col-sm-3">
                <input type="text" name="forecast_date" class="form-control assignDate datepickerMonthYearAppend" id="" style="background-color:#fff;width: 170px !important;"  />
            </div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-3 col-sm-3  label-align">Work Station*</label>
            <div class="col-md-6 col-sm-6">
                <select class="form-control"  name="work_station" id="employeeId" required>
                    <option value="">--select--</option>
                        <option value="1">In House</option>
                        <option value="2">Out Side Office</option>
                </select>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <input type="hidden" name="ticket_id" value="">


                    <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                    <button type='reset' class="btn btn-success">Reset</button>
            </div>
        </div>

    </form> -->
    <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="project-sidebar">
                    <input type="hidden" value="{{$result->id}}" id="ticketId">
                    <div class="project-menu">
                        <ul class="nav" id="navlist">
                            <li class="active">
                                <a id="ticketInfo" data-action="{{url('/getTicketInfo')}}" href="#">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Ticket Info </a>
                            </li>
{{--                            <li class="">--}}
{{--                                <a id="" data-action="{{url('/getTicketIn')}}" href="#">--}}
{{--                                    <i class="glyphicon glyphicon-upload"></i>--}}
{{--                                    Attachment </a>--}}
{{--                            </li>--}}
                            <li class="">
                                <a href="#" id="ticketStatus" data-action="{{url('/getTicketStatus')}}">
                                    <i class="glyphicon glyphicon-question-sign"></i>
                                    Ticket Status </a>
                            </li>

                            <li class="">
                                <a href="#" id="ticket_assign_info" data-action="{{url('/getTicketAssignInfo')}}">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Ticket Assign</a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 pull-right">
                <div class="ticket-content">
                    <table class="table table-responsive ">
                        <tbody><tr class="info">
                            <td colspan="2">
                                <b>Ticket Basic Info</b>
                                <a class="btn btn-success pull-right" id="edit_ticket_info" data-action="{{url('/editTicketInfo')}}" href="#">
                                    <i class="glyphicon glyphicon-pencil"></i> Edit
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td> Client Name </td>
                            <td>{{$result->client_name}}</td>
                        </tr>
                        <tr>
                            <td> Project Name </td>
                            <td>{{$result->project_name}}</td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td> Ticket No </td>--}}
{{--                            <td>230401#1161</td>--}}
{{--                        </tr>--}}
                        <tr>
                            <td> Ticket Title </td>
                            <td>{{$result->ticket_title}}</td>
                        </tr>
                        <tr>
                            <td> Ticket Description </td>
                            <td>
                                <p>{{$result->ticket_desc}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Ticket Create Date and Time</td>
                            <td>{{date('d-M-Y H:i A',strtotime($result->created_at))}}</td>

                        </tr>
                        <!--<tr>
                          <td>Priority</td>
                          <td>Major / High</td>
                        </tr>-->
                        </tbody></table>
                </div>


            </div>
    </div>
</div>

<script src="{{ URL::asset('assets/custom_js/custom_calendar.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.assignDate').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_1",
            showDropdowns: true,
            minDate: $('#block_from_date').val(),
            maxDate: $('#block_to_date').val(),
            locale: {
                format: "DD-MM-YYYY"
            }
        })
    })
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

    function getDay() {
        var cDate = $('#class_start_date').val();
        if (cDate != '') {
            $.ajax({
                type: 'GET',
                url: '{{url("/getDay")}}/' + cDate,
                success: function (data) {
                    $("#dayval").val(data);
                }
            });
        }
    }

    // block date validation for class routine add
    // $('#block_id').change(function(){
    //     $('#btnSubmit').prop("disabled",true);
    //     var blockID = $('#block_id').val();
    //     if (blockID != '') {
    //         $.ajax({
    //             type: 'GET',
    //             url: '{{url("/classRoutine/getBlockDate/")}}/' + blockID,
    //             success: function (data) {
    //                 if(data==1){
    //                     $('#btnSubmit').prop("disabled",false);
    //                 }
    //             }
    //         });
    //     }
    // });

    // block date validation for class routine add
    $('#block_id').change(function(){
        $('#btnSubmit').prop("disabled",true);
        var blockID = $('#block_id').val();
        if (blockID != '') {
            $.ajax({
                type: 'GET',
                url: '{{url("/classRoutine/getBlockDate/")}}/' + blockID,
                success: function (data) {
                    $('#block_from_date').val(data.dateForm);
                    $('#block_to_date').val(data.dateTo);
                    $('#class_start_date').focus();
                    // drp-calendar left single dspla none
                    if(data.status==1){
                        $('#btnSubmit').prop("disabled",false);
                    }
                }
            });
        }
    });



</script>

<script>
    $('#departmentId').change(function(){
        var departmentId = $(this).val();
        $('#employeeId').html('<option value="">--select--</option>');
        if(departmentId!=''){
            $.ajax({
                type: 'GET',
                url: '{{url("/getEmployee")}}/'+departmentId,
                success: function (data) {
                    $('#employeeId').html(data);
                }
            });
        }
    });
</script>

    <script>
        $('#ticketInfo').click(function (){

            var ticketId = $("#ticketId").val();
            var action_uri = $(this).attr('data-action');
            $.ajax({
                type: "POST",
                url: action_uri,
                data: { ticketId:ticketId,_token:'{{csrf_token()}}'},
                success: function (data){
                    $('.ticket-content').html(data);
                }
            });
        })
        $('#edit_ticket_info').click(function () {
            var ticketId = $("#ticketId").val();
            var action_uri = $(this).attr('data-action');
            $.ajax({
                type: "POST",
                url: action_uri,
                data: { ticketId:ticketId,_token:'{{csrf_token()}}'},
                success: function (data){
                    $('.ticket-content').html(data);
                }
            });
        });
        $('#ticketStatus').click(function () {
            var ticketId = $("#ticketId").val();
            var action_uri = $(this).attr('data-action');
            $.ajax({
                type: "POST",
                url: action_uri,
                data: { ticketId:ticketId,_token:'{{csrf_token()}}'},
                success: function (data){
                    $('.ticket-content').html(data);
                }
            });
        });

        $('#ticket_assign_info').click(function () {
            var ticketId = $("#ticketId").val();
            var action_uri = $(this).attr('data-action');
            $.ajax({
                type: "POST",
                url: action_uri,
                data: { ticketId:ticketId,_token:'{{csrf_token()}}'},
                success: function (data){
                    $('.ticket-content').html(data);
                }
            });
        });


    </script>
