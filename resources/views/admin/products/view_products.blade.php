@extends('layouts.adminLayout.admin_layout')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">View Products</a> </div>
        <h1>Products</h1>
    </div>
    <div class="container-fluid">
        <hr>
        @if(Session::has('message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{!! session('message_success') !!}</strong>
        </div>
        @endif
        <hr />
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Products</h5>
                    </div>

                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Product Color</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Featured Item</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="gradeX">
                                @foreach($products as $product)
                                <?php
                                $category_name = \App\Category::getCategoryName( $product->category_id );
                                ?>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->category_id }}</td>
                                <td>{{ $category_name }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_code }}</td>
                                <td>{{ $product->product_color }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    @if(!empty($product->image))
                                <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" >
                                    @endif
                                </td>
                                <td>
                                    @if($product->feature_item ==1)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </td>
                                <td class="center"><a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini" title="View Product">View</a> |
                                    <a href="{{ route('editproduct.page',$product->id) }} " class="btn btn-primary btn-mini" title="Edit Product">Edit</a> |
                                    <a href="{{ route('addattribute.page',$product->id) }} " class="btn btn-success btn-mini" title="Add Attributes">Add</a> |
                                    <a href="{{ route('addimages.page',$product->id) }}" class="btn btn-info btn-mini" title="Add Images">Add</a> |
                                    <a id="deleteproduct" href="{{ route('deleteproduct.page',$product->id) }}" class="btn btn-danger btn-mini" title="Delete Product">Delete</a></td>
                            </tr>
                                <div id="myModal{{ $product->id }}" class="modal hide">
                                    <div class="modal-header">
                                        <button data-dismiss="modal" class="close" type="button">×</button>
                                        <h3>{{ $product->product_name }} Full Details</h3>
                                    </div>
                                    <div class="modal-body">
                                        <p>Product ID: {{ $product->id }}</p>
                                        <p>Category ID: {{ $product->category_id }}</p>
                                        <p>Product Code: {{ $product->product_code }}</p>
                                        <p>Product Color: {{ $product->product_color }}</p>
                                        <p>Price: {{ $product->price }}</p>
                                        <p>Fabric: </p>
                                        <p>Material: </p>
                                        <p>Description: {{ $product->description }}</p>
                                    </div>
                                </div>
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
