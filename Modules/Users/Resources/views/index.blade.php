@extends('base::layouts.master')
@section('content')
    <style>
        table *
        {
            text-align: center;
        }
    </style>
    <section class="content-title">
        <h1>
            All Users
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('_admin_/base') }}"><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">Users</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title col-xs-6">Users</h3>
                        @can('create', \Modules\Users\Entities\User::class)
                            <h3 class="col-xs-6 text-right">
                                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus text-capitalize"> Create New </i>
                                </a>
                            </h3>
                        @endcan
                    </div>
                    <div class="box-body">
                        <table id="payments" class="table responsive">
                            <thead>
                            <tr>
                                @can('update', \Modules\Users\Entities\User::class)
                                    <th># User</th>
                                @endcan
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Image</th>
                                <th>Created At</th>
                                @can('update', \Modules\Users\Entities\User::class)
                                    <th>Edit</th>
                                @endcan
                                @can('delete', \Modules\Users\Entities\User::class)
                                    <th>Delete</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    @can('update', \Modules\Users\Entities\User::class)
                                        <td class="text-center"><a href="{{ route('user.edit',$user->id) }}">{{ $loop->iteration }}</a></td>
                                    @endcan
                                    <td>{{ $user->name }}</td>
                                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td class="text-center"><img
                                                src="{{ asset(!empty($user->Image->image)?$user->Image->image:'') }}"
                                                class="member-online img-rounded" style="width: 50px;height: 50px;"
                                                alt=""></td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    @can('update', \Modules\Users\Entities\User::class)
                                        <td class="text-center"><a href="{{ route('user.edit',$user->id) }}"
                                                                   class="btn btn-success btn-sm"><i
                                                        class="fa fa-edit text-capitalize"> Edit </i></a></td>
                                    @endcan
                                    @can('delete', \Modules\Users\Entities\User::class)
                                        <td class="text-center">
                                            <div class="slab">
                                                <div class="controls">
                                                    <button class="btn btn-danger btn-sm remove"><i class="fa fa-times"></i>
                                                    </button>
                                                    <div class="confirm">
                                                        <p>
                                                            Are you sure?
                                                        </p>
                                                        <button class="btn btn-primary btn-sm keep-button">No</button>
                                                        <a href="{{ route('user.delete',$user->id) }}"
                                                           class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-remove text-capitalize"> Yes </i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <span class="return-up"><i class="fa fa-chevron-up"></i></span>
@stop
