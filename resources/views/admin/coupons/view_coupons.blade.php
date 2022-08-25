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
                                <th>Coupon ID</th>
                                <th>Coupon code</th>
                                <th>Amount</th>
                                <th>Amount_Type</th>
                                <th>Expiry Date</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                            <tr class="gradeX">
                            <td>{{ $coupon->id }}</td>
                            <td>{{ $coupon->coupon_code }}</td>
                            <td>{{ $coupon->amount }}@if($coupon->amount_type == "percentage") % @else Naira @endif</td>
                            <td>{{ $coupon->amount_type }}</td>
                            <td>{{ $coupon->expiry_date }}</td>
                            <td>@if($coupon->status == "0") InActive @else Active @endif</td>
                            <td class="center">
                                <a id="editcoupon" href="{{ route('editcoupon.page',$coupon->id) }} " class="btn btn-primary btn-mini" title="Edit Coupon">Edit</a> |
                                <a id="delCoupon" onclick="return delCoupon();" href="{{ route('deletecoupon.page',$coupon->id) }}" class="btn btn-danger btn-mini" title="Delete Product">Delete</a></td>
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
