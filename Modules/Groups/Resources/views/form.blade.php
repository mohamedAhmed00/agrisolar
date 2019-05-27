@extends('base::layouts.master')
@section('content')
    <section class="content-title">
        <h1>
            {{ isset($group)? 'Edit Group : ' . $group->name : 'Add New Group' }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href={{ url('_admin_/base') }}><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="active">{{ isset($group)? 'Edit Group '  : 'Add New Group' }} </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-form">
            <div class="box-header">
                <h3 class="box-title col-xs-6">{{ isset($group)? 'Edit Group : ' . $group->name : 'Add New Group' }} </h3>
                @if(isset($group))
                    <h3 class="col-xs-6 text-right"><a href="{{ url('_admin_/group/add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus text-capitalize"> Create New </i></a></h3>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                    <form  action="{{ isset($group)? route('group.update',$group->id) : route('group.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ isset($group)? method_field('patch') :'' }}
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="name">Group Name</label>
                                    <input class="form-control" placeholder="Type Group Name" value="{{ empty(old('name'))? isset($group)?$group->name:''  : old('name') }}" id="name" name="name" type="text" />
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for="name">Redirect After Login</label>
                                    <select name="redirect" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option value="admin" {{ empty(old('redirect'))? isset($group)? ($group->redirect == 'admin' )? 'selected' : '' :''  : (old('redirect') == 'admin' )? 'selected' : '' }}>To Admin Dashboard</option>
                                        <option value="user" {{ empty(old('redirect'))? isset($group)? ($group->redirect == 'user' )? 'selected' : '' :''  : (old('redirect') == 'user' )? 'selected' : '' }}>To Public user Dashboard</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12" style="margin-bottom: 20px">
                                <div class="col-sm-4">module</div>
                                <div class="col-sm-2">show </div>
                                <div class="col-sm-2">create</div>
                                <div class="col-sm-2">edit</div>
                                <div class="col-sm-2">delete</div>
                            </div>
                            <div class="col-xs-12" style="margin-bottom: 20px">
                                <div class="col-sm-4">Pumps</div>
                                <div class="col-sm-2"><input type="checkbox" name="show_pump" value="true" {{ empty(old('show_pump'))? !empty($group->permission)? ($group->permission->show_pump == 'true')? 'checked' : '' :''  : 'checked' }} ></div>
                                <div class="col-sm-2"><input type="checkbox" name="create_pump" value="true" {{ empty(old('create_pump'))? !empty($group->permission)? ($group->permission->create_pump == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="edit_pump" value="true" {{ empty(old('edit_pump'))? !empty($group->permission)? ($group->permission->edit_pump == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="delete_pump" value="true" {{ empty(old('delete_pump'))? !empty($group->permission)? ($group->permission->delete_pump == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                            </div>
                            <div class="col-xs-12" style="margin-bottom: 20px">
                                <div class="col-sm-4">Pump Heights</div>
                                <div class="col-sm-2"><input type="checkbox" name="show_pump_height" value="true" {{ empty(old('show_pump_height'))? !empty($group->permission)? ($group->permission->show_pump_height == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="create_pump_height" value="true" {{ empty(old('create_pump_height'))? !empty($group->permission)? ($group->permission->create_pump_height == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="edit_pump_height" value="true" {{ empty(old('edit_pump_height'))? !empty($group->permission)? ($group->permission->edit_pump_height == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="delete_pump_height" value="true" {{ empty(old('delete_pump_height'))? !empty($group->permission)? ($group->permission->delete_pump_height == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                            </div>
                            <div class="col-xs-12" style="margin-bottom: 20px">
                                <div class="col-sm-4">Website Settings</div>
                                <div class="col-sm-2"><input type="checkbox" name="show_settings" value="true" {{ empty(old('show_settings'))? !empty($group->permission)? ($group->permission->show_settings == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="create_settings" value="true" {{ empty(old('create_settings'))? !empty($group->permission)? ($group->permission->create_settings == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="edit_settings" value="true" {{ empty(old('edit_settings'))? !empty($group->permission)? ($group->permission->edit_settings == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="delete_settings" value="true" {{ empty(old('delete_settings'))? !empty($group->permission)? ($group->permission->delete_settings == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                            </div>
                            <div class="col-xs-12" style="margin-bottom: 20px">
                                <div class="col-sm-4">USER GROUPS</div>
                                <div class="col-sm-2"><input type="checkbox" name="show_groups" value="true" {{ empty(old('show_groups'))? !empty($group->permission)? ($group->permission->show_groups == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="create_groups" value="true" {{ empty(old('create_groups'))? !empty($group->permission)? ($group->permission->create_groups == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="edit_groups" value="true" {{ empty(old('edit_groups'))? !empty($group->permission)? ($group->permission->edit_groups == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="delete_groups" value="true" {{ empty(old('delete_groups'))? !empty($group->permission)? ($group->permission->delete_groups == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                            </div>
                            <div class="col-xs-12" style="margin-bottom: 20px">
                                <div class="col-sm-4">Website Admin</div>
                                <div class="col-sm-2"><input type="checkbox" name="show_user" value="true" {{ empty(old('show_user'))? !empty($group->permission)? ($group->permission->show_user == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="create_user" value="true" {{ empty(old('create_user'))? !empty($group->permission)? ($group->permission->create_user == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="edit_user" value="true" {{ empty(old('edit_user'))? !empty($group->permission)? ($group->permission->edit_user == 'true')? 'checked' : '' :''  : 'checked' }}></div>
                                <div class="col-sm-2"><input type="checkbox" name="delete_user" value="true" {{ empty(old('delete_user'))? !empty($group->permission)? ($group->permission->delete_user == 'true')? 'checked' : '' :''  : 'checked' }}></div>
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
