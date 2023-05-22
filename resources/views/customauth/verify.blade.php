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
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <!-- NProgress -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/nprogress/nprogress.css') }}" />
    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/animate.css/animate.min.css') }}" />
    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="{{ URL::asset('assets/build/css/custom.min.css') }}" />
</head>
<style>
    .Password-from {
        color: white;
        background: #4ECDC4;
        background: -webkit-linear-gradient(to right, #556270, #4ECDC4);
        background: linear-gradient(to right, #556270, #4ECDC4);
    }

</style>
@php $actionUrl=url('/resetPassword/'.$token);
@endphp


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="text-align: center;line-height:0px">
                    <a href="#" class="site_title">
                        <img class="" style="height:50px !important;"
                            src="{{url('images/Logo.png')}}">
                    </a>
                </div>
                <div class="card-header" style="text-align: center">
                    <h1>{{ __('Password Reset') }}</h1>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    <div class="alert alert-success" role="alert" style="text-align: center;line-height: 0px">
                        {{ __('Hi, Dear Sir/Madam.') }}
                        <p>If you've lost your password or wish to reset it.
                            Use the link below to get started.
                            <br> <br> <a href="{{$actionUrl}}"
                                style="background:#2054e2;text-decoration:none !important; font-weight:700; margin-top:35px; color:#fff;text-transform:uppercase; font-size:12px;padding:26px;display:inline-block;border-radius:70px;">RESET
                                PASSWORD </a><br> <br>
                            If the link is not working, simply <a href="{{url('/forgetPassword')}}"> request a new
                                link.</a><br>If you didn't request a password reset,you can ignore this email.<br>Your
                            password will not be
                            changed.
                        </p>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
