@extends('layouts.adminLayout.admin_layout')
@section('content')
<div id="content" xmlns="http://www.w3.org/1999/html">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Edit Products</a> </div>
        <h1>Products</h1>
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
                        <h5>Edit Product</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ route('editbanner.page',$getBanner->id ) }}" name="edit_product" id="edit_product" novalidate="novalidate"> {{ csrf_field() }}

                            <div class="control-group">
                                <label class="control-label">Banner Title</label>
                                <div class="controls">
                                    <input type="text" name="title" id="title" value="{{ $getBanner->title }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Banner Link</label>
                                <div class="controls">
                                    <input type="text" name="link" id="link" value="{{ $getBanner->link }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Banner image</label>
                                <div class="controls">
                                    <input type="hidden" name="bcurrent_image" value="{{ $getBanner->image }}">
                                    <input type="file" name="bimage" id="image" value="{{ $getBanner->image }}">
                                    @if(!empty($getBanner->image))
                                    <img style="width: 40px;" src="{{ asset('/images/frontend_images/banners/'.$getBanner->image) }}" >
                                    | <a id="deleteproduct" href="{{ route('deletephoto.page', $getBanner->id) }}"> Delete</a>
                                    @endif

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" @if($getBanner->status == "1")checked @endif value="1">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Edit Product" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection