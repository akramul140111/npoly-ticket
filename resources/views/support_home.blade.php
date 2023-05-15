@extends('layouts.support_master')
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" style="background-color: #d7dde5">
                            <div class="col-md-2">
                                News
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row newsInfo">
                                <div class="col-md-12">
                                    @php
                                    $news = DB::table('npoly_support_news')
                                    ->select('news_id','news_title')
                                    ->where('active_status',1)
                                    ->get();
                                    @endphp
                                    <div style="padding-left: 5px !important;">
                                        <table style="border: none !important;padding-left: 5px;">
                                            @foreach($news as $nws)
                                                <tr valign="top" style="line-height: .1">
                                                    <td style="border: none !important; width: 5%;"><span> <i class="fa fa-file-text-o" aria-hidden="true"></i></span></td>
                                                    <td style="border: none !important;padding-left: 10px;">
                                                        <div style="line-height: 1.4;color: #00b1ff"><a href="{{url('/newsDetails/'.$nws->news_id)}}" style="color: #00b1ff !important;">{{$nws->news_title}}</a></div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        @if (Session::has('errors') || Session::has('passChange'))
                            <div class="alert alert-{{ Session::has('errors') ? 'danger' : 'success' }}" id="success-alert">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong> {{ Session::has('errors') ? 'Fail !': 'Success !' }} </strong>
                                {{ Session::has('errors') ? Session::get('errors') : Session::get('passChange') }}
                            </div>
                        @endif

                        <div class="card-header" style="background-color: #d7dde5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="dashboard">
                                            Technical Service Request
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                            <!-- /top tiles -->

                            @php
                                $results = DB::table('npoly_tickets as tkt')
                               ->leftJoin('sa_lookup_data as lkp', 'tkt.priority_id', '=', 'lkp.LOOKUP_DATA_ID')
                               ->leftJoin('sa_lookup_data as lkp1', 'tkt.ticket_status', '=', 'lkp1.LOOKUP_DATA_ID')
                               ->leftJoin('npoly_clients as clnt', 'clnt.client_id', '=', 'tkt.client_id')
                               ->leftJoin('npoly_projects as pro', 'pro.project_id', '=', 'tkt.project_id')
                               ->leftJoin('npoly_task_report as tskr', 'tskr.ticket_id', '=', 'tkt.id')
                               ->leftJoin('npoly_support_modules as stm', 'stm.module_id', '=', 'tkt.module_id')
                               ->select('tkt.*','lkp.LOOKUP_DATA_NAME as priorityName','clnt.client_name','pro.project_name','tskr.employee_id','tskr.task_complete','lkp1.LOOKUP_DATA_NAME as ticketStatus','stm.module_name')
                               ->where('support_user_id',Auth::user()->support_user_id)
                               ->where('tkt.ticket_status','!=',230)
                               ->orderBy('tkt.id','desc')
                               ->get();
                            @endphp
                            <div class="row dashboardInfo">
                                <div class="col-md-12">
                                    <div class="title_right">
                                        <div class="item form-group">
                                            <div class="col-md-3 col-sm-3">
                                             <a type="button" href="{{url('/supportTicketInfo')}}"  style="background-color: #DBE4ED;height: 25px !important;font-size: 12px;padding: 3px;" class="btn checkClass" pageTitle="Create Technical SR"
                                                   data-toggle="tooltip" data-placement="left"
                                                   title="Create Technical SR" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Create Technical SR</a>
                                                <!--<a type="button" class="btn btn-primary dynamicModal" pageTitle="Create Technical SR"
                                                   pageLink="{{URL::route('createSupportTicket')}}" data-toggle="tooltip" data-placement="left"
                                                   title="Create Technical SR" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Create Technical SR</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="1" id="chengeValue">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive" id="closeTicketList">
                                        <table id="datatable" class="table table-striped table-bordered dataTable"
                                               role="grid" aria-describedby="data-table-info" width="100%">
                                            <thead style="background-color: #0b58a2; color: white">
                                            <tr>
                                                <th>Sl</th>
                                                <th>Technical SR #</th>
                                                <th>Product</th>
                                                <th>Severity</th>
                                                <th>Contact</th>
                                                <th>Status</th>
                                                <th>Last Update</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $key=> $value)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>
                                                        <a style="color: #00b1ff" href="{{url('/getTicketDetailsInfo/'.$value->id)}}" class=" btn" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">{{$value->ticket_no}}</a>
                                                    </td>
                                                    <td>{{$value->module_name}}</td>
                                                    <td>{{$value->priorityName}}</td>
                                                    <td>
                                                        @if(!empty($value->contact_person))
                                                            @php
                                                                $contactPerson = DB::selectOne("select employee_name from npoly_employees where employee_id = $value->contact_person");
                                                                echo $contactPerson->employee_name;
                                                            @endphp
                                                        @endif
                                                    </td>
                                                    <td>{{$value->ticketStatus}}</td>
                                                    <td>@if(!empty($value->updated_at)){{date('d-M-Y h:i:A',strtotime($value->updated_at))}}@endif</td>
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
        $(document).ready(function() {
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert").slideUp(500);
            });
            setTimeout(function() {
                $("<div style='padding-left: 30px !important;'><i class='fa fa-file-text-o btn changeTicketInfo' style='padding-left: 30px !important; margin-top: 10px'></i></div>").insertAfter(".dataTables_length");
            }, 100);



        });

        $(document).on('click','.news',function (){
            $('.newsInfo').css('display','block')
            $('.dashboardInfo').css('display','none')
        });

        $(document).on('click','.changeTicketInfo',function (){
        var chengeValue = $('#chengeValue').val();
        if(chengeValue =='1'){
            $('#chengeValue').val(230);
            $.ajax({
                type: 'GET',
                url: '{{url("/getCloseTicket")}}/'+230,
                success: function (data) {

                    $('#closeTicketList').html(data);
                    $("#datatable").dataTable({
                        // ... skipped ...
                    });
                }
            });
        }else if(chengeValue =='230'){
            $('#chengeValue').val(1);
            $.ajax({
                type: 'GET',
                url: '{{url("/getCloseTicket")}}/'+238,
                success: function (data) {

                    $('#closeTicketList').html(data);
                    $("#datatable").dataTable({
                        // ... skipped ...
                    });
                }
            });
        }
        });




    </script>

@endsection
