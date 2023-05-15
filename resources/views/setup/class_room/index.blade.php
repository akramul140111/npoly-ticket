@extends('layouts.master')

@section('content')
@section('title')
@endsection
<style>
ul li.active, a.active {
  color: #3fbbc0;
}
</style>
<div class="" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>{{$header['pageTitle']}} </h3>
              </div>
              <div class="title_right">
              <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                    <button type="button" class="btn btn-primary dynamicModal" pageTitle="Class Room Setup" pageLink="{{URL::route('createClassRoomSetup')}}" data-toggle="tooltip" data-placement="left" title="Add Class Room Setup" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add New</button>
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
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                     <table id="datatable" class="table table-striped table-bordered dataTable custom-table-border" role="grid" aria-describedby="data-table-info" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Course</th>
                              <th>Faculty</th>
                              <th>Department</th>
                              <th>Room No</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                      <tbody>
                        @php $sl=1@endphp
                      @foreach($results as $result)
                        <tr>
                          <td>{{$sl}}</td>
                          <td>{{$result->COURSE_TYPE}}</td>
                          <td>{{$result->DEPARTMENT}}</td>
                          <td>{{$result->COURSE_NAME}}</td>
                          <td>{{$result->room_no}}</td>
                          <td>{{$result->description}}</td>
                          <td>
                            @if ($result->active_status==1)
                            <label class="btn btn-success btn-sm">Active</label>
                            @else
                            <label class="btn btn-danger btn-sm">Inactive</label>
                            @endif
                          </td>
                          <td class="text-center">
                            <button type="button" class="btn btn-info btn-sm dynamicModal" pageTitle="Update Class Room Setup" pageLink="{{url('/updateClassRoomSetup/'.$result->id)}}" data-modal-size="modal-xl"  data-toggle="tooltip" data-placement="top" title="Update Class Room">
                              <i class="glyphicon glyphicon-edit"></i>
                            </button>
                          </td>
                        </tr>
                        @php $sl++;@endphp
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

