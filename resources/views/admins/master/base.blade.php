<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title>@yield('title')</title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->
    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{asset('admins/css/bootstrap.min14ed.css?v=3.3.6')}}" rel="stylesheet">
    <link href="{{asset('admins/css/font-awesome.min93e3.css?v=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('admins/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('admins/css/style.min862f.css?v=4.1.0')}}" rel="stylesheet">
    @yield('css')
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    @include('admins.master.menu')
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('admins.master.header')
        @include('admins.master.tab')
        <div class="wrapper wrapper-content animated fadeInRight">
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

            @yield('content')
        </div>
        @include('admins.master.footer')
    </div>
    <!--右侧部分结束-->

    <!--右侧边栏开始-->
    @include('admins.master.sidebar')
    <!--右侧边栏结束-->

    <!--mini聊天窗口开始-->
    @include('admins.master.chat')
</div>
<script src="{{asset('admins/js/jquery.min.js?v=2.1.4')}}"></script>
<script src="{{asset('admins/js/bootstrap.min.js?v=3.3.6')}}"></script>
<script src="{{asset('admins/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('admins/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('admins/js/plugins/layer/layer.min.js')}}"></script>
<script src="{{asset('admins/js/hplus.min.js?v=4.1.0')}}"></script>
<script src="{{asset('admins/js/contabs.min.js')}}"></script>
<script src="{{asset('admins/js/plugins/pace/pace.min.js')}}"></script>
@yield('js')
</body>
</html>