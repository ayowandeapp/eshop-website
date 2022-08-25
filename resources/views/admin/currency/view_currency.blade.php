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
                                <th>Currency ID</th>
                                <th>Currency Code</th>
                                <th>Exchange Rate</th>
                                <th>Updated_at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="gradeX">
                                @foreach($viewCurrency as $currency)
                                <td>{{ $currency->id }}</td>
                                <td>{{ $currency->currency_code }}</td>
                                <td>{{ $currency->exchange_rate }}</td>
                                <td>{{ $currency->updated_at }}</td>
                                <td class="center">
                                    <a href="{{ url('admin/edit-currency/'.$currency->id) }}" class="btn btn-primary btn-mini" title="Edit Currency">Edit</a> |
                                    <a id="deleteCurrency" href="{{ url('admin/delete-currency/'.$currency->id) }}" class="btn btn-danger btn-mini" title="Delete Currency">Delete</a></td>
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
