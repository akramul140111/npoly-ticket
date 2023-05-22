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
        background: #1032ba;
        background: -webkit-linear-gradient(to right, #556270, #122ebd);
        background: linear-gradient(to right, #556270, #183fca);
    }

</style>
@php $actionUrl=url('/forgetPassword');
@endphp


<body class="reset Password-from">


    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card" style="background:#C2E0ED; color:black; ;margin-top: 40px">
                    <h1 style="text-align: center;font-size: 20px">NPOLY GROUP</h1>
                    <a href="#" class="site_title" style="text-align: center;margin-bottom: 30px;overflow:inherit ">
                        <img class="" height="150%"  src="{{url('images/Logo.png')}}"></a>
                    <div class=""
                        style="text-align: center;font-size: 18px;background: #9CCDE3;border: 1px solid #38A5CC">
                        {{ __('Reset Password') }}</div>

                    <div class="card-body">

                        @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <section>

                            <form method="POST" action="{{ $actionUrl }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4  text-md-right"><strong>{{ __('E-Mail Address') }}</strong></label>

                                    <div class="col-md-6">
                                        <input id="email_address" type="email_address"
                                            class="form-control @error('email_address') is-invalid @enderror"
                                            name="email_address" value="{{ old('email_address') }}" required
                                            autocomplete="email_address" autofocus placeholder="i.e example@gmail.com">

                                        @error('email_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-6">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary"
                                            style="background: #2E9BD6;border-radius: -10%;border: 0px;font-size: 14px">
                                            <span> {{ __('Send Password Reset Link') }}</span>
                                        </button>
                                    </div>

                                </div>

                                <div class="col-md-6 offset-md-8">
                                    @if (Route::has('password.request'))

                                    <a class="btn btn-link" style="color: #03a9f4; text-decoration: underline;"
                                        href="{{ route('login') }}">
                                        {{('Back to login.') }}
                                    </a>
                                    @endif
                                </div>

                                <div class="clearfix"></div>
                                <div class="separator">


                                    <div style="text-align: center">

                                        <h1><i class="fa fa-pa"></i></h1>
                                        <p>©{{date('Y')}} All Rights Reserved. NPOLY GROUP .</p>
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
