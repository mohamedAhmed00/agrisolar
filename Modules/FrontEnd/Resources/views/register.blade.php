{{--@extends('frontend::layouts.master')--}}
{{--@section('content')--}}
{{--    <header class="bg-success">--}}
{{--        <div class="container mb-4 mt-4">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-5">--}}
{{--                    <h2 class="h2 text-white font-weight-bold">AgriSolar</h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </header>--}}
{{--    <section class="login pb-5 mb-5">--}}
{{--        <div class="container">--}}
{{--            <form class="col-md-8 m-auto" action="{{ url('register') }}" method="post">--}}
{{--                @csrf--}}
{{--                <h2 class="h2 text-capitalize text-success text-center font-weight-bold">welcome user</h2>--}}
{{--                <h4 class="h4 text-capitalize text-success text-center font-weight-bold">Register to contine or--}}
{{--                    <a href="{{ url('/') }}" class="register-new-account">login if you have account</a></h4>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="name" class="text-success text-capitalize">name</label>--}}
{{--                    <input type="text" name="name" value="{{ old('name') }}" class="form-control text-success" id="name" aria-describedby="nameHelp" placeholder="Enter Name">--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="email" class="text-success text-capitalize">Email address</label>--}}
{{--                    <input type="email" name="email" value="{{ old('email') }}" class="form-control text-success" id="email" aria-describedby="emailHelp" placeholder="Enter Email">--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="phone_number" class="text-success text-capitalize">phone number</label>--}}
{{--                    <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control text-success" id="phone_number" aria-describedby="phoneNumberHelp" placeholder="Enter Phone Number">--}}
{{--                </div>--}}
{{--                <div class="form-group ">--}}
{{--                    <label for="password" class="text-success text-capitalize">Password</label>--}}
{{--                    <input type="password" name="password" class="form-control text-success" id="password" placeholder="Enter Password">--}}
{{--                </div>--}}
{{--                <div class="form-group ">--}}
{{--                    <label for="confirm_password" class="text-success text-capitalize">confirm Password</label>--}}
{{--                    <input type="password" name="password_confirmation" class="form-control text-success" id="confirm_password" placeholder="Confirm Password">--}}
{{--                </div>--}}
{{--                <div class="form-group form-check">--}}
{{--                    <input type="checkbox" class="form-check-input text-success text-capitalize" id="remember">--}}
{{--                    <label class="form-check-label text-success" for="remember">Remember Me</label>--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn btn-success text-capitalize">Register</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@stop--}}


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>login | Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="{{ asset('resources/img/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/iCheck/all.css') }}" />
    <link href="{{ asset('resources/icons/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/icons/themify-icons/themify-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('resources/css/main-style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/skins/all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/demo.css') }}">
    <style>
        .login-page .box-login, .register-page .box-register{
            width:600px !important;
        }
    </style>
</head>
<body class="skin-blue login-page">
<div class="box-login">
    <div class="box-login-body">
        <h3><span>Welcome To <b>Agrisolar </b></span></h3>
        <h5 class="text-center">please register to continue</h5>
        <form class="login-form" method="POST" action="{{ url('register') }}">
            @csrf

            <div class="form-group input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="name" placeholder=" write your Name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

            <div class="form-group input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input id="email" placeholder=" write your Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                <input id="phone_number" type="text" placeholder=" write your phone number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required autofocus>

                @if ($errors->has('phone_number'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password" type="password" placeholder=" write your password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password_confirmation" placeholder=" write your rewrite password" type="password" class="form-control" name="password_confirmation" required>

                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group input-group">
                <input type="checkbox" class="form-check-input text-success text-capitalize" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
                <h6 class="h6 text-capitalize font-weight-bold">if you have account ,
                    <a href="{{ url('/') }}" class="register-new-account">please login to continue</a>
                </h6>
            </div>

            <div class="form-group form-action">
                <button type="submit" class="btn btn-block btn-primary">Sign In</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal__flat_error" tabindex="-1" role="dialog" aria-labelledby="modal__flat_error" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body py-4">
                <p class="font-weight-semiBold"><i class="fa fa-check-circle mr-2"></i> Error </p>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                <div class="mt-2 text-right">
                    <button class="btn btn-primary btn-sm" data-dismiss="modal">Try Again</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="auth" tabindex="-1" role="dialog" aria-labelledby="auth" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body py-4">
                <p class="font-weight-semiBold"><i class="fa fa-check-circle mr-2"></i> Error </p>
                {{Session::get('unauth')}}
                <div class="mt-2 text-right">
                    <button class="btn btn-primary btn-sm" data-dismiss="modal">Try Again</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('resources/js/pages/jquery-icheck.js') }}"></script>
<script src="{{ asset('vendor/fastclick/fastclick.min.js') }}"></script>
<script src="{{ asset('resources/js/demo.js') }}"></script>

@if (Session::has('unauth'))
    <script>
        $('#auth').modal('show');
    </script>
@endif

@if ($errors->any())
    <script>
        $('#modal__flat_error').modal('show');
    </script>
@endif

</body>
</html>
