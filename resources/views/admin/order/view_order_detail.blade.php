@extends('layouts.adminLayout.admin_layout')

@section('content')
<!--main-container-part-->
<div id="content">
<div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders</a> </div>
    <h1>Order Products</h1>
</div>
<div class="container-fluid">
<hr>
@if(Session::has('message_success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{!! session('message_success') !!}</strong>
</div>
@endif
<hr>
<div class="row-fluid">
<div class="span6">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-eye-open"></i> </span>
            <h5>Order Details</h5>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>Order Date</td>
                    <td>{{ $orders->created_at }}</td>
                </tr>
                <tr>
                    <td>Order Status</td>
                    <td>{{ $orders->order_status }}</td>
                </tr>
                <tr>
                    <td>Order Total</td>
                    <td>£{{ $orders->grand_total }}</td>
                </tr>
                <tr>
                    <td>Shipping Charges</td>
                    <td>£{{ $orders->shipping_charges }}</td>
                </tr>
                <tr>
                    <td>Coupon Code</td>
                    <td>{{ $orders->coupon_code }}</td>
                </tr>
                <tr>
                    <td>Coupon Amount</td>
                    <td>{{ $orders->coupon_amount }}</td>
                </tr>
                <tr>
                    <td>Payment Method</td>
                    <td>{{ $orders->payment_method }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-eye-open"></i> </span>
            <h5>Billing Address</h5>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>Name</td>
                    <td>{{ $userDetails->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $userDetails->email }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $userDetails->address }}</td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>{{ $userDetails->city }}</td>
                </tr>
                <tr>
                    <td>State</td>
                    <td>{{ $userDetails->state }}</td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>{{ $userDetails->country }}</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>{{ $userDetails->mobile }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="span6">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-eye-open"></i> </span>
            <h5>Customer Details</h5>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>Customer Name</td>
                    <td>{{ $orders->name }}</td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>{{ $orders->user_email }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
            <h5>Update Order Status</h5>
        </div>
        <div class="widget-content">
            <div class="todo">
                <ul>
                    <li class="clearfix">
                        <form action="{{ route('updateOrderStatus',$orders->id) }}" method="post">{{ csrf_field() }}
                            <div class="control-group">
                                <input type="hidden" value="{{ $orders->id }}" name="order_id">
                                <div class="controls">
                                    <select name="orderUpdate" id="orderUpdate" style="width: 220px">
                                        <option value ='New' @if($orders->order_status == 'New') selected @endif>New</option>
                                        <option value ='Pending' @if($orders->order_status == 'Pending') selected @endif>Pending</option>
                                        <option value ='Cancelled' @if($orders->order_status == 'Cancelled') selected @endif>Cancelled</option>
                                        <option value ='Process' @if($orders->order_status == 'Process') selected @endif>In Process</option>
                                        <option value ='Shipped' @if($orders->order_status == 'Shipped') selected @endif>Shipped</option>
                                        <option value ='Delivered' @if($orders->order_status == 'Delivered') selected @endif>Delivered</option>
                                    </select>
                                </div>
                                <div class="controls">
                                    <input type="submit" value="Update Status">
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>





    <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-eye-open"></i> </span>
            <h5>Shipping Address</h5>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>Name</td>
                    <td>{{ $shippingAdd->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $shippingAdd->user_email }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $shippingAdd->address }}</td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>{{ $shippingAdd->city }}</td>
                </tr>
                <tr>
                    <td>State</td>
                    <td>{{ $shippingAdd->state }}</td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>{{ $shippingAdd->country }}</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>{{ $shippingAdd->mobile }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<hr>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-content nopadding">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Size</th>
                            <th>Product Color</th>
                            <th>Product Price</th>
                            <th>Product Qty</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders->orders as $order)
                        <tr>
                            <td>{{ $order->product_code }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->product_size }}</td>
                            <td>{{ $order->product_color }}</td>
                            <td>{{ $order->product_price }}</td>
                            <td>{{ $order->product_qty }}</td>
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
<!--main-container-part-->
@endsection