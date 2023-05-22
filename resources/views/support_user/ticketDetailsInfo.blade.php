@extends('layouts.support_master')
@php $actionUrl=url('/storeSupportTicketInfo'); @endphp
@section('content')
    @section('title')
    @endsection
    <style>
        .btnStyle{
            width: 100px;
            height: 18px;
            font-size: 12px;
            display: inline-block;
            float: left;
            padding: 0px;
            color: #003D5B;
            background-color: #d0d7e3;
        }
    </style>
    <div class="flash-message"></div>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #d7dde5">
                            <div class="col-md-12">
{{--                                <div class="" style="padding: 0px;">--}}
{{--                                    <sapn style="margin-left: -20px !important;font-size: 12px;color: #105886">Update</sapn>--}}
{{--                                </div>--}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4" style="display: inline-block;float: left">

                                           <span><span style="color: #c19751;">Last Updated</span> <span style="color: #003D5B">{{$lastUpdate}} ago</span></span>
                                        </div>
                                        <div style="display: inline-block;float: left">
                                            <button class="btn btn-info btnStyle dynamicModal" pageLink="{{url('/updateTicketDetails/'.$ticketDetails->id)}}" data-toggle="tooltip" data-placement="left" pageTitle="Update {{$ticketDetails->ticket_no}}" title="Update Details" data-target=".bs-example-modal-sm" data-modal-size="modal-lg">Add Update</button>
                                        </div>
                                        <div style="display: inline-block;float: left">
                                            <button class="btn btn-info btnStyle dynamicModal" pageLink="{{url('/updateTicketAttachment/'.$ticketDetails->id)}}" data-toggle="tooltip" data-placement="left" pageTitle="Update {{$ticketDetails->ticket_no}}" title="Update Attachment" data-target=".bs-example-modal-sm" data-modal-size="modal-lg">Add Attachment</button>
                                        </div>
                                        <div style="display: inline-block;float: left">
                                            <button class="btn btn-info btnStyle dynamicModal" pageLink="{{url('/updateCloseTicket/'.$ticketDetails->id)}}" data-toggle="tooltip" data-placement="left" pageTitle="Update {{$ticketDetails->ticket_no}}" title="Update Attachment" data-target=".bs-example-modal-sm" data-modal-size="modal-lg">Close SR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="background-color: #ebf1f9;height:78vh">
                            <div class="row newsInfo">

                                <div class="col-md-12">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <!-- <div class="col-md-3">
                    <div class="card">
                        <div class="card-header" style="background-color: #d7dde5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="" style="padding: 0px;">
                                            <sapn style="margin-left: -20px !important;font-size: 12px;color: #105886">Summery</sapn>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="background-color: #ebf1f9;height:78vh">
                            <div class="row dashboardInfo">
                                <div class="col-md-12">
                                    <div class="title_right">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div>
                                        <table style="font-size: 11px">
                                            <tr style="border-bottom-style: dotted;">
                                                <td style="text-align: right;color: #c19751;">Problem Description</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important; color: #00b1ff">One Period did not closed ..</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;color: #c19751;">Issue Type</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important;color: #003D5B;">Issue</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;color: #c19751;">Severity</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important;color: #003D5B;">3-Standard</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;color: #c19751;">Status</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important;color: #003D5B;">Review Update</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;color: #c19751;">Opened</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important;color: #003D5B;">13 days ago</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;color: #c19751;">Last Update</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important;color: #003D5B;">21 mins ago</td>
                                            </tr>
                                            <tr style="border-bottom-style: dotted;">
                                                <td style="text-align: right;color: #c19751;">Attachment</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important; color: #00b1ff">View(4)</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;color: #c19751;">Support Identifier</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important;color: #003D5B;">Identifier</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;color: #c19751;">Account Name</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important;color: #003D5B;">3-Standard</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;color: #c19751;">Primary Contact</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important;color: #003D5B;">Md.Azam Ali</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;color: #c19751;">Alternate Contact</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important;color: #003D5B;">Faysal Ahmed</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;color: #c19751;">System</td>
                                                <td></td>
                                                <td style="padding-left: 5px !important;color: #003D5B;">21 mins ago</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
@endsection

