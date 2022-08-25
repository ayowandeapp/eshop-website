
@extends('layouts.adminLayout.admin_layout')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Users</a> <a href="#" class="current">View Users</a> </div>
        <h1>Users</h1>
    </div>
    <div class="container-fluid">
        <hr>
        @if(Session::has('message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{!! session('message_success') !!}</strong>
        </div>
        @endif
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Users</h5>
                    </div>
                    <div class="widget-content nopadding">
                        {!! $chart->html() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
@endsection






