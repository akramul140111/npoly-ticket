<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NPOLY</title>
    <link rel="icon" type="image/x-icon" href="<?php echo e(URL::asset('/images/Logo.png')); ?>">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/font-awesome/css/font-awesome.min.css')); ?>" />
    <!-- NProgress -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/nprogress/nprogress.css')); ?>" />
    <!-- Animate.css -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendors/animate.css/animate.min.css')); ?>" />
    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('assets/build/css/custom.min.css')); ?>" />
</head>
<style>
    @font-face {
        font-family: OpenSans-Regular;
        src: url(assets/css/fonts/OpenSans-Regular.ttf);
    }
    .login-from {
        color: white;
        background: #1032ba;
        background: -webkit-linear-gradient(to right, #556270, #122ebd);
        background: linear-gradient(to right, #556270, #183fca);
    }
    .site_title {
        text-overflow: ellipsis;
        overflow: inherit !important;
        font-weight: 400;
        font-size: 22px;
        width: 100%;
        color: #ECF0F1 !important;
        margin-left: 0 !important;
        line-height: 59px;
        display: block;
        height: 69px !important;
        margin: 0;
        padding-left: 10px;
    }
    body, .login_content h1{
        font-family: OpenSans-Regular;
    }
    .login_content{margin: 0 15px auto;}
    .login_content form input[type="text"], .login_content form input[type="email"], .login_content form input[type="password"]{
        border-radius: 3px;
        background-color: #efeded;
        border: none;
        box-shadow: none;
        margin:0 0 15px;
    }
    .login_content form input[type="text"]:focus, .login_content form input[type="email"]:focus, .login_content form input[type="password"]:focus{
        border: 1px solid #9E9EF7;
    }
    .btnBox{text-align: left;}
    .btnLogin{
        float: right;
        border: none;
        background: #7272fc;
        padding: 6px 22px;
        margin-right: 0px;
    }
    .btn-link{margin:initial; padding: 0 !important;font-size: 13px !important;text-decoration: auto;}


</style>

<body class="login login-from">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        <div class="login_wrapper">
            <div class="animate form login_form"
                style="background:white; color:black; border:8px solid white;border-radius: 15px;">
                <section class="login_content">
                    <h1>NPLOY GROUP</h1>
                    <a href="#" class="site_title">
                        <img class="" height="120%" src="<?php echo e(url('images/Logo.png')); ?>"></a>


                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <h1>Login</h1>
                        <?php if(session('message')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('message')); ?>

                        </div>
                        <?php endif; ?>
                       <?php if($errors->any()): ?>
                            <div>
                                <p class="alert alert-danger"> <?php echo e($errors->first()); ?></p>

                            </div>
                        <?php endif; ?>

                        <div>
                            <input id="email" type="text" placeholder="Username" required=""
                                class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <input id="password" type="password" placeholder="Password" required=""
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required
                                autocomplete="current-password">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="btnBox">
                            <?php if(Route::has('forgetPassword')): ?>

                            <a class="btn btn-link" href="<?php echo e(url('/forgetPassword')); ?>">
                                <?php echo e(__('Forgot Your Password?')); ?>

                            </a>
                            <?php endif; ?>

                            <button type="submit" class="btn btn-primary login-from btnLogin">
                                <?php echo e(__('Login')); ?> <i class="fa fa-arrow-circle-right"></i>
                            </button>
                            <div style="clear: both"></div>

                        </div>

                        <!-- <div class="clearfix"></div> -->
                        <div class="separator">
                            <!-- <p class="change_link">New to site?
                  <a href="<?php echo e(url('/register')); ?>" class="to_register" style="color:black"> Create Account </a>
                </p> -->
                            <!-- <div class="clearfix"></div> -->
                            <div>
                                <!-- <h1><i class="fa fa-pa"></i> </h1> -->
                                <p>©2023 All Rights Reserved. NPOLY .</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            <!-- <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <h1><i class="fa fa-paw"></i> BIRDEM </h1>
                            <p>©2021 All Rights Reserved. BIRDEM .</p>
                        </div>
            </div> -->

            <div></div>
            </form>
            </section>
        </div>
    </div>
    </div>
</body>

</html>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/auth/login.blade.php ENDPATH**/ ?>