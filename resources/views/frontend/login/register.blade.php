<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>注 册</title>
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
                            <h2 class="m_sign">注 册</h2>
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

                        <form action="{{ URL('/register') }}" method="post" enctype="multipart/form-data">
                        <div class="bd">
                            <div class="box">
                                <div class="itm z-show">
                                    <div class="m-fm">
                                        <div class="row1 m_new_inp">
                                            <label class="lab m_f16">用户名</label>
                                            <div class="ipt">
                                                <input type="text" class="m_new_nb m_f16" placeholder="请输入用户名" name="uname" {{ old('uname') }}>
                                            </div>
                                        </div>
                                        <div class="row1 m_new_inp">
                                            <label class="lab m_f16">密码</label>
                                            <div class="ipt">
                                                <input type="password" class="m_new_nb m_f16" placeholder="请输入密码" name="upwd">
                                            </div>
                                        </div>
                                        <div class="row1 m_new_inp">
                                            <label class="lab m_f14">确认<br>密码</label>
                                            <div class="ipt">
                                                <input type="password" class="m_new_nb m_f16" placeholder="请输入确认密码" name="repwd">
                                            </div>
                                        </div>
                                        <div class="row1 m_new_inp">
                                            <label class="lab m_f16">邮箱</label>
                                            <div class="ipt">
                                                <input type="text" class="m_new_nb m_f16" placeholder="请输入邮箱" name="email" {{ old('email') }}>
                                            </div>
                                        </div>
                                        <div class="row1 m_new_inp">
                                            <label class="lab m_f16">手机号</label>
                                            <div class="ipt">
                                                <input type="text" class="m_new_nb m_f16" placeholder="请输入手机号码" name="tel" {{ old('tel') }}>
                                                <a id="sendPhoneCodeID">发送验证码</a>
                                            </div>
                                        </div>
                                        <div class="row1 m_new_inp">
                                            <label class="lab m_f16">头像</label>
                                            <div class="ipt">
                                                <input type="file" class="m_new_nb m_f16" name="uface">
                                            </div>
                                        </div>
                                        <div class="row1 m_new_inp">
                                            <div class="ipt">
                                                <input type="text" class="m_new_nb m_f16"
                                                       style="width:11rem; border-right: 1px solid #ccc; margin-right:1rem"
                                                       placeholder="验证码" name="vcode">

                                                <img src="{{ URL('captcha/'.time()) }}" onclick="this.src='{{ URL('captcha') }}/'+Math.random();" width="100" height="34" style="cursor: pointer; vertical-align: -12px">

                                                <img src="{{ URL('/service/validate_code/create') }}" onclick="this.src='{{ URL('/service/validate_code/create') }}?r='+Math.random();" width="100" height="34" style="cursor: pointer; vertical-align: -12px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ops">
                            {{ csrf_field() }}
                            <input class="m_new_u-btn u-btn-c2" type="submit" value="立即注册" style="width: 100%; border: 0;">
                        </div>
                        </form>
                        <p class="m_f14 tc">我有账号？<a href="tel:10103721" style="color:#e41b46;">请登录</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="{{asset('frontend/js/jquery-1.9.1.min.js')}}"></script>
<script>
    $(function(){
        var enable = true;
        $('#sendPhoneCodeID').click(function(){
            if(enable == false){
                return;
            }
            var tel = $('input[name=tel]').val();
            if(tel == ''){
                alert('请输入手机号');
                return;
            }
            if(tel.length != 11 || tel[0] != '1'){
                alert('手机号格式不正确');
                return;
            }

            enable = false;
            var num=60;
            var interval = setInterval(function(){
                $('#sendPhoneCodeID').html(--num+'s 重新发送');
                if(num == 0){
                    enable = true;
                    clearInterval(interval);
                    $('#sendPhoneCodeID').html('重新发送');
                }
            },1000);


            $.ajax({
                type : 'get',
                url : '/service/validate_phone/send',
                dataType : 'json',
                cache : false,
                data : {phone : tel},
                success : function(data){
                    if(data == null){
                        alert('服务端错误');
                        return;
                    }
                    if(data.status != 0){
                        alert(data.message);
                        return;
                    }
                    alert('发送成功');
                },
                error : function(xhr, status, error){
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        });
    });
</script>
