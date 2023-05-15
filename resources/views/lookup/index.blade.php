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
                <h3>{{$header['pageTitle']}}</h3>
            </div>
            <div class="title_right">
                <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                        <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Add Group"
                            pageLink="{{URL::route('createLookupGrpup')}}" data-toggle="tooltip" data-placement="left"
                            title="Add New Group" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add Group</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$header['tableTitle']}} </h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <!-- start  accordion -->
                                <div class="" id="accordion">
                                    @foreach( $lookupGroups as $key => $lookupGroup)
                                    <div class="panel-heading" style="background: #F2F5F7;
                                    padding: 13px;
                                    width: 100%;
                                    display: block; height:35px; padding-top:1px;">

                                        <div id="heading{{$key+1}}">
                                            <a style="text-decoration: none" class="panel-heading btn btn-link"
                                                role="tab" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapse{{$key+1}}" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <h4 class="panel-title">{{$key+1}}.{{$lookupGroup->LOOKUP_GRP_NAME}}
                                                </h4>
                                            </a>
                                        </div>
                                    </div>
                                    <hr style="margin-bottom: 0px;">
                                    <div id="collapse{{$key+1}}" class="panel-collapse collapse in "
                                        data-parent="#accordion" role="tabpanel" aria-labelledby="heading{{$key+1}}">

                                        <div class="panel">
                                            <table id="datatable"
                                                class="table table-striped table-bordered dataTable no-footer"
                                                role="grid" aria-describedby="datatable_info" width="100%"
                                                style="width: 100%;">
                                                <button style="margin-right: 16px;margin-top: 5px" type="button"
                                                    class="btn btn-danger btn-sm dynamicModal pull-right "
                                                    pageTitle="Add Group Item"
                                                    pageLink="{{url('createLookupGroupItem/'.$lookupGroup->LOOKUP_GRP_ID.'/'.$lookupGroup->USE_CHAR_NUMB)}}"
                                                    data-toggle="tooltip" data-placement="left" title="Add Group Item"
                                                    data-target=".bs-example-modal-lg" style="margin-top: 10px;"
                                                    data-modal-size="modal-xl">Add
                                                    More
                                                </button>
                                                <thead>
                                                    <tr>
                                                        <!-- <th>#</th> -->

                                                        <th>Item Name</th>
                                                        @if($lookupGroup->USE_CHAR_NUMB=='C')
                                                        <!-- <th>Short Name(C)</th> -->
                                                        @else
                                                        <!-- <th>Short Name(N)</th> -->
                                                        @endif
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($lookupGroupItems as $key => $lookupGroupItem)
                                                    @if($lookupGroup->LOOKUP_GRP_ID == $lookupGroupItem->LOOKUP_GRP_ID)
                                                    <tr>
                                                        <!-- <th>{{$key+1}}</th> -->

                                                        <td>{{$lookupGroupItem->LOOKUP_DATA_NAME}}</td>
                                                        @if($lookupGroup->USE_CHAR_NUMB=='C')
                                                        <!-- <td> {{$lookupGroupItem->CHAR_LOOKUP}}</td> -->
                                                        @else
                                                        <!-- <td> {{$lookupGroupItem->NUMB_LOOKUP}}</td> -->
                                                        @endif
                                                        <td>@if($lookupGroupItem->ACTIVE_FLAG==1)
                                                            <label>
                                                                <span class="btn btn-primary btn-sm">Active</span>
                                                            </label>
                                                            @else
                                                            <label>
                                                                <span class="btn btn-danger btn-sm">Inactive</span>
                                                            </label>
                                                            @endif</td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-info btn-sm dynamicModal"
                                                                pageTitle="Edit Group item"
                                                                pageLink="{{url('editLookupGroupItem/'.$lookupGroupItem->LOOKUP_DATA_ID.'/'.$lookupGroup->USE_CHAR_NUMB)}}"
                                                                data-modal-size="modal-xl" data-toggle="tooltip"
                                                                data-placement="top" title="Edit Group Item">
                                                                <i class="glyphicon glyphicon-edit"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- end of accordion -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
