@extends('base::layouts.master')

@section('content')
    <style>
        table span {
            font-size: 10px;
        }

        table * {
            text-align: center;
        }

        .table > thead > tr > th, .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            padding: 10px !important;
        }

        table {
            font-size: 12px;
        }
    </style>
    <section class="content-title">
        <h1>
            All Radiations For City ( {{ $city->name }} ) : Type ( {{ $type }} )
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('_admin_/base') }}"><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href={{ url('_admin_/city') }}><i class="fa fa-location-arrow"></i>{{ $city->name }}</a></li>
            <li class="active">Radiations</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title col-xs-6">Radiations For City ( {{ $city->name }} ) : Type ( {{ $type }}
                            )</h3>
                        @if($radiations->isEmpty())
                            <h3 class="col-xs-6 text-right">
                                <a href="{{ url('_admin_/radiation/add/'.$city->id . '/' . $type ) }}"
                                   class="btn btn-primary btn-sm"><i
                                        class="fa fa-plus text-capitalize"> Create New </i></a>
                            </h3>
                        @else
                            <div class="col-xs-6 text-right controls">
                                <button class="btn btn-danger btn-sm remove"><i
                                        class="fa fa-times"></i>Remove All</button>
                                <div class="confirm">
                                    <p>
                                        Are you sure?
                                    </p>
                                    <button class="btn btn-primary btn-sm keep-button">No</button>
                                    <a href="{{ route('radiation.delete.all',[$city->id,$type]) }}"
                                       class="btn btn-danger btn-sm"><i
                                            class="fa fa-remove text-capitalize"> Yes </i></a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="box-body">
                        <table id="payments" class="table responsive">
                            <thead>
                            <tr>
                                <th class="text-center"># Radiation</th>
                                <th class="text-center">Timing</th>
                                <th class="text-center">Jan</th>
                                <th class="text-center">Feb</th>
                                <th class="text-center">March</th>
                                <th class="text-center">April</th>
                                <th class="text-center">May</th>
                                <th class="text-center">June</th>
                                <th class="text-center">July</th>
                                <th class="text-center">Aug</th>
                                <th class="text-center">Sept</th>
                                <th class="text-center">Oct</th>
                                <th class="text-center">Nov</th>
                                <th class="text-center">Dec</th>
                                <th class="text-center">Average</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                                `
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($radiations as $radiation)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('radiation.edit',[$radiation->id,$city->id,$type]) }}">{{ $loop->iteration }}</a>
                                    </td>
                                    <td class="text-center">{{ $radiation->timing  }}</td>
                                    <td class="text-center">{{ $radiation->january }}</td>
                                    <td class="text-center">{{ $radiation->february }}</td>
                                    <td class="text-center">{{ $radiation->march }}</td>
                                    <td class="text-center">{{ $radiation->april }}</td>
                                    <td class="text-center">{{ $radiation->may }}</td>
                                    <td class="text-center">{{ $radiation->june }}</td>
                                    <td class="text-center">{{ $radiation->july }}</td>
                                    <td class="text-center">{{ $radiation->august }}</td>
                                    <td class="text-center">{{ $radiation->september }}</td>
                                    <td class="text-center">{{ $radiation->october }}</td>
                                    <td class="text-center">{{ $radiation->november }}</td>
                                    <td class="text-center">{{ $radiation->december }}</td>
                                    <td class="text-center">{{ $radiation->avg }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('radiation.edit',[$radiation->id,$city->id,$type]) }}"
                                           class="btn btn-success btn-sm">
                                            <i class="fa fa-edit text-capitalize"> Edit </i>
                                        </a>
                                    </td>
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
                                                    <a href="{{ route('radiation.delete',$radiation->id) }}"
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
