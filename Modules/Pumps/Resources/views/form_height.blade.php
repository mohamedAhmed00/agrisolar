@extends('base::layouts.master')
@section('content')
    <section class="content-title">
        <h1>
            {{ isset($pumpHeight)? 'Edit Pump Head For ' . $pump->model  : 'Add New Pump Head For ' . $pump->model }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{ url('_admin_/base') }}><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="{{ url('_admin_/pumps') }}"><i class="fa fa-power-off"></i>Pumps</a></li>
            <li class="active">{{ isset($pumpHeight)? 'Edit Pump Height For ' . $pump->model  : 'Add New Pump Head For ' . $pump->model }} </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title col-xs-6">{{ isset($pumpHeight)? 'Edit Pump Head For ' . $pump->model  : 'Add New Pump Head For  ' . $pump->model }} </h3>
                @if(isset($pumpHeight))
                    <h3 class="col-xs-6 text-right"><a href="{{ url('_admin_/pumps/add/height/add/'.$pump->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus text-capitalize"> Create New </i></a></h3>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="{{ isset($pumpHeight)? route('HeightPumps.update',[$pumpHeight->id,$pump->id]) : route('HeightPumps.store',$pump->id) }}" method="post">
                        @csrf
                        {{ isset($pumpHeight)? method_field('patch') :'' }}
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Head</label>
                                    <input class="form-control" placeholder="Type Head" value="{{ empty(old('head'))? isset($pumpHeight)?$pumpHeight->head:''  : old('head') }}" id="head" name="head" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>C0</label>
                                    <input class="form-control" placeholder="Type C0" value="{{ empty(old('c0'))? isset($pumpHeight)?$pumpHeight->c0:''  : old('c0') }}" id="c0" name="c0" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>C1</label>
                                    <input class="form-control" placeholder="Type C1" value="{{ empty(old('c1'))? isset($pumpHeight)?$pumpHeight->c1:''  : old('c1') }}" id="c1" name="c1" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>C2</label>
                                    <input class="form-control" placeholder="Type C2" value="{{ empty(old('c2'))? isset($pumpHeight)?$pumpHeight->c2:''  : old('c2') }}" id="c2" name="c2" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>C3</label>
                                    <input class="form-control" placeholder="Type C3" value="{{ empty(old('c3'))? isset($pumpHeight)?$pumpHeight->c3:''  : old('c3') }}" id="c3" name="c3" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>C4</label>
                                    <input class="form-control" placeholder="Type C4" value="{{ empty(old('c4'))? isset($pumpHeight)?$pumpHeight->c4:''  : old('c4') }}" id="c4" name="c4" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>C5</label>
                                    <input class="form-control" placeholder="Type C5" value="{{ empty(old('c5'))? isset($pumpHeight)?$pumpHeight->c5:''  : old('c5') }}" id="c5" name="c5" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Q Min</label>
                                    <input class="form-control" placeholder="Type Q Min" value="{{ empty(old('q_min'))? isset($pumpHeight)?$pumpHeight->q_min:''  : old('q_min') }}" id="q_min" name="q_min" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Q Max</label>
                                    <input class="form-control" placeholder="Type Q Max" value="{{ empty(old('q_max'))? isset($pumpHeight)?$pumpHeight->q_max:''  : old('q_max') }}" id="q_max" name="q_max" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>P Min</label>
                                    <input class="form-control" placeholder="Type P Min" value="{{ empty(old('p_min'))? isset($pumpHeight)?$pumpHeight->p_min:''  : old('p_min') }}" id="p_min" name="p_min" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>P Max</label>
                                    <input class="form-control" placeholder="Type P Max" value="{{ empty(old('p_max'))? isset($pumpHeight)?$pumpHeight->p_max:''  : old('p_max') }}" id="p_max" name="p_max" type="text" />
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
