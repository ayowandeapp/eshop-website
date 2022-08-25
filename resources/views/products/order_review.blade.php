@extends('layouts.frontLayout.front_layout')
@section('content')
    <div class="container">
            <div class="row">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Order Review</li>
                    </ol>
                </div><!--/breadcrums-->
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
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Billind Details</h2>
                        <div class="form-group">
                            {{ $userDetail->name }}
                        </div>
                        <div class="form-group">
                            {{ $userDetail->address }}
                        </div>
                        <div class="form-group">
                           {{ $userDetail->city }}
                        </div>
                        <div class="form-group">
                            {{ $userDetail->state }}
                        </div>
                        <div class="form-group">
                            {{ $userDetail->country }}
                        </div>
                        <div class="form-group">
                            {{ $userDetail->pincode }}
                        </div>
                        <div class="form-group">
                            {{ $userDetail->mobile }}
                        </div>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or"></h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Shipping Details</h2>
                        <div class="form-group">
                            {{ $shippingDetail->name }}
                        </div>
                        <div class="form-group">
                            {{ $shippingDetail->address }}
                        </div>
                        <div class="form-group">
                           {{ $shippingDetail->city }}
                        </div>
                        <div class="form-group">
                            {{ $shippingDetail->state }}
                        </div>
                        <div class="form-group">
                            {{ $shippingDetail->country }}
                        </div>
                        <div class="form-group">
                            {{ $shippingDetail->pincode }}
                        </div>
                        <div class="form-group">
                            {{ $shippingDetail->mobile }}
                        </div>
                    </div><!--/sign up form-->
                </div>
            </div>
    </div>
<section id="cart_items">
<div class="container">

<div class="review-payment">
    <h2>Review & Payment</h2>
</div>

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
                <a href=""><img width="50px" src="{{ asset('/images/backend_images/products/small/'.$cart->image) }}" alt=""></a>
            </td>
            <td class="cart_description">
                <h4><a href="">{{ $cart->product_name }}</a></h4>
                <p>Web ID: 1089772</p>
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
        <tr>
            <td colspan="4">&nbsp;</td>
            <td colspan="2">
                <table class="table table-condensed total-result">
                    <tr>
                        <td>Cart Sub Total</td>
                        <td>$<?php echo $total_amount; ?></td>
                    </tr>
                    <tr>
                        <td>Exo Tax</td>
                        <td>$2</td>
                    </tr>
                    <tr class="shipping-cost">
                        <td>Shipping Cost</td>
                        <td>Free</td>
                    </tr>
                    <tr class="shipping-cost">
                        <td>Discount Cost</td>
                        <td>@if(!empty(Session::get('CouponAmount')))
                            <?php echo Session::get('CouponAmount');?>
                            @else
                            0
                            @endif</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td><span>$<?php echo $total_amount - Session::get('CouponAmount'); ?></span></td>
                    </tr>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
    <form id="paymentForm" name="paymentForm" action="{{ route('placeOrder') }}" method="post">{{ csrf_field() }}
        <input name="total_amount" type="hidden" value="<?php echo $total_amount - Session::get('CouponAmount'); ?>">
        <div class="payment-options">
					<span>
						<label><strong>Select Payment Method:</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="COD" value="COD"> <strong>COD</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" id="paypal" value="Paypal"> <strong>Paypal</strong></label>
					</span>
                     <span style="float: right">
						<button type="submit" class="btn btn-success" onclick="selectPaymentMethod();">Place Order</button>
					</span>
        </div>
    </form>

</div>
</section>

@endsection