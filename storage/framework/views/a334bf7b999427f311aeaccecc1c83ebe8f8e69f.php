<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <?php if(auth()->guard()->guest()): ?>
                <?php if(Route::has('login')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                </li>
                <?php endif; ?>

                <?php if(Route::has('register')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                </li>
                <?php endif; ?>
                <?php else: ?>

                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                        id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">

                       <?php if(Auth::user()->USERGRP_ID==3): ?>

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
                           <?php if(!empty($photo) && !empty($imgExist)): ?>
                           <img class="rounded-circle" src="<?php echo e(url('/uploads/student_information/'.$photo)); ?>">
                           <?php else: ?>
                           <img class="rounded-circle" src="<?php echo e(url('/common/user.jpg')); ?>">
                           <?php endif; ?>
                           <?php echo e($name); ?>

                       <?php else: ?> 
                               <?php
                                    $photo = Auth::user()->image;
                                    $imgExist = file_exists('public/uploads/teacher/'.$photo);
                               ?>
                            <?php if(!empty($photo) && !empty($imgExist)): ?>
                            <img class="rounded-circle" src="<?php echo e(url('/uploads/teacher/'.Auth::user()->image)); ?>">
                            <?php else: ?>
                            <img class="rounded-circle" src="<?php echo e(url('/common/user.jpg')); ?>">
                            <?php endif; ?>
                           <?php echo e(Auth::user()->name); ?>

                       <?php endif; ?>

                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <?php if(Auth::user()->USERGRP_ID==1): ?>
                        <button type="button" pageTitle="Teacher Profile"
                            class="btn btn-primary btn-sm dynamicModal dropdown-item" ria-labelledby="navbarDropdown"
                            pageLink="<?php echo e(url('/teacherProfile/')); ?>" data-modal-size="modal-lg" data-toggle="tooltip" id="profileBtn"
                            data-placement="top" title="">
                            Profile
                        </button>
                        <?php endif; ?>
                        <a style="margin-right: 16px;margin-top: 5px" class="dynamicModal dropdown-item" pagetitle="Change Password" pagelink="<?php echo e(route('changePassword')); ?>" data-toggle="tooltip" data-placement="left" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">
                            <?php echo e(__('Change Password')); ?>

                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                    <script>
                        $('#profileBtn').click(function(){
                           $('#modalSize').removeClass("modal-xl");
                        });
                    </script>
                </li>
                <?php endif; ?>

            </ul>
        </nav>
    </div>
</div>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/layouts/topNav.blade.php ENDPATH**/ ?>