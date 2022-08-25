@extends('layouts.adminLayout.admin_layout')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Products</a> </div>
        <h1>Product Alternate Images</h1>
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
                        <h5>Add Product Images</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ route('addimages.page', $productDetails->id) }}" name="add_image" id="add_image"> {{ csrf_field() }}
                            <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                            <div class="control-group">
                                <label class="control-label">Product Name</label>
                                <div class="controls">
                                    <strong>{{ $productDetails->product_name }}</strong>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Code</label>
                                <div class="controls">
                                    <strong>{{ $productDetails->product_code }}</strong>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Alternate Product image(s)</label>
                                <div class="controls">
                                    <input type="file" name="image[]" id="image" multiple="multiple">
                                </div>
                            </div>

                            <div class="form-actions">
                                <input type="submit" value="Add Images" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Product Images</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Image ID</th>
                                <th>Product ID</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="gradeX">
                                @foreach($productImages as $image)
                                <td>{{ $image->id }}</td>
                                <td>{{ $image->product_id }}</td>
                                <td>
                                    <img width="50px" src="{{ asset('/images/backend_images/products/small/'.$image->image) }}" >
                                </td>
                                <td class="center">
                                    <a id="deleteproduct" href="{{ route('deleteimages.page', $image->id) }}" class="btn btn-danger btn-mini">Delete</a></td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection