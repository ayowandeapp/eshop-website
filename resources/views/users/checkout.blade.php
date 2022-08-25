@extends('layouts.frontLayout.front_layout')
@section('content')
    <div class="container">
        <form method="post" action="{{ route('checkout') }}">{{ csrf_field() }}
            <div class="row">
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
<?php $current_url = url()->current();
$checkout = '/checkout'?>
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li @if($current_url==$checkout) class="active" @endif ><a href="{{ url('checkout') }}"> Check out</a></li>
                    </ol>
                </div><!--/breadcrums-->
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Bill To</h2>
                        <div class="form-group">
                            <input value="{{ $userDetail->name }}" id="Billing_name" name="Billing_name" type="text" placeholder="Billing Name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input value="{{ $userDetail->address }}" id="Billing_address" name="Billing_address" type="text" placeholder="Billing Address" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input value="{{ $userDetail->city }}" id="Billing_city" name="Billing_city" type="text" placeholder="Billing City" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input value="{{ $userDetail->state }}" id="Billing_state" name="Billing_state" type="text" placeholder="Billing State" class="form-control" />
                        </div>
                        <div class="form-group">
                            <select name="Billing_country" id="Billing_country" class="form-control" />
                            <option value=""> Select Country</option>
                            @foreach($countries as $country)
                            <option @if($userDetail->country == $country->country_name) selected @endif value="{{ $country->country_name }}"> {{ $country->country_name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input value="{{ $userDetail->pincode }}" style="margin-top: 10px" id="Billing_pincode" name="Billing_pincode" type="text" placeholder="Billing Pincode" class="form-control" />

                        </div>
                        <div class="form-group">
                            <input value="{{ $userDetail->mobile }}" id="Billing_mobile" name="Billing_mobile" type="text" placeholder="Billing Mobile" class="form-control" />
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="billtoship">
                            <label class="form-check-label" for="billtoship">Shipping Address same as Billing Address</label>
                        </div>
                    </div><!--/login form-->
                </div>

                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Ship To</h2>
                        <div class="form-group">
                            <input id="shipping_name" name="shipping_name" @if(!empty($shippingDetail->name)) value="{{ $shippingDetail->name }}" @endif type="text" placeholder="Shipping_Name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input id="shipping_address" name="shipping_address" @if(!empty($shippingDetail->address)) value="{{ $shippingDetail->address }}" @endif type="text" placeholder="Shipping Address" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input id="shipping_city" name="shipping_city" @if(!empty($shippingDetail->city)) value="{{ $shippingDetail->city }}" @endif type="text" placeholder="Shipping City" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input id="shipping_state" name="shipping_state" @if(!empty($shippingDetail->state)) value="{{ $shippingDetail->state }}" @endif type="text" placeholder="Shipping State" class="form-control" />
                        </div>
                        <div class="form-group">
                            <select name="shipping_country" id="shipping_country"  @if(!empty($shippingDetail->country)) value="{{ $shippingDetail->country }}" @endif class="form-control" />
                            <option value=""> Select Country</option>
                            @if(!empty($shippingDetail->country))
                            @foreach($countries as $country)
                            <option @if( $shippingDetail->country == $country->country_name ) selected @endif value="{{ $country->country_name }}"> {{ $country->country_name }}</option>
                            @endforeach
                            @else
                            @foreach($countries as $country)
                            <option value="{{ $country->country_name }}"> {{ $country->country_name }}</option>
                            @endforeach
                            @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <input style="margin-top: 10px" id="shipping_pincode" name="shipping_pincode" @if(!empty($shippingDetail->pincode)) value="{{ $shippingDetail->pincode }}" @endif type="text" placeholder="Pincode" class="form-control" />

                        </div>
                        <div class="form-group">
                            <input id="shipping_mobile" name="shipping_mobile" @if(!empty($shippingDetail->mobile)) value="{{ $shippingDetail->mobile }}" @endif type="text" placeholder="Shipping Mobile" class="form-control" />

                        </div>
                            <button type="submit" class="btn btn-default">Checkout</button>
                    </div><!--/sign up form-->
                </div>
            </div>

        </form>
    </div>
@endsection