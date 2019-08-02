@extends('frontend::layouts.master')
@section('content')
    <style>
        .skin-blue .left-side, .skin-blue .sidebar-left, .skin-blue .wrapper {
            background: #FFF;
        }
        .content-wrapper
        {
            margin: 0 !important;
        }
        .main-footer{
            margin: 0;
            position: fixed;
            bottom:0;
            width: 100%;
            text-align: center;
        }
        .login h2 {
            font-weight: bold;
            margin-top: 50px;
            margin-bottom: 30px;
            font-size: 24px;
        }
    </style>
    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <form class="col-md-8 " action="{{ url('editProfile') }}" method="post">
                    @csrf
                    <h2 class="h2 text-capitalize text-center font-weight-bold">Edit Your Data</h2>
                    <div class="form-group">
                        <label for="name" class="text-capitalize">name</label>
                        <input type="text" name="name" value="{{ !empty(old('name'))? old('name'): auth()->user()->name }}" class="form-control text-success" id="name" aria-describedby="nameHelp" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-capitalize">Email address</label>
                        <input type="email" name="email" value="{{  !empty(old('email'))? old('email'): auth()->user()->email }}" class="form-control text-success" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="text-capitalize">phone number</label>
                        <input type="text" name="phone_number" value="{{  !empty(old('phone_number'))? old('phone_number'): auth()->user()->phone_number  }}" class="form-control text-success" id="phone_number" aria-describedby="phoneNumberHelp" placeholder="Enter Phone Number">
                    </div>
                    <div class="form-group ">
                        <label for="password" class=" text-capitalize">Password</label>
                        <input type="password" name="password" class="form-control text-success" id="password" placeholder="Enter Password">
                    </div>
                    <div class="form-group ">
                        <label for="confirm_password" class=" text-capitalize">confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control text-success" id="confirm_password" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="btn btn-primary text-capitalize">Edit Profile</button>
                </form>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <strong>Copyright &copy; reserved at {{ date('Y',time()) }} to <a href="http://www.nevdia.com">nevdia.com</a>.</strong>
        <div class="pull-right hidden-xs"></div>
    </footer>
@stop
