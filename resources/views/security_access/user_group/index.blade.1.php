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
                        <button type="button" class="btn btn-primary btn-sm dynamicModal" pageTitle="Add New Group"
                            pageLink="{{URL::route('createGroup')}}" data-toggle="tooltip" data-placement="left"
                            title="Add New Group" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">Add
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
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <!-- start  accordion -->
                                <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel">

                                        @foreach($userGroups as $key => $userGroup)
                                        <button type="button" class="btn btn-danger btn-sm dynamicModal pull-right "
                                            pageTitle="Add User Group Level"
                                            pageLink="{{url('createLevel/'.$userGroup->USERGRP_ID)}}"
                                            data-toggle="tooltip" data-placement="left" title="Add New Group"
                                            data-target=".bs-example-modal-lg" style="margin-top: 10px;"
                                            data-modal-size="modal-xl">Add
                                            level
                                        </button>
                                        <a class="panel-heading" role="tab" id="heading{{$key+1}}"
                                            data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key+1}}"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <h4 class="panel-title">{{$key+1}}.{{$userGroup->USERGRP_NAME }}
                                            </h4>
                                        </a>
                                        <div class="panel">
                                            <div id="collapse{{$key+1}}" class="panel-collapse collapse in "
                                                role="tabpanel" aria-labelledby="heading{{$key+1}}">
                                                <div class="panel-body">


                                                    @foreach($user_group_levels as $key => $user_group_level)

                                                    @if($userGroup->USERGRP_ID == $user_group_level->USERGRP_ID)

                                                    <a class="list-group-item dynamicModal "
                                                        pageLink="{{url('/editLevel/'.$user_group_level->UG_LEVEL_ID)}}"
                                                        data-toggle="tooltip" data-placement="left"
                                                        title="Add New Group" data-target=".bs-example-modal-lg"
                                                        aria-controls="home">{{$key+1}}.{{$user_group_level->UGLEVE_NAME}}

                                                        <i class="fa fa-edit">
                                                        </i>
                                                    </a>

                                                    @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach


                                    </div>
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




<script>
    var url = window.location;
    const allLinks = document.querySelectorAll('.nav-item a');
    const currentLink = [...allLinks].filter(e => {
        return e.href == url;
    });

    currentLink[0].classList.add("active")
    currentLink[0].closest(".nav-treeview").style.display = "block";

</script>

@endsection
