@extends('base::layouts.master')
@section('content')
    <section class="content-title">
        <h1>
            Add New Radiation To City [ {{ $city->name }} ] : Type ( {{ $type }} )
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{ url('_admin_/base') }}><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href={{ url('_admin_/radiation') }}><i class="fa fa-location-arrow"></i>{{ $city->name }}</a></li>
            <li class="active">{{ isset($radiation)? 'Edit Radiation '  : 'Add New Radiation' }} </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title col-xs-6"> Add New Radiation To City [ {{ $city->name }} ] : Type ( {{ $type }} ) </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="{{ route('radiation.store',[$city->id,$type]) }}" method="post">
                        @csrf
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="file_radiation">Upload Your Excel</label>
                                    <input class="form-control" value="{{ empty(old('name'))? isset($radiation)?$radiation->name:''  : old('name') }}"
                                           id="file_radiation" name="file_radiation" type="file" />
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
