@extends('base::layouts.master')
@section('content')
    <section class="content-title">
        <h1>
            {{ isset($pump)? 'Edit Pump : ' . $pump->model : 'Add New Pump' }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{ url('_admin_/base') }}><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">{{ isset($pump)? 'Edit Pump '  : 'Add New Pump' }} </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title col-xs-6">{{ isset($pump)? 'Edit Pump : ' . $pump->model : 'Add New Pump' }} </h3>
                @if(isset($pump))
                    <h3 class="col-xs-6 text-right"><a href="{{ url('_admin_/pumps/add') }}"
                                                       class="btn btn-primary btn-sm"><i
                                class="fa fa-plus text-capitalize"> Create New </i></a></h3>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form enctype="multipart/form-data"
                      action="{{ isset($pump)? route('pump.update',$pump->id) : route('pump.store') }}" method="post">
                    <div class="col-md-8">
                        @csrf
                        {{ isset($pump)? method_field('patch') :'' }}
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Pump</label>
                                    <input class="form-control" placeholder="Pump Model"
                                           value="{{ empty(old('model'))? isset($pump)?$pump->model:''  : old('model') }}"
                                           id="model" name="model" type="text"/>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Motor</label>
                                    <input class="form-control" placeholder="Motor"
                                           value="{{ empty(old('motor'))? isset($pump)?$pump->motor:''  : old('motor') }}"
                                           id="motor" name="motor" type="text"/>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Number Of Stages</label>
                                    <input class="form-control" placeholder="stages"
                                           value="{{ empty(old('stages'))? isset($pump)?$pump->stages:''  : old('stages') }}"
                                           id="stages" name="stages" type="text"/>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Q Min</label>
                                    <input class="form-control" placeholder="Type Q Min"
                                           value="{{ empty(old('q_min'))? isset($pump)?$pump->q_min:''  : old('q_min') }}"
                                           id="q_min" name="q_min" type="text"/>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Q Max</label>
                                    <input class="form-control" placeholder="Type Q Max"
                                           value="{{ empty(old('q_max'))? isset($pump)?$pump->q_max:''  : old('q_max') }}"
                                           id="q_max" name="q_max" type="text"/>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>H Min</label>
                                    <input class="form-control" placeholder="Type H Min"
                                           value="{{ empty(old('h_min'))? isset($pump)?$pump->h_min:''  : old('h_min') }}"
                                           id="h_min" name="h_min" type="text"/>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>H Max</label>
                                    <input class="form-control" placeholder="Type H Max"
                                           value="{{ empty(old('h_max'))? isset($pump)?$pump->h_max:''  : old('h_max') }}"
                                           id="h_max" name="h_max" type="text"/>
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



                    </div>
                    <div class="col-md-4">
                    @foreach($medias as $media)
                            <div class="col-md-12" style="height: 50px">
                                <input type="checkbox" name="media[]" value="{{ $media->id }}" {{ array_search((string)$media->id,array_column($selectedPumps,'media_id')) !== false  ? 'checked' : ''  }}> {{ $media->name }}
                                <img src="{{  $media->image }}" alt="" class="member-online img-rounded"
                                     style="width: 30px;height: 30px;">
                                <input type="number" name="order[]"  style="height: 30px" value=""
                                       placeholder="Enter Order">

                            </div>

                        @endforeach

                    </div>
                </form>

            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /. main content -->
    <span class="return-up"><i class="fa fa-chevron-up"></i></span>

@stop
