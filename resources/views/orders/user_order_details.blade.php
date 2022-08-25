@extends('layouts.frontLayout.front_layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active"><a href="{{ url('/orders') }}"> Orders</a></li>
                <li class="active">Orders</li>
            </ol>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading" style="text-align: center">
            <table id="example" class="table table-striped table-bordered" style="width: 100%">
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
                @foreach($ordersDetail->orders as $order)
                <tr>
                    <td>{{ $order->product_code }}</td>
                    <td>
                        {{ $order->product_name }}
                    </td>
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
</section><!--/#do_action-->



@endsection