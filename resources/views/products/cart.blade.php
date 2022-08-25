<?php// use Illuminate\Support\Facades\Session;?>
@extends('layouts.frontLayout.front_layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
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
                @foreach($userCart as $cart)
                <tr>
                    <td class="cart_product">
                        <a href=""><img style="width: 80px;"  src="{{ asset('/images/backend_images/products/small/'.$cart->image) }}" alt=""></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="">{{ $cart->product_name }}</a></h4>
                        <p> {{ $cart->product_code }} | {{ $cart->size }} </p>
                    </td>
                    <td class="cart_price">
                        <p>${{ $cart->price }}</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <a class="cart_quantity_up" href="{{ url('/cart/update-quantity/'.$cart->id.'/1') }}"> + </a>
                            <input class="cart_quantity_input" type="text" name="quantity" value="{{ $cart->quantity }}" autocomplete="off" size="2">
                            @if($cart->quantity >1)
                            <a class="cart_quantity_down" href="{{ url('/cart/update-quantity/'.$cart->id.'/-1') }}"> - </a>
                            @endif
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">${{ $cart->price * $cart->quantity }}</p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href="{{ route('deletecartproduct.page', $cart->id) }}"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                <?php $total_amount = $total_amount+ ($cart->price * $cart->quantity); ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <div class="control-group">
                                <form class="form-horizontal" action="{{ url('/cart/coupon') }}" method="post">{{ csrf_field() }}
                                 <label>Use Coupon Code</label>
                                     <input type="text" name="coupon_code">
                                     <input type="submit" class="btn btn-default update" value="Apply">
                                </form>
                            </div>
                        </li>

                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        @if(!empty(Session::has('CouponAmount')))
                        <li>Cart Sub Total <span>$<?php echo $total_amount; ?></span></li>
                        <li>Discount Cost <span><?php echo Session::get('CouponAmount'); ?></span></li>
                        <li>Cart Total <span>$<?php echo $total_amount - Session::get('CouponAmount'); ?></span></li>
                        @else
                        <li>Cart Total <span>$<?php echo $total_amount; ?></span></li>
                        @endif
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>£</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="{{ route('checkout') }}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection
