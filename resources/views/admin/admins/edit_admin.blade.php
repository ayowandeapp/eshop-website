@extends('layouts.adminLayout.admin_layout')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a href="#">Admins</a> <a href="#" class="current">Edit Admins/Sub Admins</a> </div>
        <h1>Admins</h1>
    </div>
    @if(Session::has('message_error'))
    <div class="alert alert-error alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{!! session('message_error') !!}</strong>
    </div>
    @endif
    @if(Session::has('message_success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{!! session('message_success') !!}</strong>
    </div>
    @endif
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Edit Admins/Sub Admins</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit-admin/'.$viewAdmin->id) }}" name="add_admins" id="add_admins" novalidate="novalidate"> {{ csrf_field() }}
                            <div id="fieldList">
                                <div class="control-group">
                                    <label class="control-label">Type</label>
                                    <div class="controls">
                                        <input type="text" name="type" id="type" value="{{ $viewAdmin->type }}" readonly >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Username</label>
                                    <div class="controls">
                                        <input type="text" name="username" id="username" readonly value="{{ $viewAdmin->username }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Password</label>
                                    <div class="controls">
                                        <input type="password" name="password" id="password" required>
                                    </div>
                                </div>
                                @if($viewAdmin->type == 'Sub Admin')
                                <div class="control-group" id="access">
                                    <label class="control-label">Access</label>
                                    <div class="controls">
                                        <input type="checkbox" name="categories_access" id="categories_access" value="1" style="margin-top: -3px;" @if($viewAdmin->categories_access == 1) checked @endif> &nbsp;Categories&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="products_access" id="products_access" value="1" style="margin-top: -3px;" @if($viewAdmin->products_access == 1) checked @endif> &nbsp;Products&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="orders_access" id="orders_access" value="1" style="margin-top: -3px;" @if($viewAdmin->orders_access == 1) checked @endif> &nbsp;Orders&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="users_access" id="users_access" value="1" style="margin-top: -3px;" @if($viewAdmin->users_access == 1) checked @endif> &nbsp;Users
                                    </div>
                                </div>
                                @endif
                                <div class="control-group">
                                    <label class="control-label">Enable</label>
                                    <div class="controls">
                                        <input type="checkbox" name="status" id="status" value="1" @if($viewAdmin->status == 1) checked @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <!-- <button id="addMore" class="btn btn-primary"> Add More Field</button> --> <input type="submit" value="Edit Admin" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection