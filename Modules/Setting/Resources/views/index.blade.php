@extends('base::layouts.master')
@section('content')
    <style>
        iframe{
            height: 100px !important;
            width: 100px !important;
        }
        table *
        {
            text-align: center;
        }
    </style>
    <section class="content-title">
        <h1>
            All Settings
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('_admin_/base') }}"><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">Settings</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title col-xs-6">Settings</h3>
                        @can('create', \Modules\Setting\Entities\Setting::class)
                            <h3 class="col-xs-6 text-right"><a href="{{ route('setting.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus text-capitalize"> Create New </i></a></h3>
                        @endcan
                    </div>
                    <div class="box-body">
                        <table id="payments" class="table responsive">
                            <thead>
                            <tr>
                                @can('update', \Modules\Setting\Entities\Setting::class)
                                    <th># Setting</th>
                                @endcan
                                <th>Key</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Created At
                                @can('update', \Modules\Setting\Entities\Setting::class)
                                    <th>Edit</th>
                                @endcan
                                @can('delete', \Modules\Setting\Entities\Setting::class)
                                    <th>Delete</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $setting)
                                    <tr>
                                        @can('update', \Modules\Setting\Entities\Setting::class)
                                            <td class="text-center"><a href="{{ route('setting.edit',$setting->id) }}">{{ $loop->iteration }}</a></td>
                                        @endcan
                                        <td>{{ $setting->key }}</td>
                                        <td>
                                            {!!  ($setting->type == 'text')?$setting->value: '<img src=" ' . $setting->value . '" alt="" class="member-online img-rounded" style="width: 50px;height: 50px;" >' !!}
                                        </td>
                                        <td>{{ $setting->type }}</td>
                                        <td>{{ $setting->created_at->diffForHumans() }}</td>
                                        @can('update', \Modules\Setting\Entities\Setting::class)
                                            <td class="text-center"><a href="{{ route('setting.edit',$setting->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit text-capitalize"> Edit </i></a></td>
                                        @endcan
                                        @can('delete', \Modules\Setting\Entities\Setting::class)
                                            <td class="text-center">
                                                <div class="slab">
                                                    <div class="controls">
                                                        <button class="btn btn-danger btn-sm remove"><i class="fa fa-times"></i></button>
                                                        <div class="confirm">
                                                            <p>
                                                                Are you sure?
                                                            </p>
                                                            <button class="btn btn-primary btn-sm keep-button">No</button>
                                                            <a href="{{ route('setting.delete',$setting->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-remove text-capitalize"> Yes </i></a>
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
