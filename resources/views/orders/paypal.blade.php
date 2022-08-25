@extends('layouts.frontLayout.front_layout')
@section('content')
<?php
use \Illuminate\Support\Facades\Session;
?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Thanks</li>
            </ol>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading" style="text-align: center">
            <h3>YOUR COD ORDER AS BEEN PLACED</h3>
            <p>Your order number is {{ Session::get('order_id') }} and Total payable amount ${{ Session::get('total_amount') }}</p>
        </div>
    </div>
</section><!--/#do_action-->

<?php
Session::forget('order_id');
Session::forget('total_amount');
?>
@endsection