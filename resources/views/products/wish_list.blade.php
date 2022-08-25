<?php// use Illuminate\Support\Facades\Session;?>
@extends('layouts.frontLayout.front_layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Wish List</li>
            </ol>
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

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <?php $total_amount = 0; ?>
                @foreach($getWishList as $wishList)
                <tr>
                    <td class="cart_product">
                        <a href=""><img style="width: 80px;"  src="{{ asset('/images/backend_images/products/small/'.$wishList->image) }}" alt=""></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="">{{ $wishList->product_name }}</a></h4>
                        <p> {{ $wishList->product_code }} | {{ $wishList->size }} </p>
                    </td>
                    <td class="cart_price">
                        <p>${{ $wishList->price }}</p>
                    </td>
                    <td class="cart_quantity">
                        <p>{{ $wishList->quantity }}</p>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">${{ $wishList->price * $wishList->quantity }}</p>
                    </td>
                    <td class="cart_delete">
                        <form name="addtocartform" id="addtocartForm" action="{{ route('addtocart') }}" method="post"> {{ csrf_field() }}
                            <input type="hidden" name="product_id" value="{{ $wishList->product_id }}">
                            <input type="hidden" name="product_name" value="{{ $wishList->product_name }}">
                            <input type="hidden" name="product_code" value="{{ $wishList->product_code }}">
                            <input type="hidden" name="product_color" value="{{ $wishList->product_color }}">
                            <input type="hidden" id="price" name="price" value="{{ $wishList->price }}">
                            <input type="hidden" id="quantity" name="quantity" value="{{ $wishList->quantity }}">
                            <input type="hidden" id="size" name="size" value="{{ $wishList->product_id }}-{{ $wishList->size }}">
                            <button id="cartButton" type="submit" class="btn btn-default cart" name="cartButton" value="shopping Cart">
                                <i class="fa fa-shopping-cart"></i>
                                Add to Cart
                            </button>
                            <a style="margin-left: 100px" class="cart_quantity_delete" href="{{ url('/wish-list/delete/'.$wishList->id) }}"><i class="fa fa-times"></i></a>
                            </form>

                    </td>
                </tr>
                <?php $total_amount = $total_amount+ ($wishList->price * $wishList->quantity); ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#wish list_items-->

@endsection
