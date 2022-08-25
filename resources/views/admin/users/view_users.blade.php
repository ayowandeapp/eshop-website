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
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Pincode</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Email</th>
                                <th>Registered on</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($viewUsers as $viewUser)
                            <tr class="gradeX">
                                <td>{{ $viewUser->id }}</td>
                                <td>{{ $viewUser->name }}</td>
                                <td>{{ $viewUser->address }}</td>
                                <td>{{ $viewUser->city }}</td>
                                <td>{{ $viewUser->state }}</td>
                                <td>{{ $viewUser->country }}</td>
                                <td>{{ $viewUser->pincode }}</td>
                                <td>{{ $viewUser->mobile }}</td>
                                <td>
                                    @if($viewUser->status ==1)
                                    <span style="color: green;">Active</span>
                                    @else
                                    <span style="color: red;">InActive</span>
                                    @endif

                                </td>
                                <td>{{ $viewUser->email }}</td>
                                <td>{{ $viewUser->created_at }}</td>
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
