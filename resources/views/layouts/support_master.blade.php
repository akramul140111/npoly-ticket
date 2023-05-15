<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NPOLY</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('/images/Logo.png') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/nprogress/nprogress.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/iCheck/skins/flat/green.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" />
   <!-- JQVMap -->
   <link rel="stylesheet" href="{{ URL::asset('assets/vendors/jqvmap/dist/jqvmap.min.css') }}" />
    {{--Date Picker--}}
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/date-picker/jquery-ui.css') }}" />
{{--   <link rel="stylesheet" href="{{ URL::asset('assets/vendors/switchery/dist/switchery.min.css') }}" />--}}

    <!-- bootstrap-daterangepicker -->
    <!-- <link rel="stylesheet" href="{{ URL::asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" /> -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/datatables.net/1.10.25/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/datatables.net/dataTables.wrapper.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" />
    <!--<link rel="stylesheet" href="{{ URL::asset('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" />-->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="assets/vendors/r778/chosen/chosen.css"/>


    <link rel="stylesheet" href="{{ URL::asset('assets/build/css/custom.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/customize.css') }}" />
    <!-- PNotify -->
    <link rel="stylesheet"  href="{{ URL::asset('assets/vendors/pnotify/dist/pnotify.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/pnotify/dist/pnotify.buttons.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/pnotify/dist/pnotify.nonblock.css') }}" />
    <!-- Required Jquery -->
    <!-- calender css -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/fullcalendar/dist/fullcalendar.min.css') }}" />
{{--    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/fullcalendar/dist/fullcalendar.print.css') }}" />--}}
    <!-- calender css -->
    <!-- bootstrap-daterangepicker -->
    <link href="{{ URL::asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{{ URL::asset('assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/r778/chosen/chosen.jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/parsleyjs/dist/parsley.js') }}"></script>


    {{-- alertify --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/alertify/alertify.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('assets/alertify/default.min.css') }}"/>
    <script src="{{ URL::asset('assets/alertify/alertify.min.js') }}"></script>
    <script>
    //Turn on closable go to alertify.min.js, set closable:!0
    </script>

    {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
    {{--<link rel="stylesheet" href="/resources/demos/style.css">--}}

</head>
<body style="background: #eee">
    <div class="container body">
        <div class="top_nav">
            <div class="nav_menu">
                <nav class="nav navbar-nav" style="background: #ebf1f9">
                    <ul class=" navbar-right">
                        <a href="{{url('/support_home')}}">Dashboard</a>
                        <a style="padding-left: 20px !important;" href="{{url('/supportTicketInfo')}}">Service Request</a>
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
        @yield('content')
    </div>
    <!-- /compose -->
      <!-- Open Global modal-->
   <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div id="modalSize" class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel"></h4>
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <h4>Text in a modal</h4>
                      <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                      <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
            </div>
          </div>
          <!-- <script src="{{ URL::asset('assets/vendors/validator/multifield.js')}}"></script>
        <script src="{{ URL::asset('assets/vendors/validator/validator.js')}}"></script>
 -->
        <script>
        $(document).ready(function(){
          $('.dynamicModal').click(function(){
          var modal_size = $(this).attr('data-modal-size');
          if ( modal_size!=='' && typeof modal_size !== typeof undefined && modal_size !== false ) {
            $("#modalSize").addClass(modal_size);
          }
          else{
            $("#modalSize").addClass('modal-lg');

             }

           var pageTitle = $(this).attr('pageTitle');
           var pageLink = $(this).attr('pageLink');
           $('.modal .modal-title').html(pageTitle)
           $('.modal .modal-body').html("Content loading please wait......")
           $('.modal').modal("show");
           $('.modal .modal-body').load(pageLink)
          })
        })

          //   $(document).ready(function(){
          //   $(".dynamicModal").click(function(){
          //     var pageTitle = $(this).attr('pageTitle');
          //     var pageLink = $(this).attr('pageLink');
          //     $(".modal .modal-title").html(pageTitle);
          //     $(".modal .modal-body").html("Content loading please wait...");
          //     $(".modal").modal("show");
          //     $(".modal .modal-body").load(pageLink);
          //   });
          // });
  </script>

    <script type="text/javascript" src="{{ URL::asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/fastclick/lib/fastclick.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/nprogress/nprogress.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/skycons/skycons.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/Flot/jquery.flot.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/DateJS/build/date.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/moment/min/moment.min.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ URL::asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script> -->
    <!-- <script src="{{ URL::asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script> -->
    <script src="{{ URL::asset('assets/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js" integrity="sha512-9p/L4acAjbjIaaGXmZf0Q2bV42HetlCLbv8EP0z3rLbQED2TAFUlDvAezy7kumYqg5T8jHtDdlm1fgIsr5QzKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Datatables -->
    <script src="{{ URL::asset('assets/vendors/datatables.net/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/datatables.net-buttons/js/buttons.colVis.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

    <!-- Wizard -->
    <script src="{{ URL::asset('assets/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    <!-- Wizard -->
    <!-- Calender Events -->
    <script src="{{ URL::asset('assets/vendors/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <!-- Calender Events -->
    {{----}}
    {{--Date Picker Start--}}
    <script src="{{ URL::asset('assets/vendors/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ URL::asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="{{ URL::asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Theme Required + Custom -->
    <script type="text/javascript" src="{{ URL::asset('assets/build/js/custom.js') }}"></script>


    <!-- for text editor -->
{{--<script src="{{ URL::asset('assets/vendors/switchery/dist/switchery.min.js') }}"></script>--}}
{{--<script src="{{ URL::asset('assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>--}}
    {{--<script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>--}}

        <!-- PNotify -->
  <script src="{{ URL::asset('assets/vendors/pnotify/dist/pnotify.js') }}"></script>
  <script src="{{ URL::asset('assets/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
  <script src="{{ URL::asset('assets/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>
	<!--<script src="{{URL::asset('vali/dist/jquery.validate.js')}}"></script>-->

    {{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
    {{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}

<!--custom calender -->
    <script type="text/javascript" src="{{ URL::asset('assets/custom_js/customcalendar.js') }}"></script>
  </body>
