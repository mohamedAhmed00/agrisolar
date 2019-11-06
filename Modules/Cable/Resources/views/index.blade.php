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
            All Cables
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('_admin_/base') }}"><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">Cables</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title col-xs-6">Cables</h3>
                        <h3 class="col-xs-6 text-right">
                            <a href="{{ url('_admin_/cable/add') }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus text-capitalize"> Create New </i></a>
                        </h3>
                    </div>
                    <div class="box-body">
                        <table id="payments" class="table responsive">
                            <thead>
                            <tr>
                                <th class="text-center"># Cable </th>
                                <th class="text-center">Motor Hp </th>
                                <th class="text-center">3x1.5 </th>
                                <th class="text-center">3x2.5 </th>
                                <th class="text-center">3x4 </th>
                                <th class="text-center">3x6 </th>
                                <th class="text-center">3x10 </th>
                                <th class="text-center">3x16 </th>
                                <th class="text-center">c_3x25 </th>
                                <th class="text-center">c_3x35 </th>
                                <th class="text-center">c_3x50 </th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Edit </th>
                                <th class="text-center">Delete </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cables as $cable)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('cable.edit',$cable->id) }}">{{ $loop->iteration }}</a>
                                    </td>
                                    <td class="text-center">{{ $cable->motor_hp }}</td>
                                    <td class="text-center">{{ $cable->c_3x1_5 }}</td>
                                    <td class="text-center">{{ $cable->c_3x2_5 }}</td>
                                    <td class="text-center">{{ $cable->c_3x4 }}</td>
                                    <td class="text-center">{{ $cable->c_3x6 }}</td>
                                    <td class="text-center">{{ $cable->c_3x10 }}</td>
                                    <td class="text-center">{{ $cable->c_3x16 }}</td>
                                    <td class="text-center">{{ $cable->c_3x25 }}</td>
                                    <td class="text-center">{{ $cable->c_3x35 }}</td>
                                    <td class="text-center">{{ $cable->c_3x50 }}</td>
                                    <td class="text-center">{{ $cable->created_at->diffForHumans() }}</td>
                                    <td class="text-center"><a href="{{ route('cable.edit',$cable->id) }}"
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
                                                    <a href="{{ route('cable.delete',$cable->id) }}"
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
