@extends('base::layouts.master')
@section('content')
    <section class="content-title">
        <h1>
            {{ isset($cable)? 'Edit Cable : ' . $cable->model : 'Add New Cable' }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{ url('_admin_/base') }}><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">{{ isset($cable)? 'Edit Cable '  : 'Add New Cable' }} </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title col-xs-6">{{ isset($cable)? 'Edit Cable : ' . $cable->model : 'Add New Cable' }} </h3>
                @if(isset($cable))
                    <h3 class="col-xs-6 text-right"><a href="{{ url('_admin_/cables/add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus text-capitalize"> Create New </i></a></h3>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="{{ isset($cable)? route('cable.update',$cable->id) : route('cable.store') }}" method="post">
                        @csrf
                        {{ isset($cable)? method_field('patch') :'' }}
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>Cable Motor HP</label>
                                    <input class="form-control" placeholder="Cable Motor HP" value="{{ empty(old('motor_hp'))? isset($cable)?$cable->motor_hp:''  : old('motor_hp') }}" id="motor_hp" name="motor_hp" type="text" />
                                </div>
                            </div>


                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>3x1.5</label>
                                    <input class="form-control" placeholder="3x1.5" value="{{ empty(old('c_3x1_5'))? isset($cable)?$cable->c_3x1_5:''  : old('c_3x1-5') }}" id="c_3x1_5" name="c_3x1_5" type="text" />
                                </div>
                            </div>

                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>3x2.5</label>
                                    <input class="form-control" placeholder="3x2.5" value="{{ empty(old('c_3x2_5'))? isset($cable)?$cable->c_3x2_5:''  : old('c_3x2_5') }}" id="c_3x2_5" name="c_3x2_5" type="text" />
                                </div>
                            </div>


                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>3x4</label>
                                    <input class="form-control" placeholder="3x4" value="{{ empty(old('c_3x4'))? isset($cable)?$cable->c_3x4:''  : old('c_3x4') }}" id="c_3x4" name="c_3x4" type="text" />
                                </div>
                            </div>

                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>3x6</label>
                                    <input class="form-control" placeholder="3x6" value="{{ empty(old('c_3x6'))? isset($cable)?$cable->c_3x6:''  : old('c_3x6') }}" id="c_3x6" name="c_3x6" type="text" />
                                </div>
                            </div>


                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>3x10</label>
                                    <input class="form-control" placeholder="3x10" value="{{ empty(old('c_3x10'))? isset($cable)?$cable->c_3x10:''  : old('c_3x10') }}" id="c_3x10" name="c_3x10" type="text" />
                                </div>
                            </div>


                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>3x16</label>
                                    <input class="form-control" placeholder="3x16" value="{{ empty(old('c_3x16'))? isset($cable)?$cable->c_3x16:''  : old('c_3x16') }}" id="c_3x16" name="c_3x16" type="text" />
                                </div>
                            </div>


                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>3x25</label>
                                    <input class="form-control" placeholder="3x25" value="{{ empty(old('c_3x25'))? isset($cable)?$cable->c_3x25:''  : old('c_3x25') }}" id="c_3x25" name="c_3x25" type="text" />
                                </div>
                            </div>


                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>3x35</label>
                                    <input class="form-control" placeholder="3x35" value="{{ empty(old('c_3x35'))? isset($cable)?$cable->c_3x35:''  : old('c_3x35') }}" id="c_3x35" name="c_3x35" type="text" />
                                </div>
                            </div>


                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>3x50</label>
                                    <input class="form-control" placeholder="3x50" value="{{ empty(old('c_3x50'))? isset($cable)?$cable->c_3x50:''  : old('c_3x50') }}" id="c_3x50" name="c_3x50" type="text" />
                                </div>
                            </div>

                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>3x70</label>
                                    <input class="form-control" placeholder="3x70" value="{{ empty(old('c_3x70'))? isset($cable)?$cable->c_3x70:''  : old('c_3x70') }}" id="c_3x70" name="c_3x70" type="text" />
                                </div>
                            </div>

                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label>3x95</label>
                                    <input class="form-control" placeholder="3x95" value="{{ empty(old('c_3x95'))? isset($cable)?$cable->c_3x95:''  : old('c_3x95') }}" id="c_3x95" name="c_3x95" type="text" />
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
