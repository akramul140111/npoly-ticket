@extends('layouts.master')
@section('content')
  @include('layouts.modalFormSubmit')
<div class="" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>{{$header['pageTitle']}}</h3>
              </div>
              <div class="title_right">
              <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                    <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Sub Menu" pageLink="{{URL::route('createSubMenuForm')}}" data-toggle="modal" data-target=".bs-example-modal-lg">Add New</button>
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
                              <th>Submenu</th>
                              <th>Type</th>
                              <th>Description</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                      <tbody>                      
                      @foreach($results as $key=>$row)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>

                            {{$row->menu_name}}
                          </td>
                          <td>{{$row->sub_menu_name}}</td>
                          <td>{{$row->type_name}}</td>                          
                          <td>{{$row->menu_description}}</td>
                          <td>
                            <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Sub Menu" pageLink="{{route('editSubMenuForm', [$row->sub_menu_id])}}" data-toggle="modal" title="Update" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-edit"></i></button>
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