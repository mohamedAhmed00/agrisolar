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
            {{ isset($media)? 'Edit Media : ' . $media->key : 'Add New Media' }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{ url('_admin_/base') }}><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">{{ isset($media)? 'Edit Media : ' . $media->key : 'Add New Media' }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">{{ isset($media)? 'Edit Media : ' . $media->key : 'Add New Media' }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="{{ isset($media)? route('media.update',$media->id) : route('media.store') }}" method="post">
                        @csrf
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Media Title  </label>
                                    <input class="form-control" value="{{ empty(old('name'))? isset($media)?$media->name:''  : old('name') }}" placeholder="Media Name" id="name" name="name" type="text" />
                                </div>
                            </div>
                            <div class='form-group image select_type_item'>
                                <div class="col-xs-6">
                                    <label>Upload image</label>
                                    <input type="file" name="image"  >
                                </div>
                                <div class="col-xs-6">
                                    <img class="member-online img-rounded" style="width: 100px;height: 100px;" src="{{ empty(old('value'))? isset($media)?asset($media->value):''  : old('value') }}" alt="Media Image">
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
