@extends('base::layouts.master')
@section('content')
    <section class="content-title">
        <h1>
            {{ isset($module)? 'Edit Module : ' . $module->model : 'Add New Module' }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{ url('_admin_/base') }}><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">{{ isset($module)? 'Edit Module '  : 'Add New Module' }} </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title col-xs-6">{{ isset($module)? 'Edit Module : ' . $module->model : 'Add New Module' }} </h3>
                @if(isset($module))
                    <h3 class="col-xs-6 text-right"><a href="{{ url('_admin_/modules/add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus text-capitalize"> Create New </i></a></h3>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="{{ isset($module)? route('module.update',$module->id) : route('module.store') }}" method="post">
                        @csrf
                        {{ isset($module)? method_field('patch') :'' }}
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Module Name</label>
                                    <input class="form-control" placeholder="Module Name" value="{{ empty(old('name'))? isset($module)?$module->name:''  : old('name') }}" id="name" name="name" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Module Open Circuit Voltage ( VOC )</label>
                                    <input class="form-control" placeholder="Module VOC" value="{{ empty(old('voc'))? isset($module)?$module->voc:''  : old('voc') }}" id="voc" name="voc" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Module Voltage At Max Power point ( VMPP )</label>
                                    <input class="form-control" placeholder="Module Vmpp" value="{{ empty(old('vmpp'))? isset($module)?$module->vmpp:''  : old('vmpp') }}" id="vmpp" name="vmpp" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Module Power Max ( P )</label>
                                    <input class="form-control" placeholder="Module Power Max" value="{{ empty(old('power_max'))? isset($module)?$module->power_max:''  : old('power_max') }}" id="power_max" name="power_max" type="text" />
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
