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

<body class="reset Password-from">


    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card"
                    style="background:white; color:black; border:8px solid white;border-radius: 15px; margin-top: 50px">
                    <div class="card-header" style="text-align: center;font-size: 20px">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <section>


                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf


                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-6">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary"
                                            style="background: linear-gradient(to right, #556270, #4ECDC4)">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="separator">


                                    <div style="text-align: center">
                                        <br>
                                        <h4> NPOLY </h4>

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
