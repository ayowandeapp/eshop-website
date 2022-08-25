@extends('layouts.frontLayout.front_layout')
@section('content')
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($banners as $key => $banner)
                        <li data-target="#slider-carousel" data-slide-to="0" class="@if($key==0) active @endif"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($banners as $key => $banner)
                        <div class="item @if($key==0) active @endif">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>{{ $banner->title }}</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/frontend_images/banners/{{ $banner->image }}" class="girl img-responsive" alt="" />
                                <img src="{{ asset('images/frontend_images/banners/pricing.png') }}"  class="pricing" alt="" />
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<!--category sidebar-->
<section>
<div class="container">
<div class="row">
<div class="col-sm-3">
    @include('layouts.frontLayout.front_sidebar')
</div>

<div class="col-sm-9 padding-right">
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Featured Items</h2>
    @foreach($productAll as $product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{ asset('/images/backend_images/products/large/'.$product->image) }}" alt="" />
                    <h2>${{ $product->price }}</h2>
                    <p>{{ $product->product_name }}</p>
                    <a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h3>{{ $product->description }}</h3>
                        <h2>${{ $product->price }}</h2>
                        <p>{{ $product->product_name }}</p>
                        <a href="{{ url('/product/'.$product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
    <br>
    <div class="row">
        <div class="col-md-12">
            <div align="center">{{ $productAll->links() }}</div>
        </div>

    </div>
</div><!--features_items-->
</div>
</div>
</div>
</section>
@endsection