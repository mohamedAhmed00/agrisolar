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
    <section class="login">
        <div class="container">
            <form class="col-md-8 m-auto" action="{{ url('login') }}" method="post">
                @csrf
                <h2 class="h2 text-capitalize text-success text-center font-weight-bold">welcome user</h2>
                <h4 class="h4 text-capitalize text-success text-center font-weight-bold">login to contine or
                    <a href="{{ url('/register') }}" class="register-new-account">register new account</a></h4>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="text-success">Email address</label>
                    <input type="email" name="email" class="form-control text-success" id="exampleInputEmail1"
                           aria-describedby="emailHelp"
                           placeholder="Enter email">
                </div>
                <div class="form-group ">
                    <label for="exampleInputPassword1" class="text-success">Password</label>
                    <input type="password" name="password" class="form-control text-success" id="exampleInputPassword1"
                           placeholder="Password">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input text-success text-capitalize" id="remember">
                    <label class="form-check-label text-success" for="remember">Remember Me</label>
                    <h6 class="h6 text-capitalize text-success font-weight-bold">if you dont have account ,
                        <a href="{{ url('/register') }}" class="register-new-account">please register one</a>
                    </h6>
                </div>
                <button type="submit" class="btn btn-success ">login</button>
            </form>
        </div>
    </section>
@stop
