@extends('layouts.frontLayout.front_layout')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
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
                @if($errors->any())
                <div class="alert alert-error alert-block">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>{{ $error }}</strong>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="login-form"><!--login form-->
                    <h2>Reset your password</h2>
                    <form id="userPasswordReset" name="userPasswordReset" action="{{ url('/password/resetPassword/'.$token) }}" method="post">{{ csrf_field() }}
                        <input id="resetPassword"  name="resetPassword" type="password" placeholder="Enter Password" value="{{ old('resetPassword') }}" />
                        <input id="confirmResetPassword" name="confirmResetPassword" type="password" placeholder="Confirm Password" value="{{ old('confirmPassword') }}" />
                        <button type="submit" class="btn btn-default" name="recover" value="recover">Recover</button>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection