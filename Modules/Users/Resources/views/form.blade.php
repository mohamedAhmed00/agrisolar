@extends('base::layouts.master')
@section('content')
    <section class="content-title">
        <h1>
            {{ isset($user)? 'Edit User : ' . $user->name : 'Add New User' }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{ url('_admin_/base') }}><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">{{ isset($user)? 'Edit User '  : 'Add New User' }} </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title col-xs-6">{{ isset($user)? 'Edit User : ' . $user->name : 'Add New User' }} </h3>
                @if(isset($user))
                    <h3 class="col-xs-6 text-right"><a href="{{ url('_admin_/services/add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus text-capitalize"> Create New </i></a></h3>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                    <form  action="{{ isset($user)? route('user.update',$user->id) : route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ isset($user)? method_field('patch') :'' }}
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>User Name</label>
                                    <input class="form-control" placeholder="Type User Name" value="{{ empty(old('name'))? isset($user)?$user->name:''  : old('name') }}" id="title" name="name" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>User Email</label>
                                    <input class="form-control" placeholder="Type User Email" value="{{ empty(old('email'))? isset($user)?$user->email:''  : old('email') }}" id="title" name="email" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>User phone number</label>
                                    <input class="form-control" placeholder="Type User phone number" value="{{ empty(old('phone_number'))? isset($user)?$user->phone_number:''  : old('phone_number') }}" id="title" name="phone_number" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>User Password</label>
                                    <input class="form-control" placeholder="User password" id="title" name="password" type="password" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Confirm User Password</label>
                                    <input class="form-control" placeholder="Confirm User password" id="title" name="password_confirmation" type="password" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Choose Admin Group</label>
                                <select name="group_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    @forelse($groups as $group)
                                        <option value="{{ $group->id }}" selected="{{ empty(old('group_id'))? isset($user)? ($user->group_id == $group->id )? 'selected' : '' :''  : (old('group_id') == $group->id )? 'selected' : '' }}">{{ $group->name }}</option>
                                    @empty
                                        <option selected="selected">You must enter admin group before adding admin</option>


                                    @endforelse
                                </select>

                            </div>
                            <div class='form-group'>
                                <div class="col-xs-6">
                                    <label>Upload image</label>
                                    <input type="file" name="image">
                                </div>
                                <div class="col-xs-6">

                                    <img class="member-online img-rounded" style="width: 100px;height: 100px;" src="{{ asset(!empty($user->Image->image)?$user->Image->image:'') }}" alt="User Image">
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /. main content -->
    <span class="return-up"><i class="fa fa-chevron-up"></i></span>
@stop
