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
                    <h2>Recover your account</h2>
                    <form id="userPasswordRecovery" name="userPasswordRecovery" action="{{ url('/user-recover-password') }}" method="post">{{ csrf_field() }}
                        <input name="recoverEmail" type="email" placeholder="Email Address" value="{{ old('recoverEmail') }}" required="" />
                        <button type="submit" class="btn btn-default" name="recover" value="recover">Recover</button>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection