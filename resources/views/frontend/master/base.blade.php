<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>@yield('title') {{ config("app.webname") }}</title>
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
    @yield('css')
</head>
<body ontouchstart>
@if(session('success'))
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ session('error') }}
    </div>
@endif
@yield('header')
    @yield('content')
</div>

<script src="{{asset('frontend/js/jquery-1.9.1.min.js')}}"></script>
<script src="{{asset('frontend/js/router.min.js')}}"></script>
<script src="{{asset('frontend/js/example.js')}}"></script>
<script src="{{asset('frontend/js/swiper.min.js')}}"></script>
<script src="{{asset('frontend/js/underscore-min.js')}}"></script>
<script src="{{asset('frontend/js/moment.min.js')}}"></script>
<script src="{{asset('frontend/js/clndr.min.js')}}"></script>
<script src="{{asset('frontend/js/func.js')}}"></script>
<!--<script src="js/touch.js"></script>-->
@yield('js')
</body>
</html>
