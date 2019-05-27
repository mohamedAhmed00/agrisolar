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
            {{ isset($setting)? 'Edit Setting : ' . $setting->key : 'Add New Setting' }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{ url('_admin_/base') }}><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">{{ isset($setting)? 'Edit Setting : ' . $setting->key : 'Add New Setting' }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title">{{ isset($setting)? 'Edit Setting : ' . $setting->key : 'Add New Setting' }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="{{ isset($setting)? route('setting.update',$setting->id) : route('setting.store') }}" method="post">
                        @csrf
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Setting Title ( must be Unique ) </label>
                                    <input class="form-control" value="{{ empty(old('key'))? isset($setting)?$setting->key:''  : old('key') }}" placeholder="Type Setting key" id="key" name="key" type="text" />
                                </div>
                            </div>

                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Select Value Type : </label>
                                    <div>
                                        <label for="text">text</label>
                                        <input type="radio" id="text" class="select_type" name="type" value="text"   />
                                        OR
                                        <label for="image">image</label>
                                        <input type="radio" id="image" class="select_type" name="type" value="image"   />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="setting_type" value="" id="setting_type" >
                            <div class='col-md-12 text select_type_item hidden'>
                                <div class='form-group'>
                                    <label>Value</label>
                                    <input class="form-control" value="{{ empty(old('value'))? (!empty($setting) AND $setting->type == 'text')? $setting->value:''  : old('value') }}" id="Value" name="value" type="text" placeholder="Setting Value" />
                                </div>
                            </div>
                            <div class='form-group image select_type_item hidden'>
                                <div class="col-xs-6">
                                    <label>Upload image</label>
                                    <input type="file" name="value"  >
                                </div>
                                <div class="col-xs-6">
                                    <img class="member-online img-rounded" style="width: 100px;height: 100px;" src="{{ empty(old('value'))? isset($setting)?asset($setting->value):''  : old('value') }}" alt="Setting Image">
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
