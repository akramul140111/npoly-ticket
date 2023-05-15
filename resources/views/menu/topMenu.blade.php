@include('layouts.modalFormSubmit')
@php $actionUrl=url('/saveTomMenuInformation'); @endphp

@extends('layouts.master')
@section('content')
<div class="" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>{{$header['pageTitle']}}</h3>
              </div>
              <div class="title_right">
              <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                    <button type="button" class="btn btn-primary dynamicModal" pageTitle="Top Menu" pageLink="{{URL::route('createTomMenuForm')}}" data-toggle="modal" data-target=".bs-example-modal-lg">Add New</button>
                    </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{$header['tableTitle']}} </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Menu</th>
                              <th>Menu Description</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                      <tbody>                      
                      @foreach($results as $key=>$result)                   
                        <tr>
                          <td>{{$key}}</td>
                          <td>{{$result->menu_name}}</td>
                          <td>{{$result->menu_description}}</td>
                          <td>
                          <button type="button" class="btn btn-primary dynamicModal" pageTitle="Top Menu" pageLink="{{route('editMenu', [$result->menu_id])}}" data-toggle="modal" data-target=".bs-example-modal-lg">Edit</button>
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