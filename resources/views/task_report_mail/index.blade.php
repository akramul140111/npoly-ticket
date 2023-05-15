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
                <h3>{{$header['pageTitle']}} </h3>
            </div>
            <!-- USER LEVEL SUPERVISOR=10 WILL LOGIN -->
            {{-- @if(Auth::user()->USERLVL_ID==10) --}}
            <div class="title_right">
                <div class="item form-group">
                    <div class="col-md-3 col-sm-3 offset-md-9">
                        <button type="button" class="btn btn-primary dynamicModal" pageTitle="Add Task Mail"
                            pageLink="{{URL::route('createTaskMail')}}" data-toggle="tooltip" data-placement="left"
                            title="Add Task Mail" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add
                            New</button>
                    </div>
                </div>
            </div>
            {{-- @endif --}}
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="x_panel">
                    <div class="x_title" style="border:none;">
                        <h2>{{$header['tableTitle']}} </h2>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered dataTable"
                                        role="grid" aria-describedby="data-table-info" width="100%">
                                        <thead style="background-color: #0b58a2; color: white">
                                            <tr>
                                                <th>Sl</th>
                                                <th>Employee Name</th>
                                                <th>Report To</th>
                                                <th>CC Person</th>
                                                <th>BCC Person</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($results as $key=> $result)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$result->employee_name}}</td>
                                                <td>{{$result->report_to}}</td>
                                                <td>
                                                    @php
                                                    if(!empty($result->cc_to)){
                                                      $employeeName = DB::select("select employee_name from npoly_employees where employee_id in($result->cc_to)");
                                                     if(!empty($employeeName)){
                                                         $empsName = [];
                                                         foreach ($employeeName as $emp){
                                                             $empsName [] = $emp->employee_name;
                                                         }
                                                         $empName = implode(',',$empsName);
                                                         echo $empName;
                                                     }
                                                    }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        if(!empty($result->bcc_to)){
                                                          $employeeName = DB::select("select employee_name from npoly_employees where employee_id in($result->bcc_to)");
                                                         if(!empty($employeeName)){
                                                             $empsName = [];
                                                             foreach ($employeeName as $emp){
                                                                 $empsName [] = $emp->employee_name;
                                                             }
                                                             $empName = implode(',',$empsName);
                                                             echo $empName;
                                                         }
                                                        }
                                                    @endphp
                                                </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-sm dynamicModal"
                                                            pageTitle="Update Task Mail"
                                                            pageLink="{{url('/updateTaskMail/'.$result->task_mail_id)}}"
                                                            data-modal-size="modal-xl" data-toggle="tooltip"
                                                            data-placement="top" title="Update Task Mail">
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
