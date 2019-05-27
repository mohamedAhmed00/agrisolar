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
            Welcome to Dashboard
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i>Dashboard</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <i class="fa fa-bookmark text-navy"></i>
                        <div class="text-center value">0</div>
                        <div class="text-muted text-uppercase text-center text-bold">All Products</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <i class="fa fa-user text-light-blue"></i>
                        <div class="text-center value">0</div>
                        <div class="text-muted text-uppercase text-center text-bold">All Admin</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <i class="fa fa-envelope-o text-maroon"></i>
                        <div class="text-center value">0</div>
                        <div class="text-muted text-uppercase text-center text-bold">All Message</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <i class="fa fa-envelope-open-o text-green"></i>
                        <div class="text-center value">2</div>
                        <div class="text-muted text-uppercase text-center text-bold">All Unread Message</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">website traffic</h3>
                <div class="box-tools pull-right">
                    <a href="#" class=" btn-box-tool">View all</a>
                </div>
            </div>
            <div class="box-body">
                <canvas id="myChart" style="display: block; width: 1200px; height: 280px;" width="1200" height="280"></canvas>
            </div>
        </div>
        @can('view', \Modules\Users\Entities\User::class)
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Users List</h3>
                    <div class="box-tools pull-right">
                        <a href="#" class=" btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class=" btn-box-tool">View all</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
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
                                    <td class="text-center"><img src="{{ asset(!empty($user->Image->image)?$user->Image->image:'') }}" class="member-online img-rounded" style="width: 50px;height: 50px;" alt=""></td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        @endcan

    </section>
    <span class="return-up"><i class="fa fa-chevron-up"></i></span>
@stop
