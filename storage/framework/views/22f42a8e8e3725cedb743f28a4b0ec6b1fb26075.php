<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NPOLY | </title>
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
    .Password-from {
        color: white;
        background: #1032ba;
        background: -webkit-linear-gradient(to right, #556270, #122ebd);
        background: linear-gradient(to right, #556270, #183fca);
    }

</style>
<?php $actionUrl=url('/forgetPassword');
?>


<body class="reset Password-from">


    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card" style="background:#C2E0ED; color:black; ;margin-top: 40px">
                    <h1 style="text-align: center;font-size: 20px">NPOLY GROUP</h1>
                    <a href="#" class="site_title" style="text-align: center;margin-bottom: 30px;overflow:inherit ">
                        <img class="" height="150%"  src="<?php echo e(url('images/Logo.png')); ?>"></a>
                    <div class=""
                        style="text-align: center;font-size: 18px;background: #9CCDE3;border: 1px solid #38A5CC">
                        <?php echo e(__('Reset Password')); ?></div>

                    <div class="card-body">

                        <?php if(session('message')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('message')); ?>

                        </div>
                        <?php endif; ?>
                        <section>

                            <form method="POST" action="<?php echo e($actionUrl); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4  text-md-right"><strong><?php echo e(__('E-Mail Address')); ?></strong></label>

                                    <div class="col-md-6">
                                        <input id="email_address" type="email_address"
                                            class="form-control <?php $__errorArgs = ['email_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="email_address" value="<?php echo e(old('email_address')); ?>" required
                                            autocomplete="email_address" autofocus placeholder="i.e example@gmail.com">

                                        <?php $__errorArgs = ['email_address'];
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
                                </div>

                                <div class="form-group row mb-6">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary"
                                            style="background: #2E9BD6;border-radius: -10%;border: 0px;font-size: 14px">
                                            <span> <?php echo e(__('Send Password Reset Link')); ?></span>
                                        </button>
                                    </div>

                                </div>

                                <div class="col-md-6 offset-md-8">
                                    <?php if(Route::has('password.request')): ?>

                                    <a class="btn btn-link" style="color: #03a9f4; text-decoration: underline;"
                                        href="<?php echo e(route('login')); ?>">
                                        <?php echo e(('Back to login.')); ?>

                                    </a>
                                    <?php endif; ?>
                                </div>

                                <div class="clearfix"></div>
                                <div class="separator">


                                    <div style="text-align: center">

                                        <h1><i class="fa fa-pa"></i></h1>
                                        <p>©<?php echo e(date('Y')); ?> All Rights Reserved. NPOLY GROUP .</p>
                                    </div>
                                </div>
                            </form>
                        </section>

                    </div>
                </div>
            </div>

        </div>


    </div>


</body>

</html>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/customauth/passwords/email.blade.php ENDPATH**/ ?>