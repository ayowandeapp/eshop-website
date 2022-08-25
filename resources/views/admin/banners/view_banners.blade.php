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
                                <th>Banner ID</th>
                                <th>Banner Image</th>
                                <th>Banner Title</th>
                                <th>Banner Link</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bannerAll as $banner)
                            <tr class="gradeX">
                                <td>{{ $banner->id }}</td>
                                <td>
                                    @if(!empty($banner->image))
                                    <img src="{{ asset('images/frontend_images/banners/'.$banner->image) }}" style="width: 50px">
                                    @endif

                                </td>
                                <td>{{ $banner->title }}</td>
                                <td>{{ $banner->link }}</td>
                                <td>@if($banner->status == "0") InActive @else Active @endif</td>
                                <td class="center">
                                    <a id="editcoupon" href="{{ route('editbanner.page',$banner->id) }} " class="btn btn-primary btn-mini" title="Edit Banner">Edit</a> |
                                    <a id="delBanner" onclick="return delBanner();" href="{{ route('deletebanner.page',$banner->id) }}" class="btn btn-danger btn-mini" title="Delete Banner">Delete</a></td>
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
