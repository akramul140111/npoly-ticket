@extends('layouts.master') @section('content') @section('title') @endsection

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
                        <button type="button" class="btn btn-primary dynamicModal" pageTitle="Add Exam Marks Type Setup"
                            pageLink="{{URL::route('createExamMarksTypeSetup')}}" data-toggle="tooltip"
                            data-placement="left" title="Add New Exam Marks Type Setup"
                            data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add
                            New</button>

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
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </li>
                            <li>
                                <a class="close-link"></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable"
                                        class="table table-striped table-bordered custom-table-border">
                                        <thead>

                                            <tr>
                                                <th>Sl</th>
                                                <th>Exam Marks Type</th>
                                                <th>Description</th>
                                                <th>Criteria</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($examMarksTypes as $key => $examMarksType)
                                            <tr>

                                                <td>{{$key+1}}</td>
                                                <td>{{$examMarksType->exam}}</td>

                                                <td>{{$examMarksType->description}}</td>
                                                <td>
                                                    @if ($examMarksType->type==1)
                                                    <label class="" style="color:blue">Marks</label>
                                                    @else
                                                    <label class="" style="color:#fb07ff">Selection </label>
                                                    @endif
                                                </td>
                                                <td>@if ($examMarksType->active_status==1)
                                                    <label class="btn btn-success btn-sm">Active</label>
                                                    @else
                                                    <label class="btn btn-danger btn-sm">Inactive</label>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-info btn-sm dynamicModal"
                                                        pageTitle="Edit Exam Marks Type Setup"
                                                        pageLink="{{url('editMarksTypeSetup/'.$examMarksType->id)}}"
                                                        data-modal-size="modal-xl" data-toggle="tooltip"
                                                        data-placement="top" title="Edit  Exam Marks Type Setup">
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

@endsection
