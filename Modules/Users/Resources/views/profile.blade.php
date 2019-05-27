@extends('base::layouts.master')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-widget widget-user">
                    <div class="widget-user-header"
                         style="background: url('{{ asset('resources/img/bg-profile.jpg') }}') center center;">
                        <h3 class="widget-user-username">{{ $user->name }}</h3>
                        <h5 class="widget-user-desc">{{ $user->email }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset(!empty($user->Image->image)?$user->Image->image:'') }}"
                             alt="User Image">
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Profile
                        </h3>
                    </div>
                    <div class="box-body">
                        <strong>Name</strong>
                        <p>{{ $user->name }}</p>
                        <strong>Email ID</strong>
                        <p>{{ $user->email }}</p>
                        <strong>Phone</strong>
                        <p>{{ $user->phone_number }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_2" data-toggle="tab">Update Your Profile</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_2">
                            <div class="box box-form no-shadow">
                                <div class="box-header">
                                    <h3 class="box-title">Your Information Information</h3>
                                </div>
                                <div class="box-body">
                                    <form action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('patch') }}
                                        <div class="col-md-12">
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label>Name</label>
                                                        <input class="form-control" id="first-name" name="name"
                                                               placeholder="Type User Name"
                                                               value="{{ empty(old('name'))? isset($user)?$user->name:''  : old('name') }}"
                                                               type="text"/>
                                                    </div>
                                                </div>

                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label>User Email</label>
                                                        <input class="form-control" placeholder="Type User Email"
                                                               value="{{ empty(old('email'))? isset($user)?$user->email:''  : old('email') }}"
                                                               id="title" name="email" type="text"/>
                                                    </div>
                                                </div>
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label>User phone number</label>
                                                        <input class="form-control" placeholder="Type User phone number"
                                                               value="{{ empty(old('phone_number'))? isset($user)?$user->phone_number:''  : old('phone_number') }}"
                                                               id="title" name="phone_number" type="text"/>
                                                    </div>
                                                </div>
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label>User Password</label>
                                                        <input class="form-control" placeholder="User password"
                                                               id="title"
                                                               name="password" type="password"/>
                                                    </div>
                                                </div>
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label>Confirm User Password</label>
                                                        <input class="form-control" placeholder="Confirm User password"
                                                               id="title" name="password_confirmation" type="password"/>
                                                    </div>
                                                </div>
                                                <div class='col-md-12' style="margin-bottom: 20px">
                                                    <div class='form-group'>
                                                        <div class="col-xs-6">
                                                            <label>Upload image</label>
                                                            <input type="file" name="image">
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <img class="member-online img-rounded"
                                                                 style="width: 100px;height: 100px;"
                                                                 src="{{ asset(!empty($user->Image->image)?$user->Image->image:'') }}"
                                                                 alt="User Image">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <span class="return-up"><i class="fa fa-chevron-up"></i></span>
@endsection
