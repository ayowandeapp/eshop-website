@extends('layouts.frontLayout.front_layout')
@section('content')
    <div class="container">
        <div class="row">
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
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Update Account</h2>
                   <form id="account" name="account" action="{{ route('useraccount.page') }}" method="post">{{ csrf_field() }}
                       <input value="{{ $userDetails->email }}" readonly />
                       <input id="name" name="name" type="text" placeholder="{{ $userDetails->name }}" />
                       <input id="address" name="address" type="text" placeholder="Address" />
                       <input id="city" name="city" type="text" placeholder="City" />
                       <input id="state" name="state" type="text" placeholder="State" />
                       <select name="country" id="country"  />
                            <option value=""> Select Country</option>
                       @foreach($countries as $country)
                       <option @if($userDetails->country == $country->country_name) selected @endif value="{{ $country->country_name }}"> {{ $country->country_name }}</option>
                       @endforeach
                       </select>
                       <input style="margin-top: 10px" id="pincode" name="pincode" type="text" placeholder="Pincode" />
                       <input id="mobile" name="mobile" type="text" placeholder="Mobile" />
                       <button type="submit" class="btn btn-default">Update Account</button>
                   </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Update Password</h2>
                    <form id="updatePassword" name="updatePassword" action="{{ route('updatePassword') }}" method="post">{{ csrf_field() }}
                        <input id="current_password" name="current_password" type="password" placeholder="current_password" />
                        <span id="chkPwd"></span>
                        <input id="new_pwd" name="new_pwd" type="password" placeholder="new password" />
                        <input id="confirm_pwd" name="confirm_pwd" type="password" placeholder="confirm password" />
                        <button type="submit" class="btn btn-default">Update Password</button>

                    </form>

                </div><!--/sign up form-->
            </div>
        </div>
    </div>
@endsection