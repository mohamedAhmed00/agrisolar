@extends('base::layouts.master')

@section('content')
    <style>
        table span {
            font-size: 10px;
        }

        table * {
            text-align: center;
        }

        .table>thead>tr>th,.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 10px  !important;
        }
    </style>
    <section class="content-title">
        <h1>
            All Cities
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('_admin_/base') }}"><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">Cities</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title col-xs-6">Modules</h3>
                        <h3 class="col-xs-6 text-right">
                            <a href="{{ url('_admin_/module/add') }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus text-capitalize"> Create New </i></a>
                        </h3>
                    </div>
                    <div class="box-body">
                        <table id="payments" class="table responsive">
                            <thead>
                            <tr>
                                <th class="text-center"># Module </th>
                                <th class="text-center">Name </th>
                                <th class="text-center">Open Circuit Voltage </th>
                                <th class="text-center">Voltage At Max Power point </th>
                                <th class="text-center">Power Max </th>
                                <th class="text-center">Edit </th>
                                <th class="text-center">Delete </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($modules as $module)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('module.edit',$module->id) }}">{{ $loop->iteration }}</a>
                                    </td>
                                    <td class="text-center">{{ $module->name }}</td>
                                    <td class="text-center">{{ $module->voc }}</td>
                                    <td class="text-center">{{ $module->vmpp }}</td>
                                    <td class="text-center">{{ $module->power_max }}</td>
                                    <td class="text-center"><a href="{{ route('module.edit',$module->id) }}"
                                                               class="btn btn-success btn-sm"><i
                                                class="fa fa-edit text-capitalize"> Edit </i></a></td>
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
                                                    <a href="{{ route('module.delete',$module->id) }}"
                                                       class="btn btn-danger btn-sm"><i
                                                            class="fa fa-remove text-capitalize"> Yes </i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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
