@extends('frontend::layouts.master')
@section('content')
    <header class="bg-success">
        <div class="container mb-4 mt-4">
            <div class="row">
                <div class="col-sm-5">
                    <a href="{{ url('dashboard') }}">
                        <h2 class="h2 text-white font-weight-bold text-capitalize">AgriSolar</h2>
                    </a>
                </div>
                <div class="col-sm-7">
                    <nav class="navbar navbar-expand-lg navbar-light bg-success">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ">
                                <li class="nav-item text-white">
                                    <a class="nav-link text-white text-capitalize" href="{{ url('logout') }}" tabindex="-1" aria-disabled="true">logout</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white text-capitalize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ auth()->user()->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item text-capitalize" href="{{ url('profile') }}">Profile</a>
                                    </div>
                                </li>
                                <li class="nav-item text-white">
                                    <a class="nav-link text-white text-capitalize" href="{{ url('dashboard') }}" tabindex="-1" aria-disabled="true">dashboard</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <section class="login pb-5 mb-5">
        <div class="container">
            <form class="col-md-8 m-auto" action="{{ url('editProfile') }}" method="post">
                @csrf
                <h2 class="h2 text-capitalize text-success text-center font-weight-bold">Edit Your Data</h2>
                <div class="form-group">
                    <label for="name" class="text-success text-capitalize">name</label>
                    <input type="text" name="name" value="{{ !empty(old('name'))? old('name'): auth()->user()->name }}" class="form-control text-success" id="name" aria-describedby="nameHelp" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="email" class="text-success text-capitalize">Email address</label>
                    <input type="email" name="email" value="{{  !empty(old('email'))? old('email'): auth()->user()->email }}" class="form-control text-success" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="phone_number" class="text-success text-capitalize">phone number</label>
                    <input type="text" name="phone_number" value="{{  !empty(old('phone_number'))? old('phone_number'): auth()->user()->phone_number  }}" class="form-control text-success" id="phone_number" aria-describedby="phoneNumberHelp" placeholder="Enter Phone Number">
                </div>
                <div class="form-group ">
                    <label for="password" class="text-success text-capitalize">Password</label>
                    <input type="password" name="password" class="form-control text-success" id="password" placeholder="Enter Password">
                </div>
                <div class="form-group ">
                    <label for="confirm_password" class="text-success text-capitalize">confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control text-success" id="confirm_password" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-success text-capitalize">Edit Profile</button>
            </form>
        </div>
    </section>
@stop
