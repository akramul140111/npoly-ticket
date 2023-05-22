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
<?php $actionUrl=url('/resetPassword');
?>

<body class="Password-from">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card"
                    style="background:white; color:black; border:8px solid white;border-radius: 15px; margin-top: 50px">
                    <a href="#" class="site_title" style="text-align: center;line-height:0px">
                        <img class="" height="100%" src="<?php echo e(url('images/Logo.png')); ?>"></a>
                    <div class="" style="text-align: center;font-size: 20px"><?php echo e(__('Reset Password')); ?></div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e($actionUrl); ?>">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="token" value="<?php echo e($token); ?>">

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                        required autocomplete="new-password">

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
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirm Password')); ?></label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary"
                                        style="background: linear-gradient(to right, #556270, #4ECDC4)">
                                        <?php echo e(__('Reset Password')); ?>

                                    </button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/customauth/passwords/reset.blade.php ENDPATH**/ ?>