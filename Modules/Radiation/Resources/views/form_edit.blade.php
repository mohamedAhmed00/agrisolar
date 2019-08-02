@extends('base::layouts.master')
@section('content')
    <section class="content-title">
        <h1>
            Edit Radiation To City [ {{ $city->name }} ] : Type ( {{ $type }} )
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{ url('_admin_/base') }}><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href={{ url('_admin_/radiation') }}><i class="fa fa-location-arrow"></i>{{ $city->name }}</a></li>
            <li class="active">{{  'Edit Radiation ' }} </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title col-xs-6">Edit Radiation To City [ {{ $city->name }} ] : Type ( {{ $type }} )</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="{{ route('radiation.update',[$radiation->id,$city->id,$type])  }}" method="post">
                        @csrf
                        {{ method_field('patch') }}
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="timing">Timing</label>
                                    <input class="form-control" placeholder="Timing" id="timing" name="timing" type="text" value="{{ empty(old('timing'))? isset($radiation)?$radiation->timing:''  : old('timing') }}" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="january">january</label>
                                    <input class="form-control" placeholder="january" id="january" name="january" type="text" value="{{ empty(old('january'))? isset($radiation)?$radiation->january:''  : old('january') }}" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="february">february</label>
                                    <input class="form-control" placeholder="february" id="february" name="february" type="text" value="{{ empty(old('february'))? isset($radiation)?$radiation->february:''  : old('february') }}" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="march">march</label>
                                    <input class="form-control" placeholder="march" id="march" name="march" type="text" value="{{ empty(old('march'))? isset($radiation)?$radiation->march:''  : old('march') }}" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="april">april</label>
                                    <input class="form-control" placeholder="april" id="april" name="april" type="text" value="{{ empty(old('april'))? isset($radiation)?$radiation->april:''  : old('april') }}" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="may">may</label>
                                    <input class="form-control" placeholder="may" id="may" name="may" type="text" value="{{ empty(old('may'))? isset($radiation)?$radiation->may:''  : old('may') }}" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="june">june</label>
                                    <input class="form-control" placeholder="june" id="june" name="june" type="text" value="{{ empty(old('june'))? isset($radiation)?$radiation->june:''  : old('june') }}" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="july">july</label>
                                    <input class="form-control" placeholder="july" id="july" name="july" type="text" value="{{ empty(old('july'))? isset($radiation)?$radiation->july:''  : old('july') }}" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="august">august</label>
                                    <input class="form-control" placeholder="august" id="august" name="august" type="text" value="{{ empty(old('august'))? isset($radiation)?$radiation->august:''  : old('august') }}" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="september">september</label>
                                    <input class="form-control" placeholder="september" id="september" name="september" type="text" value="{{ empty(old('september'))? isset($radiation)?$radiation->september:''  : old('september') }}" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="october">october</label>
                                    <input class="form-control" placeholder="october" id="october" name="october" type="text" value="{{ empty(old('october'))? isset($radiation)?$radiation->october:''  : old('october') }}" />
                                </div>
                            </div>

                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="november">november</label>
                                    <input class="form-control" placeholder="november" id="november" name="november" type="text" value="{{ empty(old('november'))? isset($radiation)?$radiation->november:''  : old('november') }}" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="december">december</label>
                                    <input class="form-control" placeholder="december" id="december" name="december" type="text" value="{{ empty(old('december'))? isset($radiation)?$radiation->december:''  : old('december') }}" />
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
