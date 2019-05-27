@extends('base::layouts.master')
@section('content')
    <style>
        table span {
            font-size: 10px;
        }
        table *
        {
            text-align: center;
        }
    </style>
    <section class="content-title">
        <h1>
            All Pumps
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('_admin_/base') }}"><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">Pumps</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title col-xs-6">Pumps</h3>
                        @can('create', Modules\Pumps\Entities\Pump::class)
                            <h3 class="col-xs-6 text-right"><a href="{{ url('_admin_/pumps/add') }}"
                                                               class="btn btn-primary btn-sm"><i
                                            class="fa fa-plus text-capitalize"> Create New </i></a></h3>
                        @endcan

                    </div>
                    <div class="box-body">
                        <table id="payments" class="table responsive">
                            <thead>
                            <tr>
                                @can('update', Modules\Pumps\Entities\Pump::class)
                                    <th class="text-center"># Pump <br> <br> <span> </span></th>
                                @endcan
                                <th class="text-center">Model <br> <br> <span> </span></th>

                                <th class="text-center">Motor <br> <span> ( hp )</span></th>
                                <th class="text-center">No. of Stages <br> <br> <span> </span></th>
                                <th class="text-center">Q Min <br> <span> ( m<sup>3</sup> / hr )</span></th>
                                <th class="text-center">Q Max <br> <span> ( m<sup>3</sup> / hr )</span></th>
                                <th class="text-center">H Min <br> <span> ( m )</span></th>
                                <th class="text-center">H Max <br> <span> ( m )</span></th>
                                @can('view', Modules\Pumps\Entities\HeightPumps::class)
                                    <th class="text-center">+ Head <br> <br> <span> </span></th>
                                @endcan
                                <th class="text-center">Created At<br> <br> <span> </span></th>

                                @can('update', Modules\Pumps\Entities\Pump::class)
                                    <th class="text-center">Edit <br> <br> <span> </span></th>
                                @endcan
                                @can('delete', Modules\Pumps\Entities\Pump::class)
                                    <th class="text-center">Delete <br> <br> <span> </span></th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pumps as $pump)
                                <tr>
                                    @can('update', Modules\Pumps\Entities\Pump::class)
                                        <td class="text-center"><a
                                                    href="{{ route('pump.edit',$pump->id) }}">{{ $loop->iteration }}</a>
                                        </td>
                                    @endcan
                                    <td class="text-center">{{ $pump->model }}</td>
                                    <td class="text-center">{{ $pump->motor }}</td>
                                    <td class="text-center">{{ $pump->stages }}</td>
                                    <td class="text-center">{{ $pump->q_min }}</td>
                                    <td class="text-center">{{ $pump->q_max }}</td>
                                    <td class="text-center">{{ $pump->h_min }}</td>
                                    <td class="text-center">{{ $pump->h_max }}</td>
                                    @can('view', Modules\Pumps\Entities\HeightPumps::class)
                                        <td class="text-center"><a
                                                    href="{{ url('_admin_/pumps/add/height/' . $pump->id ) }}">+
                                                Head</a></td>

                                    @endcan
                                    <td class="text-center">{{ $pump->created_at->diffForHumans() }}</td>
                                    @can('update', Modules\Pumps\Entities\Pump::class)
                                        <td class="text-center"><a href="{{ route('pump.edit',$pump->id) }}"
                                                                   class="btn btn-success btn-sm"><i
                                                        class="fa fa-edit text-capitalize"> Edit </i></a></td>
                                    @endcan
                                    @can('delete', Modules\Pumps\Entities\Pump::class)
                                        <td class="text-center">
                                            <div class="slab">
                                                <div class="controls">
                                                    <button class="btn btn-danger btn-sm remove"><i
                                                                class="fa fa-times"></i></button>
                                                    <div class="confirm">
                                                        <p>
                                                            Are you sure?
                                                        </p>
                                                        <button class="btn btn-primary btn-sm keep-button">No</button>
                                                        <a href="{{ route('pump.delete',$pump->id) }}"
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
