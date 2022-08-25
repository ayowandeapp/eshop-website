@extends('layouts.adminLayout.admin_layout')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">Edit Category</a> </div>
        <h1>Categories</h1>
    </div>
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Edit Category</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{ route('editcategory.page', $categoryDetail->id) }}" name="edit_category" id="edit_category" novalidate="novalidate"> {{ csrf_field() }}
                            <div class="control-group">
                                <label class="control-label">Category Name</label>
                                <div class="controls">
                                    <input type="text" name="category_name" id="category_name" value="{{ $categoryDetail->name }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Category Level</label>
                                <div class="controls">
                                    <select name="parent_id" style="width: 220px">
                                        <option value="0">Main Category</option>
                                        @foreach($level as $val)
                                        <option value="{{ $val->id }}" @if($val->id == $categoryDetail->parent_id) selected @endif>{{ $val->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <textarea name="description" id="description">{{ $categoryDetail->description }}</textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Url</label>
                                <div class="controls">
                                    <input type="text" name="url" id="url" value="{{ $categoryDetail->url }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">meta_title</label>
                                <div class="controls">
                                    <input type="text" name="meta_title" id="meta_title" value="{{ $categoryDetail->meta_title }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">meta_description</label>
                                <div class="controls">
                                    <input type="text" name="meta_description" id="meta_description" value="{{ $categoryDetail->meta_description }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">meta_keywords</label>
                                <div class="controls">
                                    <input type="text" name="meta_keywords" id="meta_keywords" value="{{ $categoryDetail->meta_keywords }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Enable</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value ="1" @if($categoryDetail->status = '1') checked @endif >
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Edit Category" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection