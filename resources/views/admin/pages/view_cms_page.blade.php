@extends('layouts.adminLayout.admin_layout')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">CMS Pages</a> <a href="#" class="current">View CMS Pages</a> </div>
        <h1>CMS Pages</h1>
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
                        <h5>View CMS Pages</h5>
                    </div>

                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Page ID</th>
                                <th>Page Title</th>
                                <th>Page Url</th>
                                <th>Page status</th>
                                <th>Page created on</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="gradeX">
                                @foreach($viewCmsPage as $page)
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->url }}</td>
                                <td>
                                    @if($page->status ==1)
                                    <span style="color:green;">Active</span>
                                    @else
                                    <span style="color:red;">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $page->created_at }}</td>
                                <td class="center"><a href="#myModal{{ $page->id }}" data-toggle="modal" class="btn btn-success btn-mini" title="View CMS Pages">View</a> |
                                    <a href="{{ url('admin/edit-cms-page/'.$page->id) }}" class="btn btn-primary btn-mini" title="Edit CMS Pages">Edit</a> |
                                    <a id="deleteCmsPage" href=" {{ url('admin/delete-cms-page/'.$page->id) }}" class="btn btn-danger btn-mini" title="Delete CMS Pages">Delete</a></td>
                            </tr>
                            <div id="myModal{{ $page->id }}" class="modal hide">
                                <div class="modal-header">
                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                    <h3>{{ $page->title }} Page Details</h3>
                                </div>
                                <div class="modal-body">
                                    <p>Page ID: {{ $page->id }}</p>
                                    <p>Page Title: {{ $page->title }}</p>
                                    <p>Page Url: {{ $page->url }}</p>
                                    <p>Page Description: {{ $page->description }}</p>
                                    <p>Page Meta_title: {{ $page->meta_title }}</p>
                                    <p>Page Meta_Description: {{ $page->meta_description }}</p>
                                    <p>Page Meta_keywords: {{ $page->meta_keywords }}</p>
                                    <p>Page Status:
                                        @if($page->status ==1)
                                        <span style="color:green;">Active</span>
                                        @else
                                        <span style="color:red;">Inactive</span>
                                        @endif
                                    </p>
                                    <p>Page Created on: {{ $page->created_at }}</p>
                                </div>
                            </div>
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
