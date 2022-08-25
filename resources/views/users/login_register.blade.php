@extends('layouts.frontLayout.front_layout')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
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
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form id="userLoginForm" name="userLoginForm" action="{{ route('userlogin.page') }}" method="post">
                        <input name="_token" id="csrf-token" type="hidden" value="{{ Session::token() }}" />
                        <input name="email" type="email" placeholder="Email Address" />
                        <input  name="password" type="password" placeholder="Enter Password" />
							<span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span>
                        <span>
                            <button type="submit" class="btn btn-default">Login</button>

                           <button type="button" style="margin-top: -32px; margin-left: 200px" class="btn btn-default"> <a href="{{ url('/user-recover-password') }}" style="color: #ffffff;">Forgot Password</a></button>
                        </span>

                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form id="registerForm" name="registerForm" action="{{ route('userregister.page') }}" method="post">{{ csrf_field() }}
                        <input id="name" name="name" type="text" placeholder="Name"/>
                        <input id="email" name="email" type="email" placeholder="Email Address"/>
                        <input id="userPassword" name="password" type="password" placeholder="Password"/>
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection