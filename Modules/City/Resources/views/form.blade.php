@extends('base::layouts.master')
@section('content')
    <section class="content-title">
        <h1>
            {{ isset($city)? 'Edit City : ' . $city->model : 'Add New City' }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{ url('_admin_/base') }}><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">{{ isset($city)? 'Edit City '  : 'Add New City' }} </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title col-xs-6">{{ isset($city)? 'Edit City : ' . $city->model : 'Add New City' }} </h3>
                @if(isset($city))
                    <h3 class="col-xs-6 text-right"><a href="{{ url('_admin_/citys/add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus text-capitalize"> Create New </i></a></h3>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="{{ isset($city)? route('city.update',$city->id) : route('city.store') }}" method="post">
                        @csrf
                        {{ isset($city)? method_field('patch') :'' }}
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>City Name</label>
                                    <input class="form-control" placeholder="City Name" value="{{ empty(old('name'))? isset($city)?$city->name:''  : old('name') }}" id="name" name="name" type="text" />
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
