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
                <h3>{{$header['pageTitle']}}</h3>
              </div>
              <div class="title_right">
              <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                    <button type="button" class="btn btn-primary dynamicModal" pageTitle="Block Management" pageLink="{{URL::route('createBlock')}}" data-toggle="tooltip" data-placement="left" title="Add New Block" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add New</button>

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
                    <table id="" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                            <th class="center">#</th>
                            <th class="center">Logo</th>
                            <th class="center">Organization</th>
                            <th class="center">Status</th>
                            <th class="center">Group</th>
                            <th class="center">User</th>
                            <th class="center">Modules</th>
                            <th class="center">Pages</th>
                            </tr>
                          </thead>
                      <tbody>    
                        @php $sl=1@endphp
                      @foreach($organizations as $organization)
                        <tr>
                          <td>{{$sl}}ddd</td>                         
                          <td>{{$organization->ORG_NAME}}</td>                         
                          <td>{{$organization->ORG_NAME}}</td>                         
                          <td>{{$organization->ORG_NAME}}</td>                         
                          <td>
                          <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Crate Group" pageLink="{{url('/createGroup/'.$organization->org_id)}}"  data-modal-size="modal-xl"  data-toggle="tooltip" data-placement="top" title="Create Group" >
                          Create Group   
                        </i>
                          </button>

                          </td>                         
                          <td>
                          <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Create New" pageLink="{{url('/createUser/'.$organization->org_id)}}"  data-modal-size="modal-xl"  data-toggle="tooltip" data-placement="top" title="Create User" >
                           Create User
                          </button>
                          </td>                      
                          <td>
                          <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Module Manage" pageLink="{{url('/assignModul/'.$organization->org_id)}}" data-toggle="modal" data-modal-size="modal-xl"  data-placement="top" title="Assign Module" >
                          Assign Model
                          </button>
                        </td>    
                        <td>
                        <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Add Paage" pageLink="{{url('/addPage/'.$organization->org_id)}}"  data-modal-size="modal-xl"  data-toggle="tooltip" data-placement="top" title="Add Page" >
                           Add Page
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

<script>
var url = window.location;
const allLinks = document.querySelectorAll('.nav-item a');
const currentLink = [...allLinks].filter(e => {
  return e.href == url;
});

currentLink[0].classList.add("active")
currentLink[0].closest(".nav-treeview").style.display="block";

</script>

@endsection

