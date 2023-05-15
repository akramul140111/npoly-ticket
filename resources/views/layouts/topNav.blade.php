<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else

                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                        id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">

                       @if(Auth::user()->USERGRP_ID==3)

                           <?php // students name, photo
                               $name = '';
                               $photo = '';
                               $student_id = Auth::user()->student_id;
                               if(isset($student_id) && !empty($student_id)){
                                   $studentInfo = DB::table('stu_students_information')->where('student_id', $student_id)->first();
                                   if($studentInfo){
                                       $name = $studentInfo->students_name;
                                       $photo = $studentInfo->students_image;
                                   }
                               }
                               $imgExist = file_exists('public/uploads/student_information/'.$photo);
                           ?>
                           @if(!empty($photo) && !empty($imgExist))
                           <img class="rounded-circle" src="{{url('/uploads/student_information/'.$photo)}}">
                           @else
                           <img class="rounded-circle" src="{{url('/common/user.jpg')}}">
                           @endif
                           {{$name}}
                       @else {{-- Teacher/User --}}
                               <?php
                                    $photo = Auth::user()->image;
                                    $imgExist = file_exists('public/uploads/teacher/'.$photo);
                               ?>
                            @if(!empty($photo) && !empty($imgExist))
                            <img class="rounded-circle" src="{{url('/uploads/teacher/'.Auth::user()->image)}}">
                            @else
                            <img class="rounded-circle" src="{{url('/common/user.jpg')}}">
                            @endif
                           {{Auth::user()->name}}
                       @endif

                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->USERGRP_ID==1)
                        <button type="button" pageTitle="Teacher Profile"
                            class="btn btn-primary btn-sm dynamicModal dropdown-item" ria-labelledby="navbarDropdown"
                            pageLink="{{url('/teacherProfile/')}}" data-modal-size="modal-lg" data-toggle="tooltip" id="profileBtn"
                            data-placement="top" title="">
                            Profile
                        </button>
                        @endif
                        <a style="margin-right: 16px;margin-top: 5px" class="dynamicModal dropdown-item" pagetitle="Change Password" pagelink="{{ route('changePassword') }}" data-toggle="tooltip" data-placement="left" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">
                            {{ __('Change Password') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <script>
                        $('#profileBtn').click(function(){
                           $('#modalSize').removeClass("modal-xl");
                        });
                    </script>
                </li>
                @endguest

            </ul>
        </nav>
    </div>
</div>
