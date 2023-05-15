<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NPOLY</title>
    <link rel="icon" type="image/x-icon" href="<?php echo e(URL::asset('/images/Logo.png')); ?>">

    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/font-awesome/css/font-awesome.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/nprogress/nprogress.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/iCheck/skins/flat/green.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')); ?>" />
   <!-- JQVMap -->
   <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/jqvmap/dist/jqvmap.min.css')); ?>" />
    
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/date-picker/jquery-ui.css')); ?>" />


    <!-- bootstrap-daterangepicker -->
    <!-- <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')); ?>" /> -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')); ?>" />

    <!-- Datatables -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/datatables.net/1.10.25/css/jquery.dataTables.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/datatables.net/dataTables.wrapper.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>" />
    <!--<link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')); ?>" />-->
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="assets/vendors/r778/chosen/chosen.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/build/css/custom.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/customize.css')); ?>" />
    <!-- PNotify -->
    <link rel="stylesheet"  href="<?php echo e(URL::asset('assets/vendors/pnotify/dist/pnotify.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/pnotify/dist/pnotify.buttons.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/pnotify/dist/pnotify.nonblock.css')); ?>" />
    <!-- Required Jquery -->
    <!-- calender css -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/fullcalendar/dist/fullcalendar.min.css')); ?>" />

    <!-- calender css -->
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo e(URL::asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo e(URL::asset('assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')); ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/jquery/dist/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/r778/chosen/chosen.jquery.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/parsleyjs/dist/parsley.js')); ?>"></script>


    
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/alertify/alertify.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/alertify/default.min.css')); ?>"/>
    
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets2/vendors/themify-icons/css/themify-icons.css')); ?>" />
    <script src="<?php echo e(URL::asset('assets/alertify/alertify.min.js')); ?>"></script>
    <script>
    //Turn on closable go to alertify.min.js, set closable:!0
    </script>

    
    

</head>
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <!-- sidebar menu -->
              <?php echo $__env->make('layouts.leftSideBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                 <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                             <?php echo csrf_field(); ?>
              </form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
        <!-- top navigation -->
        <?php echo $__env->make('layouts.topNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
        <?php echo $__env->make('layouts.flashMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- <div class="flash-message"></div> -->
          <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
       <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- /footer content -->
      </div>
    </div>
    <!-- /compose -->
      <!-- Open Global modal-->
   <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div id="modalSize" class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #0b58a2;color: white;"style="background-color: #0b58a2;color: white;">
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
          <!-- <script src="<?php echo e(URL::asset('assets/vendors/validator/multifield.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('assets/vendors/validator/validator.js')); ?>"></script>
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

    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/fastclick/lib/fastclick.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/nprogress/nprogress.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/Chart.js/dist/Chart.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/gauge.js/dist/gauge.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/iCheck/icheck.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/skycons/skycons.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/Flot/jquery.flot.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/Flot/jquery.flot.pie.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/Flot/jquery.flot.time.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/Flot/jquery.flot.stack.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/Flot/jquery.flot.resize.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/flot-spline/js/jquery.flot.spline.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/flot.curvedlines/curvedLines.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/DateJS/build/date.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/jqvmap/dist/jquery.vmap.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/echarts/dist/echarts.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/moment/min/moment.min.js')); ?>"></script>
    <!-- <script type="text/javascript" src="<?php echo e(URL::asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script> -->
    <!-- <script src="<?php echo e(URL::asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')); ?>"></script> -->
    <script src="<?php echo e(URL::asset('assets/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')); ?>"></script>

    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js" integrity="sha512-9p/L4acAjbjIaaGXmZf0Q2bV42HetlCLbv8EP0z3rLbQED2TAFUlDvAezy7kumYqg5T8jHtDdlm1fgIsr5QzKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Datatables -->
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-buttons/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/datatables.net-buttons/js/buttons.colVis.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/jszip/dist/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/pdfmake/build/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/pdfmake/build/vfs_fonts.js')); ?>"></script>

    <!-- Wizard -->
    <script src="<?php echo e(URL::asset('assets/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')); ?>"></script>
    <!-- Wizard -->
    <!-- Calender Events -->
    <script src="<?php echo e(URL::asset('assets/vendors/fullcalendar/dist/fullcalendar.min.js')); ?>"></script>
    <!-- Calender Events -->
    
    
    <script src="<?php echo e(URL::asset('assets/vendors/date-picker/jquery-ui.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="<?php echo e(URL::asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')); ?>"></script>

    <!-- Theme Required + Custom -->
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/build/js/custom.js')); ?>"></script>


    <!-- for text editor -->


    

        <!-- PNotify -->
  <script src="<?php echo e(URL::asset('assets/vendors/pnotify/dist/pnotify.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('assets/vendors/pnotify/dist/pnotify.buttons.js')); ?>"></script>
  <script src="<?php echo e(URL::asset('assets/vendors/pnotify/dist/pnotify.nonblock.js')); ?>"></script>
	<!--<script src="<?php echo e(URL::asset('vali/dist/jquery.validate.js')); ?>"></script>-->

    
    

<!--custom calender -->
    <script type="text/javascript" src="<?php echo e(URL::asset('assets/custom_js/customcalendar.js')); ?>"></script>
  </body>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/layouts/master.blade.php ENDPATH**/ ?>