<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piao.com管理后台 - 登录</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{asset('admins/css/bootstrap.min14ed.css?v=3.3.6')}}" rel="stylesheet">
    <link href="{{asset('admins/css/font-awesome.min93e3.css?v=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('admins/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('admins/css/style.min862f.css?v=4.1.0')}}" rel="stylesheet">
    <link href="{{asset('admins/css/login.min.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <style type="text/css">
        .signin-wrap { background: #fff; padding: 20px; color: #444;}
    </style>
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="signin">
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">H+</h1>
        </div>
        <div class="signin-wrap">
            <h3>欢迎使用 piao.com</h3>

            @if(count($errors) > 0)
                <div class="alert alert-warning alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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

            <form class="m-t" role="form" action="{{ URL('/admin/login') }}" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名" required="" name="aname">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" required=""  name="apwd">
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="验证码" required=""  name="vcode">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <img src="{{ URL('captcha/'.time()) }}" onclick="this.src='{{ URL('captcha') }}/'+Math.random();" width="100" height="34" style="cursor: pointer">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 text-left">
                        <label>
                            <input type="checkbox" class="i-checks" name="remember" value="1">自动登录
                        </label>
                    </div>
                    <div class="col-xs-6 text-right">
                        <a href=""><small>忘记密码？</small></a>
                    </div>
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary block full-width">登 录</button>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('admins/js/jquery.min.js?v=2.1.4')}}"></script>
<script src="{{asset('admins/js/bootstrap.min.js?v=3.3.6')}}"></script>
</body>
</html>
