@extends('layouts.adminLayout.admin_layout')
@section('content')
<div id="content" xmlns="http://www.w3.org/1999/html">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Edit Products</a> </div>
        <h1>Products</h1>
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
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Edit Coupon</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ route('editcoupon.page',$couponDetail->id ) }}" name="edit_coupon" id="edit_coupon" novalidate="novalidate"> {{ csrf_field() }}
                            <div class="control-group">
                            <label class="control-label">Coupon Code</label>
                            <div class="controls">
                                <input type="text" name="coupon code" id="coupon code" MIN="5" max="15" required="required" value="{{ $couponDetail->coupon_code }}">
                            </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Amount</label>
                        <div class="controls">
                            <input type="number" name="amount" id="amount" min="1" required value="{{ $couponDetail->amount}}">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Amount_Type</label>
                        <div class="controls">
                            <select name="amount_type" id="amount_type" style="width: 220px">

                                <option @if($couponDetail->amount_type == "percentage") selected @endif value="percentage">Percentage</option>
                                <option @if($couponDetail->amount_type == "fixed") selected @endif value="fixed">Fixed</option>

                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Expiry Date</label>
                        <div class="controls">
                            <input type="date" name="expiry_date" id="expiry_date" min="<?php echo date("Y-m-d"); ?>" required value="{{ $couponDetail->expiry_date }}">
                        </div>
                    </div>
                            <div class="control-group">
                                <label class="control-label">Status</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" @if($couponDetail->status == "1")checked @endif value="1">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Edit Product" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection