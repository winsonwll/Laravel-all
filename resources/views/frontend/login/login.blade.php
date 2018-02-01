<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>用户登录</title>
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/review.css')}}" rel="stylesheet">
</head>
<body ontouchstart>
<div class="container" id="container">
    <div class="g-doc">
        <div class="g-bd">
            <div class="m-confirm">
                <div class="box">
                    <div class="m-deliver">
                        <div class="hd">
                            <h2 class="m_sign">用户登录</h2>
                        </div>

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

                        <form action="{{ URL('/login') }}" method="post">
                            <div class="bd">
                                <div class="box">
                                    <div class="itm z-show">
                                        <div class="m-fm">
                                            <div class="row1 m_new_inp">
                                                <label class="lab m_f16">账号</label>
                                                <div class="ipt">
                                                    <input type="text" class="m_new_nb m_f16" placeholder="请输入用户名" name="uname" {{ old('uname') }}>
                                                </div>
                                            </div>
                                            <div class="row1 m_new_inp">
                                                <label class="lab m_f16">密码</label>
                                                <div class="ipt">
                                                    <input type="password" class="m_new_nb m_f16" name="upwd" placeholder="请输入登录密码">
                                                </div>
                                            </div>
                                            <div class="row1 m_new_inp">
                                                <div class="ipt">
                                                    <input type="text" class="m_new_nb m_f16"
                                                           style="width:11rem; border-right: 1px solid #ccc; margin-right:1rem"
                                                           placeholder="验证码" name="vcode">

                                                    <img src="{{ URL('captcha/'.time()) }}" onclick="this.src='{{ URL('captcha') }}/'+Math.random();" width="100" height="34" style="cursor: pointer; vertical-align: -12px">
                                                </div>
                                            </div>
                                            <div class="row1 m_new_inp">
                                                <label>
                                                    <input type="checkbox" class="i-checks" name="remember" value="1">自动登录
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ops">
                                {{ csrf_field() }}
                                <input type="hidden" name="redirect" value="{{ $redirect }}">
                                <input class="m_new_u-btn u-btn-c2" type="submit" value="登 录" style="width: 100%; border: 0;">
                            </div>
                        </form>
                        <div class="clear">
                            <span class="m_user_zc" onclick="javascript:window.location.href='{{ URL("/register") }}'">快速注册</span>
                            <span class="m_user_pass" onclick="javascript:window.location.href='{{ URL("/findpwd") }}'">忘记密码？</span></div>
                        <div class="m_por">
                            <span class="m_other">第三方账号登录</span>
                        </div>
                        <div class="m_qudao_pic">
                            <a class="m_weibo_pic" href="http://openapi.damai.cn/user/sina/login?terminal=101002&device=102001&deviceNo=&marketingType=103001&marketingPlatform=104999&marketingMode=105999&leadUrl=http://m.damai.cn&ip=192.168.71.5&bussinessType=107001&urlBeforeReg=http://m.damai.cn/ticket/105699.html&redirectUri=http%3a%2f%2fm.damai.cn%2fbuynow.aspx%3fbt%3d2%26id%3d105699%26pid%3d0%26s%3d3%26_m%3df455e03c68d5cb767784c51bcef489d5&damaiAppKey=damai_normal&regPlatform=106004&customerKind=3&oop=3&sso=1"></a>
                            <a class="m_qq_pic" href="http://openapi.damai.cn/user/qzone/login?terminal=101002&device=102001&deviceNo=&marketingType=103001&marketingPlatform=104999&marketingMode=105999&leadUrl=http://m.damai.cn&ip=192.168.71.5&bussinessType=107001&urlBeforeReg=http://m.damai.cn/ticket/105699.html&redirectUri=http%3a%2f%2fm.damai.cn%2fbuynow.aspx%3fbt%3d2%26id%3d105699%26pid%3d0%26s%3d3%26_m%3df455e03c68d5cb767784c51bcef489d5&damaiAppKey=damai_normal&regPlatform=106004&customerKind=3&oop=3&sso=1"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
