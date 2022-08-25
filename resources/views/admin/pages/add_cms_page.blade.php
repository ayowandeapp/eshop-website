@extends('layouts.adminLayout.admin_layout')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">CMS Pages</a> <a href="#" class="current">Add CMS Page</a> </div>
        <h1>CMS Pages</h1>
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
                        <h5>Add CMS Page</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/add-cms-page') }}" name="add_cms_page" id="add_cms_page" novalidate="novalidate"> {{ csrf_field() }}
                            <div class="control-group">
                                <label class="control-label">Title</label>
                                <div class="controls">
                                    <input type="text" name="title" id="title" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">CMS Page Url</label>
                                <div class="controls">
                                    <input type="text" name="url" id="url" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <textarea name="description" id="description" required></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">meta_title</label>
                                <div class="controls">
                                    <input type="text" name="meta_title" id="meta_title" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">meta_description</label>
                                <div class="controls">
                                    <input type="text" name="meta_description" id="meta_description">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">meta_keywords</label>
                                <div class="controls">
                                    <input type="text" name="meta_keywords" id="meta_keywords">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Enable</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value="1">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Add Cms Page" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection