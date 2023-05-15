@extends('layouts.master')

@section('content')
@section('title')  
@endsection
<style>
ul li.active, a.active {
  color: #3fbbc0;
}
</style>
<link rel="stylesheet" href="{{URL::asset('assets/custom_css/admission_index_academic_officer.css')}}">
<div class="" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>{{$header['pageTitle']}} </h3>
              </div>
              <div class="title_right">
              <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                    <button type="button" class="btn btn-primary dynamicModal" pageTitle="Academic Calendar Setup" pageLink="{{URL::route('createAcademicCalendarSetup')}}" data-toggle="tooltip" data-placement="left" title="Academic Calendar Setup" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add New</button>
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
                     <table id="datatable" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="data-table-info" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Activity/Event Type</th>
                              <th>Topics</th>
                              <th>Description</th>
                              <th>Faculty</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                      <tbody> 
                        @php $sl=1@endphp
                      @foreach($results as $result)
                        <tr>
                          <td>{{$sl}}</td>                         
                          <td>{{$result->activity_name}}</td>        
                          <td>{{$result->topic}}</td>        
                          <td>{{$result->calendarTitile}}</td>
                          <td>{{$result->LOOKUP_DATA_NAME}}</td>
                          <td>{{($result->start)? date('d-m-Y', strtotime($result->start)):''}}</td> 
                          <td>{{($result->end)? date('d-m-Y', strtotime($result->end)):''}}</td>
                          <td>
                            @if ($result->active_status==1)
                            <label class="btn btn-success btn-sm">Active</label>
                            @else                            
                            <label class="btn btn-danger btn-sm">Inactive</label>
                            @endif
                          </td>  
                          <td class="text-center">
                            <button type="button" class="btn btn-info btn-sm dynamicModal" pageTitle="Update Activity Setup" pageLink="{{url('/updateAcademicCalendarSetup/'.$result->calenderId)}}" data-modal-size="modal-xl"  data-toggle="tooltip" data-placement="top" title="Update Event">
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

