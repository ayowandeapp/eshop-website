@extends('layouts.adminLayout.admin_layout')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Currencies</a> <a href="#" class="current">Add Currency</a> </div>
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
                        <h5>Add Currency</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/edit-currency/'.$currency->id) }}" name="add_currency" id="add_currency" novalidate="novalidate"> {{ csrf_field() }}
                            <div id="fieldList">
                                <div class="control-group">
                                    <label class="control-label">Currency Code</label>
                                    <div class="controls">
                                        <input type="text" name="currency_code" id="currency_code" value="{{ $currency->currency_code }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Exchange Rate</label>
                                    <div class="controls">
                                        <input type="text" name="exchange_rate" id="exchange_rate" value="{{ $currency->exchange_rate }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enable</label>
                                    <div class="controls">
                                        <input type="checkbox" name="status" id="status" value="1" @if($currency->status == 1)checked @endif>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <!-- <button id="addMore" class="btn btn-primary"> Add More Field</button> --> <input type="submit" value="Add Currency" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection