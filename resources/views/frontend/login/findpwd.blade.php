<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>找回密码</title>
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
                            <h2 class="m_sign">找回密码</h2>
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

                        <form action="{{ URL('/findpwd') }}" method="post">
                            <div class="bd">
                                <div class="box">
                                    <div class="itm z-show">
                                        <div class="m-fm">
                                            <div class="row1 m_new_inp">
                                                <label class="lab m_f16">邮箱</label>
                                                <div class="ipt">
                                                    <input type="text" class="m_new_nb m_f16" placeholder="请输入邮箱" name="email" {{ old('email') }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ops">
                                {{ csrf_field() }}
                                <input class="m_new_u-btn u-btn-c2" type="submit" value="点击找回" style="width: 100%; border: 0;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
