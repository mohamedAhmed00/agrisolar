@extends('frontend::layouts.master')
@section('content')
    <header class="bg-success">
        <div class="container mb-4 mt-4">
            <div class="row">
                <div class="col-sm-5">
                    <h2 class="h2 text-white font-weight-bold">AgriSolar</h2>
                </div>
            </div>
        </div>
    </header>
    <section class="login pb-5 mb-5">
        <div class="container">
            <form class="col-md-8 m-auto" action="{{ url('register') }}" method="post">
                @csrf
                <h2 class="h2 text-capitalize text-success text-center font-weight-bold">welcome user</h2>
                <h4 class="h4 text-capitalize text-success text-center font-weight-bold">Register to contine or
                    <a href="{{ url('/') }}" class="register-new-account">login if you have account</a></h4>
                <div class="form-group">
                    <label for="name" class="text-success text-capitalize">name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control text-success" id="name" aria-describedby="nameHelp" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="email" class="text-success text-capitalize">Email address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control text-success" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="phone_number" class="text-success text-capitalize">phone number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control text-success" id="phone_number" aria-describedby="phoneNumberHelp" placeholder="Enter Phone Number">
                </div>
                <div class="form-group ">
                    <label for="password" class="text-success text-capitalize">Password</label>
                    <input type="password" name="password" class="form-control text-success" id="password" placeholder="Enter Password">
                </div>
                <div class="form-group ">
                    <label for="confirm_password" class="text-success text-capitalize">confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control text-success" id="confirm_password" placeholder="Confirm Password">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input text-success text-capitalize" id="remember">
                    <label class="form-check-label text-success" for="remember">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-success text-capitalize">Register</button>
            </form>
        </div>
    </section>
@stop
