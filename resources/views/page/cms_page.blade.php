@extends('layouts.frontLayout.front_layout')
@section('content')
<!--category sidebar-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.frontLayout.front_sidebar')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">{{ $viewCmsPage->title }}</h2>
                    <p>
                        {{ $viewCmsPage->description }}

                    </p>
                    <br>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection