@extends('layouts.adminLayout.admin_layout')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Orders</a> <a href="#" class="current">View Orders</a> </div>
        <h1>Orders</h1>
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
                        <h5>View Orders</h5>
                    </div>

                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Ordered Products</th>
                                <th>Order Amount</th>
                                <th>Order Status</th>
                                <th>Payment Method</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr class="gradeX">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->user_email }}</td>
                                <td>
                                    <ul>
                                        @foreach($order->orders as $product)
                                            <li>
                                                <a href="{{ url('/orders/'.$order->id ) }}">
                                                    {{ $product->product_name }}
                                                    ({{ $product->product_qty }})
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $order->grand_total }}</td>
                                <td>{{ $order->order_status }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td class="center">
                                    <a id="" href="{{ route('viewOrderProduct',$order->id) }}" class="btn btn-primary btn-mini" title=" Order Detail">View Order Details</a> <br><br>
                                    <a id="" href="{{ route('viewOrderInvoice',$order->id) }}" class="btn btn-primary btn-mini" title=" Order Detail">View Invoice Details</a>
                                </td>
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
@endsection
