@extends('layouts.adminLayout.admin_layout')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Products</a> </div>
        <h1>Product Attributes</h1>
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
                        <h5>Add Product Attributes</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ route('addattribute.page', $productDetails->id ) }}" name="add_attribute" id="add_attribute" > {{ csrf_field() }}
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
                                <label class="control-label">Product Color</label>
                                <div class="controls">
                                    <strong>{{ $productDetails->product_color }}</strong>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="field_wrapper">
                                    <div>
                                        <input required type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px;" />
                                        <input required type="text" name="size[]" id="size" placeholder="Size" style="width: 120px;" />
                                        <input required type="text" name="price[]" id="price" placeholder="Price" style="width: 120px;" />
                                        <input required type="text" name="stock[]" id="stock" placeholder="Stock" style="width: 120px;" />
                                        <a href="javascript:void(0);" class="add_button" title="Add-field">Add</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Add Attributes" class="btn btn-success">
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
                        <h5>View Products Attributes</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ route('editattribute.page', $productDetails->id) }}" name="edit_attribute" id="edit_attribute" > {{ csrf_field() }}
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Attribute ID</th>
                                    <th>SKU</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr class="gradeX">
                                    @foreach($productDetails['attributes'] as $attributes)
                                    <td><input type="hidden" name="idAttr[]" value="{{ $attributes->id }}"> {{ $attributes->id }}</td>
                                    <td>{{ $attributes->sku }}</td>
                                    <td>{{ $attributes->size }}</td>
                                    <td><input style="width: 100px;" type="text" name="price[]" value="{{ $attributes->price }}"></td>
                                    <td><input style="width: 100px;" type="text" name="stock[]" value="{{ $attributes->stock }}"></td>
                                    <td class="center">
                                        <input type="submit" value="Update" class="btn btn-primary btn-mini">
                                        <a id="deleteattribute" href="{{ route('deleteproductattribute.page', $attributes->id) }}" class="btn btn-danger btn-mini">Delete</a>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection