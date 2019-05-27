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
            All USER GROUPS
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('_admin_/base') }}"><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">USER GROUPS</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title col-xs-6">USER GROUPS</h3>
                        @can('create', \Modules\Groups\Entities\Group::class)
                            <h3 class="col-xs-6 text-right">
                                <a href="{{ route('group.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus text-capitalize"> Create New </i>
                                </a>
                            </h3>
                        @endcan

                    </div>
                    <div class="box-body">
                        <table id="payments" class="table responsive">
                            <thead>
                            <tr>
                                @can('update', \Modules\Groups\Entities\Group::class)
                                    <th class="text-center"># Group</th>
                                @endcan
                                <th class="text-center">Name</th>
                                <th class="text-center">Slug</th>
                                <th class="text-center">Created At</th>
                                @can('update', \Modules\Groups\Entities\Group::class)
                                    <th class="text-center">Edit</th>
                                @endcan
                                @can('delete', \Modules\Groups\Entities\Group::class)
                                    <th class="text-center">Delete</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    @can('update', \Modules\Groups\Entities\Group::class)
                                        <td class="text-center"><a href="{{ route('group.edit',$group->id) }}">{{ $loop->iteration }}</a></td>
                                    @endcan
                                    <td class="text-center">{{ $group->name }}</td>
                                    <td class="text-center">{{ $group->slug }}</td>
                                    <td class="text-center">{{ $group->created_at->diffForHumans() }}</td>
                                    @can('update', \Modules\Groups\Entities\Group::class)
                                        <td class="text-center"><a href="{{ route('group.edit',$group->id) }}"
                                                                   class="btn btn-success btn-sm"><i
                                                        class="fa fa-edit text-capitalize"> Edit </i></a>
                                        </td>
                                    @endcan

                                    @can('delete', \Modules\Groups\Entities\Group::class)
                                        <td class="text-center">
                                            <div class="slab">
                                                <div class="controls">
                                                    <button class="btn btn-danger btn-sm remove"><i
                                                                class="fa fa-times"></i>
                                                    </button>
                                                    <div class="confirm">
                                                        <p>
                                                            Are you sure?
                                                        </p>
                                                        <button class="btn btn-primary btn-sm keep-button">No</button>
                                                        <a href="{{ route('group.delete',$group->id) }}"
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

