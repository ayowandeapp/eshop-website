@extends('layouts.adminLayout.admin_layout')
@section('content')

<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Website Users From Countries - 2020"
            },
            data: [{
                type: "pie",
                startAngle: 240,
                yValueFormatString: "##0.00\"%\"",
                indexLabel: "{label} {y}",
                dataPoints: [
                    {y: <?php echo $viewUsersCountry[0]['count']; ?>, label: "<?php echo $viewUsersCountry[0]['country']; ?>"},
                    {y: <?php echo $viewUsersCountry[1]['count'];?>, label: "<?php echo $viewUsersCountry[1]['country']; ?>"},
                    {y: <?php echo $viewUsersCountry[2]['count']; ?>, label: "<?php echo $viewUsersCountry[2]['country']; ?>"},
                    {y: <?php echo $viewUsersCountry[3]['count']; ?>, label: "<?php echo $viewUsersCountry[3]['country']; ?>"}
                ]
            }]
        });
        chart.render();

    }
</script>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Users</a> <a href="#" class="current">Users Country</a> </div>
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
                        <h5>View Users Country</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <br>
                        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src = "{{ asset('js/backend_js/canvasjs.min.js') }}" ></script>
@endsection
