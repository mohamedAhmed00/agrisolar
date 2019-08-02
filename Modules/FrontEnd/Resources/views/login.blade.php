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
</head>
<body class="skin-blue login-page">
<div class="box-login">
    <div class="box-login-body">
        <h3><span>Welcome To <b>Agrisolar </b></span></h3>
        <h5 class="text-center">please login to continue</h5>
        <form class="login-form" method="POST" action="{{ url('login') }}">
            @csrf
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group input-group">
                <input type="checkbox" class="form-check-input text-success text-capitalize" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
                <h6 class="h6 text-capitalize font-weight-bold">if you dont have account ,
                    <a href="{{ url('/register') }}" class="register-new-account">please register one</a>
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
