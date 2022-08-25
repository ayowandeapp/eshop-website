

@extends('layouts.adminLayout.admin_layout')

@section('content')

<div id="content">

<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('dashboard.page') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
</div>
<!--End-breadcrumbs-->

<!--Action boxes-->
<div class="container-fluid">
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
<div class="quick-actions_homepage">
    <ul class="quick-actions">
        <li class="bg_lb"> <a href="{{ url('admin/dashboard') }}"> <i class="icon-dashboard"></i>  My Dashboard </a> </li>
        <li class="bg_lg span3"> <a href="{{ route('viewUsers') }}"> <i class="icon-signal"></i> Users</a> </li>
        <li class="bg_ly"> <a href="{{ route('viewOrder') }}"> <i class="icon-inbox"></i><span class="label label-success">101</span> Orders </a> </li>
        <li class="bg_lo"> <a href="{{ route('viewproduct.page') }}"> <i class="icon-th"></i> Products</a> </li>
        <li class="bg_ls"> <a href="{{ route('viewcategory.page') }}"> <i class="icon-fullscreen"></i> Categories</a> </li>

    </ul>
</div>
<!--End-Action boxes-->

<!--Chart-box-->
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
            <h5>Site Analytics</h5>
        </div>
        <div class="widget-content" >
            <div class="row-fluid">
                <div class="span9">
                    {!! $chart->html() !!}

                </div>
                <div class="span3">
                    <ul class="site-stats">
                        <li class="bg_lh"><i class="icon-user"></i> <strong>{{ $totalUsers }}</strong> <small>Total Users</small></li>
                        <li class="bg_lh"><i class="icon-plus"></i> <strong>{{ $newUsers }}</strong> <small>New Users </small></li>
                        <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong>{{ $totalShop }}</strong> <small>Total Shop</small></li>
                        <li class="bg_lh"><i class="icon-tag"></i> <strong>{{ $totalOrders }}</strong> <small>Total Orders</small></li>
                        <li class="bg_lh"><i class="icon-repeat"></i> <strong>{{ $pendingOrder }}</strong> <small>Pending Orders</small></li>
                        <li class="bg_lh"><i class="icon-globe"></i> <strong>{{ $completedOrder }}</strong> <small>Completed Orders</small></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End-Chart-box-->
<hr/>
<div class="row-fluid">
<div class="span6">
    <div class="widget-box">
        <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
            <h5>Latest Posts</h5>
        </div>
        <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
                <li>
                    <div class="user-thumb"> <img width="40" height="40" alt="User" src="{{ asset('images/backend_images/demo/av1.jpg') }}"> </div>
                    <div class="article-post"> <span class="user-info"> By: john Deo / Date: 2 Aug 2012 / Time:09:27 AM </span>
                        <p><a href="#">This is a much longer one that will go on for a few lines.It has multiple paragraphs and is full of waffle to pad out the comment.</a> </p>
                    </div>
                </li>
                <li>
                    <div class="user-thumb"> <img width="40" height="40" alt="User" src="{{ asset('images/backend_images/demo/av2.jpg') }}"> </div>
                    <div class="article-post"> <span class="user-info"> By: john Deo / Date: 2 Aug 2012 / Time:09:27 AM </span>
                        <p><a href="#">This is a much longer one that will go on for a few lines.It has multiple paragraphs and is full of waffle to pad out the comment.</a> </p>
                    </div>
                </li>
                <li>
                    <div class="user-thumb"> <img width="40" height="40" alt="User" src="{{ asset('images/backend_images/demo/av4.jpg') }}"> </div>
                    <div class="article-post"> <span class="user-info"> By: john Deo / Date: 2 Aug 2012 / Time:09:27 AM </span>
                        <p><a href="#">This is a much longer one that will go on for a few lines.Itaffle to pad out the comment.</a> </p>
                    </div>
                <li>
                    <button class="btn btn-warning btn-mini">View All</button>
                </li>
            </ul>
        </div>
    </div>


</div>
</div>
</div>
</div>
<!--end-main-container-part-->
{!! Charts::scripts() !!}
{!! $chart->script() !!}
@endsection