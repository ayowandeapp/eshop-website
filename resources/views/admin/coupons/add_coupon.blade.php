@extends('layouts.adminLayout.admin_layout')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Products</a> </div>
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
                        <h5>Add Coupons</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{ route('addcoupon.page') }}" name="add_coupon" id="add_coupon" novalidate="novalidate"> {{ csrf_field() }}

                            <div class="control-group">
                                <label class="control-label">Coupon Code</label>
                                <div class="controls">
                                    <input type="text" name="coupon code" id="coupon code" MIN="5" max="15" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Amount</label>
                                <div class="controls">
                                    <input type="number" name="amount" id="amount" min="1" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Amount_Type</label>
                                <div class="controls">
                                    <select name="amount_type" id="amount_type" style="width: 220px">

                                        <option value="percentage">Percentage</option>
                                        <option value="fixed">Fixed</option>

                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Expiry Date</label>
                                <div class="controls">
                                    <input type="date" name="expiry_date" id="expiry_date" min="<?php echo date("Y-m-d"); ?>" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Enable</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value="1">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Add Coupon" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection