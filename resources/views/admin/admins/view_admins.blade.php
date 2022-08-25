@extends('layouts.adminLayout.admin_layout')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home</a> <a href="#">Admins</a> <a href="#" class="current">View Admins/Sub Admins</a> </div>
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
                        <h5>View View Admins/Sub Admins</h5>
                    </div>

                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Type</th>
                                <th>Roles</th>
                                <th>Status</th>
                                <th>Created on</th>
                                <th>Updated on</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($viewAdmins as $viewAdmin)
                            <?php
                            if($viewAdmin->type == 'Admin'){
                                $roles = 'All';
                            }else{
                                $roles= '';
                                    if($viewAdmin->categories_access == 1){
                                        $roles .= "Categories, ";
                                    }
                                if($viewAdmin->products_access == 1){
                                    $roles .= "Products, ";
                                }
                                if($viewAdmin->users_access == 1){
                                    $roles .= "Users, ";
                                }
                                if($viewAdmin->orders_access == 1){
                                    $roles .= "Orders, ";
                                }
                            }
                            ?>
                            <tr class="gradeX">
                                <td>{{ $viewAdmin->id }}</td>
                                <td>{{ $viewAdmin->username }}</td>
                                <td>{{ $viewAdmin->type }}</td>
                                <td>{{ $roles }}</td>
                                <td>
                                    @if($viewAdmin->status ==1)
                                    <span style="color: green;">Active</span>
                                    @else
                                    <span style="color: red;">InActive</span>
                                    @endif

                                </td>
                                <td>{{ $viewAdmin->created_at }}</td>
                                <td>{{ $viewAdmin->updated_at }}</td>
                                <td>
                                    <a href="{{ url('admin/edit-admin/'.$viewAdmin->id) }} " class="btn btn-primary btn-mini" title="Edit Admin">Edit</a> |
                                    <a href="{{ url('admin/delete-admin/'.$viewAdmin->id) }} " class="btn btn-danger btn-mini" title="Delete Admin">Delete</a>
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
