@extends('layouts.frontLayout.front_layout')
@section('content')

<section>
<div class="container">
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
<div class="row">
<div class="col-sm-3">
    @include('layouts.frontLayout.front_sidebar')
</div>

<div class="col-sm-9 padding-right">
<?php echo $breadCrumb; ?>
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                <a href="{{ asset('/images/backend_images/products/large/'.$productDetails->image) }}">
                    <img style="width: 300px;" class="mainImage" src="{{ asset('/images/backend_images/products/medium/'.$productDetails->image) }}" alt="" />
                </a>
            </div>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active thumbnails">
                    <a href="{{ asset('/images/backend_images/products/large/'.$productDetails->image) }}" data-standard="{{ asset('/images/backend_images/products/small/'.$productDetails->image) }}">
                        <img class="changeImage" style="width: 80px; cursor: pointer;" src="{{ asset('/images/backend_images/products/small/'.$productDetails->image) }}" alt="">
                    </a>
                    @foreach($productAltImages as $img)
                    <a href="{{ asset('/images/backend_images/products/large/'.$img->image) }}" data-standard="{{ asset('/images/backend_images/products/small/'.$img->image) }}">
                        <img class="changeImage" style="width: 80px; cursor: pointer;" src="{{ asset('/images/backend_images/products/small/'.$img->image) }}" alt="">
                    </a>
                    @endforeach


                </div>
            </div>
            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>

    </div>
    <div class="col-sm-7">
        <form name="addtocartform" id="addtocartForm" action="{{ route('addtocart') }}" method="post"> {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
            <input type="hidden" name="product_name" value="{{ $productDetails->product_name }}">
            <input type="hidden" name="product_code" value="{{ $productDetails->product_code }}">
            <input type="hidden" name="product_color" value="{{ $productDetails->product_color }}">
            <input type="hidden" id="price" name="price" value="{{ $productDetails->price }}">
            <div class="product-information"><!--/product-information-->
                <img src="{{ asset('/images/frontend_images/product-details/new.jpg') }}" class="newarrival" alt="" />
                <h2>{{ $productDetails->product_name }}</h2>
                <p>Product Code: {{ $productDetails->product_code }}</p>
                <p>Product Color: {{ $productDetails->product_color }}</p>
                <p>
                    <select id="selSize" name="size" style="width: 150px" required="required">
                        <option value="">Select Size</option>
                        @foreach($productDetails->attributes as $sizes)
                        <option value="{{ $productDetails->id }}-{{ $sizes-> size }}"> {{ $sizes->size }}</option>
                        @endforeach
                    </select>
                </p>

                <img src="images/product-details/rating.png" alt="" />
								<span>
									<span id="getPrice"> #{{ $productDetails->price }}
                                        <br>
                                    <br>
                                    <p><?php
                                        use App\Currency;
                                        $price= Currency::getCurrencyRate($productDetails->price) ?>
                                        @foreach($price as $p)
                                        <h2>{{ $p }}</h2>
                                        @endforeach
                                        </p>

                                    </span>

									<label>Quantity:</label>
									<input type="text" name="quantity" value="1" />
                                    @if($total_stock> 0)
                                        <button id="cartButton" type="submit" class="btn btn-default cart" name="cartButton" value="shopping Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    Add to Cart
                                    </button>
                                    @endif

                                    <p>
                                        <button id="wishListButton" type="submit" class="btn btn-default cart" name="wishListButton"value="WishList">
                                            <i class="fa fa-briefcase"></i>
                                            Add to WishList
                                        </button>
                                    </p>

								</span>

                <p><b>Availability:</b> <span id="availability"> @if($total_stock> 0)In Stock @else Out of Stock @endif</span></p>
                <p><b>Condition:</b> New</p>
                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
            </div><!--/product-information-->
        </form>
    </div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li><a href="#description" data-toggle="tab">Description</a></li>
            <li><a href="#care" data-toggle="tab">Material & Care</a></li>
            <li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
            @if(!empty($productDetails->video))
            <li><a href="#video" data-toggle="tab">Product Video</a></li>
            @endif
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="description" >
            <div class="col-sm-12">
                <p>{{ $productDetails->description }}</p>
            </div>
        </div>
        <div class="tab-pane fade" id="care" >
            <div class="col-sm-12">
                <p>{{ $productDetails->care }}</p>
            </div>
        </div>
        <div class="tab-pane fade text-center" id="delivery">
            <div class="col-sm-12">
                <p>100% Original Products <br>
                Cash on Delivery
                </p>
            </div>
        </div>
        @if(!empty($productDetails->video))
        <div class="tab-pane fade text-center" id="video">
            <div class="col-sm-12">
                <video controls width="320" height="240">
                    <source src="{{ url('videos/'.$productDetails->video)}}" type="video/mp4">
                </video>

            </div>
        </div>
        @endif
    </div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php $count =1; ?>
            @foreach($relatedProducts->chunk(3) as $chunk)
            <div <?php if($count==1){?> class="item active" <?php } else { ?> class="item" <?php } ?>>
                @foreach($chunk as $item)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img style="width: 200px;" src="{{ asset('/images/backend_images/products/large/'.$item->image) }}" alt="" />
                                <h2>$ {{$item->price }}</h2>
                                <p>{{$item->product_name }}</p>
                                <a href="{{ route('productdetail.page', $item->id) }}">
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
            <?php $count++; ?>

        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div><!--/recommended_items-->

</div>
</div>
</div>
</section>


@endsection
